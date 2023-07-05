@extends('layouts.app')

@section('content')

    {{--    breadcrumb --}}
    @include('layouts.components.breadcrumb',['title' => trans('app.departments_page_title'),'first_list_item' => trans('app.departments'),'last_list_item' => trans('app.edit_department')])
    {{--    end breadcrumb --}}

    <!-- Row -->
    <div class="row">
        {{-- start departments --}}
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form method="post" action="{{ route('departments.update', $department->id) }}">
                        @csrf
                        @method('put')
                        <div class="mt-4">
                            <input class="form-control" name='company_id' value="{{ $department->company_id}}"
                                type="hidden">
                            <div class="items departments-items">
                                <div class="item mt-4">
                                    <h4>@lang('app.department_data')</h4>
                                    <hr>
                                    <div class="row row-sm mb-4">
                                        <div class="col-lg">
                                            <div class="main-content-label mg-b-5">@lang('app.name')</div>
                                            <input class="form-control" name='name' value="{{old('name') ?? $department->name}}" placeholder="@lang('app.name')"
                                                type="text">
                                            @error('name')
                                                <div id="validationServer03Feedback" class="invalid-feedback"> {{$message}} </div>
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
                                    <a role="button" href="{{ URL::previous() }}" class="btn btn-danger"><i
                                        class="fa fa-backward pe-2"></i>@lang('app.back')</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
            {{-- end departments --}}
    </div>

    <!-- End Row -->

@endsection
