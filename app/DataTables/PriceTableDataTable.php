<?php

namespace App\DataTables;

use App\Models\PriceTable;
use App\Models\Receiver;
use App\Services\PriceTableService;
use App\Services\ReceiverService;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Str;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PriceTableDataTable extends DataTable
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
            ->addColumn('company_id', function (PriceTable $priceTable) {
                return $priceTable->company->name;
            })
            ->editColumn('location_from', function (PriceTable $priceTable) {
                return $priceTable->city->title;
            })
            ->editColumn('location_to', function (PriceTable $priceTable) {
                return $priceTable->area->title;
            })
            ->addColumn('action', function (PriceTable $priceTable) {
                return view(
                    'layouts.dashboard.price-table.components._actions',
                    ['model' => $priceTable,'url'=>route('receivers.destroy',$priceTable->id)]
                );
            });
    }

    /**
     * @param ReceiverService $model
     * @return QueryBuilder
     */
    public function query(PriceTableService $priceTableService): QueryBuilder
    {
        return $priceTableService->priceTableQueryBuilder(filters: $this->filters , withRelations: $this->withRelations);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('prices-table')
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
            Column::make('company_id')->title(trans('app.receiver_name'))->orderable(false),
            Column::make('location_from')->title(trans('app.from'))->searchable(false)->orderable(false),
            Column::make('location_to')->title(trans('app.to'))->searchable(false)->orderable(false),
            Column::make('price')->title(trans('app.price'))->orderable(false),
            Column::make('basic_kg')->title(trans('app.basic_kg'))->orderable(false)->searchable(false),
            Column::make('additional_kg_price')->title(trans('app.additional_kg_price'))->orderable(false),
            Column::make('return_price')->title(trans('app.return_price'))->searchable(false)->orderable(false),
            Column::make('special_price')->title(trans('app.special_price'))->searchable(false)->orderable(false),
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
        return 'prices' . date('YmdHis');
    }
}
