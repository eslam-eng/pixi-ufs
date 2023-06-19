<td class="text-end">
    <div>
        <button data-bs-toggle="dropdown" class="btn btn-rounded btn-primary btn-block" aria-expanded="false">@lang('app.actions')
            <i class="icon ion-ios-arrow-down tx-11 mg-l-3"></i>
        </button>
        <div class="dropdown-menu" style="">
            <a href="{{route('companies.show',$model->id)}}" class="dropdown-item">@lang('app.show')</a>
            @can('edit_companies')
            <a href="{{route('companies.edit',$model->id)}}" class="dropdown-item">@lang('app.edit')</a>
            @endcan
            @can('delete_companies')
            <button role="button" onclick="destroy('{{$url}}')" class="dropdown-item">@lang('app.delete')</button>
            @endcan
        </div>
        <!-- dropdown-menu -->
    </div>
</td>
