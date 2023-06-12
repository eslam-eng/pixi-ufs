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
                    <form action="{{route('prices.update', $priceTable->id)}}" method="post">
                        @csrf
                        @method('put')
                        <div class="row row-sm">
                            <div class="col-lg">
                                @livewire('company', ['selected_company'=>$priceTable->company_id])
                                @error('company_id')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                @livewire('location.cities', ['field_name'=>'location_from', 'selected_city'=>$priceTable->location_from])
                                @error('location_from')
                                    <div  class="text-danger"> {{$message}} </div>
                                @enderror
                            </div>

                            <div class="col-lg">
                                @livewire('location.cities', ['field_name'=>'location_to', 'selected_city'=>$priceTable->location_to])
                                @error('location_to')
                                    <div  class="text-danger"> {{$message}} </div>
                                @enderror
                            </div>

                        </div>

                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.price')</div>
                                <input class="form-control" value="{{old('price') ?? $priceTable->price }}" name="price" placeholder="@lang('app.price')"
                                       type="number" required>
                                @error('price')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.basic_kg')</div>
                                <input class="form-control" value="{{old('basic_kg') ?? $priceTable->basic_kg}}" name="basic_kg"
                                       placeholder="@lang('app.basic_kg')" type="number" required>

                                @error('basic_kg')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.additional_kg_price')</div>
                                <input class="form-control" value="{{old('additional_kg_price') ?? $priceTable->additional_kg_price }}" name="additional_kg_price"
                                       placeholder="@lang('app.additional_kg_price')" type="number" required>

                                @error('additional_kg_price')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.return_price')</div>
                                <input class="form-control" value="{{old('return_price') ?? $priceTable->return_price }}" name="return_price" placeholder="@lang('app.return_price')"
                                       type="number">

                                @error('return_price')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.special_price')</div>
                                <input class="form-control" value="{{old('special_price') ?? $priceTable->special_price }}" name="special_price" placeholder="@lang('app.special_price')"
                                       type="number">

                                @error('special_price')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer mt-4">
                            <div class="form-group mb-0 mt-3 justify-content-end">
                                <div>
                                    <button type="submit" class="btn btn-success"><i
                                            class="fa fa-save pe-2"></i>@lang('app.submit')</button>

                                    <a role="button" href="{{route('prices.index')}}" class="btn btn-danger"><i
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
