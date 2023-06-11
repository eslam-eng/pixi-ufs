@extends('layouts.app')

@section('content')

    {{--    breadcrumb --}}
    @include('layouts.components.breadcrumb',['title' => trans('branches_page_title'),'first_list_item' => trans('app.branches'),'last_list_item' => trans('app.edit_branch')])
    {{--    end breadcrumb --}}

    <!-- Row -->
    <div class="row">
        {{-- start branches --}}
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form method="post" action="{{ route('branches.update', $branch->id) }}">
                        @csrf
                        @method('put')
                        <div class="mt-4">
                            <input class="form-control" name='company_id' value="{{ $branch->company_id}}"
                                type="hidden">
                            <div class="items branches-items">
                                <div class="item mt-4">
                                    <h4>@lang('app.branch_data')</h4>
                                    <hr>
                                    <div class="row row-sm mb-4">
                                        <div class="col-lg">
                                            <div class="main-content-label mg-b-5">@lang('app.name')</div>
                                            <input class="form-control" name='name' value="{{old('name') ?? $branch->name}}" placeholder="@lang('app.name')"
                                                type="text" required>
                                            @error('name')
                                                <div id="validationServer03Feedback" class="invalid-feedback"> {{$message}} </div>
                                            @enderror
                                        </div>
        
                                        <div class="col-lg">
                                            <div class="main-content-label mg-b-5">@lang('app.phone')</div>
                                            <input class="form-control" value="{{old('phone') ?? $branch->phone}}" name="phone" placeholder="@lang('app.phone')"
                                                type="text" required>
                                            @error('phone')
                                                <div class="text-danger"> {{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <div class="row row-sm mb-4">
                                        <div class="col-lg">
                                            <div class="main-content-label mg-b-5">@lang('app.status')</div>
                                            <input name="status" value="{{ $branch->status }}"
                                                type="checkbox" {{ $branch->status ? "checked":"" }}>
        
                                            @error('status')
                                            <div class="text-danger"> {{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <hr>
                                    <div class="row row-sm mb-4">
                                        <div class="col-lg">
                                            <div class="main-content-label mg-b-5">@lang('app.address')</div>
                                            <input class="form-control" name="address" value="{{old('address') ?? $branch->address}}"  placeholder="@lang('app.address')"
                                                type="text" required>
        
                                            @error('address')
                                            <div class="text-danger"> {{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="col-lg">
                                            @livewire("locations-drop-down", ["city_id"=>$branch->city_id, "area_id"=>$branch->area_id])
                                            @error('city_id')
                                            <div class="text-danger"> {{$message}}</div>
                                            @enderror
                                            @error('area_id')
                                            <div class="text-danger"> {{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="form-group mb-0 mt-3 justify-content-end">
                                <div>
                                    <button type="submit" class="btn btn-success"><i
                                            class="fa fa-save pe-2"></i>@lang('app.submit')</button>
                                    <a role="button" href="{{ URL::previous() }}" class="btn btn-danger"><i
                                        class="fa fa-backward pe-2"></i>@lang('app.back')</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
            {{-- end branches --}}
    </div>

    <!-- End Row -->

@endsection

