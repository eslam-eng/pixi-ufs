<?php

namespace App\Services;

use App\Models\ImportLog;
use App\QueryFilters\ImportLogsFilter;
use Illuminate\Database\Eloquent\Builder;

class ImportLogsService extends BaseService
{

    public function __construct(public ImportLog $model)
    {
    }

    public function getModel(): ImportLog
    {
        return $this->model;
    }

    //method for api with pagination
    public function listing(array $filters = [], $withRelations = [], $perPage = 10): \Illuminate\Contracts\Pagination\CursorPaginator
    {
        return $this->importLogsQueryBuilder(filters: $filters, withRelations: $withRelations)->cursorPaginate($perPage);
    }

    public function importLogsQueryBuilder(array $filters = [], array $withRelations = []): Builder
    {
        $addresses = $this->getQuery()->with($withRelations);
        return $addresses->filter(new ImportLogsFilter($filters));
    }

}
