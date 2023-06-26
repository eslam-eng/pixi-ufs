<div>
    {{-- Be like water. --}}
    <div class="form-group">
        <label class="main-content-label mg-b-5">@lang('app.departments')</label>
        <select name="{{$field_name}}" class="form-control form-select" data-bs-placeholder="Select department">
            @if(!isset($departments_for_company_id))
                <option value="" selected>@lang('app.select_department')</option>
            @endif
            @foreach($departments as $department)
                <option value="{{$department->id}}" {{$department->id == old("$field_name")?'selected':''}}>{{$department->name}}</option>
            @endforeach
        </select>
    </div>
</div>

