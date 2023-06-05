@extends('layouts.app')

@section('content')

    {{--    breadcrumb --}}
    @include('layouts.components.breadcrumb',['title' => trans('companies_page_title'),'first_list_item' => trans('app.companies'),'last_list_item' => trans('app.add_company')])
    {{--    end breadcrumb --}}

    <!-- Row -->
    <div class="row">
        <div class="col-lg-12">
            <form action="{{route('companies.store')}}" method="post">
                @csrf
                {{-- start companies --}}
                <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12"> <!--div-->

                    <div class="card">
                        <div class="card-header">
                            <h3>@lang('app.companies')</h3>
                        </div>
                        <div class="card-body">
                                <div class="row row-sm mb-4">
                                    <div class="col-lg">
                                        <div class="main-content-label mg-b-5">@lang('app.name')</div>
                                        <input class="form-control" name="name" value="{{old('name')}}" placeholder="@lang('app.name')"
                                            type="text" required>
                                        @error('name')
                                            <div id="validationServer03Feedback" class="invalid-feedback"> {{$message}} </div>
                                        @enderror
                                    </div>

                                    <div class="col-lg">
                                        <div class="main-content-label mg-b-5">@lang('app.email')</div>
                                        <input class="form-control" name="email" value="{{old('email')}}" placeholder="@lang('app.email')"
                                            type="email" required>
                                        @error('email')
                                            <div id="validationServer03Feedback" class="invalid-feedback"> {{$message}} </div>
                                        @enderror
                                    </div>

                                    <div class="col-lg">
                                        <div class="main-content-label mg-b-5">@lang('app.ceo')</div>
                                        <input class="form-control" name="ceo" value="{{old('ceo')}}" placeholder="@lang('app.ceo')"
                                            type="text" required>
                                        @error('ceo')
                                            <div id="validationServer03Feedback" class="invalid-feedback"> {{$message}} </div>
                                        @enderror
                                    </div>

                                    <div class="col-lg">
                                        <div class="main-content-label mg-b-5">@lang('app.phone')</div>
                                        <input class="form-control" value="{{old('phone')}}" name="phone" placeholder="@lang('app.phone')"
                                            type="text" required>
                                        @error('phone')
                                            <div class="text-danger"> {{$message}}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row row-sm mb-4">
                                    <div class="col-lg">
                                        <div class="main-content-label mg-b-5">@lang('app.show_dashboard')</div>
                                        <input name="show_dashboard" value="1"
                                            placeholder="@lang('app.show_dashboard')" type="checkbox" checked>

                                        @error('show_dashboard')
                                        <div class="text-danger"> {{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="col-lg">
                                        <div class="main-content-label mg-b-5">@lang('app.notes')</div>
                                        <input class="form-control" value="{{old('notes')}}" name="notes" placeholder="@lang('app.notes')"
                                            type="text">

                                        @error('notes')
                                        <div class="text-danger"> {{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="col-lg">
                                        <div class="main-content-label mg-b-5">@lang('app.status')</div>
                                        <input name="status" value="1"
                                            placeholder="@lang('app.status')" type="checkbox" checked>

                                        @error('status')
                                        <div class="text-danger"> {{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="col-lg">
                                        <div class="main-content-label mg-b-5">@lang('app.store_receivers')</div>
                                        <input name="store_receivers" value="1"
                                            placeholder="@lang('app.store_receivers')" type="checkbox" checked>

                                        @error('store_receivers')
                                        <div class="text-danger"> {{$message}}</div>
                                        @enderror
                                    </div>


                                </div>

                                <div class="row row-sm mb-4">


                                    <div class="col-lg">
                                        <div class="main-content-label mg-b-5">@lang('app.num_custom_fields')</div>
                                        <input class="form-control" value="{{old('num_custom_fields')}}" name="num_custom_fields" placeholder="@lang('app.num_custom_fields')"
                                            type="number">

                                        @error('num_custom_fields')
                                        <div class="text-danger"> {{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="col-lg">
                                        <div class="main-content-label mg-b-5">@lang('app.importation_type')</div>
                                        <select class="form-control" name="importation_type">
                                            <option selected disabled>...</option>
                                            <option value="{{ \App\Enums\ImportTypeEnum::AWBWITHREFERENCE->value }}">@lang('app.import_with_reference')</option>
                                            <option value="{{ \App\Enums\ImportTypeEnum::AWBWITHOUTREFERENCE->value }}">@lang('app.import_without_reference')</option>
                                        </select>

                                        @error('importation_type')
                                        <div class="text-danger"> {{$message}}</div>
                                        @enderror
                                    </div>


                                </div>

                                <div class="row row-sm mb-4">
                                    <div class="col-lg">
                                        <div class="main-content-label mg-b-5">@lang('app.address')</div>
                                        <input class="form-control" name="address" value="{{old('address')}}"  placeholder="@lang('app.address')"
                                            type="text" required>

                                        @error('address')
                                        <div class="text-danger"> {{$message}}</div>
                                        @enderror
                                    </div>

                                </div>

                                <div>
                                    <livewire:locations-drop-down/>
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
                {{-- end companies --}}

                {{-- start branches --}}
                <div class="col-lg-12 col-md-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <div>
                            <a aria-controls="branches-collapse" aria-expanded="false" class="btn ripple btn-primary collapsed" data-bs-toggle="collapse" href="#branches-collapse" role="button">@lang('app.branches')</a>
                            <div class="collapse" id="branches-collapse" style="">
                                <div class="mt-4">
                                    <div class="items branches-items">
                                        <div class="item mt-4">
                                            <h4>@lang('app.branch_data')</h4>
                                            <hr>
                                            <div class="row row-sm mb-4">
                                                <div class="col-lg">
                                                    <div class="main-content-label mg-b-5">@lang('app.name')</div>
                                                    <input class="form-control" name='branches[0][name]' value="{{old('branches[0][name]')}}" placeholder="@lang('app.name')"
                                                        type="text">
                                                    @error('branches[0][name]')
                                                        <div id="validationServer03Feedback" class="invalid-feedback"> {{$message}} </div>
                                                    @enderror
                                                </div>

                                                <div class="col-lg">
                                                    <div class="main-content-label mg-b-5">@lang('app.phone')</div>
                                                    <input class="form-control" value="{{old('branches[0][phone]')}}" name="branches[0][phone]" placeholder="@lang('app.phone')"
                                                        type="text">
                                                    @error('branches[0][phone]')
                                                        <div class="text-danger"> {{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row row-sm mb-4">
                                                <div class="col-lg">
                                                    <div class="main-content-label mg-b-5">@lang('app.status')</div>
                                                    <input name="branches[0][status]" value="1"
                                                        placeholder="@lang('app.status')" type="checkbox" checked>

                                                    @error('branches[0][status]')
                                                    <div class="text-danger"> {{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="row row-sm mb-4">
                                                <div class="col-lg">
                                                    <div class="main-content-label mg-b-5">@lang('app.address')</div>
                                                    <input class="form-control" name="branches[0][address]" value="{{old('branches[0][address]')}}"  placeholder="@lang('app.address')"
                                                        type="text">

                                                    @error('branches[0][address]')
                                                    <div class="text-danger"> {{$message}}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-lg">
                                                    @livewire("locations-drop-down",['city_field_name'=>'branches[0][city_id]', 'area_field_name'=>'branches[0][area_id]'])
                                                    @error('branches[0][city_id]')
                                                    <div class="text-danger"> {{$message}}</div>
                                                    @enderror
                                                    @error('branches[0][area_id]')
                                                    <div class="text-danger"> {{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <button class="btn btn-danger remove-item">X</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <div class="form-group mb-0 mt-3 justify-content-end">
                                        <div>
                                            <button type="button" class="btn btn-success append-branch"><i
                                                    class="fa fa-save pe-2"></i>@lang('app.add_branch')</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                {{-- end branches --}}

                {{-- start departments --}}
                <div class="col-lg-12 col-md-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div>
                                <a aria-controls="departments-collapse" aria-expanded="false" class="btn ripple btn-primary collapsed" data-bs-toggle="collapse" href="#departments-collapse" role="button">@lang('app.departments')</a>
                                <div class="collapse" id="departments-collapse" style="">
                                    <div class="mt-4">
                                        <div class="items departments-items">
                                            <div class="item mt-4">
                                                <h4>@lang('app.department_data')</h4>
                                                <hr>
                                                <div class="row row-sm mb-4">
                                                    <div class="col-lg">
                                                        <div class="main-content-label mg-b-5">@lang('app.name')</div>
                                                        <input class="form-control" name="departments[0][name]" value="{{old('departments[0][name]')}}" placeholder="@lang('app.name')"
                                                            type="text">
                                                        @error('departments[0][name]')
                                                            <div id="validationServer03Feedback" class="invalid-feedback"> {{$message}} </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <button class="btn btn-danger remove-item">X</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <div class="form-group mb-0 mt-3 justify-content-end">
                                            <div>
                                                <button type="button" class="btn btn-success append-department"><i
                                                        class="fa fa-save pe-2"></i>@lang('app.add_department')</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                {{-- end departments --}}

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
        $(document).ready(function(){
            var branchIndex = 1;
            var departmentIndex = 1;
            $('.append-branch').on('click', function(){

                var item = $('.branches-items .item').first().html();
                $('.branches-items').append('<div class="item mt-4">' + item + '</div>');
                var inputs = $('.branches-items .item:last').find('input');
                $('.branches-items .item:last [name="branches[0][name]"]').attr('name', 'branches['+ branchIndex +'][name]');
                $('.branches-items .item:last [name="branches[0][phone]"]').attr('name', 'branches['+ branchIndex +'][phone]');
                $('.branches-items .item:last [name="branches[0][status]"]').attr('name', 'branches['+ branchIndex +'][status]');
                $('.branches-items .item:last [name="branches[0][address]"]').attr('name', 'branches['+ branchIndex +'][address]');
                $('.branches-items .item:last [name="branches[0][city_id]"]').attr('name', 'branches['+ branchIndex +'][city_id]');
                $('.branches-items .item:last [name="branches[0][area_id]"]').attr('name', 'branches['+ branchIndex +'][area_id]');
                branchIndex++;
            });

            $('.append-department').on('click', function(){

                var item = $('.departments-items .item').first().html();

                $('.departments-items').append('<div class="item mt-4">' + item + '</div>');
                var inputs = $('.departments-items .item:last').find('input');
                inputs.attr('name', 'departments['+ departmentIndex +'][name]');
                departmentIndex++;
            });
            $('.items').on('click', '.remove-item', function(){
                $(this).parent().remove();
            });

        });

    </script>
@endsection
