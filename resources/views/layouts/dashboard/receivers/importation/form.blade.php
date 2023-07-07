@extends('layouts.app')

@section('content')

    {{--    breadcrumb --}}
    @include('layouts.components.breadcrumb',['title' => trans('app.receivers_title'),'first_list_item' => trans('app.receivers'),'last_list_item' => trans('app.imports')])
    {{--    end breadcrumb --}}
    <!-- Row -->
    @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
    <div class="row row-sm">
        <div class="col-lg-4">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="text-dark mb-4">@lang('app.first_download_receivers_template')</div>
                        <a role="button" class="btn btn-info btn-block" href="{{route('receivers-download-template')}}">download
                            template</a>
                    </div>
                </div>
            </div>
            
        </div>

        <div class="col-lg-8">
            <form method="post" action="{{route('receivers-import')}}" enctype="multipart/form-data">
                @csrf
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="card-header">
                            <div class="text-dark">@lang('app.second_step_upload_excel')</div>
                        </div>
                        <div class="card-body">
                            <div>
                                <label for="formFileLg" class="form-label">File</label>
                                <input name="file" class="form-control form-control-lg" type="file" required>
                            </div>
                            @error('file')
                                <div class="text-danger">{{ $error }}</div>
                            @enderror
                        </div>
                    </div>

                   <div class="card-footer">
                       <div class="form-group mb-0 mt-3 justify-content-end">
                           <div>
                               <button type="submit" class="btn btn-primary"><i
                                       class="fa fa-send pe-2"></i>@lang('app.send')</button>

                               <a role="button" href="{{ URL::previous() }}" class="btn btn-primary"><i
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
