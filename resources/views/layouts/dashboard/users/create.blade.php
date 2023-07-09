@extends('layouts.app')

@section('content')

    {{--    breadcrumb --}}
    @include('layouts.components.breadcrumb',['title' => trans('app.users_page_title'),'first_list_item' => trans('app.users'),'last_list_item' => trans('app.add_user')])
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
                    <form action="{{route('users.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.name') *</div>
                                <input class="form-control" name="name" value="{{old('name')}}" placeholder="@lang('app.name')"
                                       type="text">
                                @error('name')
                                    <div class="text-danger"> {{$message}} </div>
                                @enderror
                            </div>

                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.email') *</div>
                                <input class="form-control" value="{{old('email')}}" name="email" placeholder="@lang('app.email')"
                                       type="email">
                                @error('email')
                                    <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.phone') *</div>
                                <input class="form-control" value="{{old('phone')}}" name="phone"
                                       placeholder="@lang('app.phone')" type="text">

                                @error('phone')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="row row-sm mb-4">

                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.profile_image')</div>
                                <input class="form-control" value="{{old('profile_image')}}" name="profile_image"
                                       placeholder="@lang('app.profile_image')" type="file">

                                @error('profile_image')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.password') *</div>
                                <input class="form-control" value="{{old('password')}}" name="password" placeholder="@lang('app.password')"
                                       type="password">
                                @error('password')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.password_confirmation') *</div>
                                <input class="form-control" value="{{old('password_confirmation')}}" name="password_confirmation" placeholder="@lang('app.password_confirmation')"
                                       type="password">
                                @error('password')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>


                        </div>


                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                @livewire('company', ['selected_company'=>old('company_id')])
                                @error('company_id')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-lg">
                               <livewire:branch/>
                                @error('branch_id')
                                    <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-lg">
                               <livewire:department/>
                                @error('department_id')
                                    <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.type')</div>
                                <select class="form-control" name="type">
                                    @foreach (App\Enums\UsersType::options() as $name=>$value)
                                    <option value="{{ $value }}">{{ $name }}</option>
                                    @endforeach
                                </select>

                                @error('type')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-lg">
                                <div class="col-lg">
                                    @livewire('location.cities', ['selected_city'=>old('city_id')])
                                    @error('city_id')
                                        <div class="text-danger"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <div class="col-lg">
                                    <livewire:location.areas/>
                                    @error('area_id')
                                        <div class="text-danger"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.address')</div>
                                <textarea class="form-control" name="address"
                                       placeholder="@lang('app.address')">{{old('address')}}</textarea>

                                @error('address')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.notes')</div>
                                <textarea class="form-control" name="notes"
                                       placeholder="@lang('app.notes')">{{old('notes')}}</textarea>

                                @error('notes')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg mt-2 mb-4">
                            <label class="custom-control custom-checkbox custom-control-lg"> <input
                                    type="checkbox" class="custom-control-input" name="status"
                                    value="1" checked> <span
                                    class="custom-control-label custom-control-label-md  tx-17">@lang('app.status')</span>
                            </label>
                            @error('status')
                            <div class="text-danger"> {{$message}}</div>
                            @enderror
                        </div>
                        <div class="row row-sm mb-4">
                            @if(count($permissions))
                                {{-- permissions --}}
                                @foreach($permissions as $key =>$permission)

                                    <div class="col-sm-4 col-xl-4 border-5">
                                        <div class="card card-absolute">
                                            <div class="card-header bg-primary">
                                                <h5 class="text-white">{{trans('app.'.$key)}}</h5>
                                            </div>

                                            <div class="card-body">
                                                @foreach($permission as $item)
                                                    <div class="mb-3 m-t-15">
                                                        <div class="form-check checkbox checkbox-primary mb-0">
                                                            <label class="custom-control custom-checkbox custom-control-lg"> <input
                                                                    type="checkbox" class="custom-control-input" name="permissions[]"
                                                                    value="{{$item}}"> <span
                                                                    class="custom-control-label custom-control-label-md  tx-17">@lang('app.'.$item)</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                        </div>

                        <div class="card-footer mt-4">
                            <div class="form-group mb-0 mt-3 justify-content-end">
                                <div>
                                    <button type="submit" class="btn btn-primary"><i
                                            class="fa fa-save pe-2"></i>@lang('app.save')</button>

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
