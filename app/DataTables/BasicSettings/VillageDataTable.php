<?php

namespace App\DataTables\BasicSettings;

use App\Models\BasicSettings\Village;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class VillageDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('division', function ($row) {
                return $row->division->name ?? '';
            })
            ->addColumn('district', function ($row) {
                return $row->district->name ?? '';
            })
            ->addColumn('thana', function ($row) {
                return $row->thana->name ?? '';
            })
            ->addColumn('union', function ($row) {
                return $row->union->name ?? '';
            })
            ->editColumn('en_name', function ($row) {
                return $row->en_name ?? '';
            })
            ->editColumn('bn_name', function ($row) {
                return $row->bn_name ?? '';
            })
            ->addColumn('action', function ($row) {
                $actionBtn = '
                <div class="table-action d-flex align-items-center justify-content-center">
                    <a href="' . route('basic-settings.village.show', $row->id) . '" class="btn btn-sm btn-info mr-1" title="Show" data-toggle="tooltip">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="' . route('basic-settings.village.edit', $row->id) . '" class="btn btn-sm btn-primary mr-1" title="Edit" data-toggle="tooltip">
                        <i class="fa fa-edit"></i>
                    </a>
                    <form action="' . route('basic-settings.village.destroy', $row->id) . '" method="POST" class="deleteData" style="display:inline-block; margin:0;">
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
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    public function query(Village $model): QueryBuilder
    {
        return $model->with(['division', 'district', 'thana', 'union'])->newQuery()->latest();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('village-table')
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
            Column::make('en_name')->title('Village Name'),
            Column::make('bn_name')->title('Bengali Name'),
            Column::make('division')->title('Division')->name('division.name')->orderable(false)->searchable(false),
            Column::make('district')->title('District')->name('district.name')->orderable(false)->searchable(false),
            Column::make('thana')->title('Thana')->name('thana.name')->orderable(false)->searchable(false),
            Column::make('union')->title('Union')->name('union.name')->orderable(false)->searchable(false),
            Column::computed('action')
                ->title('Action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Village_' . date('YmdHis');
    }
}
