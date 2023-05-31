<div>
    {{-- Be like water. --}}
    <div class="form-group">
        <label class="form-label">@lang('app.companies')</label>
        <select name="{{$field_name}}" wire:model="selected_company" class="form-control form-select" data-bs-placeholder="Select company">
            @if(!isset($selected_company))
                <option selected>@lang('app.select_company')</option>
            @endif
            @foreach($companies as $company)
                <option value="{{$company->id}}" {{$company->id == old("$field_name")?'selected':''}}>{{$company->name}}</option>
            @endforeach
        </select>
    </div>
</div>
