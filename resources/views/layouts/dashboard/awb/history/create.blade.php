@extends('layouts.app')

@section('content')

    {{--    breadcrumb --}}
    @include('layouts.components.breadcrumb',['title' => trans('app.create_new_awb_title'),'first_list_item' => trans('app.awbs'),'last_list_item' => trans('app.add_awb')])
    {{--    end breadcrumb --}}

    <!-- Row -->
    <div class="row row-sm">
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="card custom-card">
                <div class="card-header  d-flex custom-card-header border-bottom-0 ">
                    <h5 class="card-title">
                        @lang('app.awb_history')
                    </h5>
                </div>
                <div class="container">
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
                <div class="card-body">
                    {{--                    change history using form --}}
                    <form action="{{route('awb-history.store',$awb->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col mb-4">
                            <label class="form-label">@lang('app.status')</label>
                            <select id="awb_status" name="awb_status_id" class="form-control form-select" data-bs-placeholder="Select Status">
                                <option selected>@lang('app.select_status')</option>
                                @foreach($statuses as $status)
                                    <option data-code="{{$status->code}}" value="{{$status->id}}">{{$status->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col mb-4">
                            <label class="form-label">@lang('app.comment')</label>
                            <input type="text" name="comment" value="{{old('comment')}}" class="form-control">
                        </div>
                        <div id="pod_section">
                            <h4 class="text-primary text-center">POD Data</h4>
                            <div class="col mb-4">
                                <div class="form-group">
                                    <label class="form-label">@lang('app.actual_receipt')</label>
                                    <input type="text" value="{{old('actual_recipient')}}" name="actual_recipient" class="form-control">
                                </div>
                            </div>

                            <div class="col mb-4">
                                <label class="form-label">@lang('app.title')</label>
                                <input type="text" value="{{old('title')}}" name="title" class="form-control">
                            </div>

                            <div class="col mb-4">
                                <label class="form-label">@lang('app.card_number')</label>
                                <input type="text" value="{{old('card_number')}}" name="card_number" class="form-control">
                            </div>

                            <div class="col mb-4">
                                <label class="form-label">@lang('app.images')</label>
                                <input type="file" name="images[]" multiple class="form-control">
                            </div>

                        </div>

                        <div class="mt-4">
                            <div class="form-group mb-0 mt-3 justify-content-end">
                                <div>
                                    <button type="submit" class="btn btn-rounded btn-success"><i
                                            class="fa fa-save pe-2"></i>@lang('app.save')</button>

                                    <a role="button" href="{{route('receivers.index')}}" class="btn btn-rounded btn-danger"><i
                                            class="fa fa-backward pe-2"></i>@lang('app.back')</a>
                                </div>
                            </div>
                        </div>

                    </form>
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
                                    <div><span class="text-dark float-end">{{$history->created_at->format('Y-m-d h:i A')}}</span></div>

                                    <p class="mb-2 font-weight-semibold text-dark tx-13">{{$history->status->name}}</p>
                                    <p class="text-muted mt-0 mb-0">{{$history->status->description}}</p>
                                    @isset($history->lat,$history->lng)
                                        <a href="https://www.google.com/maps?q=' . {{$history->lat}} . ',' . {{$history->lng}}" class="tx-12 text-dark text-end">
                                            <p class="mb-1 font-weight-semibold text-dark tx-13 pull-right"><i class="fa fa-map-marker fa-2x"></i> map</p>
                                        </a>
                                    @endisset

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
@section('scripts')
    <script>
        $("#pod_section").css('display','none');
        $("#awb_status").change(function () {
            const option = $(this).find('option:selected');
            const code = option.data('code');
             if (code == {{\App\Enums\AwbStatuses::DELIVERED->value}})
                 $("#pod_section").css('display','block');
            else
                 $("#pod_section").css('display','none');
        });
    </script>
@endsection
