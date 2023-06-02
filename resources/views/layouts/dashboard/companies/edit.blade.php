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
                                <input name="show_dashboard" value="1"
                                    placeholder="@lang('app.show_dashboard')" type="checkbox" {{ $company->show_dashboard == 1 ? "checked":"" }}>

                                @error('show_dashboard')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.notes')</div>
                                <input class="form-control" value="{{old('notes') ?? $company->notes}}" name="notes"
                                       type="text">

                                @error('notes')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.status')</div>
                                <input name="status" value="1"
                                    placeholder="@lang('app.status')" type="checkbox" {{ $company->status == 1 ? "checked":"" }}>

                                @error('status')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.store_receivers')</div>
                                <input name="store_receivers" value="1"
                                    placeholder="@lang('app.store_receivers')" type="checkbox" {{ $company->store_receivers == 1 ? "checked":"" }}>

                                @error('store_receivers')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>

                            
                        </div>

                        <div class="row row-sm mb-4">


                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.num_custom_fields')</div>
                                <input class="form-control" value="{{old('num_custom_fields') ?? $company->num_custom_fields}}" name="num_custom_fields"
                                       type="number">

                                @error('num_custom_fields')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                            
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.importation_type')</div>
                                <select class="form-control" name="importation_type">
                                    <option selected disabled>...</option>
                                    <option {{ \App\Enums\ImportTypeEnum::IMPORTWITHREFERENCE->value == $company->importation_type ? "selected":"" }} value="{{ \App\Enums\ImportTypeEnum::IMPORTWITHREFERENCE->value }}">@lang('app.import_with_reference')</option>
                                    <option {{ \App\Enums\ImportTypeEnum::IMPORTWITHOUTREFERENCE->value == $company->importation_type ? "selected":"" }} value="{{ \App\Enums\ImportTypeEnum::IMPORTWITHOUTREFERENCE->value }}">@lang('app.import_without_reference')</option>
                                </select>

                                @error('importation_type')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>


                        </div>

                        <div class="card card-success mt-4">
                            <div class="card-header pb-2"><h5 class="card-title mb-0 pb-0">Address Info</h5></div>
                            <div class="card-body text-success">
                                <div class="row row-sm mb-4">
                                    <div class="col-lg">
                                        <div class="main-content-label mg-b-5">@lang('app.address')</div>
                                        <input class="form-control" name="address" value="{{old('address') ?? $company->address}}"
                                               type="text" required>

                                        @error('address')
                                        <div class="text-danger"> {{$message}}</div>
                                        @enderror
                                    </div>

                                </div>

                                <div>
                                    @livewire('locations-drop-down',["city_id"=>"{{ $company->city_id }}", "area_id"=>"{{ $company->area_id }}"])

                                    @error('city_id')
                                    <div class="text-danger"> {{$message}}</div>
                                    @enderror
                                    @error('area_id')
                                    <div class="text-danger"> {{$message}}</div>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="card-footer mt-4">
                            <div class="form-group mb-0 mt-3 justify-content-end">
                                <div>
                                    <button type="submit" class="btn btn-success"><i
                                            class="fa fa-save pe-2"></i>@lang('app.next')</button>

                                    <a role="button" href="{{route('companies.index')}}" class="btn btn-danger"><i
                                            class="fa fa-backward pe-2"></i>@lang('app.back')</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>

    <!-- End Row -->

@endsection
