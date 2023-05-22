@extends('layouts.app')

@section('content')

    {{--    breadcrumb --}}
    @include('layouts.components.breadcrumb',['title' => trans('receivers_page_title'),'first_list_item' => trans('app.receivers'),'last_list_item' => trans('app.add_receiver')])
    {{--    end breadcrumb --}}

    <!-- Row -->
    <div class="row">
        <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12"> <!--div-->
            <div class="card">
                <div class="card-body">
                    <form action="{{route('receivers.update',$receiver->id)}}" method="post">
                        @csrf
                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.receiver_name')</div>
                                <input class="form-control" name="name" value="{{$receiver->name}}" placeholder="@lang('app.receiver_name')"
                                       type="text" required>
                                @error('name')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.receiver_phone')</div>
                                <input class="form-control" value="{{$receiver->phone}}" name="phone" placeholder="@lang('app.receiver_phone')"
                                       type="text" required>
                                @error('phone')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.receiving_company')</div>
                                <input class="form-control" value="{{$receiver->receiving_company}}" name="receiving_company"
                                       placeholder="@lang('app.receiving_company')" type="text" required>

                                @error('receiving_company')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.reference')</div>
                                <input class="form-control" value="{{$receiver->reference}}" name="reference" placeholder="@lang('app.reference')"
                                       type="text">

                                @error('reference')
                                <div class="text-danger"> {{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div>
                            @livewire('company-with-branch-and-departments',['company_name' =>'company_id','branch_name' =>  'branch_id','selected_company' => $receiver->branch->company_id , 'selected_branch' => $receiver->branch_id])
                            @error('branch_id')
                            <div class="text-danger"> {{$message}}</div>
                            @enderror
                        </div>

                        <div class="card-footer mt-4">
                            <div class="form-group mb-0 mt-3 justify-content-end">
                                <div>
                                    <button type="submit" class="btn btn-success"><i
                                            class="fa fa-save pe-2"></i>@lang('app.save')</button>

                                    <a role="button" href="{{route('receivers.index')}}" class="btn btn-danger"><i
                                            class="fa fa-backward pe-2"></i>@lang('app.back')</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="breadcrumb-header justify-content-between">
                        <div class="left-content">
                            <a class="btn ripple btn-primary" href="{{route('addresses.create',['id'=>$receiver->id ,'type'=>\App\Enums\AddressTypes::RECEIVER])}}"><i class="fe fe-plus me-2"></i>Add New User</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <td>@lang('app.address')</td>
                            <td>@lang('app.city')</td>
                            <td>@lang('app.area')</td>
                            <td>@lang('app.is_default')</td>
                            <td>@lang('app.actions')</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($receiver->addresses as $address)
                            <tr>
                                <td>{{$address->address}}</td>
                                <td>{{$address->city?->title}}</td>
                                <td>{{$address->area?->title}}</td>
                                <td>{{$address->is_default ? trans('app.yes') : trans('app.no')}}</td>
                                <td>
                                    <div>
                                        <button data-bs-toggle="dropdown" class="btn btn-primary btn-block" aria-expanded="false">@lang('app.actions')
                                            <i class="icon ion-ios-arrow-down tx-11 mg-l-3"></i>
                                        </button>
                                        <div class="dropdown-menu" style="">
                                            @if(!$address->is_default)
                                                <livewire:set-address-default address_id="{{$address->id}}"/>
                                            @endif
{{--                                            <a href="{{route('addresses.edit')}}" class="dropdown-item">@lang('app.edit')</a>--}}
                                            <button role="button"  class="dropdown-item">@lang('app.delete')</button>
                                        </div>
                                        <!-- dropdown-menu -->
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- End Row -->

@endsection
