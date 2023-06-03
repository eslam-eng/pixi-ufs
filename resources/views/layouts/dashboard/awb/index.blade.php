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
                            <a class="btn ripple btn-primary" href="{{route('awbs.create')}}"><i class="fe fe-plus me-2"></i>@lang('app.new')</a>
                            <a role="button" href="{{route('awb.import-form')}}" class="btn btn-success"><i class="fa fa-upload pe-2"></i>@lang('app.import')</a>
                            <button class="btn ripple btn-primary" data-bs-target="#print_awbs_modal" data-bs-toggle="modal"><i class="fa fa-print"></i>@lang('app.print')</button>
                            <button class="btn ripple btn-primary" data-bs-target="#export_pdf_modal" data-bs-toggle="modal"><i class="fa fa-download"></i>@lang('app.export_pdf')</button>
                            <button data-url="{{route('awb.delete-multiple')}}" data-csrf="{{csrf_token()}}" class="btn btn-danger delete-selected-btn"><i class="fa fa-trash pe-2"></i>@lang('app.delete_selected')</button>
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

    @include('layouts.dashboard.awb.components.print-awbs-modal')
    @include('layouts.dashboard.awb.components.export-pdf-modal')

@endsection

@section('scripts')
    @include('layouts.components.datatable-scripts')

@endsection
