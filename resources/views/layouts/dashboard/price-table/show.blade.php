@extends('layouts.app')

@section('content')

    {{--    breadcrumb --}}
    @include('layouts.components.breadcrumb',['title' => trans('prices_page_title'),'first_list_item' => trans('app.prices'),'last_list_item' => trans('app.edit_price')])
    {{--    end breadcrumb --}}

    <!-- Row -->
    <div class="row">
        <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12"> <!--div-->
            <div class="card">
                <div class="card-body">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.company')</div>
                                <label class="form-control">{{ $priceTable->company->name }}</label>
                            </div>
                        </div>
                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.location_from')</div>
                                <label class="form-control">{{ $priceTable->locationFrom->title }}</label>
                            </div>

                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.locaiton_to')</div>
                                <label class="form-control">{{ $priceTable->locationTo->title }}</label>
                            </div>

                        </div>

                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.price')</div>
                                <label class="form-control">{{ $priceTable->price }}</label>
                            </div>
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.basic_kg')</div>
                                <label class="form-control">{{ $priceTable->basic_kg }}</label>
                            </div>

                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.additional_kg_price')</div>
                                <label class="form-control">{{ $priceTable->additional_kg_price }}</label>
                            </div>
                        </div>

                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.return_price')</div>
                                <label class="form-control">{{ $priceTable->return_price }}</label>
                            </div>
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.special_price')</div>
                                <label class="form-control">{{ $priceTable->special_price }}</label>
                            </div>
                        </div>

                        <div class="card-footer mt-4">
                            <div class="form-group mb-0 mt-3 justify-content-end">
                                <div>
                                    <a role="button" href="{{route('prices.index')}}" class="btn btn-danger"><i
                                            class="fa fa-backward pe-2"></i>@lang('app.back')</a>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End Row -->

@endsection
