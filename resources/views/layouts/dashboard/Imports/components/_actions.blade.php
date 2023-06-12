<td class="text-end">
    @if(isset($model->errors))
        <div>
            <button href="{{ route('import-logs.errors', $model->id) }}" class="import_errors btn btn-sm btn-danger">@lang('app.imports errors')</button>
        </div>
    @endif
</td>
