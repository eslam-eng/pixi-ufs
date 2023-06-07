<div>
    <div class="main-content-label mg-b-5">@lang('app.'.$service_type_title)</div>
    <select class="form-select form-control"
            id="service_type" name="{{$service_type_field_name}}"
            aria-label="Select service type">
        @foreach($options as $service)
            <option value="{{$service->id}}"
                    @if(!is_null($selected) && ($service->name == $selected)) selected @endif
            >{{$service->name}}</option>
        @endforeach
    </select>
</div>
