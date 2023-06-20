<td class="text-end">
    <div>
        <button data-bs-toggle="dropdown" class="btn btn-primary btn-block" aria-expanded="false">@lang('app.actions')
            <i class="icon ion-ios-arrow-down tx-11 mg-l-3"></i>
        </button>
        <div class="dropdown-menu" style="">
            @can('view_shipment')
                <a href="{{route('awbs.show',$model->id)}}" class="dropdown-item">@lang('app.show')</a>
            @endcan
            @can('edit_shipment')
{{--            <a href="{{route('receivers.edit',$model->id)}}" class="dropdown-item">@lang('app.edit')</a>--}}
            @endcan
            @can('delete_shipment')
            <button role="button" onclick="destroy('{{$url}}')" class="dropdown-item">@lang('app.delete')</button>
            @endcan
        </div>
        <!-- dropdown-menu -->
    </div>
</td>
