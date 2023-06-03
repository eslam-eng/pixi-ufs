@extends('layouts.app')

@section('content')

    {{--    breadcrumb --}}
    @include('layouts.components.breadcrumb',['title' => trans('branches_page_title'),'first_list_item' => trans('app.branches'),'last_list_item' => trans('app.show_branch')])
    {{--    end breadcrumb --}}

    <!-- Row -->
    <div class="row">
        {{-- start branches --}}
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                        <div class="mt-4">
                            <input class="form-control" name='company_id' value="{{ $branch->company_id}}"
                                type="hidden">
                            <div class="items branches-items">
                                <div class="item mt-4">
                                    <h4>@lang('app.branch_data')</h4>
                                    <hr>
                                    <div class="row row-sm mb-4">
                                        <div class="col-lg">
                                            <div class="main-content-label mg-b-5">@lang('app.name')</div>
                                            <label class="form-control">{{ $branch->name }}</label>
                                        </div>
        
                                        <div class="col-lg">
                                            <div class="main-content-label mg-b-5">@lang('app.phone')</div>
                                            <label class="form-control">{{ $branch->phone }}</label>
                                        </div>
                                    </div>
        
                                    <div class="row row-sm mb-4">
                                        <div class="col-lg">
                                            <div class="main-content-label mg-b-5">@lang('app.status')</div>
                                            <label class="form-control">{{ $branch->status }}</label>
                                        </div>
                                    </div>
        
                                    <hr>
                                    <div class="row row-sm mb-4">
                                        <div class="col-lg">
                                            <div class="main-content-label mg-b-5">@lang('app.address')</div>
                                            <label class="form-control">{{ $branch->address }}</label>
                                        </div>
                                        <div class="col-lg">
                                            @livewire("locations-drop-down", ["city_id"=>$branch->city_id, "area_id"=>$branch->area_id])
                                            @error('city_id')
                                            <div class="text-danger"> {{$message}}</div>
                                            @enderror
                                            @error('area_id')
                                            <div class="text-danger"> {{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="form-group mb-0 mt-3 justify-content-end">
                                <div>
                                    <a href="{{ URL::previous() }}" class="btn btn-success"><i
                                            class="fa fa-save pe-2"></i>@lang('app.back')</a>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            </div>
            {{-- end branches --}}
    </div>

    <!-- End Row -->

@endsection

