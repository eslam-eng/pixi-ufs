<div>
    <div class="row">
        @if($is_supper_admin)

            <div class="col-md-4 col-lg-4 col-sm-4">
                <label for="basic-url" class="form-label">@lang('app.companies')</label>
                <div class="input-group mb-5">
                    <span class="input-group-text" id="basic-addon3"><i class="fa fa-home"></i></span>
                    <select class="form-select" wire:change="getBranchesAndDepartmentsForSelectedCompany" wire:model="selected_company"
                            id="selected_company" name="{{$company_name}}"
                            aria-label="Select location">
                        <option value="" @if(is_null($governorate_id)) selected @endif>@lang('app.select_governorate')</option>
                        @foreach($companies_options as $company)
                            <option value="{{$company->id}}"
                                    wire:key="company-{{$company->id}}"
                                    @if(!is_null($selected_company) && ($company->id == $selected_company)) selected @endif
                            >{{$company->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif

        @if (!is_null($selected_company))
            <div class="col-md-4 col-lg-4 col-sm-4">
                <label for="basic-url" class="form-label">@lang('app.branches')</label>
                <div class="input-group mb-5">
                    <span class="input-group-text" id="basic-addon3"><i class="fa fa-home"></i></span>
                    <select class="form-select"  id="branch_id"
                            name="{{$branch_name}}"
                            aria-label="Select location">
                        <option @if(is_null($selected_branch)) selected @endif value="">@lang('app.select_branch')</option>
                        @foreach($branches_options as $branch)
                            <option value="{{$branch->id}}" wire:key="branch-{{$branch->id}}"
                                    @if(!is_null($selected_branch) && ($branch->id == $selected_branch)) selected @endif>{{$branch->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif

            @if (!is_null($selected_department))
                <div class="col-md-4 col-lg-4 col-sm-4">
                    <label for="basic-url" class="form-label">@lang('app.departments')</label>
                    <div class="input-group mb-5">
                        <span class="input-group-text" id="basic-addon3"><i class="fa fa-home"></i></span>
                        <select class="form-select"  id="department_id"
                                name="{{$department_name}}"
                                aria-label="Select department">
                            <option @if(is_null($selected_department)) selected @endif value="">@lang('app.select_department')</option>
                            @foreach($departments_options as $department)
                                <option value="{{$department->id}}" wire:key="department-{{$department->id}}"
                                        @if(!is_null($selected_department) && ($branch->id == $selected_branch)) selected @endif>{{$branch->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif


    </div>
</div>
