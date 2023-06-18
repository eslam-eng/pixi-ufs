@extends('layouts.app')

@section('content')

    {{--    breadcrumb --}}
    @include('layouts.components.breadcrumb',['title' => trans('app.companies_page_title'),'first_list_item' => trans('app.companies'),'last_list_item' => trans('app.add_company')])
    {{--    end breadcrumb --}}

    <!-- Row -->
    <div class="row">
        <div class="col-lg-12">
            <form action="{{route('companies.store')}}" method="post">
                @csrf
                {{-- start companies --}}
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12"> <!--div-->

                        <div class="card">
                            <div class="card-header">
                                <h3>@lang('app.companies')</h3>
                            </div>
                            <div class="card-body">
                                <div class="row row-sm mb-4">
                                    <div class="col-lg">
                                        <div class="main-content-label mg-b-5">@lang('app.name')</div>
                                        <input class="form-control" name="name" value="{{old('name')}}"
                                               placeholder="@lang('app.name')"
                                               type="text" required>
                                        @error('name')
                                        <div id="validationServer03Feedback" class="invalid-feedback"> {{$message}} </div>
                                        @enderror
                                    </div>

                                    <div class="col-lg">
                                        <div class="main-content-label mg-b-5">@lang('app.email')</div>
                                        <input class="form-control" name="email" value="{{old('email')}}"
                                               placeholder="@lang('app.email')"
                                               type="email" required>
                                        @error('email')
                                        <div id="validationServer03Feedback" class="invalid-feedback"> {{$message}} </div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="row row-sm mb-4">
                                    <div class="col-lg">
                                        <div class="main-content-label mg-b-5">@lang('app.ceo')</div>
                                        <input class="form-control" name="ceo" value="{{old('ceo')}}"
                                               placeholder="@lang('app.ceo')"
                                               type="text">
                                        @error('ceo')
                                        <div id="validationServer03Feedback" class="invalid-feedback"> {{$message}} </div>
                                        @enderror
                                    </div>

                                    <div class="col-lg">
                                        <div class="main-content-label mg-b-5">@lang('app.phone')</div>
                                        <input class="form-control" value="{{old('phone')}}" name="phone"
                                               placeholder="@lang('app.phone')"
                                               type="text" required>
                                        @error('phone')
                                        <div class="text-danger"> {{$message}}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row row-sm mb-4">

                                    <div class="col-lg">
                                        <div class="main-content-label mg-b-5">@lang('app.notes')</div>
                                        <input class="form-control" value="{{old('notes')}}" name="notes"
                                               placeholder="@lang('app.notes')"
                                               type="text">

                                        @error('notes')
                                        <div class="text-danger"> {{$message}}</div>
                                        @enderror
                                    </div>

                                </div>

                                <div class="row row-sm mb-4">
                                    <div class="col-lg mt-4">
                                        <div class="main-content-label mg-b-5">@lang('app.num_custom_fields')</div>
                                        <input class="form-control" value="{{old('num_custom_fields')}}"
                                               name="num_custom_fields" placeholder="@lang('app.num_custom_fields')"
                                               type="number">

                                        @error('num_custom_fields')
                                        <div class="text-danger"> {{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="col-lg mt-5">
                                        <label class="custom-control custom-checkbox custom-control-lg"> <input
                                                type="checkbox" class="custom-control-input" name="show_dashboard"
                                                value="0"> <span
                                                class="custom-control-label custom-control-label-lg  tx-20">@lang('app.show_dashboard')</span>
                                        </label>

                                        @error('show_dashboard')
                                        <div class="text-danger"> {{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="col-lg mt-5">
                                        <label class="custom-control custom-checkbox custom-control-lg"> <input
                                                type="checkbox" class="custom-control-input" name="status"
                                                value="1" checked> <span
                                                class="custom-control-label custom-control-label-lg  tx-20">@lang('app.status')</span>
                                        </label>
                                        @error('status')
                                        <div class="text-danger"> {{$message}}</div>
                                        @enderror
                                    </div>

                                </div>

                                <div class="row row-sm mb-4">
                                    <div class="col-lg">
                                        <div class="main-content-label mg-b-5">@lang('app.address')</div>
                                        <input class="form-control" name="address" value="{{old('address')}}"
                                               placeholder="@lang('app.address')"
                                               type="text" required>

                                        @error('address')
                                        <div class="text-danger"> {{$message}}</div>
                                        @enderror
                                    </div>

                                </div>

                                <div class="row row-sm mb-4">

                                    <div class="col-lg">
                                        <div class="main-content-label mg-b-5">@lang('app.importation_type')</div>
                                        <select class="form-control" name="importation_type">
                                            <option selected disabled>...</option>
                                            <option
                                                value="{{ \App\Enums\ImportTypeEnum::AWBWITHREFERENCE->value }}">@lang('app.import_with_reference')</option>
                                            <option
                                                value="{{ \App\Enums\ImportTypeEnum::AWBWITHOUTREFERENCE->value }}">@lang('app.import_without_reference')</option>
                                        </select>

                                        @error('importation_type')
                                            <div class="text-danger"> {{$message}}</div>
                                        @enderror
                                    </div>


                                </div>

                                <div class="row row-sm mb-4">

                                    <div class="col-lg">
                                        <livewire:location.cities/>
                                        @error('city_id')
                                        <div class="text-danger"> {{$message}}</div>
                                        @enderror
                                    </div>
                                    {{-- start company area --}}
                                    <div class="col-lg">
                                        <livewire:location.areas/>
                                        @error('area_id')
                                        <div class="text-danger"> {{$message}}</div>
                                        @enderror
                                    </div>
                                    {{-- end company area --}}
                                </div>

                            </div>
                        </div>
                    </div>

{{--                    start branches --}}
                    <div class="col-md-6 col-lg-6 col-xl-6 col-sm-6"> <!--div-->
                        <div class="card custom-card">
                            <div class="card-body">
                                <div class="mt-4">
                                    <div class="items branches-items">
                                        <div class="item mt-4">
                                            <h4>@lang('app.branch_data')</h4>
                                            <hr>
                                            <div class="row row-sm mb-4">
                                                <div class="col-lg">
                                                    <div class="main-content-label mg-b-5">@lang('app.name')</div>
                                                    <input class="form-control" name='branches_name[]' value="{{old('branches_name[]')}}" placeholder="@lang('app.name')"
                                                           type="text">
                                                    @error('branches_name[]')
                                                    <div id="validationServer03Feedback" class="invalid-feedback"> {{$message}} </div>
                                                    @enderror
                                                </div>

                                                <div class="col-lg">
                                                    <div class="main-content-label mg-b-5">@lang('app.phone')</div>
                                                    <input class="form-control" value="{{old('branches_phone[]')}}" name="branches_phone[]" placeholder="@lang('app.phone')"
                                                           type="text">
                                                    @error('branches_phone[]')
                                                    <div class="text-danger"> {{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row row-sm mb-4">

                                                <div class="col-lg">
                                                    <div class="main-content-label mg-b-5">@lang('app.address')</div>
                                                    <input class="form-control" name="branches_address[]" value="{{old('branches_address[]')}}"  placeholder="@lang('app.address')"
                                                           type="text">

                                                    @error('branches_address[]')
                                                    <div class="text-danger"> {{$message}}</div>
                                                    @enderror
                                                </div>

                                            </div>

                                            <div class="row row-sm mb-4">
                                                <div class="col-lg mt-4">
                                                    <label class="custom-control custom-checkbox custom-control-lg"> <input
                                                            type="checkbox" class="custom-control-input" value="1" checked name="branches_status[]"> <span
                                                            class="custom-control-label custom-control-label-lg  tx-20">@lang('app.status')</span>
                                                    </label>

                                                    @error('branches_status[]')
                                                    <div class="text-danger"> {{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="locations row row-sm mb-4">
                                                <div class="col-lg">
                                                    <div class="main-content-label mg-b-5">@lang('app.cities')</div>
                                                    <select class="company_city form-control" name="branches_city_id[]">
                                                        <option value="">{{ trans('app.select_city') }}</option>
                                                        @foreach ($cities as $city)
                                                            <option value="{{ $city->id }}">{{ $city->title }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('branches_city_id.*')
                                                    <div class="text-danger"> {{$message}}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-lg">
                                                    <div class="main-content-label mg-b-5">@lang('app.areas')</div>
                                                    <select class="form-control" name="branches_area_id[]">
                                                        <option value="">...</option>
                                                    </select>
                                                    @error('branches_area_id.*')
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
                                            <button type="button" class="btn btn-success append-branch"><i
                                                    class="fa fa-plus pe-2"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--                        end branches--}}

                    {{--                    start departments --}}

                    <div class="col-md-6 col-lg-6 col-xl-6 col-sm-6"> <!--div-->
                        <div class="card custom-card">
                            <div class="card-body">
                                <div class="mt-4">
                                    <div class="items departments-items">
                                        <div class="item mt-4">
                                            <h4>@lang('app.department_data')</h4>
                                            <hr>
                                            <div class="row row-sm mb-4">
                                                <div class="col-lg">
                                                    <div class="main-content-label mg-b-5">@lang('app.name')</div>
                                                    <input class="form-control" name="departments_name[]" value="{{old('departments_name[]')}}" placeholder="@lang('app.name')"
                                                           type="text">
                                                    @error('departments_name[]')
                                                    <div id="validationServer03Feedback" class="invalid-feedback"> {{$message}} </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <div class="form-group mb-0 mt-3 justify-content-end">
                                        <div>
                                            <button type="button" class="btn btn-success append-department"><i
                                                    class="fa fa-plus pe-2"></i>add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--end departments--}}

                </div>
                {{-- end companies --}}


                {{-- start actons buttons --}}
                <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12"> <!--div-->
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group mb-0 mt-3 justify-content-end">
                                <div>
                                    <button type="submit" class="btn btn-success"><i
                                            class="fa fa-save pe-2"></i>@lang('app.submit')</button>

                                    <a role="button" href="{{route('companies.index')}}" class="btn btn-danger"><i
                                            class="fa fa-backward pe-2"></i>@lang('app.back')</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end actions buttons --}}
            </form>
        </div>
    </div>

    <!-- End Row -->

@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $('.append-branch').on('click', function () {

                var item = $('.branches-items .item').first().html();
                $('.branches-items').append('<div class="item mt-4">' + item + '<button class="btn btn-danger remove-item"><i class="fa fa-close"></i>remove</button></div>');
            });

            $('.append-department').on('click', function () {

                var item = $('.departments-items .item').first().html();

                $('.departments-items').append('<div class="item mt-4">' + item + '<button class="btn btn-danger remove-item"><i class="fa fa-close"></i>remove</button></div>');
            });
            $('.items').on('click', '.remove-item', function () {
                $(this).parent().remove();
            });

        });

    </script>
    <script>
        $(document).ready(function () {
            $('body').on('change', 'select[name="branches_city_id[]"]', function () {
                var city = $(this).val();
                var href = '/dashboard/city-area/' + city;
                var areasInput = $(this).parents('.locations').children().last().find('select');
                $.ajax({
                    url: href,
                    type: 'get',
                    dataType: 'JSON',
                    success: function (data) {

                        var selectOptions ='<option value="" selected>...</option>';
                        data.forEach(element => {
                            selectOptions += '<option value="'+element['id']+'">'+element['title']+'</option>'
                        });
                        areasInput.html(selectOptions);
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

