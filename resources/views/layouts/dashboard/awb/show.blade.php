@php
    use \Illuminate\Support\Arr ;
@endphp
@extends('layouts.app')

@section('content')

    {{--    breadcrumb --}}
{{--    @include('layouts.components.breadcrumb',['title' => trans('app.create_new_awb_title'),'first_list_item' => trans('app.awbs'),'last_list_item' => trans('app.add_awb')])--}}
    {{--    end breadcrumb --}}

    <!-- Row -->

    <div class="row row-sm">
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="card custom-card">
                <div class="card-header  d-flex custom-card-header border-bottom-0 ">
                    <h5 class="card-title">
                        @lang('app.awb_info')
                    </h5>
                    <div class="card-options">

                        <a role="button" href="{{route('awb-history.create',$awb->id)}}" class="btn btn-secondary">
                            <i class="fa fa-history"></i> History
                        </a>
                    </div>
                </div>
                <div class="card-body">
                   <table class="table table-striped">
                       <tbody>
                       <tr class="bg-info">
                           <td colspan="2">@lang('app.status'):</td>
                           <td colspan="2">{{$awb->latestStatus?->status?->name}}</td>
                       </tr>
                       <tr>
                           <td>@lang('app.code'):</td>
                           <td>{{$awb->code}}</td>
                           <td>@lang('app.company'):</td>
                           <td>{{$awb->company?->name}}</td>
                       </tr>

                       <tr>
                           <td>@lang('app.branch'):</td>
                           <td>{{$awb->branch?->name}}</td>
                           <td>@lang('app.department'):</td>
                           <td>{{$awb->department?->name}}</td>
                       </tr>

{{--                       @if($user->can('show_awbs_price'))--}}
                           <tr>
                               <td>@lang('app.zone_price')</td>
                               <td>{{$awb->zone_price}}</td>
                               <td>@lang('app.additional_kg_price')</td>
                               <td>{{$awb->additional_kg_price}}</td>
                           </tr>
                           <tr>
                               <td>@lang('app.wight')</td>
                               <td>{{$awb->weight}}</td>
                               <td>@lang('app.pieces')</td>
                               <td>{{$awb->pieces}}</td>
                           </tr>
{{--                       @endif--}}

{{--                       @if($user->can('show_awbs_pod'))--}}
                           <tr>
                               <td colspan="2">@lang('app.additional kg price')</td>
                               <td colspan="2">{{$awb->additional_kg_price}}</td>
                           </tr>
{{--                       @endif--}}
{{--                       @if($user->can('show_awb_pod_attachment'))--}}
                       <tr>
                           <td colspan="4" class="text-center bg-info">@lang('app.POD') </td>
                       </tr>
                       <tr>
                           <td colspan="2">@lang('app.actual-receipt') </td>
                           <td colspan="2">{{$awb->actual_recipient}}</td>
                       </tr>
                       <tr>
                           <td colspan="2">title</td>
                           <td colspan="2">{{$awb->title}}</td>
                       </tr>
                           <tr>
                               <td colspan="2">card</td>
                               <td colspan="2">{{$awb->card_number}}</td>
                           </tr>
                       <tr>
                           <td colspan="2">@lang('app.pod')</td>
                           <td colspan="2"><button class="btn btn-sm btn-info">show Attachments</button></td>
                       </tr>
{{--                       @endif--}}

                       </tbody>
                   </table>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="card custom-card">
                <div class="card-header  d-flex custom-card-header border-bottom-0 ">
                    <h5 class="card-title">
                        @lang('app.awb_receiver_info')
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tbody>
                        <tr class="bg-info">
                            <td colspan="2">receiver:</td>
                            <td colspan="2">{!!Arr::get($awb->receiver_data,'name')!!}</td>
                        </tr>
                        <tr>
                            <td>phone1:</td>
                            <td>{!!Arr::get($awb->receiver_data,'phone1')!!}</td>
                            <td>phone2:</td>
                            <td>{!!Arr::get($awb->receiver_data,'phone2')!!}</td>
                        </tr>

                        <tr>
                            <td>address:</td>
                            <td colspan="3">{!!Arr::get($awb->receiver_data,'address1')!!}</td>
                        </tr>

                        <tr>
                            <td>address2:</td>
                            <td colspan="3">{!!Arr::get($awb->receiver_data,'address2')!!}</td>
                        </tr>

                        <tr>
                            <td>city:</td>
                            <td>{!!Arr::get($awb->receiver_data,'city')!!}</td>
                            <td>area:</td>
                            <td>{!!Arr::get($awb->receiver_data,'area')!!}</td>
                        </tr>

                        <tr>
                            <td>title:</td>
                            <td>{!!Arr::get($awb->receiver_data,'title')!!}</td>
                            <td>receiving_company:</td>
                            <td>{!!Arr::get($awb->receiver_data,'receiving_company')!!}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="card custom-card">
                <div class="card-header  d-flex custom-card-header border-bottom-0 ">
                    <h5 class="card-title">
                        @lang('app.awb_additional_info')
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <td colspan="2">note1:</td>
                            <td colspan="2">{{$awb->additionalInfo->custome_field1}}</td>
                        </tr>

                        <tr>
                            <td colspan="2">note2:</td>
                            <td colspan="2">{{$awb->additionalInfo->custome_field2}}</td>
                        </tr>


                        <tr>
                            <td>note3:</td>
                            <td colspan="2">{{$awb->additionalInfo->custome_field3}}</td>
                        </tr>

                        <tr>
                            <td colspan="2">note4:</td>
                            <td colspan="2">{{$awb->additionalInfo->custome_field4}}</td>
                        </tr>

                        <tr>
                            <td colspan="2">note5:</td>
                            <td colspan="2">{{$awb->additionalInfo->custome_field5}}</td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- End Row -->

@endsection
@section('script_footer')
    <script src="{{asset('assets/js/create-awb.js')}}"></script>
@endsection