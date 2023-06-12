<?php

namespace App\DataTables;

use App\Models\ImportLog;
use App\Services\ImportLogsService;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ImportLogsDatatable extends DataTable
{
    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Awb $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ImportLogsService $awbService): QueryBuilder
    {
        return $awbService->datatable(filters: $this->filters, withRelations: $this->withRelations);
    }

    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)

            ->addColumn('success_count', function (ImportLog $model) {
                return $model->success_count;
            })
            ->editColumn('import_type', function (ImportLog $model) {
                return  $model->import_type_text;
            })
            ->editColumn('created_by', function (ImportLog $model) {
                return $model->user->name;
            })
            // ->editColumn('created_at', function (ImportLog $model) {
            //     return $model->created_at->format("Y-m-d");
            // })
            ->addColumn('company', function (ImportLog $model) {
                return $model->user?->company?->name;

            })
            ->addColumn('branch', function (ImportLog $model) {
                return $model->user?->branch?->name;
            })
            ->addColumn('department', function (ImportLog $model) {
                return $model->user?->department?->name;
            })
            ->editColumn('status_id', function (ImportLog $model) {
                return  $model->status_text;
            })
            ->addColumn('action', function (ImportLog $model) {
                return view('layouts.dashboard.Imports.components._actions', compact('model'));
            });
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('import-logs-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1);
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
            Column::make('total_count')->title(trans('app.total_count'))->searchable(false)->orderable(false),
            Column::make('success_count')->title(trans('app.success_count'))->searchable(false)->orderable(false),
            Column::make('created_by')->title(trans('app.user'))->searchable(false)->orderable(false),
            Column::make('company')->title(trans('app.company'))->searchable(false)->orderable(false),
            Column::make('branch')->title(trans('app.branch'))->searchable(false)->orderable(false),
            Column::make('department')->title(trans('app.department'))->searchable(false)->orderable(false),
            Column::make('import_type')->title(trans('app.import_type'))->searchable(false)->orderable(false),
            Column::make('status_id')->title(trans('app.status'))->searchable(false)->orderable(false),
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
        return 'import_logs_' . date('YmdHis');
    }
}
