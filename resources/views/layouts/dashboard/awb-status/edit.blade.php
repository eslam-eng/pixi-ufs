@extends('layouts.app')

@section('content')

    {{--    breadcrumb --}}
    @include('layouts.components.breadcrumb',['title' => trans('app.prices_page_title'),'first_list_item' => trans('app.prices'),'last_list_item' => trans('app.add_price')])
    {{--    end breadcrumb --}}

    <!-- Row -->
    <div class="row">
        @if($errors->any())
        <ul>
        @foreach ($errors->all() as $error)
            <i>
                {{ $error }}
            </i>
        @endforeach
        </ul>
        @endif
        <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12"> <!--div-->
            <div class="card">
                <div class="card-body">
                    <form action="{{route('awb-status.update', $awbStatus->id)}}" method="post">
                        @csrf
                        @method('put')
                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.name')</div>
                                <input class="form-control" value="{{old('name') ?? $awbStatus->name }}" name="name" placeholder="@lang('app.name')"
                                       type="text">
                                @error('name')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.stepper')</div>
                                <select class="form-control" name="stepper">
                                    @foreach (App\Enums\Stepper::options() as $name=>$value)
                                    <option value="{{ $value }}" {{ $value == $awbStatus->stepper ? "selected":""  }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('stepper')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.type')</div>
                                <select class="form-control" name="type">
                                    @foreach (App\Enums\AwbStatusCategory::options() as $name=>$value)
                                    <option value="{{ $value }}" {{ $value == $awbStatus->type ? "selected":""  }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('type')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.sms')</div>
                                <input class="form-control" value="{{old('sms') ?? $awbStatus->sms }}" name="sms" placeholder="@lang('app.sms')"
                                       type="text">
                                @error('sms')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.description')</div>
                                <textarea class="form-control" name="description" placeholder="@lang('app.description')"
                                       >{{old('description') ?? $awbStatus->description }}</textarea>
                                @error('description')
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
