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
    <!-- End Row -->

@endsection

@section('scripts')
    @include('layouts.components.datatable-scripts')
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
$(document).ready(function()
{
    // $('#myModal').click(function(){
    //     $.ajax({
    //         url: '{{ route('import-logs.errors', 3) }}',
    //         method:'get',
    //         success: function( response ) {
                
    //         }
    //     });
    // });
    
    
});
</script>