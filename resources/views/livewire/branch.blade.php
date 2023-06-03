<div>
    {{-- Be like water. --}}
    <div class="form-group">
        <label class="form-label">@lang('app.branches')</label>
        <select name="{{$field_name}}" id="branch_id" class="form-control form-select" data-bs-placeholder="Select branch">
            @if(!isset($selected_branch))
                <option selected>@lang('app.select_branch')</option>
            @endif
            @foreach($branches as $branch)
                <option data-phone="{{$branch->phone}}" data-address="{{$branch->address}}" data-city="{{$branch->city->title}}" data-area="{{$branch->area->title}}" value="{{$branch->id}}" {{$branch->id == old("$field_name")?'selected':''}}>{{$branch->name}}</option>
            @endforeach
        </select>
    </div>
</div>

