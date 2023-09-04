@extends('layouts.app')

@section('content')

    {{--    breadcrumb --}}
    @include('layouts.components.breadcrumb',['title' => trans('app.create_new_awb_title'),'first_list_item' => trans('app.awbs'),'last_list_item' => trans('app.add_awb')])
    {{--    end breadcrumb --}}

    <!-- Row -->
    <div class="row">
        <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12"> <!--div-->
            <form action="{{route('awbs.store')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="main-content-label mg-b-5">Sender Info</div>
                                <div class="pd-30 pd-sm-20">
                                    <div class="row row-xs">
                                        <div class="col-md-4 col-lg-4 col-sm-12">
                                            @if($authUser->type == \App\Enums\UsersType::SUPERADMIN->value)
                                                @livewire('company')
                                            @elseif($authUser->type == \App\Enums\UsersType::ADMIN->value || $authUser->type == \App\Enums\UsersType::EMPLOYEE->value)
                                                @livewire('company',['selected_company'=>$authUser->company_id])
                                            @endif
                                            @error('company_id')
                                            <div class="text-danger"> {{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 col-lg-4 col-sm-12 mg-t-5 mg-md-t-0">
                                            <livewire:branch/>
                                            @error('branch_id')
                                            <div class="text-danger"> {{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 col-lg-4 col-sm-12 mg-t-5 mg-md-t-0">
                                            <livewire:department/>
                                            @error('department_id')
                                            <div class="text-danger"> {{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="pd-30 pd-sm-20">
                                    <div class="row row-xs">
                                        <div class="col-md-6 col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="main-content-label">@lang('app.phone')</label>
                                                <p id="branch_phone" class="form-control"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-12 mg-t-10 mg-md-t-0">
                                            <label class="main-content-label">@lang('app.address')</label>
                                            <p id="branch_address" class="form-control"></p>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-12 mg-t-10 mg-md-t-0">
                                            <label class="main-content-label">@lang('app.city')</label>
                                            <p id="branch_city" class="form-control"></p>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-12 mg-t-10 mg-md-t-0">
                                            <label class="main-content-label">@lang('app.area')</label>
                                            <p id="branch_area" class="form-control"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="main-content-label mg-b-5">Receiver Info</div>
                                <div class="pd-30 pd-sm-20">
                                    <div class="row row-xs">
                                        <x-awb-receivers-search-data-section/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="main-content-label mg-b-5">@lang('app.awb_info')</div>
                                <div class="pd-30 pd-sm-20">
                                    <div class="row row-xs">
                                        <div class="col-md-5">
                                            <x-service-types/>
                                        </div>
                                        <div class="col-md-5 mg-t-10 mg-md-t-0">
                                            <x-payment-types/>
                                        </div>
                                    </div>

                                    <div class="row row-xs">
                                        <div class="col-md-3" id="collection">
                                            <label class="main-content-label">@lang('app.collection')</label>
                                            <input class="form-control" type="number" name="collection" value="{{ old('collection') }}">
                                            @error('collection')
                                            <div class="text-danger"> {{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-2 mt-5 ms-3">
                                            <label class="custom-control custom-checkbox custom-control-lg"> <input
                                                    type="checkbox" class="custom-control-input" name="is_return"
                                                    value="1" checked> <span
                                                    class="custom-control-label custom-control-label-md  tx-17">@lang('app.awb_is_reverse')</span>
                                            </label>
                                        </div>

                                    </div>
                                    <div class="row row-xs mt-3">
                                        <div class="col-md-4 mg-t-10 mg-md-t-0">
                                            <livewire:company-shipment-type/>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="main-content-label">@lang('app.pieces')</label>
                                            <input class="form-control" value="{{ old('pieces') ?? 1 }}" id="pieces" type="number" name="pieces"/>
                                            @error('pieces')
                                            <div class="text-danger"> {{$message}}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-3">
                                            <label class="main-content-label">@lang('app.weight')</label>
                                            <input class="form-control" value="{{ old('weight') ?? 1 }}" type="number" name="weight"/>
                                            @error('weight')
                                            <div class="text-danger"> {{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row row-xs" id="awb_details">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="main-content-label mg-b-5">@lang('app.awb_additional_info')</div>
                                <div class="pd-30 pd-sm-20">
                                    <div class="row row-xs">
                                        <div class="col-md-3 col-lg-3">
                                            <label class="main-content-label">@lang('app.custom_field1')</label>
                                            <input class="form-control" type="text" name="custom_field1" value="{{ old('custom_field1') }}">
                                            @error('custom_field1')
                                            <div class="text-danger"> {{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 col-lg-3">
                                            <label class="main-content-label">@lang('app.custom_field2')</label>
                                            <input class="form-control" type="text" name="custom_field2" value="{{ old('custom_field2') }}"/>
                                            @error('custom_field2')
                                            <div class="text-danger"> {{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 col-lg-3">
                                            <label class="main-content-label">@lang('app.custom_field3')</label>
                                            <input class="form-control" type="text" name="custom_field3" value="{{ old('custom_field3') }}"/>
                                            @error('custom_field3')
                                            <div class="text-danger"> {{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 col-lg-3">
                                            <label class="main-content-label">@lang('app.custom_field4')</label>
                                            <input class="form-control" type="text" name="custom_field4" value="{{ old('custom_field4') }}"/>
                                            @error('custom_field4')
                                            <div class="text-danger"> {{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 col-lg-3">
                                            <div class="mt-4">
                                                <button type="submit" class="btn btn-primary"><i
                                                        class="fa fa-save pe-2"></i>@lang('app.save')</button>

                                                <a role="button" href="{{ URL::previous() }}" class="btn btn-primary"><i
                                                        class="fa fa-backward pe-2"></i>@lang('app.back')</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <!-- End Row -->

@endsection
@section('script_footer')
    <script src="{{asset('assets/js/create-awb.js')}}"></script>
@endsection
