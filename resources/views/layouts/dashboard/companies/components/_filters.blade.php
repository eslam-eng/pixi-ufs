<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card custom-card">
            <div class="card-body">
                <div>
                    <a aria-controls="collapseExample" class="btn ripple btn-light collapsed"
                       data-bs-toggle="collapse" href="#collapseExample" role="button"
                       aria-expanded="false"><i class="fa fa-filter pe-2"></i>@lang('app.companies_filter')
                    </a>
                </div>
                <div>

                    <div class="collapse show" id="collapseExample" style="">
                        <div class="mt-4">
                            <form class="datatables_parameters">
                                <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12"> <!--div-->
                                    <div class="row row-sm mt-4">
                                        <div class="col-lg">
                                            <div class="main-content-label mg-b-5">@lang('app.email')</div>
                                            <input class="form-control" name="email" placeholder="@lang('app.email')" type="email">
                                        </div>
                                        <div class="col-lg">
                                            <div class="main-content-label mg-b-5">@lang('app.phone')</div>
                                            <input class="form-control" name="phone" placeholder="@lang('app.phone')"
                                                   type="text">
                                        </div>
                                        <div class="col-lg">
                                            <div class="main-content-label mg-b-5">@lang('app.num_custom_fields')</div>
                                            <input class="form-control" name="num_custom_fields" placeholder="@lang('app.num_custom_fields')"
                                                   type="text">
                                        </div>
                                    </div>
                                    <div class="row row-sm mt-4">
                                        <div class="col-lg">
                                            <div class="main-content-label mg-b-5">@lang('app.show_dashboard')</div>
                                            <input name="show_dashboard" type="checkbox" value="1">
                                        </div>
                                        <div class="col-lg">
                                            <div class="main-content-label mg-b-5">@lang('app.status')</div>
                                            <input name="status" type="checkbox" value="1">
                                        </div>
                                    </div>
                                    <div class="row row-sm mt-4">
                                        <div class="col-lg">
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

                                <div class="card-footer">
                                    <div class="form-group mb-0 mt-3 justify-content-end">
                                        <div>
                                            <button type="submit" class="search_datatable btn btn-success"><i class="fa fa-search pe-2"></i>@lang('app.search')</button>
                                            <button type="reset" class="reset_form_data btn btn-secondary ms-4">@lang('app.reset')</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

