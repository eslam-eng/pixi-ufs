@extends('layouts.app')

@section('content')

    {{--    breadcrumb --}}
    @include('layouts.components.breadcrumb',['title' => trans('app.users_page_title'),'first_list_item' => trans('app.users'),'last_list_item' => trans('app.show_user')])
    {{--    end breadcrumb --}}

    <!-- Row -->
    <div class="row">
        <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12"> <!--div-->
            <div class="card">
                <div class="card-body">
                        <div class="row row-sm mb-4">
                            @isset($user->attachments)
                                <div class="col-lg">
                                    <div class="text-wrap">
                                        <div class="example">
                                            <img alt="Responsive image" class="img-thumbnail wd-100p wd-sm-200" src="{{ asset($user->attachments->path."/".$user->attachments->file_name) }}">
                                        </div>
                                    </div>
                                </div>
                            @endisset
                        </div>
                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.name')</div>
                                <label class="form-control">{{ $user->name }}</label>
                            </div>

                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.email')</div>
                                <label class="form-control">{{ $user->email }}</label>
                            </div>

                        </div>

                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.phone')</div>
                                <label class="form-control">{{ $user->phone }}</label>

                            </div>
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.type')</div>
                                <label class="form-control">{{ App\Enums\UsersType::from($user->type)->name }}</label>
                            </div>


                        </div>


                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.company')</div>
                                    <label class="form-control">{{ $user->company->name ?? "" }}</label>
                            </div>

                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.branch')</div>
                                <label class="form-control">{{ $user->branch->name ?? "" }}</label>
                            </div>
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.department')</div>
                                <label class="form-control">{{ $user->department->name ?? "" }}</label>
                            </div>
                        </div>
                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="col-lg">
                                    <div class="main-content-label mg-b-5">@lang('app.city')</div>
                                    <label class="form-control">{{ $user->city->title ?? "" }}</label>
                                </div>
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <div class="col-lg">
                                    <div class="main-content-label mg-b-5">@lang('app.area')</div>
                                    <label class="form-control">{{ $user->area->title ?? "" }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.address')</div>
                                <label class="form-control">{{ $user->address }}</label>
                            </div>
                        </div>
                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.notes')</div>
                                <label class="form-control">{{ $user->notes }}</label>
                            </div>
                        </div>
                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="col-lg">
                                    <label class="custom-control custom-checkbox custom-control-lg"> <input
                                        type="checkbox" class="custom-control-input" name="status"
                                        {{ $user->status ? "checked":"" }} @disabled(true)> <span
                                        class="custom-control-label custom-control-label-md  tx-17">@lang('app.status')</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row row-sm mb-4">
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
                                                                type="checkbox" class="custom-control-input" name="status"
                                                                {{ $user->can($item->name) ? "checked":""}} @disabled(true)> <span
                                                                class="custom-control-label custom-control-label-md  tx-17">@lang('app.'.$item->name)</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                    </div>
                                </div>

                            @endforeach
                        </div>

                        <div class="card-footer mt-4">
                            <div class="form-group mb-0 mt-3 justify-content-end">
                                <div>
                                    <a role="button" href="{{ URL::previous() }}" class="btn btn-primary"><i
                                            class="fa fa-backward pe-2"></i>@lang('app.back')</a>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>

    <!-- End Row -->

@endsection
