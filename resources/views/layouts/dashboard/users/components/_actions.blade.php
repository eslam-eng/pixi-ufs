<td class="text-end">
    <div>
        <button data-bs-toggle="dropdown" class="btn btn-primary btn-block" aria-expanded="false">@lang('app.actions')
            <i class="icon ion-ios-arrow-down tx-11 mg-l-3"></i>
        </button>
        <div class="dropdown-menu" style="">
            @can('view_users_details')
                <a href="{{route('users.show',$model->id)}}" class="dropdown-item">@lang('app.show')</a>
            @endcan
            @can('edit_users')
                <a href="{{route('users.edit',$model->id)}}" class="dropdown-item">@lang('app.edit')</a>
            @endcan

            @can('delete_users')
                <button role="button" onclick="destroy('{{$url}}')" class="dropdown-item">@lang('app.delete')</button>
                @endcan

        </div>
        <!-- dropdown-menu -->
    </div>
</td>
