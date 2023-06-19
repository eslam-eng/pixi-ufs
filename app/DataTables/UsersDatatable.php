<?php

namespace App\DataTables;

use App\Enums\UsersType;
use App\Models\User;
use App\Services\ReceiverService;
use App\Services\UserService;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Str;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UsersDatatable extends DataTable
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
            ->editColumn('company_id', function (User $user) {
                return $user->company->name ?? "";
            })
            ->editColumn('status', function (User $user) {
                return $user->status ? trans('app.yes'):trans('app.no');
            })
            ->editColumn('type', function (User $user) {
                return UsersType::from($user->type)->name;
            })
            ->editColumn('branch_id', function (User $user) {
                return $user->branch->name ?? "";
            })
            ->editColumn('department_id', function (User $user) {
                return $user->department->name ?? "";
            })
            ->editColumn('city_id', function (User $user) {
                return $user->city->title ?? "";
            })
            ->editColumn('area_id', function (User $user) {
                return $user->area->title ?? "";
            })
            ->editColumn('address', function (User $user) {
                return Str::limit($user->address,30);
            })
            ->addColumn('action', function (User $user) {
                return view(
                    'layouts.dashboard.users.components._actions',
                    ['model' => $user,'url'=>route('users.destroy',$user->id)]
                );
            });
    }

    /**
     * @param ReceiverService $model
     * @return QueryBuilder
     */
    public function query(UserService $userService): QueryBuilder
    {
        return $userService->datatable(filters: $this->filters , withRelations: $this->withRelations);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('users-table')
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
            Column::make('email')->title(trans('app.email'))->orderable(false),
            Column::make('phone')->title(trans('app.phone'))->orderable(false),
            Column::make('status')->title(trans('app.status'))->orderable(false),
            Column::make('type')->title(trans('app.type'))->orderable(false)->searchable(false),
            Column::make('company_id')->title(trans('app.company'))->searchable(false)->orderable(false),
            Column::make('branch_id')->title(trans('app.branch'))->searchable(false)->orderable(false),
            Column::make('department_id')->title(trans('app.department'))->searchable(false)->orderable(false),
            Column::make('address')->title(trans('app.address'))->searchable(false)->orderable(false),
            Column::make('city_id')->title(trans('app.city'))->searchable(false)->orderable(false),
            Column::make('area_id')->title(trans('app.area'))->searchable(false)->orderable(false),
            Column::make('notes')->title(trans('app.notes'))->searchable(false)->orderable(false),
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
        return 'Users_' . date('YmdHis');
    }
}
