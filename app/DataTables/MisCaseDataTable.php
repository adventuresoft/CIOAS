<?php

namespace App\DataTables;

use App\Models\MisCase;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class MisCaseDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('case_date', function($row) {
                return $row->case_date ? $row->case_date->format('d/m/Y') : '—';
            })
            ->addColumn('case_type_label', function($row) {
                return $row->case_type_label ?? '—';
            })
            ->addColumn('plaintiffs', function($row) {
                $names = [];
                if (!empty($row->plaintiffs)) {
                    foreach ($row->plaintiffs as $p) {
                        if (!empty($p['name'])) {
                            $names[] = $p['name'];
                        }
                    }
                }
                return !empty($names) ? implode(', ', $names) : '—';
            })
            ->addColumn('defendants', function($row) {
                $names = [];
                if (!empty($row->defendants)) {
                    foreach ($row->defendants as $d) {
                        if (!empty($d['name'])) {
                            $names[] = $d['name'];
                        }
                    }
                }
                return !empty($names) ? implode(', ', $names) : '—';
            })
            ->editColumn('status', function($row) {
                $statusClass = $row->status;
                $statusLabel = ucfirst($row->status);
                return '<span class="status-badge ' . $statusClass . '">' . $statusLabel . '</span>';
            })
            ->addColumn('action', function($row) {
                $showUrl = route('miscase.show', $row->id);
                $editUrl = route('miscase.edit', $row->id);
                $deleteUrl = route('miscase.destroy', $row->id);
                $indexUrl = route('miscase.index');
                $csrfToken = csrf_token();

                $editButton = '';
                if ($row->status !== 'closed') {
                    $editButton = '<a href="' . $editUrl . '" class="action-btn btn-edit" title="Edit" data-toggle="tooltip">
                        <i class="fas fa-edit"></i>
                    </a>';
                }

                return '<div style="display:flex;gap:6px;align-items:center;">
                    <a href="' . $showUrl . '" class="action-btn btn-eye" title="Show" data-toggle="tooltip">
                        <i class="fas fa-eye"></i>
                    </a>
                    ' . $editButton . '
                    <form class="deleteData" method="post" style="margin:0;">
                        <input type="hidden" name="_token" value="' . $csrfToken . '">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" class="deleteUrl" name="deleteUrl" value="' . $deleteUrl . '">
                        <input type="hidden" class="redirect-url" name="redirectUrl" value="' . $indexUrl . '">
                        <button type="submit" class="action-btn btn-delete" title="Delete" data-toggle="tooltip">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>';
            })
            ->filterColumn('case_date', function($query, $keyword) {
                if (preg_match('/^(\d{2})\/(\d{2})\/(\d{4})$/', $keyword, $matches)) {
                    $dbDate = "{$matches[3]}-{$matches[2]}-{$matches[1]}";
                    $query->where('case_date', '=', $dbDate);
                } else {
                    $query->where('case_date', 'like', '%' . $keyword . '%');
                }
            })
            ->filterColumn('case_type_label', function($query, $keyword) {
                $matchingKeys = [];
                foreach (MisCase::CASE_TYPES as $key => $label) {
                    if (mb_strpos($label, $keyword) !== false || mb_strpos($key, $keyword) !== false) {
                        $matchingKeys[] = $key;
                    }
                }
                if (!empty($matchingKeys)) {
                    $query->whereIn('case_type', $matchingKeys);
                } else {
                    $query->whereRaw('1 = 0');
                }
            })
            ->filterColumn('plaintiffs', function($query, $keyword) {
                $query->where('plaintiffs', 'like', '%' . $keyword . '%');
            })
            ->filterColumn('defendants', function($query, $keyword) {
                $query->where('defendants', 'like', '%' . $keyword . '%');
            })
            ->filterColumn('status', function($query, $keyword) {
                $query->where('status', 'like', '%' . $keyword . '%');
            })
            ->rawColumns(['status', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(MisCase $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('misCaseTable')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1, 'desc')
            ->addTableClass('mc-table table table-bordered table-striped')
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
            Column::make('case_no')->title('Case No'),
            Column::make('case_date')->title('Date'),
            Column::make('case_type_label')->title('মামলার ধরণ'),
            Column::make('plaintiffs')->title('বাদী'),
            Column::make('defendants')->title('বিবাদী'),
            Column::make('status')->title('স্ট্যাটাস'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(120)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'MisCase_' . date('YmdHis');
    }
}
