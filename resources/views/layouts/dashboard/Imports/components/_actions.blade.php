<td class="text-end">

    @if($model->check_errors)
        <button data-href="{{route('import-logs.errors', $model->id)}}"
                class="btn btn-sm btn-danger show_import_errors">
            @lang('admin.imports.errors')
        </button>
    @endif

</td>
