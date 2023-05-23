@extends('layouts.app')

@section('styles')
    <link href="{{asset('assets/plugins/datatable/css/dataTables.bootstrap5.css')}}" rel="stylesheet" />
@endsection

@section('content')

{{--    breadcrumb --}}
    @include('layouts.components.breadcrumb',['title' => trans('receivers_page_title'),'first_list_item' => trans('app.receivers'),'last_list_item' => trans('app.all_receivers')])
{{--    end breadcrumb --}}


    <!--start filters section -->
        @include('layouts.dashboard.receivers.components._filters')
    <!--end filterd section -->
    <!--Row-->
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="breadcrumb-header justify-content-between">
                        <div class="left-content">
                            <a class="btn ripple btn-primary" href="{{route('receivers.create')}}"><i class="fe fe-plus me-2"></i>{{ trans('app.add_new_receiver') }}</a>
                        </div>
{{--                        <div class="justify-content-center">--}}
{{--                            <button type="button" class="btn btn-secondary">--}}
{{--                                <i class="fe fe-download me-1"></i> Download User Data--}}
{{--                            </button>--}}
{{--                        </div>--}}
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

@endsection

@section('scripts')
    @include('layouts.components.datatable-scripts')
@endsection
