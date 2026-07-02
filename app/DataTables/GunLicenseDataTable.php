<?php

namespace App\DataTables;

use Illuminate\Support\Collection;
use Yajra\DataTables\CollectionDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class GunLicenseDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param Collection $collection Results from collection() method.
     */
    public function dataTable(Collection $collection): CollectionDataTable
    {
        return datatables()->collection($collection)
            ->addIndexColumn()
            ->editColumn('tracking_no', function ($row) {
                $routePrefix = $this->getRoutePrefix($row);
                return '<a href="' . route($routePrefix . '.show', $row->id) . '">
                            <strong class="text-primary">' . $row->tracking_no . '</strong>
                        </a>';
            })
            ->editColumn('name', function ($row) {
                return '<strong>' . $row->name . '</strong>';
            })
            ->editColumn('license_type', function ($row) {
                if ($row->type === 'person') {
                    return '<span class="badge badge-success">' . $row->license_type . '</span>';
                } elseif ($row->type === 'org') {
                    return '<span class="badge badge-primary">' . $row->license_type . '</span>';
                } else {
                    return '<span class="badge badge-danger">' . $row->license_type . '</span>';
                }
            })
            ->editColumn('phone', function ($row) {
                return $row->phone ?? 'N/A';
            })
            ->editColumn('weapon', function ($row) {
                return '<span class="badge badge-info">' . $row->weapon . '</span>';
            })
            ->editColumn('status', function ($row) {
                $classes = [
                    'Submitted' => 'badge-submitted',
                    'Verified' => 'badge-verified',
                    'Interviewed' => 'badge-interviewed',
                    'Approved' => 'badge-approved',
                    'Rejected' => 'badge-rejected',
                ];
                $class = $classes[$row->status] ?? 'badge-secondary';
                return '<span class="badge ' . $class . '">' . $row->status . '</span>';
            })
            ->addColumn('verification_col', function ($row) {
                $routePrefix = $this->getRoutePrefix($row);
                if ($row->has_verification) {
                    return '<span class="text-success"><i class="fas fa-check-circle"></i> Completed</span>';
                } else {
                    return '<a href="' . route($routePrefix . '.verification.create', $row->id) . '" class="btn btn-xs btn-outline-primary"><i class="fas fa-shield-alt"></i> Fill Appendix-7</a>';
                }
            })
            ->addColumn('interview_col', function ($row) {
                $routePrefix = $this->getRoutePrefix($row);
                if ($row->has_interview) {
                    return '<span class="text-success"><i class="fas fa-check-circle"></i> Completed</span>';
                } else {
                    if ($row->status == 'Verified' || $row->status == 'Interviewed') {
                        return '<a href="' . route($routePrefix . '.interview.create', $row->id) . '" class="btn btn-xs btn-outline-purple" style="color: #8b5cf6; border-color: #8b5cf6;"><i class="fas fa-microphone"></i> Fill Appendix-8</a>';
                    } else {
                        return '<span class="text-muted"><i class="fas fa-lock"></i> Pending</span>';
                    }
                }
            })
            ->addColumn('action', function ($row) {
                $routePrefix = $this->getRoutePrefix($row);
                $html = '<div class="btn-group btn-group-sm" role="group" style="gap: 2px;">';
                $html .= '<a href="' . route($routePrefix . '.show', $row->id) . '" class="btn btn-info text-white" style="border-radius: 4px; padding: 4px 10px;" title="View"><i class="fas fa-eye"></i></a>';
                
                if (in_array($row->status, ['Submitted', 'Verified', 'Interviewed'])) {
                    $html .= '<form action="' . route($routePrefix . '.approve', $row->id) . '" method="POST" onsubmit="event.preventDefault(); Swal.fire({title: \'আবেদন অনুমোদন?\', text: \'আপনি কি এই আবেদনটি অনুমোদন করতে চান?\', icon: \'question\', showCancelButton: true, confirmButtonColor: \'#0f766e\', cancelButtonColor: \'#475569\', confirmButtonText: \'হ্যাঁ, অনুমোদন করুন!\', cancelButtonText: \'বাতিল\'}).then((result) => { if (result.isConfirmed) { this.submit(); } });" style="display:inline-block; margin:0;">
                                ' . csrf_field() . '
                                <button type="submit" class="btn btn-success" style="border-radius: 4px; padding: 4px 10px;" title="Approve"><i class="fas fa-check-circle"></i></button>
                            </form>';
                    $html .= '<form action="' . route($routePrefix . '.reject', $row->id) . '" method="POST" onsubmit="event.preventDefault(); Swal.fire({title: \'আবেদন প্রত্যাখ্যান?\', text: \'আপনি কি এই আবেদনটি প্রত্যাখ্যান করতে চান?\', icon: \'warning\', showCancelButton: true, confirmButtonColor: \'#dc2626\', cancelButtonColor: \'#475569\', confirmButtonText: \'হ্যাঁ, প্রত্যাখ্যান করুন!\', cancelButtonText: \'বাতিল\'}).then((result) => { if (result.isConfirmed) { this.submit(); } });" style="display:inline-block; margin:0;">
                                ' . csrf_field() . '
                                <button type="submit" class="btn btn-danger" style="border-radius: 4px; padding: 4px 10px;" title="Reject"><i class="fas fa-times-circle"></i></button>
                            </form>';
                }
                $html .= '</div>';
                return $html;
            })
            ->rawColumns(['tracking_no', 'name', 'license_type', 'weapon', 'status', 'verification_col', 'interview_col', 'action']);
    }

    private function getRoutePrefix($row)
    {
        if ($row->type === 'person') {
            return 'gun-license.person';
        } elseif ($row->type === 'org') {
            return 'gun-license.org';
        } else {
            return 'gun-license.other-org';
        }
    }

    /**
     * Override ajax method to serve collection data correctly.
     */
    public function ajax(): \Illuminate\Http\JsonResponse
    {
        return $this->dataTable($this->collection())->toJson();
    }

    /**
     * Get the query source of dataTable.
     */
    public function collection(): Collection
    {
        return $this->collection ?? collect([]);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('unifiedLicensesTable')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0) // Default order Sl.
            ->addTableClass('table table-bordered table-striped table-hover cioas-datatable')
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
                ],
                'initComplete' => "function () {
                    // Match the design_tem styling
                    $('.dataTables_length select').addClass('form-select form-select-sm').css('display', 'inline-block').css('width', 'auto');
                    $('.dataTables_filter input').addClass('form-control form-control-sm').css('display', 'inline-block').css('width', 'auto');
                }"
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('Sl.')->searchable(false)->orderable(false)->width(50),
            Column::make('tracking_no')->title('Tracking No')->name('tracking_no'),
            Column::make('name')->title('আবেদনকারী/প্রতিষ্ঠানের নাম')->name('name'),
            Column::make('license_type')->title('লাইসেন্সের ধরণ')->name('license_type')->orderable(false),
            Column::make('phone')->title('মোবাইল নম্বর')->name('phone'),
            Column::make('weapon')->title('চাহিত আগ্নেয়াস্ত্র')->name('weapon')->orderable(false),
            Column::make('status')->title('অবস্থা')->name('status'),
            Column::computed('verification_col')
                  ->title('তদন্ত প্রতিবেদন')
                  ->exportable(false)
                  ->printable(false)
                  ->searchable(false)
                  ->orderable(false),
            Column::computed('interview_col')
                  ->title('সাক্ষাৎকার')
                  ->exportable(false)
                  ->printable(false)
                  ->searchable(false)
                  ->orderable(false),
            Column::computed('action')
                  ->title('Action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(120)
                  ->addClass('text-center')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'GunLicense_' . date('YmdHis');
    }
}

