<div>
    {{-- Be like water. --}}
    <div class="form-group">
        <label class="main-content-label mg-b-5">@lang('app.companies')</label>
        <select name="{{$field_name}}" wire:model="selected_company" class="form-control form-select" data-bs-placeholder="Select company">
            @if(!isset($selected_company))
                <option value="" selected>@lang('app.select_company')</option>
            @endif
            @foreach($companies as $company)
                <option value="{{$company->id}}" {{$company->id == old("$field_name")?'selected':''}}>{{$company->name}}</option>
            @endforeach
        </select>
    </div>
</div>
