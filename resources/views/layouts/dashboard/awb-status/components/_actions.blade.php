<td class="text-end">
    <div>
        <button data-bs-toggle="dropdown" class="btn btn-primary btn-block" aria-expanded="false">@lang('app.actions')
            <i class="icon ion-ios-arrow-down tx-11 mg-l-3"></i>
        </button>
        <div class="dropdown-menu" style="">
            <a href="{{route('awb-status.edit',$model->id)}}" class="dropdown-item">@lang('app.edit')</a>
            <button role="button" onclick="destroy('{{route('awb-status.destroy', $model->id)}}')" class="dropdown-item">@lang('app.delete')</button>
        </div>
        <!-- dropdown-menu -->
    </div>
</td>
