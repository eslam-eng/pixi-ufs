<?php

namespace App\DataTables;

use App\Models\Awb;
use App\Services\AwbService;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AwbsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->addColumn('check_box', function (Awb $awb) {
                return view(
                    'layouts.components._datatable-checkbox',
                    ['name' => "awbs[]",'value'=>$awb->id]
                );
            })
            ->editColumn('company_id',function (Awb $awb){
                return $awb->branch->company->name ;
            })
            ->editColumn('branch_id',function (Awb $awb){
                return $awb->branch->name ;
            })
            ->editColumn('department_id',function (Awb $awb){
                return $awb->department->name ;
            })

            ->editColumn('created_at',function (Awb $awb){
                return $awb->created_at->format('Y-m-d') ;
            })

            ->addColumn('receiver',function (Awb $awb){
               return Arr::get($awb->receiver_data , 'name');
            })
            ->addColumn('address',function (Awb $awb){
                return Str::limit(Arr::get($awb->receiver_data , 'default_address.address'), 30); ;
            })

            ->addColumn('action', function (Awb $awb) {
                return view(
                    'layouts.dashboard.receivers.components._actions',
                    ['model' => $awb,'url'=>route('receivers.destroy',$awb->id)]
                );
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Awb $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(AwbService $awbService): QueryBuilder
    {
        return $awbService->datatable(filters: $this->filters, withRelations: $this->withRelations);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('awbs-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('check_box')->title('#')->searchable(false)->orderable(false),
            Column::make('code')->title(trans('app.awb_code')),
            Column::make('company_id')->title(trans('app.company'))->searchable(false)->orderable(false),
            Column::make('branch_id')->title(trans('app.branch'))->searchable(false)->orderable(false),
            Column::make('department_id')->title(trans('app.department'))->searchable(false)->orderable(false),
            Column::make('receiver')->title(trans('app.awb_receiver'))->searchable(false)->orderable(false),
            Column::make('address')->title(trans('app.address'))->searchable(false)->orderable(false),
            Column::make('created_at')->title(trans('app.created_at'))->searchable(false)->orderable(false),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Awbs_' . date('YmdHis');
    }
}
