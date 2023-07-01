<div>
    {{-- Be like water. --}}
    <div class="form-group">
        <label class="main-content-label mg-b-5">@lang('app.areas')</label>
        <select name="{{$field_name}}" wire:model="selected_area" class="form-control form-select" data-bs-placeholder="Select area">
            <option value="" selected>@lang('app.select_area')</option>
            @foreach($areas as $area)
                <option value="{{$area->id}}" {{$area->id == old("$field_name")?'selected':''}}>{{$area->title}}</option>
            @endforeach
        </select>
    </div>
</div>
