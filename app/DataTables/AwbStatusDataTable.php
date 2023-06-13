<?php

namespace App\DataTables;

use App\Enums\AwbStatusCategory;
use App\Enums\AwbStatuses;
use App\Enums\Stepper;
use App\Models\AwbStatus;
use App\Models\PriceTable;
use App\Services\AwbStatusService;
use App\Services\PriceTableService;
use App\Services\ReceiverService;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AwbStatusDataTable extends DataTable
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
            ->editColumn('code', function (AwbStatus $awbStatus) {
                return AwbStatuses::from($awbStatus->code)->name;
            })
            ->editColumn('is_final', function (AwbStatus $awbStatus) {
                return $awbStatus->is_final ? trans('app.yes'):trans('app.no');
            })
            ->editColumn('stepper', function (AwbStatus $awbStatus) {
                return Stepper::from($awbStatus->stepper)->name;
            })
            ->editColumn('type', function (AwbStatus $awbStatus) {
                return AwbStatusCategory::from($awbStatus->type)->name;
            })
            ->addColumn('action', function (AwbStatus $awbStatus) {
                return view(
                    'layouts.dashboard.awb-status.components._actions',
                    ['model' => $awbStatus,'url'=>route('awb-status.destroy',$awbStatus->id)]
                );
            });
    }

    /**
     * @param ReceiverService $model
     * @return QueryBuilder
     */
    public function query(AwbStatusService $awbStatusService): QueryBuilder
    {
        return $awbStatusService->AwbStatusQueryBuilder(filters: $this->filters);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('awbStatus-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->title("#"),
            Column::make('name')->title(trans('app.name'))->orderable(false),
            Column::make('code')->title(trans('app.code'))->searchable(false)->orderable(false),
            Column::make('is_final')->title(trans('app.is_final'))->searchable(false)->orderable(false),
            Column::make('stepper')->title(trans('app.stepper'))->orderable(false),
            Column::make('type')->title(trans('app.type'))->orderable(false)->searchable(false),
            Column::make('sms')->title(trans('app.sms'))->orderable(false),
            Column::make('description')->title(trans('app.description'))->searchable(false)->orderable(false),
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
        return 'AwbStatus' . date('YmdHis');
    }
}
