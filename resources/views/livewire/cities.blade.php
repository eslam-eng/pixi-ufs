<div>
    {{-- Be like water. --}}
    <div class="form-group">
        <label class="form-label">@lang('app.cities')</label>
        <select name="{{$field_name}}" wire:model="selected_city" class="form-control form-select" data-bs-placeholder="Select city">
            @if(!isset($selected_city))
                <option selected>@lang('app.select_city')</option>
            @endif
            @foreach($cities as $city)
                <option value="{{$city->id}}" {{$city->id == old("$field_name")?'selected':''}}>{{$city->title}}</option>
            @endforeach
        </select>
    </div>
</div>
