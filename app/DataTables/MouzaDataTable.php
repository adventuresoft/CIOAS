<?php

namespace App\DataTables;

use App\Models\Mouza;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class MouzaDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('district', function ($row) {
                return $row->district->name ?? '';
            })
            ->addColumn('upazila', function ($row) {
                return $row->upazila->name ?? '';
            })
            ->editColumn('status', function ($row) {
                if ($row->status == 1) {
                    return '<span class="badge bg-success">Active</span>';
                } else {
                    return '<span class="badge bg-danger">Inactive</span>';
                }
            })
            ->addColumn('action', function ($row) {
                $actionBtn = '
                <div class="table-action d-flex align-items-center justify-content-center">
                    <a href="' . route('basic-settings.mouza.show', $row->id) . '" class="btn btn-sm btn-info mr-1" title="Show" data-toggle="tooltip">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="' . route('basic-settings.mouza.edit', $row->id) . '" class="btn btn-sm btn-primary mr-1" title="Edit" data-toggle="tooltip">
                        <i class="fa fa-edit"></i>
                    </a>
                    <form action="' . route('basic-settings.mouza.destroy', $row->id) . '" method="POST" class="deleteData" style="display:inline-block; margin:0;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-sm btn-danger" title="Delete" data-toggle="tooltip">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </div>
                ';
                return $actionBtn;
            })
            ->rawColumns(['status', 'action'])
            ->setRowId('id');
    }

    public function query(Mouza $model): QueryBuilder
    {
        return $model->with(['district', 'upazila'])->newQuery()->orderBy('created_at', 'desc');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('mouza-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->parameters([
                // 'dom'          => 'Bfrtip',
                // 'buttons'      => ['excel', 'csv', 'pdf', 'print', 'reset', 'reload'],
                'initComplete' => "function() {
                    $('.dataTables_filter input').attr('placeholder', 'অনুসন্ধান করুন...');
                }",
                'language' => [
                    'search' => '',
                    'searchPlaceholder' => 'অনুসন্ধান করুন...',
                    'lengthMenu' => '_MENU_ রেকর্ড প্রতি পৃষ্ঠায়',
                    'zeroRecords' => 'কোনো রেকর্ড পাওয়া যায়নি',
                    'info' => '_TOTAL_ টি রেকর্ডের মধ্যে _START_ থেকে _END_ পর্যন্ত দেখানো হচ্ছে',
                    'infoEmpty' => 'কোনো রেকর্ড উপলব্ধ নেই',
                    'infoFiltered' => '(মোট _MAX_ রেকর্ড থেকে ফিল্টার করা হয়েছে)',
                    'paginate' => [
                        'first' => 'প্রথম',
                        'last' => 'শেষ',
                        'next' => 'পরবর্তী',
                        'previous' => 'পূর্ববর্তী'
                    ],
                ],
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('SL')->searchable(false)->orderable(false)->width(50)->addClass('text-center'),
            Column::make('bn_name')->title('Bengali Name'),
            Column::make('name')->title('English Name'),
            Column::make('record')->title('Record'),
            Column::make('district')->title('District')->name('district.name'),
            Column::make('upazila')->title('Upazila/Circle')->name('upazila.name'),
            Column::make('code')->title('Code'),
            Column::make('order')->title('Order'),
            Column::make('status')->title('Status')->addClass('text-center'),
            Column::computed('action')
                ->title('Action')
                ->exportable(false)
                ->printable(false)
                ->width(150)
                ->addClass('text-center'),
        ];
    }
}
