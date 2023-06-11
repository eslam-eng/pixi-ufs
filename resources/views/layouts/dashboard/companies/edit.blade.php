@extends('layouts.app')

@section('content')

    {{--    breadcrumb --}}
    @include('layouts.components.breadcrumb',['title' => trans('companies_page_title'),'first_list_item' => trans('app.compaines'),'last_list_item' => trans('app.edit_company')])
    {{--    end breadcrumb --}}

    <!-- Row -->
    <div class="row">
        <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12"> <!--div-->
            <div class="card">
                <div class="card-body">

                    <form action="{{route('companies.update', $company->id)}}" method="post">
                        @csrf
                        @method('put')
                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.name')</div>
                                <input class="form-control" name="name" value="{{old('name') ?? $company->name}}"
                                       type="text" required>
                                @error('name')
                                <div id="validationServer03Feedback" class="invalid-feedback"> {{$message}} </div>
                                @enderror
                            </div>

                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.email')</div>
                                <input class="form-control" name="email" value="{{old('email') ?? $company->email}}"
                                       type="email" required>
                                @error('email')
                                <div id="validationServer03Feedback" class="invalid-feedback"> {{$message}} </div>
                                @enderror
                            </div>

                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.ceo')</div>
                                <input class="form-control" name="ceo" value="{{old('ceo') ?? $company->ceo}}"
                                       type="text" required>
                                @error('ceo')
                                <div id="validationServer03Feedback" class="invalid-feedback"> {{$message}} </div>
                                @enderror
                            </div>

                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.phone')</div>
                                <input class="form-control" value="{{old('phone') ?? $company->phone}}" name="phone"
                                       type="text" required>
                                @error('phone')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row row-sm mb-4">
                            <div class="col-lg">

                                <div class="main-content-label mg-b-5">@lang('app.show_dashboard')</div>
                                <label class="custom-control custom-checkbox custom-control-md">
                                    <input type="checkbox" class="custom-control-input"
                                           name="show_dashboard" value="1" {{ $company->show_dashboard == 1 ? "checked":"" }}>
                                    <span
                                        class="custom-control-label custom-control-label-md  tx-17"></span>
                                </label>
                                @error('show_dashboard')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>


                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.status')</div>
                                <label class="custom-control custom-checkbox custom-control-md">
                                    <input type="checkbox" class="custom-control-input"
                                           name="status" value="1" {{ $company->status == 1 ? "checked":"" }}>
                                    <span
                                        class="custom-control-label custom-control-label-md  tx-17"></span>
                                </label>
                                @error('status')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="row row-sm mb-4">


                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.num_custom_fields')</div>
                                <input class="form-control"
                                       value="{{old('num_custom_fields') ?? $company->num_custom_fields}}"
                                       name="num_custom_fields"
                                       type="number">

                                @error('num_custom_fields')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.importation_type')</div>
                                <select class="form-control" name="importation_type">
                                    <option selected disabled>...</option>
                                    <option
                                        {{ \App\Enums\ImportTypeEnum::AWBWITHREFERENCE->value == $company->importation_type ? "selected":"" }} value="{{ \App\Enums\ImportTypeEnum::AWBWITHREFERENCE->value }}">@lang('app.import_with_reference')</option>
                                    <option
                                        {{ \App\Enums\ImportTypeEnum::AWBWITHOUTREFERENCE->value == $company->importation_type ? "selected":"" }} value="{{ \App\Enums\ImportTypeEnum::AWBWITHOUTREFERENCE->value }}">@lang('app.import_without_reference')</option>
                                </select>

                                @error('importation_type')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>


                        </div>

                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.notes')</div>
                                <input class="form-control" value="{{old('notes') ?? $company->notes}}" name="notes"
                                       type="text">

                                @error('notes')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.address')</div>
                                <input class="form-control" name="address"
                                       value="{{old('address') ?? $company->address}}"
                                       type="text" required>

                                @error('address')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="row row-sm mb-4">
                            <div class="col-lg">

                                @livewire('location.cities',['selected_city' => "$company->city_id"])
                                @error('city_id')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>


                            <div class="col-lg">

                                @livewire('location.areas',['selected_area' => "$company->area_id",'areas_for_city_id' => "$company->city_id"])
                                @error('area_id')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="card-footer mt-4">
                            <div class="form-group mb-0 mt-3 justify-content-end">
                                <div>
                                    <button type="submit" class="btn btn-rounded btn-success"><i
                                            class="fa fa-save pe-2"></i>@lang('app.submit')</button>

                                    <a role="button" href="{{route('companies.index')}}"
                                       class="btn btn-rounded btn-danger"><i
                                            class="fa fa-backward pe-2"></i>@lang('app.back')</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            {{-- start branches --}}
            <div class="card">
                <div class="card-header">
                    <div class="breadcrumb-header justify-content-between">
                        <div class="left-content">
                            <div>
                                <form method="get" action="{{ route('branches.create') }}">
                                    <input type="hidden" name="company_id" value="{{ $company->id }}">
                                    <button class="btn btn-rounded btn-primary"
                                            type="submit">@lang('app.add_new_branch')</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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
                                <td>{{$branch->status ? trans('app.yes'): trans('app.no')}}</td>
                                <td>{{$branch->address}}</td>
                                <td>{{$branch->city?->title}}</td>
                                <td>{{$branch->area?->title}}</td>
                                <td>
                                    <div>
                                        <button data-bs-toggle="dropdown" class="btn btn-rounded btn-primary btn-block"
                                                aria-expanded="false">@lang('app.actions')
                                            <i class="icon ion-ios-arrow-down tx-11 mg-l-3"></i>
                                        </button>
                                        <div class="dropdown-menu" style="">
                                            <a href="{{route('branches.edit', $branch->id)}}"
                                               class="dropdown-item">@lang('app.edit')</a>
                                            <div>
                                                <button role="button" onclick="destroy('{{route('branches.destroy',$branch->id)}}')" class="dropdown-item">@lang('app.delete')</button>
                                            </div>
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
            {{-- end branches --}}

            {{-- start departments --}}

            <div class="card">
                <div class="card-header">
                    <div class="breadcrumb-header justify-content-between">
                        <div class="left-content">
                            <div>
                                <form method="get" action="{{ route('departments.create') }}">
                                    <input type="hidden" name="company_id" value="{{ $company->id }}">
                                    <button class="btn btn-rounded btn-primary"
                                            type="submit">@lang('app.add_new_department')</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <td>@lang('app.name')</td>
                            <td width="300">@lang('app.actions')</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($company->departments as $department)
                            <tr>
                                <td>{{$department->name}}</td>
                                <td>
                                    <div>
                                        <button data-bs-toggle="dropdown" class="btn btn-rounded btn-primary btn-block"
                                                aria-expanded="false">@lang('app.actions')
                                            <i class="icon ion-ios-arrow-down tx-11 mg-l-3"></i>
                                        </button>
                                        <div class="dropdown-menu" style="">
                                            <a href="{{route('departments.edit', $department->id)}}"
                                               class="dropdown-item">@lang('app.edit')</a>
                                            <div>
                                                <button role="button" onclick="destroy('{{route('departments.destroy',$department->id)}}')" class="dropdown-item">@lang('app.delete')</button>
                                            </div>
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
