<td class="text-end">
    @if(isset($model->errors))
        <div>
            <button id="import_errors" class="btn btn-sm btn-danger">@lang('app.imports errors')</button>
        </div>
    @endif
</td>
