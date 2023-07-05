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
                            <a class="btn btn-primary" href="{{route('awbs.create')}}"><i class="fe fe-plus me-2"></i>@lang('app.new')</a>
                            
                            <div class="btn-group ms-2 mt-2 mb-2">
                                <div class="dropdown">
                                    <button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary" data-bs-toggle="dropdown" id="dropdownMenuButton" type="button">@lang('app.actions') <i class="fas fa-caret-down ms-1"></i></button>
                                    <div class="dropdown-menu tx-13" style="">
                                        <a class="dropdown-item" href="{{route('awb.import-form')}}"><i class="fa fa-file-import pe-2"></i>@lang('app.import')</a>
                                        <a class="dropdown-item" data-bs-target="#changeAwbsStatus" data-bs-toggle="modal" href=""><i class="fa fa-exchange-alt pe-2"></i>@lang('app.change_status')</a>
                                        <button class="dropdown-item btn" data-bs-target="#print_awbs_modal" data-bs-toggle="modal"><i class="fa fa-print pe-2"></i>@lang('app.print')</button>
                                        @can('delete_shipment')
                                        <button data-url="{{route('awb.delete-multiple')}}" data-csrf="{{csrf_token()}}" class="dropdown-item btn delete-selected-btn"><i class="fa fa-trash pe-2"></i>@lang('app.delete_selected')</button>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {!! $dataTable->table(['class' => 'table-data table table-bordered text-nowrap border-bottom']) !!}
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
