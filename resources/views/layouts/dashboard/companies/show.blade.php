@extends('layouts.app')

@section('content')

    {{--    breadcrumb --}}
    @include('layouts.components.breadcrumb',['title' => trans('companies_page_title'),'first_list_item' => trans('app.receivers'),'last_list_item' => trans('app.add_receiver')])
    {{--    end breadcrumb --}}

    <!-- Row -->
    <div class="row">
        <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12"> <!--div-->
            <div class="card">
                <div class="card-body">

                    <div class="row row-sm mb-4">
                        <div class="col-lg">
                            <div class="main-content-label mg-b-5">@lang('app.name')</div>
                            <label class="form-control">{{ $company->name }}</label>
                        </div>

                        <div class="col-lg">
                            <div class="main-content-label mg-b-5">@lang('app.email')</div>
                            <label class="form-control">{{ $company->email }}</label>
                        </div>

                        <div class="col-lg">
                            <div class="main-content-label mg-b-5">@lang('app.ceo')</div>
                            <label class="form-control">{{ $company->ceo }}</label>
                        </div>

                        <div class="col-lg">
                            <div class="main-content-label mg-b-5">@lang('app.phone')</div>
                            <label class="form-control">{{ $company->phone }}</label>
                        </div>
                    </div>

                    <div class="row row-sm mb-4">


                        <div class="col-lg">
                            <div class="main-content-label mg-b-5">@lang('app.num_custom_fields')</div>
                            <label class="form-control">{{ $company->num_custom_fields }}</label>
                        </div>

                        <div class="col-lg">
                            <div class="main-content-label mg-b-5">@lang('app.importation_type')</div>
                            <label
                                class="form-control">{{ $company->importation_type == \App\Enums\ImportTypeEnum::AWBWITHREFERENCE->value ? \App\Enums\ImportTypeEnum::AWBWITHREFERENCE->name:\App\Enums\ImportTypeEnum::AWBWITHOUTREFERENCE->name }}</label>
                        </div>


                    </div>

                    <div class="row row-sm mb-4">
                        <div class="col-lg">
                            <div class="main-content-label mg-b-5">@lang('app.address')</div>
                            <label class="form-control">{{ $company->address }}</label>
                        </div>

                        <div class="col-lg">
                            <div class="main-content-label mg-b-5">@lang('app.city')</div>
                            <label class="form-control">{{ $company->city->title }}</label>
                        </div>

                        <div class="col-lg">
                            <div class="main-content-label mg-b-5">@lang('app.area')</div>
                            <label class="form-control">{{ $company->area->title }}</label>
                        </div>

                    </div>

                    <div class="row row-sm mb-4">
                        <div class="col-lg">
                            <div class="main-content-label mg-b-5">@lang('app.show_dashboard')</div>
                            <input disabled type="checkbox" {{ $company->show_dashboard == 1 ? "checked":"" }}>
                        </div>

                        <div class="col-lg">
                            <div class="main-content-label mg-b-5">@lang('app.notes')</div>
                            <label class="form-control">{{ $company->notes }}</label>
                        </div>

                        <div class="col-lg">
                            <div class="main-content-label mg-b-5">@lang('app.status')</div>
                            <input disabled type="checkbox" {{ $company->status == 1 ? "checked":"" }}>
                        </div>

                    </div>
                </div>
            </div>
            {{-- start branches --}}
            <div class="card">
                @can('create_branches')
                <div class="card-header">
                    <div class="form-group mb-0 mt-3 justify-content-end">
                        <div>
                            <form method="get" action="{{ route('branches.create') }}">
                                <h4 class="pe-4">
                                    <input type="hidden" name="company_id" value="{{ $company->id }}">
                                    <button class="btn ripple btn-primary" type="submit">@lang('app.add_new_branch')</button>
                                </h4>
                            </form>
                        </div>
                    </div>
                </div>
                @endcan
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <td>@lang('app.name')</td>
                            <td>@lang('app.phone')</td>
                            <td>@lang('app.status')</td>
                            <td>@lang('app.address')</td>
                            <td>@lang('app.city')</td>
                            <td>@lang('app.area')</td>
                            <td>@lang('app.actions')</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($company->branches as $branch)
                            <tr>
                                <td>{{$branch->name}}</td>
                                <td>{{$branch->phone}}</td>
                                <td>{{$branch->status ? trans('app.yes') : trans('app.no') }}</td>
                                <td>{{$branch->address}}</td>
                                <td>{{$branch->city?->title}}</td>
                                <td>{{$branch->area?->title}}</td>
                                <td>
                                    <div>
                                        <button data-bs-toggle="dropdown" class="btn btn-primary btn-block"
                                                aria-expanded="false">@lang('app.actions')
                                            <i class="icon ion-ios-arrow-down tx-11 mg-l-3"></i>
                                        </button>
                                        <div class="dropdown-menu" style="">
                                            @can('edit_branches')
                                            <a href="{{route('branches.edit', $branch->id)}}"
                                                class="dropdown-item">@lang('app.edit')</a>
                                            @endcan
                                            @can('delete_branches')
                                            <div>
                                                <button role="button" onclick="destroy('{{route('branches.destroy', $branch->id)}}')" class="dropdown-item">@lang('app.delete')</button>
                                            </div>
                                            @endcan
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- end branches --}}

            {{-- start departments --}}

            <div class="card">
                @can('create_departments')
                <div class="card-header">
                    <div class="form-group mb-0 mt-3 justify-content-end">
                        <div>
                            <form method="get" action="{{ route('departments.create') }}">
                                <h4 class="pe-4">
                                    <input type="hidden" name="company_id" value="{{ $company->id }}">
                                    <button class="btn ripple btn-primary" type="submit">@lang('app.add_new_department')</button>
                                </h4>
                            </form>
                        </div>
                    </div>
                </div>
                @endcan
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <td>@lang('app.name')</td>
                            <td width="250px">@lang('app.actions')</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($company->departments as $department)
                            <tr>
                                <td>{{$department->name}}</td>
                                <td>
                                    <div>
                                        <button data-bs-toggle="dropdown" class="btn btn-primary btn-block"
                                                aria-expanded="false">@lang('app.actions')
                                            <i class="icon ion-ios-arrow-down tx-11 mg-l-3"></i>
                                        </button>
                                        <div class="dropdown-menu" style="">
                                            @can('edit_departments')
                                            <a href="{{route('departments.edit', $department->id)}}"
                                                class="dropdown-item">@lang('app.edit')</a>
                                            @endcan
                                            @can('delete_departments')
                                            <div>
                                                <button role="button" onclick="destroy('{{route('departments.destroy', $department->id)}}')" class="dropdown-item">@lang('app.delete')</button>
                                            </div>
                                            @endcan
                                        </div>
                                        <!-- dropdown-menu -->
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- end departments --}}
        </div>
    </div>

    <!-- End Row -->

@endsection
