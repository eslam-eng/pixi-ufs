@php
    use \Illuminate\Support\Arr ;
@endphp
@extends('layouts.app')

@section('content')

    <!-- container --> 
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="left-content">
                <span class="main-content-title mg-b-0 mg-b-lg-1">@lang('app.images')</span>
            </div>
            <div class="justify-content-center mt-2">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">@lang('app.awb_history')</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@lang('app.images')</li>
                </ol>
            </div>
        </div>
        <!-- /breadcrumb -->
        <div class="masonry row">
            
            @if($model->attachments()->count())
                @foreach($model->attachments as $attachment)
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="brick">
                            <a href="{{asset($attachment->path.'/'.$attachment->file_name)}}" class="js-img-viewer" data-caption="IMAGE-01" data-id="lion" data-group="nogroup" data-index="0">
                                <img src="{{asset($attachment->path.'/'.$attachment->file_name)}}" alt="">
                            </a>
                        </div>
                    </div>
                @endforeach
            @endif
            
        </div>
    </div>
    <!-- Container closed --> 

@endsection
