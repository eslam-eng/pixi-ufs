@section('after_styles')
    <link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
<div>
    <div class="row">
        @if($is_supper_admin)
            <div class="col-lg-12 col-md-12 col-sm-12 mt-2 mb-4">
                <div class="main-content-label mg-b-5">@lang('app.Companies')</div>
                <select class="form-select"
                        wire:change="getBranchesAndDepartmentsForSelectedCompany"
                        wire:model="selected_company" , id="company_id"
                        name="{{$company_name}}">
                    <option value="0">@lang('app.select_company')</option>
                    @foreach($companies_options as $company)
                        <option value="{{$company->id}}"
                                wire:key="company-{{$company->id}}"
                                @if(!is_null($selected_company) && ($company->id == $selected_company)) selected @endif
                        >{{$company->name}}</option>
                    @endforeach
                </select>
            </div>
        @endif
    </div>

    <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="main-content-label mb-3">@lang('app.branches')</div>
                <select class="form-select" id="branch_id" wire:model="selected_branch"
                        name="{{$branch_name}}"
                        aria-label="Select branch">
                    <option @if(is_null($selected_branch)) selected @endif value="">@lang('app.select_branch')</option>
                    @foreach($branches_options as $branch)
                        <option value="{{$branch->id}}" wire:key="branch-{{$branch->id}}"
                                @if(!is_null($selected_branch) && ($branch->id == $selected_branch)) selected @endif>{{$branch->name}}</option>
                    @endforeach
                </select>
            </div>
         <div class="col-md-6 col-lg-6 col-sm-6">
             <div class="main-content-label mb-3">@lang('app.departments')</div>
              <div class="input-group mb-5">
                    <span class="input-group-text" id="basic-addon3"><i class="fa fa-home"></i></span>
                    <select class="form-select" id="department_id"
                            name="{{$department_name}}"
                            aria-label="Select department">
                        <option @if(is_null($selected_department)) selected
                                @endif value="">@lang('app.select_department')</option>
                        @foreach($departments_options as $department)
                            <option value="{{$department->id}}" wire:key="department-{{$department->id}}"
                                    @if(!is_null($selected_department) && ($branch->id == $selected_branch)) selected @endif>{{$branch->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
    </div>


    <div class="row mb-4">

            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="main-content-label mg-b-5">@lang('app.phone')</div>
                <input class="form-control" type="text" id="branch_phone" disabled readonly/>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="main-content-label mg-b-5">@lang('app.address')</div>
                <input class="form-control" type="text" id="branch_address" disabled readonly/>
            </div>
    </div>


    <div class="row">

        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="main-content-label mg-b-5">@lang('app.city')</div>
            <input class="form-control" type="text" id="branch_city" disabled readonly/>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="main-content-label mg-b-5">@lang('app.area')</div>
            <input class="form-control" type="text" id="branch_area" disabled readonly/>
        </div>
    </div>
</div>
@section('script_footer')
     <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('branchSelected', function (branch) {
               $("#branch_phone").val(branch.phone);
               $("#branch_address").val(branch.address);
               $("#branch_city").val(branch.city.title);
               $("#branch_area").val(branch.area.title);
            });
        });
    </script>
@endsection
