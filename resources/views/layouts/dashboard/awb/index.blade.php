@extends('layouts.app')

@section('styles')
    <link href="{{asset('assets/plugins/datatable/css/dataTables.bootstrap5.css')}}" rel="stylesheet" />
@endsection

@section('content')

{{--    breadcrumb --}}
    @include('layouts.components.breadcrumb',['title' => trans('app.awbs_title'),'first_list_item' => trans('app.awbs'),'last_list_item' => trans('app.all_awbs')])
{{--    end breadcrumb --}}

    <!--start filters section -->
        @include('layouts.dashboard.awb.components._filters')
    <!--end filterd section -->
    <!--Row-->
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="form-group mb-0 mt-3 justify-content-end">
                        <div>
                            <a class="btn ripple btn-primary" href="{{route('awb.create')}}"><i class="fe fe-plus me-2"></i>@lang('app.new')</a>
                            <a role="button" href="{{route('awb.import-form')}}" class="btn btn-success"><i class="fa fa-upload pe-2"></i>@lang('app.import')</a>
                            <button type="submit" class="btn btn-info"><i class="fa fa-download pe-2"></i>@lang('app.export_pdf')</button>
                            <button data-url="{{route('awb.destroy')}}" data-csrf="{{csrf_token()}}" class="btn btn-danger delete-selected-btn"><i class="fa fa-trash pe-2"></i>@lang('app.delete_selected')</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {!! $dataTable->table(['class' => 'table table-bordered text-nowrap border-bottom']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->

@endsection

@section('scripts')
    @include('layouts.components.datatable-scripts')

@endsection
