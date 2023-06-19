<td class="text-end">
    <div>
        <button data-bs-toggle="dropdown" class="btn btn-primary btn-block" aria-expanded="false">@lang('app.actions')
            <i class="icon ion-ios-arrow-down tx-11 mg-l-3"></i>
        </button>
        <div class="dropdown-menu" style="">
            @can('edit_price_tables')
            <a href="{{route('prices.edit',$model->id)}}" class="dropdown-item">@lang('app.edit')</a>
            @endcan
            @can('delete_price_tables')
            <button role="button" onclick="destroy('{{route('prices.destroy', $model->id)}}')" class="dropdown-item">@lang('app.delete')</button>
            @endcan
        </div>
        <!-- dropdown-menu -->
    </div>
</td>
