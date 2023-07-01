<div>
    {{-- Be like water. --}}
    <div class="form-group">
        <label class="main-content-label mg-b-5">{{$title}}</label>
        <select name="{{$field_name}}" wire:model="selected_city" class="form-control form-select" data-bs-placeholder="Select city">
            @if(!isset($selected_city))
                <option value="" selected>@lang('app.select_city')</option>
            @endif
            @foreach($cities as $city)
                <option value="{{$city->id}}" {{$city->id == old("$field_name")?'selected':''}}>{{$city->title}}</option>
            @endforeach
        </select>
    </div>
</div>
