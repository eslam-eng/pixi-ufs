@extends('layouts.app')

@section('content')

    {{--    breadcrumb --}}
    @include('layouts.components.breadcrumb',['title' => trans('prices_page_title'),'first_list_item' => trans('app.prices'),'last_list_item' => trans('app.increase_price')])
    {{--    end breadcrumb --}}

    <!-- Row -->
    <div class="row">
        <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12"> <!--div-->
            <div class="card">
                <div class="card-body">
                    <form action="{{route('increase-prices.store')}}" method="post">
                        @csrf
                        <div class="row row-sm">
                            <div class="col-lg">
                                <livewire:company/>
                                @error('company_id')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.increase_percentage')</div>
                                <input class="form-control" value="{{old('increase_percentage')}}" name="increase_percentage"
                                       placeholder="@lang('app.increase_percentage')" type="number" required>

                                @error('increase_percentage')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer mt-4">
                            <div class="form-group mb-0 mt-3 justify-content-end">
                                <div>
                                    <button type="submit" class="btn btn-primary"><i
                                            class="fa fa-save pe-2"></i>@lang('app.submit')</button>

                                    <a role="button" href="{{ URL::previous() }}" class="btn btn-primary"><i
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
