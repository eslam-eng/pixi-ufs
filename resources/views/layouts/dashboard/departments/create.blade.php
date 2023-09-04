@extends('layouts.app')

@section('content')

    {{--    breadcrumb --}}
    @include('layouts.components.breadcrumb',['title' => trans('app.departments_page_title'),'first_list_item' => trans('app.departments'),'last_list_item' => trans('app.add_department')])
    {{--    end breadcrumb --}}

    <!-- Row -->
    <div class="row">
        {{-- start branches --}}
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form method="post" action="{{ route('departments.store') }}">
                        @csrf
                        <div class="mt-4">
                            <input class="form-control" name='company_id' value="{{ $company_id}}"
                                type="hidden">
                            <div class="items branches-items">
                                <div class="item mt-4">
                                    <h4>@lang('app.department_data')</h4>
                                    <hr>
                                    <div class="row row-sm mb-4">
                                        <div class="col-lg">
                                            <div class="main-content-label mg-b-5">@lang('app.name')</div>
                                            <input class="form-control" name='name' value="{{old('name')}}" placeholder="@lang('app.name')"
                                                type="text">
                                                @error('name')
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
                                    <button type="submit" class="btn btn-primary"><i
                                            class="fa fa-save pe-2"></i>@lang('app.submit')</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
            {{-- end branches --}}
    </div>

    <!-- End Row -->

@endsection
