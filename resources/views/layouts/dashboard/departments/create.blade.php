@extends('layouts.app')

@section('content')

    {{--    breadcrumb --}}
    @include('layouts.components.breadcrumb',['title' => trans('branches_page_title'),'first_list_item' => trans('app.branches'),'last_list_item' => trans('app.add_branch')])
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
                                    <h4>@lang('app.branch_data')</h4>
                                    <hr>
                                    <div class="row row-sm mb-4">
                                        <div class="col-lg">
                                            <div class="main-content-label mg-b-5">@lang('app.name')</div>
                                            <input class="form-control" name='name' value="{{old('name')}}" placeholder="@lang('app.name')"
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
                                    <button type="submit" class="btn btn-success"><i
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
