@php
    use \Illuminate\Support\Arr ;
@endphp
@extends('layouts.app')

@section('content')

    {{--        breadcrumb --}}
    @include('layouts.components.breadcrumb',['title' => trans('app.create_new_awb_title'),'first_list_item' => trans('app.awbs'),'last_list_item' => trans('app.add_awb')])
    {{--        end breadcrumb --}}

    <!-- Row -->

    <div class="row row-sm">
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">

            <div class="card custom-card">
                <div class="card-header  d-flex custom-card-header border-bottom-0 ">
                    <h5 class="card-title">
                        @lang('app.awb_info')
                    </h5>
                    <div class="card-options">

                        <a role="button" href="{{route('awb-history.create',$awb->id)}}"
                           class="btn btn-danger">
                            <i class="fa fa-history"></i> change status
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tbody>
                        <tr class="fw-bold">
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
                            <td colspan="2">@lang('app.additional_kg_price')</td>
                            <td colspan="2">{{$awb->additional_kg_price}}</td>
                        </tr>
                        {{--                       @endif--}}

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card custom-card">
                <div class="card-header  d-flex custom-card-header border-bottom-0 ">
                    <h5 class="card-title">
                        @lang('app.awb_receiver_info')
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tbody>
                        <tr class="fw-bold">
                            <td colspan="2">@lang('app.receiver'):</td>
                            <td colspan="2">{!!Arr::get($awb->awb_receiver_data,'name')!!}</td>
                        </tr>
                        <tr>
                            <td>@lang('app.phone1'):</td>
                            <td>{!!Arr::get($awb->awb_receiver_data,'phone1')!!}</td>
                            <td>@lang('app.phone2'):</td>
                            <td>{!!Arr::get($awb->awb_receiver_data,'phone2')!!}</td>
                        </tr>

                        <tr>
                            <td>@lang('app.address'):</td>
                            <td colspan="3">{!!Arr::get($awb->awb_receiver_data,'address1')!!}</td>
                        </tr>

                        <tr>
                            <td>@lang('app.address2'):</td>
                            <td colspan="3">{!!Arr::get($awb->awb_receiver_data,'address2')!!}</td>
                        </tr>

                        <tr>
                            <td>@lang('app.city'):</td>
                            <td>{{$awb->receiverCity?->title}}</td>
                            <td>area:</td>
                            <td>{{$awb->receiverArea?->title}}</td>
                        </tr>

                        <tr>
                            <td>@lang('app.title'):</td>
                            <td>{!!Arr::get($awb->awb_receiver_data,'title')!!}</td>
                            <td>@lang('app.receiving_company'):</td>
                            <td>{!!Arr::get($awb->awb_receiver_data,'receiving_company')!!}</td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>


            <div class="card custom-card">
                <div class="card-header  d-flex custom-card-header border-bottom-0 ">
                    <h5 class="card-title">
                        @lang('app.awb_pod')
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <td colspan="2">@lang('app.actual_receipt') </td>
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
                            <td colspan="2">
                                <button class="btn btn-primary">show Attachments</button>
                            </td>
                        </tr>
                        {{--                       @endif--}}

                        </tbody>
                    </table>
                </div>
            </div>


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
                            <td colspan="2">{{$awb->additionalInfo?->custom_field1}}</td>
                        </tr>

                        <tr>
                            <td colspan="2">note2:</td>
                            <td colspan="2">{{$awb->additionalInfo?->custom_field2}}</td>
                        </tr>


                        <tr>
                            <td colspan="2">note3:</td>
                            <td colspan="2">{{$awb->additionalInfo?->custom_field3}}</td>
                        </tr>

                        <tr>
                            <td colspan="2">note4:</td>
                            <td colspan="2">{{$awb->additionalInfo?->custom_field4}}</td>
                        </tr>

                        <tr>
                            <td colspan="2">note5:</td>
                            <td colspan="2">{{$awb->additionalInfo?->custom_field5}}</td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">

            <div class="card">
                <div class="card-header bg-transparent pb-0">
                    <div><h3 class="card-title mb-2">History</h3></div>
                </div>
                <div class="card-body mt-0">
                    <div class="latest-timeline mt-4">
                        <ul class="timeline mb-0">
                            @foreach($awb->history as $history)
                                <li>
                                    <div class="featured_icon1"></div>
                                </li>
                                <li class="mt-0 activity border br-5 p-2">
                                    <div><span
                                            class="text-dark float-end">{{isset($history->created_at)?$history->created_at->format('Y-m-d h:i A'):$history?->created_at}}</span>
                                    </div>

                                    <p class="mb-2 font-weight-semibold text-dark tx-13">{{$history->status->name}} <span class="pd-12 text-danger"><strong>changed By({{$history->user->name}})</strong></span></p>
                                    <p class="text-muted mt-0 mb-0">{{$history->status->description}}</p>
                                    @isset($history->lat,$history->lng)
                                        <div>
                                            <span
                                                class="text-dark float-end">
                                                <a href="https://www.google.com/maps/search/?api=1&query={{$history->lat}},{{$history->lng}}" target="_blank"
                                                    class="tx-12 text-dark text-end">
                                                    <p class="mb-1 font-weight-semibold text-danger tx-13 pull-right"><i
                                                            class="fa fa-map-marker-alt fa-2x"></i></p>
                                                </a>
                                            </span>
                                    </div>
                                        
                                    @endisset
                                    <p class="text-muted mt-0 mt-1 mb-1">
                                        <a class="btn btn-primary btn-sm" href="{{ route('awb-history.gallary', $history->id) }}">@lang('app.images')</a>
                                    </p>
                                    

                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>

        </div>

    </div>


    <!-- End Row -->

@endsection
@section('script_footer')
    <script src="{{asset('assets/js/create-awb.js')}}"></script>
@endsection
