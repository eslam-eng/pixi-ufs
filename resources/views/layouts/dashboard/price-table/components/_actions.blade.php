<td class="text-end">
    <div>
        <button data-bs-toggle="dropdown" class="btn btn-primary btn-rounded btn-block" aria-expanded="false">@lang('app.actions')
            <i class="icon ion-ios-arrow-down tx-11 mg-l-3"></i>
        </button>
        <div class="dropdown-menu" style="">
            <a href="{{route('prices.show',$model->id)}}" class="dropdown-item">@lang('app.show')</a>
            <a href="{{route('prices.edit',$model->id)}}" class="dropdown-item">@lang('app.edit')</a>
{{--            <a href="{{route('awbs.edit',$model->id)}}" class="dropdown-item">@lang('app.edit')</a>--}}
            <button role="button" onclick="destroy('{{route('prices.destroy', $model->id)}}')" class="dropdown-item">@lang('app.delete')</button>
        </div>
        <!-- dropdown-menu -->
    </div>
</td>
