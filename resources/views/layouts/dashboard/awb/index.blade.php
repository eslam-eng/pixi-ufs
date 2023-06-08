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
                            <a class="btn btn-rounded btn-primary" href="{{route('awbs.create')}}"><i class="fe fe-plus me-2"></i>@lang('app.new')</a>
                            <a role="button" href="{{route('awb.import-form')}}" class="btn btn-rounded btn-success"><i class="fa fa-upload pe-2"></i>@lang('app.import')</a>
                            <a class="btn btn-rounded btn-dark" data-bs-target="#changeAwbsStatus" data-bs-toggle="modal" href="">@lang('app.change_status')</a>
                            <button class="btn btn-rounded btn-primary" data-bs-target="#print_awbs_modal" data-bs-toggle="modal"><i class="fa fa-print"></i>@lang('app.print')</button>
                            <button data-url="{{route('awb.delete-multiple')}}" data-csrf="{{csrf_token()}}" class="btn btn-danger btn-rounded delete-selected-btn"><i class="fa fa-trash pe-2"></i>@lang('app.delete_selected')</button>
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
    @include('layouts.dashboard.awb.components.change-awb-status-modal',['awb_statuses'=>$awb_statuses])

@endsection

@section('scripts')
    @include('layouts.components.datatable-scripts')
@endsection
