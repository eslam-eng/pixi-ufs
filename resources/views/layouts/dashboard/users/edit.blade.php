@extends('layouts.app')

@section('content')

    {{--    breadcrumb --}}
    @include('layouts.components.breadcrumb',['title' => trans('app.users_page_title'),'first_list_item' => trans('app.users'),'last_list_item' => trans('app.edit_user')])
    {{--    end breadcrumb --}}

    <!-- Row -->
    <div class="row">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12"> <!--div-->
            <div class="card">
                <div class="card-body">
                    <form action="{{route('users.update', $user)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.name')</div>
                                <input class="form-control" name="name" value="{{old('name') ?? $user->name}}" placeholder="@lang('app.name')"
                                       type="text">
                                @error('name')
                                    <div id="validationServer03Feedback" class="invalid-feedback"> {{$message}} </div>
                                @enderror
                            </div>

                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.email')</div>
                                <input class="form-control" value="{{old('email') ?? $user->email}}" name="email" placeholder="@lang('app.email')"
                                       type="email">
                                @error('email')
                                    <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.password')</div>
                                <input class="form-control" value="{{old('password')}}" name="password" placeholder="@lang('app.password')"
                                       type="password">
                                @error('password')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.password_confirmation')</div>
                                <input class="form-control" value="{{old('password_confirmation')}}" name="password_confirmation" placeholder="@lang('app.password_confirmation')"
                                       type="password">
                                @error('password_confirmation')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.phone')</div>
                                <input class="form-control" value="{{old('phone') ?? $user->phone}}" name="phone"
                                        type="text">

                                @error('phone')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.profile_image')</div>
                                <input class="form-control" value="{{old('profile_image') ?? $user->profile_image}}" name="profile_image"
                                        type="file">

                                @error('profile_image')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.type')</div>
                                <select class="form-control" name="type">
                                    @foreach (App\Enums\UsersType::options() as $name=>$value)
                                    <option value="{{ $value }}" {{ $value == $user->type ? "selected":"" }}>{{ $name }}</option>
                                    @endforeach
                                </select>

                                @error('type')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>


                        </div>


                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                @livewire('company', ['selected_company'=>$user->company_id])
                                @error('company_id')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-lg">
                               @livewire('branch', ['branches_for_company_id'=>$user->company_id, 'selected_branch'=>$user->branch_id])
                                @error('branch_id')
                                    <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-lg">
                               @livewire('department', ['departments_for_company_id'=>$user->company_id])
                                @error('department_id')
                                    <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="col-lg">
                                    @livewire('location.cities', ['selected_city'=>$user->city_id])
                                    @error('city_id')
                                        <div class="text-danger"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <div class="col-lg">
                                    @livewire('location.areas', ['areas_for_city_id'=>$user->city_id, 'selected_area'=>$user->area_id])
                                    @error('area_id')
                                        <div class="text-danger"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.address')</div>
                                <textarea class="form-control" name="address">{{old('address') ?? $user->address}}</textarea>

                                @error('address')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.notes')</div>
                                <textarea class="form-control" name="notes">{{old('notes') ?? $user->notes}}</textarea>

                                @error('notes')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row row-sm mb-4">
                            <div class="col-lg mt-2 mb-4">
                                <label class="custom-control custom-checkbox custom-control-lg"> <input
                                        type="checkbox" class="custom-control-input" name="status"
                                        value="1" {{ $user->status ? "checked":"" }}> <span
                                        class="custom-control-label custom-control-label-md  tx-17">@lang('app.status')</span>
                                </label>
                                @error('status')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row row-sm mb-4">
                            {{-- permissions --}}
                            @if(count($permissions))
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
                                                            <label class="custom-control custom-checkbox custom-control-lg">
                                                                <input
                                                                    type="checkbox" class="custom-control-input" name="permissions[]"
                                                                    value="{{$item}}"  {{ $user->can($item) ? "checked":""}}>
                                                                <span class="custom-control-label custom-control-label-md  tx-17">@lang('app.'.$item)</span>
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
