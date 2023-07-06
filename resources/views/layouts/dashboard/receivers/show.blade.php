@extends('layouts.app')

@section('content')

    {{--    breadcrumb --}}
    @include('layouts.components.breadcrumb',['title' => trans('app.receivers_page_title'),'first_list_item' => trans('app.receivers'),'last_list_item' => trans('app.show_receiver')])
    {{--    end breadcrumb --}}

    <!-- Row -->
    <div class="row">
        <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12"> <!--div-->
            <div class="card">
                <div class="card-body">
                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.receiver_name')</div>
                                <label class="form-control">{{$receiver->name}}</label>
                            </div>

                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.phone1')</div>
                                <label class="form-control">{{$receiver->phone1}}</label>
                            </div>

                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.phone2')</div>
                                <label class="form-control">{{$receiver->phone2}}</label>
                            </div>
                        </div>

                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.receiving_company')</div>
                                <label class="form-control">{{$receiver->receiving_company}}</label>
                            </div>

                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.receiving_branch')</div>
                                <label class="form-control">{{$receiver->receiving_branch}}</label>
                            </div>

                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.reference')</div>
                                <label class="form-control">{{$receiver->reference}}</label>
                            </div>
                        </div>


                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.title')</div>
                                <label class="form-control">{{$receiver->title}}</label>
                            </div>
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.company')</div>
                                <label class="form-control">{{$receiver->company->name}}</label>
                            </div>

                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.branch')</div>
                                <label class="form-control">{{$receiver->branch->name}}</label>
                            </div>
                        </div>

                </div>
            </div>
            <div class="card">
                <div class="card-header pb-2"><h5 class="card-title mb-0 pb-0">Address Info</h5></div>
                <div class="card-body text-success">
                    <div class="row row-sm mb-4">
                        <div class="col-lg">
                            <div class="main-content-label mg-b-5">@lang('app.address1')</div>
                            <label class="form-control">{{$receiver->address1}}</label>
                        </div>

                        <div class="col-lg">
                            <div class="main-content-label mg-b-5">@lang('app.address2')</div>
                            <label class="form-control">{{$receiver->address2}}</label>
                        </div>


                    </div>

                    <div class="row row-sm mb-4">
                        <div class="col-lg">
                            <div class="main-content-label mg-b-5">@lang('app.lat')</div>
                            <label class="form-control">{{$receiver->lat}}</label>
                        </div>
                        <div class="col-lg">
                            <div class="main-content-label mg-b-5">@lang('app.lng')</div>
                            <label class="form-control">{{$receiver->lng}}</label>
                        </div>

                        <div class="col-lg">
                            <div class="main-content-label mg-b-5">@lang('app.map_url')</div>
                            <label class="form-control">{{$receiver->map_url}}</label>
                        </div>
                    </div>

                    <div class="row row-sm mb-4">
                        <div class="col-lg">
                            <div class="main-content-label mg-b-5">@lang('app.city')</div>
                            <label class="form-control">{{$receiver->city->title}}</label>
                        </div>
                        <div class="col-lg">
                            <div class="main-content-label mg-b-5">@lang('app.area')</div>
                            <label class="form-control">{{$receiver->area->title}}</label>
                        </div>

                    </div>
                </div>
                <div class="card-footer mt-4">
                    <div class="form-group mb-0 mt-3 justify-content-end">
                        <div>
                            <a role="button" href="{{ URL::previous() }}" class="btn btn-primary"><i
                                    class="fa fa-backward pe-2"></i>@lang('app.back')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End Row -->

@endsection
