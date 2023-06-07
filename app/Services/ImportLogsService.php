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

    public function importLogsQueryBuilder(array $filters = [], array $withRelations = []): Builder
    {
        $addresses = $this->getQuery()->with($withRelations);
        return $addresses->filter(new ImportLogsFilter($filters));
    }

    public function datatable(array $filters = [], $withRelations = []): Builder
    {
        return $this->importLogsQueryBuilder(filters: $filters, withRelations: $withRelations)->orderByDesc('id');
    }

}
