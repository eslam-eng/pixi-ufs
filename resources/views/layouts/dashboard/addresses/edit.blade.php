@extends('layouts.app')

@section('content')

    {{--    breadcrumb --}}
    @include('layouts.components.breadcrumb',['title' => trans('app.addresses_edit'),'first_list_item' => trans('app.addresses'),'last_list_item' => trans('app.add_address')])
    {{--    end breadcrumb --}}

    <!-- Row -->
    <div class="row">
        <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12"> <!--div-->
            <div class="card">
                <div class="card-body">
                    <form action="{{route('address.update', $address->id)}}" method="post">
                        @csrf
                        @method('put')
                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.address')</div>
                                <input class="form-control" name="address" value="{{old('address') ?? $address->address }}" placeholder="@lang('app.address')"
                                       type="text" required>
                                @error('address')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.map_url')</div>
                                <input class="form-control" name="map_url" value="{{old('map_url') ?? $address->map_url }}" placeholder="@lang('app.map_url')"
                                       type="url" required>
                                @error('map_url')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <livewire:locations-drop-down/>
                            @error('city_id')
                                <div class="text-danger"> {{$message}}</div>
                            @enderror
                            @error('area_id')
                            <div class="text-danger"> {{$message}}</div>
                            @enderror
                        </div>

                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.lat')</div>
                                <input class="form-control" name="lat" value="{{old('lat') ?? $address->lat }}" placeholder="@lang('app.lat')"
                                       type="text">

                            </div>

                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.lng')</div>
                                <input class="form-control" name="lng" value="{{old('lng') ?? $address->lng }}" placeholder="@lang('app.lng')"
                                       type="text">
                            </div>

                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.postal_code')</div>
                                <input class="form-control" name="postal_code" value="{{old('postal_code')  ?? $address->postal_code }}" placeholder="@lang('app.receiver_name')"
                                       type="text">
                            </div>
                        </div>

                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="form-group mg-b-20">
                                    <label class="ckbox"><input name="is_default" checked="" type="checkbox">
                                        <span class="tx-13">@lang('app.make_address_default')</span>
                                    </label>
                                </div>
                            </div>


                        </div>

                        <div class="card-footer mt-4">
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
        </div>
    </div>

    <!-- End Row -->

@endsection
