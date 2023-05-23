<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="main-content-label mg-b-5">@lang('app.service_types')</div>
        <select class="form-select" wire:model="service_type"
                id="city_id" name="{{$city_field_name}}"
                aria-label="Select location">
            <option  @if(is_null($city_id)) selected @endif>@lang('app.select_city')</option>
            @foreach($cities as $city)
                <option value="{{$city->id}}"
                        wire:key="city-{{$city->id}}"
                        @if(!is_null($city_id) && ($city->id == $city_id)) selected @endif
                >{{$city->title}}</option>
            @endforeach
        </select>
    </div>
</div>
