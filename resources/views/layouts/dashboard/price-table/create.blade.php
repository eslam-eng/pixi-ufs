@extends('layouts.app')

@section('content')

    {{--    breadcrumb --}}
    @include('layouts.components.breadcrumb',['title' => trans('app.prices_page_title'),'first_list_item' => trans('app.prices'),'last_list_item' => trans('app.add_price')])
    {{--    end breadcrumb --}}

    <!-- Row -->
    <div class="row">
        <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12"> <!--div-->
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
                    <form action="{{route('prices.store')}}" method="post">
                        @csrf
                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                @livewire('company',['selected_company' => old('company_id')])
                                @error('company_id')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-lg">
                                @livewire('location.cities', ['field_name'=>'location_from','title' => 'location from','selected_city' => old('location_from')])
                                @error('location_from')
                                    <div  class="text-danger"> {{$message}} </div>
                                @enderror
                            </div>

                            <div class="col-lg">
                                @livewire('location.cities', ['field_name'=>'location_to','title' => 'location to','selected_city' => old('location_to')])
                                @error('location_to')
                                    <div  class="text-danger"> {{$message}} </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.price') *</div>
                                <input class="form-control" value="{{old('price')}}" name="price" placeholder="@lang('app.price')"
                                       type="number">
                                @error('price')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.basic_kg') *</div>
                                <input class="form-control" value="{{old('basic_kg')}}" name="basic_kg"
                                       placeholder="@lang('app.basic_kg')" type="number">

                                @error('basic_kg')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.additional_kg_price') *</div>
                                <input class="form-control" value="{{old('additional_kg_price')}}" name="additional_kg_price"
                                       placeholder="@lang('app.additional_kg_price')" type="number">

                                @error('additional_kg_price')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.return_price')</div>
                                <input class="form-control" value="{{old('return_price')}}" name="return_price" placeholder="@lang('app.return_price')"
                                       type="number">

                                @error('return_price')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.special_price')</div>
                                <input class="form-control" value="{{old('special_price')}}" name="special_price" placeholder="@lang('app.special_price')"
                                       type="number">

                                @error('special_price')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer mt-4">
                            <div class="form-group mb-0 mt-3 justify-content-end">
                                <div>
                                    <button type="submit" class="btn btn-primary"><i
                                            class="fa fa-save pe-2"></i>@lang('app.submit')</button>

                                    <a role="button" href="{{route('prices.index')}}" class="btn btn-primary"><i
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
