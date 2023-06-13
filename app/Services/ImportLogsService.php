<?php

namespace App\Services;

use App\Models\ImportLog;
use App\QueryFilters\ImportLogsFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

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
        $imports = $this->getQuery()->with($withRelations);
        return $imports->filter(new ImportLogsFilter($filters));
    }

    public function datatable(array $filters = [], $withRelations = []): Builder
    {
        $result =  $this->getQuery()->with($withRelations)->select([
            'id','import_type','total_count','success_count','errors','status_id',
            'created_by','created_at',DB::raw('IF(errors IS NOT NULL, true, false) as check_errors'),
        ])->orderByDesc('id');

        return  $result->filter(new ImportLogsFilter($filters));
    }

}
