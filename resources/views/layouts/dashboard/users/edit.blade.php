@extends('layouts.app')

@section('content')

    {{--    breadcrumb --}}
    @include('layouts.components.breadcrumb',['title' => trans('users_page_title'),'first_list_item' => trans('app.users'),'last_list_item' => trans('app.edit_user')])
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
                                       type="text" required>
                                @error('name')
                                    <div id="validationServer03Feedback" class="invalid-feedback"> {{$message}} </div>
                                @enderror
                            </div>

                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.email')</div>
                                <input class="form-control" value="{{old('email') ?? $user->email}}" name="email" placeholder="@lang('app.email')"
                                       type="email" required>
                                @error('email')
                                    <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.password')</div>
                                <input class="form-control" value="{{old('password')}}" name="password" placeholder="@lang('app.password')"
                                       type="password" required>
                                @error('password')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.password_confirmation')</div>
                                <input class="form-control" value="{{old('password_confirmation')}}" name="password_confirmation" placeholder="@lang('app.password_confirmation')"
                                       type="password" required>
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
                               @livewire('branch')
                                @error('branch_id')
                                    <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-lg">
                               @livewire('department')
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
                            <div class="col-lg">
                                <div class="col-lg">
                                    <div class="main-content-label mg-b-5">@lang('app.status')</div>
                                    <input name="status" value="1"
                                        placeholder="@lang('app.status')" type="checkbox" {{ $user->status ? "checked":"" }}>

                                    @error('status')
                                    <div class="text-danger"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row row-sm mb-4">
                            <div class="col-lg">
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
                                                                <input class="form-check-input" name="permissions[]" value="{{$item->name}}" id="checkbox-primary-{{$item->id}}" type="checkbox" data-bs-original-title="" title="{{$item->name}}" {{ $user->can($item->name) ? "checked":""}}>
                                                                <label class="form-check-label" for="checkbox-primary-{{$item->id}}">{{$item->name}}</label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                        </div>
                                    </div>

                                @endforeach
                            </div>
                        </div>

                        <div class="card-footer mt-4">
                            <div class="form-group mb-0 mt-3 justify-content-end">
                                <div>
                                    <button type="submit" class="btn btn-success"><i
                                            class="fa fa-save pe-2"></i>@lang('app.save')</button>

                                    <a role="button" href="{{route('users.index')}}" class="btn btn-danger"><i
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