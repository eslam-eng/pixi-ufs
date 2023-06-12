@extends('layouts.app')

@section('content')

    {{--    breadcrumb --}}
    @include('layouts.components.breadcrumb',['title' => trans('import_errors_page_title'),'first_list_item' => trans('app.import_errors'),'last_list_item' => trans('app.show_import_errors')])
    {{--    end breadcrumb --}}

    <!-- Row -->
    <div class="row">
        <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12"> <!--div-->
           
            {{-- start departments --}}

            <div class="card">
                <div class="card-body">
                    <table class="table table-row-bordered table-row-dashed table-bordered">
                        <thead>
                        <tr class="alert alert-danger">
                            <td colspan="3">@lang('app.total_errors') : {{count($errors)}}</td>
                        </tr>
                            <tr>
                                <td>@lang('app.error_row')</td>
                                <td>@lang('app.error_attribute')</td>
                                <td>@lang('app.error')</td>
                            </tr>
                        </thead>
                        @if(count($errors))
                            @foreach($errors as $index=>$import_errors)
                                <tr>
                                        <td class="text-gray-900">{{Arr::get($import_errors , 'row')}}</td>
                                        <td class="text-gray-900">{{Arr::get($import_errors,'attribute')}}</td>
                                        <td class="text-gray-900">{{Arr::first(Arr::get($import_errors,'errors'))}}</td>
                                </tr>
                                @if($index > 20)
                                    @break
                                @endif
                            @endforeach
                        @else
                            <div class="alert alert-success">@lang('app.there_is_no_errors')</div>
                        @endif
                    
                    </table>
                </div>
            </div>
            {{-- end departments --}}
        </div>
    </div>

    <!-- End Row -->
@endsection