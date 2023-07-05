@extends('layouts.app')

@section('content')

    {{--    breadcrumb --}}
    @include('layouts.components.breadcrumb',['title' => trans('app.receivers_page_title'),'first_list_item' => trans('app.receivers'),'last_list_item' => trans('app.edit_receiver')])
    {{--    end breadcrumb --}}

    <!-- Row -->
    <div class="row">
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12"> <!--div-->
            <div class="card">
                <div class="card-body">
                    <form action="{{route('receivers.update', $receiver->id)}}" method="post">
                        @csrf
                        @method('put')
                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.receiver_name')</div>
                                <input class="form-control" name="name" value="{{$receiver->name}}" placeholder="@lang('app.receiver_name')"
                                       type="text" required>
                                @error('name')
                                    <div id="validationServer03Feedback" class="invalid-feedback"> {{$message}} </div>
                                @enderror
                            </div>

                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.phone1')</div>
                                <input class="form-control" value="{{$receiver->phone1}}" name="phone1" placeholder="@lang('app.receiver_phone')"
                                       type="text" required>
                                @error('phone1')
                                    <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.phone2')</div>
                                <input class="form-control" value="{{$receiver->phone2}}" name="phone2" placeholder="@lang('app.receiver_phone')"
                                       type="text">
                                @error('phone2')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.receiving_company')</div>
                                <input class="form-control" value="{{$receiver->receiving_company}}" name="receiving_company"
                                       placeholder="@lang('app.receiving_company')" type="text">

                                @error('receiving_company')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.receiving_branch')</div>
                                <input class="form-control" value="{{$receiver->receiving_branch}}" name="receiving_branch"
                                       placeholder="@lang('app.receiving_branch')" type="text">

                                @error('receiving_branch')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="row row-sm mb-4">

                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.reference')</div>
                                <input class="form-control" value="{{$receiver->reference}}" name="reference" placeholder="@lang('app.reference')"
                                       type="text">

                                @error('reference')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.title')</div>
                                <input class="form-control" value="{{$receiver->title}}" name="title" placeholder="@lang('app.title')"
                                       type="text">

                                @error('title')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                @livewire('company', ['selected_company'=> $receiver->company_id])
                                @error('company_id')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-lg">
                               @livewire('branch',['branches_for_company_id' => $receiver->company_id,'selected_branch' => $receiver->branch_id])
                                @error('branch')
                                    <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="card card-success mt-4">
                            <div class="card-header pb-2"><h5 class="card-title mb-0 pb-0">Address Info</h5></div>
                            <div class="card-body text-success">
                                <div class="row row-sm mb-4">
                                    <div class="col-lg">
                                        <div class="main-content-label mg-b-5">@lang('app.address1')</div>
                                        <input class="form-control" name="address1" value="{{$receiver->address1}}"  placeholder="@lang('app.address')"
                                               type="text" required>

                                        @error('address1')
                                        <div class="text-danger"> {{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="col-lg">
                                        <div class="main-content-label mg-b-5">@lang('app.address2')</div>
                                        <input class="form-control" name="address2" value="{{$receiver->address2}}"  placeholder="@lang('app.address')"
                                               type="text">

                                        @error('address2')
                                        <div class="text-danger"> {{$message}}</div>
                                        @enderror
                                    </div>


                                </div>

                                <div class="row row-sm mb-4">
                                    <div class="col-lg">
                                        <div class="main-content-label mg-b-5">@lang('app.lat')</div>
                                        <input class="form-control" value="{{$receiver->lat}}" name="lat" placeholder="@lang('app.lat')"
                                               type="text">
                                    </div>
                                    <div class="col-lg">
                                        <div class="main-content-label mg-b-5">@lang('app.lng')</div>
                                        <input class="form-control" value="{{ $receiver->lng}}" name="lng" placeholder="@lang('app.lng')"
                                               type="text">
                                    </div>

                                    <div class="col-lg">
                                        <div class="main-content-label mg-b-5">@lang('app.map_url')</div>
                                        <input class="form-control" value="{{$receiver->map_url}}" name="map_url" placeholder="@lang('app.map_url')"
                                               type="text">
                                    </div>
                                </div>

                                <div class="row row-sm mb-4">
                                    <div class="col-lg">
                                      @livewire("location.cities",['selected_city' => $receiver->city_id])
                                        @error('city_id')
                                        <div class="text-danger"> {{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg">
                                        @livewire("location.areas",["areas_for_city_id" =>  $receiver->city_id,"selected_area" => $receiver->area_id])
                                    </div>
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

                                    <a role="button" href="{{route('receivers.index')}}" class="btn btn-danger"><i
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
