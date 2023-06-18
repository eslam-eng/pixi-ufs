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
                        <h4 class="text-dark mb-4">@lang('app.first_download_template')</h4>
                        <a role="button" class="btn btn-rounded btn-dark-gradient btn-block" href="{{route('prices-download-template')}}">download
                            template</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <form method="post" action="{{route('prices-import')}}" enctype="multipart/form-data">
                @csrf
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="card-header">
                            <h4 class="text-dark">@lang('app.upload_excel_with_properties')</h4>
                        </div>
                        <div class="card-body">
                            <livewire:company/>
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
