<?php

namespace App\DataTables;

use App\Models\CaseOrder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CaseOrderDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('id', function ($row) {
                return '<span class="hearing-badge">' . sprintf('H%05d', $row->id) . '</span>';
            })
            ->editColumn('mis_case_id', function ($row) {
                return $row->misCase ? '<strong>' . e($row->misCase->case_no) . '</strong>' : '—';
            })
            ->editColumn('next_hearing_date', function ($row) {
                $dateStr = $row->next_hearing_date ? $row->next_hearing_date->format('d/m/Y') : '—';
                if ($row->next_hearing_time) {
                    $dateStr .= '<br><small class="text-muted">' . e($row->next_hearing_time) . '</small>';
                }
                return $dateStr;
            })
            ->addColumn('case_type_label', function ($row) {
                return $row->misCase ? ($row->misCase->case_type_label ?? '—') : '—';
            })
            ->addColumn('plaintiffs', function ($row) {
                $misCase = $row->misCase;
                return $misCase && !empty($misCase->plaintiffs) ? ($misCase->plaintiffs[0]['name'] ?? '—') : '—';
            })
            ->addColumn('defendants', function ($row) {
                $misCase = $row->misCase;
                return $misCase && !empty($misCase->defendants) ? ($misCase->defendants[0]['name'] ?? '—') : '—';
            })
            ->editColumn('status', function ($row) {
                return '<span class="status-badge ' . e($row->status_class) . '">' . e($row->status_label) . '</span>';
            })
            ->addColumn('action', function ($row) {
                $misCaseId = $row->misCase ? $row->misCase->id : $row->mis_case_id;
                
                $editButton = '<a href="' . route('caseorder.edit', $row->id) . '" class="action-btn btn-clock mr-1" title="তারিখ পরিবর্তন" data-toggle="tooltip"><i class="fas fa-clock"></i></a>';
                $showButton = '<a href="' . route('caseorder.show', $misCaseId) . '" class="action-btn btn-eye mr-1" title="ইতিহাস দেখুন" data-toggle="tooltip"><i class="fas fa-eye"></i></a>';
                $registerButton = '<a href="' . route('caseorder.register', $misCaseId) . '" class="action-btn btn-order" title="অর্ডার যোগ করুন" data-toggle="tooltip"><i class="fas fa-edit"></i></a>';
                
                return '<div class="table-action d-flex align-items-center justify-content-center">' . $editButton . $showButton . $registerButton . '</div>';
            })
            ->filterColumn('mis_case_id', function ($query, $keyword) {
                $query->whereHas('misCase', function ($q) use ($keyword) {
                    $q->where('case_no', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('case_type_label', function ($query, $keyword) {
                $matchingKeys = [];
                foreach (\App\Models\MisCase::CASE_TYPES as $key => $label) {
                    if (mb_strpos($label, $keyword) !== false || mb_strpos($key, $keyword) !== false) {
                        $matchingKeys[] = $key;
                    }
                }
                if (!empty($matchingKeys)) {
                    $query->whereHas('misCase', function ($q) use ($matchingKeys) {
                        $q->whereIn('case_type', $matchingKeys);
                    });
                } else {
                    $query->whereRaw('1 = 0');
                }
            })
            ->filterColumn('plaintiffs', function ($query, $keyword) {
                $query->whereHas('misCase', function ($q) use ($keyword) {
                    $q->where('plaintiffs', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('defendants', function ($query, $keyword) {
                $query->whereHas('misCase', function ($q) use ($keyword) {
                    $q->where('defendants', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('next_hearing_date', function ($query, $keyword) {
                if (preg_match('/^(\d{2})\/(\d{2})\/(\d{4})$/', $keyword, $matches)) {
                    $dbDate = "{$matches[3]}-{$matches[2]}-{$matches[1]}";
                    $query->whereDate('next_hearing_date', '=', $dbDate);
                } else {
                    $query->where('next_hearing_date', 'like', '%' . $keyword . '%');
                }
            })
            ->filterColumn('status', function ($query, $keyword) {
                $query->where('status', 'like', '%' . $keyword . '%');
            })
            ->rawColumns(['id', 'mis_case_id', 'next_hearing_date', 'status', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(CaseOrder $model): QueryBuilder
    {
        return $model->newQuery()
            ->with('misCase')
            ->whereIn('case_orders.id', function ($query) {
                $query->selectRaw('MAX(id)')
                    ->from('case_orders')
                    ->groupBy('mis_case_id');
            })
            ->orderBy('case_orders.created_at', 'desc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('case-order-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->addTableClass('table table-bordered table-striped')
            ->parameters([
                'language' => [
                    'search' => 'খুঁজুন:',
                    'lengthMenu' => 'প্রদর্শন করুন _MENU_ টি রেকর্ড',
                    'info' => 'মোট _TOTAL_ টি রেকর্ডের মধ্যে _START_ থেকে _END_ দেখানো হচ্ছে',
                    'infoEmpty' => 'কোনো রেকর্ড নেই',
                    'infoFiltered' => '(মোট _MAX_ টি রেকর্ড থেকে ফিল্টার করা হয়েছে)',
                    'zeroRecords' => 'কোনো মেলানো রেকর্ড পাওয়া যায়নি',
                    'paginate' => [
                        'first' => 'প্রথম',
                        'previous' => 'পূর্ববর্তী',
                        'next' => 'পরবর্তী',
                        'last' => 'শেষ'
                    ]
                ]
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->title('শুনানি নং')->addClass('text-center'),
            Column::make('mis_case_id')->title('কেস নং'),
            Column::make('next_hearing_date')->title('পরবর্তী শুনানি'),
            Column::make('case_type_label')->title('মামলার ধরণ')->searchable(true)->orderable(false),
            Column::make('plaintiffs')->title('বাদী')->searchable(true)->orderable(false),
            Column::make('defendants')->title('বিবাদী')->searchable(true)->orderable(false),
            Column::make('status')->title('স্ট্যাটাস'),
            Column::computed('action')->title('পদক্ষেপ')
                ->exportable(false)
                ->printable(false)
                ->width(140)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'CaseOrder_' . date('YmdHis');
    }
}
