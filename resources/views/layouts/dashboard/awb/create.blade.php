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
            <form action="{{route('awbs.store')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="main-content-label mg-b-5">Sender Info</div>
                                <div class="pd-30 pd-sm-20">
                                    <div class="row row-xs">
                                        <div class="col-md-4 col-lg-4 col-sm-12">
                                            <livewire:company/>
                                        </div>
                                        <div class="col-md-4 col-lg-4 col-sm-12 mg-t-5 mg-md-t-0">
                                            <livewire:branch/>
                                        </div>
                                        <div class="col-md-4 col-lg-4 col-sm-12 mg-t-5 mg-md-t-0">
                                            <livewire:department/>
                                        </div>
                                    </div>
                                </div>

                                <div class="pd-30 pd-sm-20">
                                    <div class="row row-xs">
                                        <div class="col-md-6 col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">@lang('app.phone')</label>
                                                <p id="branch_phone" class="form-control"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-12 mg-t-10 mg-md-t-0">
                                            <label class="form-label">@lang('app.address')</label>
                                            <p id="branch_address" class="form-control"></p>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-12 mg-t-10 mg-md-t-0">
                                            <label class="form-label">@lang('app.city')</label>
                                            <p id="branch_city" class="form-control"></p>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-12 mg-t-10 mg-md-t-0">
                                            <label class="form-label">@lang('app.area')</label>
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
                                        <div class="col-md-4">
                                            <x-service-types/>
                                        </div>
                                        <div class="col-md-4 mg-t-10 mg-md-t-0">
                                            <x-payment-types/>
                                        </div>
                                        <div class="col-md-4 mg-t-10 mg-md-t-0">
                                            <livewire:company-shipment-type/>
                                        </div>
                                    </div>

                                    <div class="row row-xs">
                                        <div class="col-md-3">
                                            <label class="form-label">@lang('app.collection')</label>
                                            <input class="form-control" type="number" name="collection"/>
                                        </div>
                                        <div class="col-md-2 mt-5 ms-3">
                                            <label class="ckbox">
                                                <input type="checkbox" name="is_return">
                                                <span
                                                    class="font-weight-bold text-dark">@lang('app.awb_is_reverse')
                                                </span>
                                            </label>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">@lang('app.pieces')</label>
                                            <input class="form-control" type="number" name="collection"/>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">@lang('app.weight')</label>
                                            <input class="form-control" type="number" name="collection"/>
                                        </div>
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
                                            <label class="form-label">@lang('app.custom_field1')</label>
                                            <input class="form-control" type="text" name="custom_field1"/>
                                        </div>
                                        <div class="col-md-3 col-lg-3">
                                            <label class="form-label">@lang('app.custom_field2')</label>
                                            <input class="form-control" type="text" name="custom_field1"/>
                                        </div>
                                        <div class="col-md-3 col-lg-3">
                                            <label class="form-label">@lang('app.custom_field3')</label>
                                            <input class="form-control" type="text" name="custom_field1"/>
                                        </div>
                                        <div class="col-md-3 col-lg-3">
                                            <label class="form-label">@lang('app.custom_field4')</label>
                                            <input class="form-control" type="text" name="custom_field1"/>
                                        </div>
                                    </div>
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
