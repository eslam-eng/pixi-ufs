<?php

namespace App\DataTables;

use App\Models\Company;
use App\Services\CompanyService;
use App\Services\ReceiverService;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CompaniesDatatable extends DataTable
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
            ->addColumn('branches_count', function (Company $company) {
                return $company->branches->count();
            })
            ->addColumn('departments_count', function (Company $company) {
                return $company->departments->count();
            })
            // ->editColumn('branch_id', function (Company $company) {
            //     return $company->branch->name;
            // })
            ->addColumn('action', function (Company $company) {
                return view(
                    'layouts.dashboard.companies.components._actions',
                    ['model' => $company,'url'=>route('companies.destroy',$company->id)]
                );
            });
    }

    /**
     * @param ReceiverService $model
     * @return QueryBuilder
     */
    public function query(CompanyService $companyService): QueryBuilder
    {
        return $companyService->datatable(filters: $this->filters , withRelations: $this->withRelations);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('companies-table')
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
            Column::make('name')->title(trans('app.company_name'))->orderable(false),
            Column::make('email')->title(trans('app.email'))->orderable(false),
            Column::make('ceo')->title(trans('app.ceo'))->orderable(false),
            Column::make('phone')->title(trans('app.phone'))->searchable(false)->orderable(false),
            Column::make('show_dashboard')->title(trans('app.show_dashboard'))->searchable(false)->orderable(false),
            Column::make('notes')->title(trans('app.notes'))->searchable(false)->orderable(false),
            Column::make('status')->title(trans('app.status'))->searchable(false)->orderable(false),
            Column::make('store_receivers')->title(trans('app.store_receivers'))->searchable(false)->orderable(false),
            Column::make('address')->title(trans('app.address'))->searchable(false)->orderable(false),
            Column::make('num_custom_fields')->title(trans('app.num_custom_fields'))->searchable(false)->orderable(false),
            Column::make('city_id')->title(trans('app.city'))->searchable(false)->orderable(false),
            Column::make('area_id')->title(trans('app.area'))->searchable(false)->orderable(false),
            Column::make('branches_count')->title(trans('app.branches_count'))->searchable(false)->orderable(false),
            Column::make('departments_count')->title(trans('app.departments_count'))->searchable(false)->orderable(false),
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
        return 'Companies_' . date('YmdHis');
    }
}
