<td class="text-end">
    @if(isset($model->errors))
        <div>
            <button href="{{route('receivers.show',$model->id)}}" class="btn btn-sm btn-danger">@lang('app.imports errors')</button>
        </div>
    @endif
</td>
