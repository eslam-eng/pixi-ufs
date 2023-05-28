@extends('layouts.app')

@section('content')

    {{--    breadcrumb --}}
    @include('layouts.components.breadcrumb',['title' => trans('app.create_new_awb_title'),'first_list_item' => trans('app.awbs'),'last_list_item' => trans('app.add_awb')])
    {{--    end breadcrumb --}}

    <!-- Row -->
    <div class="row">
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12"> <!--div-->
            <form action="{{route('awb.store')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="card">
                            <div class="card-header pb-0"><h5
                                    class="card-title mb-3 pb-0">@lang('app.awb_sender_info')</h5></div>
                            <div class="card-body">
                                <livewire:awb.awb-sender-section  company_name_field="company_id" branch_name_field="branch_id" department_name_field="department_id" need_departments_select="true"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="card">
                            <div class="card-header pb-0"><h5
                                    class="card-title mb-3 pb-0">@lang('app.awb_receiver_info')</h5></div>
                            <div class="card-body">
                                <x-awb-receivers-search-data-section/>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="card">
                            <div class="card-header pb-0"><h5 class="card-title mb-3 pb-0">@lang('app.awb_info')</h5></div>
                            <div class="card-body">

                                <div class="row">

                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <x-service-types/>
                                    </div>

                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <x-payment-types/>
                                    </div>

                                    <div class="col-lg-3 col-md-3 col-sm-12" id="collection">
                                        <div class="main-content-label mg-b-5">@lang('app.collection')</div>
                                        <input class="form-control" type="number" name="collection"/>
                                    </div>

                                    <div class="col-lg-3 col-md-3 col-sm-12 mt-3">
                                        <div class="p-3 alert-info">
                                            <label class="ckbox">
                                                <input type="checkbox" name="is_return"><span class="font-weight-bold text-dark">@lang('app.awb_is_reverse')</span></label>
                                        </div>
                                    </div>
                                </div>

                                <hr class="text-info">
                                <div class="row">

                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <livewire:company-shipment-type/>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="main-content-label mg-b-5">@lang('app.pieces')</div>
                                        <input class="form-control" type="number" name="pieces"/>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="main-content-label mg-b-5">@lang('app.weight')</div>
                                        <input class="form-control" type="number" name="weight"/>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="card">
                            <div class="card-header pb-0"><h5 class="card-title mb-3 pb-0">@lang('app.awb_additional_info')</h5></div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="main-content-label mg-b-5">@lang('app.custom_field1')</div>
                                        <input class="form-control" type="text" name="custom_field1"/>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="main-content-label mg-b-5">@lang('app.custom_field2')</div>
                                        <input class="form-control" type="text" name="custom_field2"/>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="main-content-label mg-b-5">@lang('app.custom_field3')</div>
                                        <input class="form-control" type="text" name="custom_field3"/>
                                    </div>

{{--                                    <div class="col-lg-4 col-md-4 col-sm-12">--}}
{{--                                        <div class="main-content-label mg-b-5">@lang('app.custom_field4')</div>--}}
{{--                                        <input class="form-control" type="number" name="custom_field4"/>--}}
{{--                                    </div>--}}

{{--                                    <div class="col-lg-4 col-md-4 col-sm-12">--}}
{{--                                        <div class="main-content-label mg-b-5">@lang('app.custom_field5')</div>--}}
{{--                                        <input class="form-control" type="number" name="custom_field5"/>--}}
{{--                                    </div>--}}
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="mt-4">
                    <div class="form-group mb-0 mt-3 justify-content-end">
                        <div>
                            <button type="submit" class="btn btn-success"><i
                                    class="fa fa-save pe-2"></i>@lang('app.save')</button>

                            <a role="button" href="{{route('receivers.index')}}" class="btn btn-danger"><i
                                    class="fa fa-backward pe-2"></i>@lang('app.back')</a>
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
