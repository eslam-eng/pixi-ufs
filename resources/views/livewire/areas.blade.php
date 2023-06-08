<div>
    {{-- Be like water. --}}
    <div class="form-group">
        <label class="form-label">@lang('app.areas')</label>
        <select name="{{$field_name}}" wire:model="selected_area" class="form-control form-select" data-bs-placeholder="Select area">
            @if(!isset($selected_area))
                <option value="" selected>@lang('app.select_area')</option>
            @endif
            @foreach($areas as $area)
                <option value="{{$area->id}}" {{$area->id == old("$field_name")?'selected':''}}>{{$area->title}}</option>
            @endforeach
        </select>
    </div>
</div>
