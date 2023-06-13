@extends('layouts.app')

@section('styles')
    <link href="{{asset('assets/plugins/datatable/css/dataTables.bootstrap5.css')}}" rel="stylesheet" />
@endsection

@section('content')

{{--    breadcrumb --}}
    @include('layouts.components.breadcrumb',['title' => trans('app.awbs_title'),'first_list_item' => trans('app.awbs'),'last_list_item' => trans('app.all_awbs')])
{{--    end breadcrumb --}}

    <!--start filters section -->

    <!--end filterd section -->
    <!--Row-->
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="table-responsive">
                        {!! $dataTable->table(['class' => 'table table-bordered text-nowrap border-bottom']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="show_import_errors">error apear here</div>
    <!-- End Row -->
@endsection

@section('scripts')
    @include('layouts.components.datatable-scripts')
    <script>
        $(document).ready(function () {
            $(document).on('click', '.import_errors', function () {
                var href = $(this).data('href');
                $.ajax({
                    url: href,
                    type: 'get',
                    dataType: 'JSON',
                    success: function (data) {

                        $('#show_import_errors').html(data.data);
                    },
                    error: function (xhr) {
                        // Handle error response
                        Swal.fire(
                            '' + xhr.statusText + '',
                            '' + xhr.responseJSON.message + '',
                            'error'
                        );
                    }
                });
            });
        });
    </script>
@endsection
