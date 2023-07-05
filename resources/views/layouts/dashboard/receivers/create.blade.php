@extends('layouts.app')

@section('content')

    {{--    breadcrumb --}}
    @include('layouts.components.breadcrumb',['title' => trans('app.receivers_page_title'),'first_list_item' => trans('app.receivers'),'last_list_item' => trans('app.add_receiver')])
    {{--    end breadcrumb --}}

    <!-- Row -->
    <div class="row">
        <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12"> <!--div-->
            <form action="{{route('receivers.store')}}" method="post">
                <div class="card">
                    <div class="card-body">
                            @csrf
                            <div class="row row-sm mb-4">
                                <div class="col-lg">
                                    <div class="main-content-label mg-b-5">@lang('app.receiver_name')</div>
                                    <input class="form-control" name="name" value="{{old('name')}}" placeholder="@lang('app.receiver_name')"
                                        type="text">
                                    @error('name')
                                        <div class="text-danger"> {{$message}} </div>
                                    @enderror
                                </div>

                                <div class="col-lg">
                                    <div class="main-content-label mg-b-5">@lang('app.phone1')</div>
                                    <input class="form-control" value="{{old('phone1')}}" name="phone1" placeholder="@lang('app.receiver_phone')"
                                        type="text">
                                    @error('phone1')
                                        <div class="text-danger"> {{$message}}</div>
                                    @enderror
                                </div>

                                <div class="col-lg">
                                    <div class="main-content-label mg-b-5">@lang('app.phone2')</div>
                                    <input class="form-control" value="{{old('phone2')}}" name="phone2" placeholder="@lang('app.receiver_phone')"
                                        type="text">
                                    @error('phone2')
                                    <div class="text-danger"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row row-sm mb-4">
                                <div class="col-lg">
                                    <div class="main-content-label mg-b-5">@lang('app.receiving_company')</div>
                                    <input class="form-control" value="{{old('receiving_company')}}" name="receiving_company"
                                        placeholder="@lang('app.receiving_company')" type="text">

                                    @error('receiving_company')
                                    <div class="text-danger"> {{$message}}</div>
                                    @enderror
                                </div>

                                <div class="col-lg">
                                    <div class="main-content-label mg-b-5">@lang('app.receiving_branch')</div>
                                    <input class="form-control" value="{{old('receiving_branch')}}" name="receiving_branch"
                                        placeholder="@lang('app.receiving_branch')" type="text">

                                    @error('receiving_branch')
                                    <div class="text-danger"> {{$message}}</div>
                                    @enderror
                                </div>

                                <div class="col-lg">
                                    <div class="main-content-label mg-b-5">@lang('app.reference')</div>
                                    <input class="form-control" value="{{old('reference')}}" name="reference" placeholder="@lang('app.reference')"
                                        type="text">

                                    @error('reference')
                                    <div class="text-danger"> {{$message}}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="row row-sm mb-4">

                                <div class="col-lg">
                                    <div class="main-content-label mg-b-5">@lang('app.title')</div>
                                    <input class="form-control" value="{{old('title')}}" name="title" placeholder="@lang('app.title')"
                                        type="text">

                                    @error('title')
                                    <div class="text-danger"> {{$message}}</div>
                                    @enderror
                                </div>

                                <div class="col-lg">
                                    <livewire:company/>
                                    @error('company_id')
                                    <div class="text-danger"> {{$message}}</div>
                                    @enderror
                                </div>

                                <div class="col-lg">
                                <livewire:branch/>
                                    @error('branch')
                                        <div class="text-danger"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header pb-2"><h5>Address Info</h5></div>
                        <div class="card-body text-success">
                            <div class="row row-sm mb-4">
                                <div class="col-lg">
                                    <div class="main-content-label mg-b-5">@lang('app.address1')</div>
                                    <input class="form-control" name="address1" value="{{old('address1')}}"  placeholder="@lang('app.address')"
                                           type="text">

                                    @error('address1')
                                    <div class="text-danger"> {{$message}}</div>
                                    @enderror
                                </div>

                                <div class="col-lg">
                                    <div class="main-content-label mg-b-5">@lang('app.address2')</div>
                                    <input class="form-control" name="address2" value="{{old('address2')}}"  placeholder="@lang('app.address')"
                                           type="text">

                                    @error('address2')
                                    <div class="text-danger"> {{$message}}</div>
                                    @enderror
                                </div>


                            </div>

                            <div class="row row-sm mb-4">
                                <div class="col-lg">
                                    <div class="main-content-label mg-b-5">@lang('app.lat')</div>
                                    <input class="form-control" value="{{old('lat')}}" name="lat" placeholder="@lang('app.lat')"
                                           type="text">
                                    @error('lat')
                                    <div class="text-danger"> {{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-lg">
                                    <div class="main-content-label mg-b-5">@lang('app.lng')</div>
                                    <input class="form-control" value="{{old('lng')}}" name="lng" placeholder="@lang('app.lng')"
                                           type="text">
                                    @error('lng')
                                    <div class="text-danger"> {{$message}}</div>
                                    @enderror
                                </div>

                                <div class="col-lg">
                                    <div class="main-content-label mg-b-5">@lang('app.map_url')</div>
                                    <input class="form-control" value="{{old('map_url')}}" name="map_url" placeholder="@lang('app.map_url')"
                                           type="text">
                                    @error('map_url')
                                    <div class="text-danger"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row row-sm mb-4">
                                <div class="col-lg">
                                  @livewire("location.cities",['selected_city' => old('city_id')])
                                    @error('city_id')
                                    <div class="text-danger"> {{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-lg">
                                    @livewire("location.areas",["areas_for_city_id" => old('city_id'),"selected_area" => old('area_id')])
                                    @error('area_id')
                                    <div class="text-danger"> {{$message}}</div>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="card-footer mt-4">
                            <div class="form-group mb-0 mt-3 justify-content-end">
                                <div>
                                    <button type="submit" class="btn btn-primary"><i
                                            class="fa fa-save pe-2"></i>@lang('app.submit')</button>

                                    <a role="button" href="{{route('receivers.index')}}" class="btn btn-primary"><i
                                            class="fa fa-backward pe-2"></i>@lang('app.back')</a>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>

    <!-- End Row -->

@endsection
