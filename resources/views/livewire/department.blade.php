<div>
    {{-- Be like water. --}}
    <div class="form-group">
        <label class="form-label">@lang('app.departments')</label>
        <select name="{{$field_name}}" class="form-control form-select" data-bs-placeholder="Select department">
            @if(!isset($departments_for_company_id))
                <option selected>@lang('app.select_branch')</option>
            @endif
            @foreach($departments as $department)
                <option value="{{$department->id}}" {{$department->id == old("$field_name")?'selected':''}}>{{$department->name}}</option>
            @endforeach
        </select>
    </div>
</div>

