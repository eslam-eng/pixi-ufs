@extends('layouts.app')

@section('content')

    {{--    breadcrumb --}}
    @include('layouts.components.breadcrumb',['title' => trans('departments_page_title'),'first_list_item' => trans('app.departments'),'last_list_item' => trans('app.show_department')])
    {{--    end breadcrumb --}}

    <!-- Row -->
    <div class="row">
        {{-- start departments --}}
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                        <div class="mt-4">
                            <div class="items departments-items">
                                <div class="item mt-4">
                                    <h4>@lang('app.department_data')</h4>
                                    <hr>
                                    <div class="row row-sm mb-4">
                                        <div class="col-lg">
                                            <div class="main-content-label mg-b-5">@lang('app.name')</div>
                                            <label class="form-control">{{ $department->name }}</label>
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
            {{-- end departments --}}
    </div>

    <!-- End Row -->

@endsection
