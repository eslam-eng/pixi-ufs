<div>
    <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="main-content-label mg-b-5">@lang('app.Companies')</div>
                <select class="form-select" wire:change="getAreasForSelectedCity" wire:model="city_id"
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

        @if (!is_null($city_id))
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="main-content-label mg-b-5">@lang('app.areas')</div>
                <select class="form-select" name="{{$area_field_name}}" aria-label="Select area" id="area_id">
                    <option @if(is_null($area_id)) selected @endif>@lang('app.select_area')</option>
                    @foreach($areas as $area)
                        <option value="{{$area->id}}"
                                @if(!is_null($area_id) && ($area->id == $area_id)) selected @endif>{{$area->title}}</option>
                    @endforeach
                </select>
            </div>

        @endif


    </div>
</div>

