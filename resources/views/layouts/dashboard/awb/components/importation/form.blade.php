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
                        <a role="button" class="btn btn-info btn-block" href="{{route('awb.download-template')}}">download
                            template</a>
                    </div>
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="col-lg-8">
            <form method="post" action="{{route('awb.import')}}" enctype="multipart/form-data">
                @csrf
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="card-header">
                            <div class="text-dark">@lang('app.first_upload_excel')</div>
                        </div>
                        <div class="card-body">
                            <x-payment-types/>
                            <hr>
                            <x-service-types service_type_field_name="service_type_id"/>
                            <hr>
                            <livewire:company-shipment-type shipment_types_for_company_id="{{$company_id}}"/>
                            <hr>
                            <div>
                                <label for="formFileLg" class="form-label">File</label>
                                <input name="file" class="form-control form-control-lg" type="file">
                            </div>
                        </div>
                    </div>

                   <div class="card-footer">
                       <div class="form-group mb-0 mt-3 justify-content-end">
                           <div>
                               <button type="submit" class="btn btn-success"><i
                                       class="fa fa-send pe-2"></i>@lang('app.send')</button>

                               <a role="button" href="{{route('awbs.index')}}" class="btn btn-danger"><i
                                       class="fa fa-backward pe-2"></i>@lang('app.back')</a>
                           </div>
                       </div>
                   </div>

                </div>

            </form>
        </div>
    </div>
    <!-- End Row -->

@endsection
