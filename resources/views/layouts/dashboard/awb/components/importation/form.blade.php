@extends('layouts.app')

@section('content')

    {{--    breadcrumb --}}
    @include('layouts.components.breadcrumb',['title' => trans('app.awbs_title'),'first_list_item' => trans('app.awbs'),'last_list_item' => trans('app.imports')])
    {{--    end breadcrumb --}}
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-4">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="text-dark mb-4">@lang('app.first_download_awb_template')</div>
                        <a role="button" class="btn btn-info btn-block" href="{{route('awb.download-template')}}">download template</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="text-dark">@lang('app.first_upload_excel')</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->

@endsection
