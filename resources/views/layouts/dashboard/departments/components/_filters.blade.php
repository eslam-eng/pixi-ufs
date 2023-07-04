<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card custom-card">
            <div class="card-body">
                <div>
                    <a aria-controls="collapseExample" class="btn ripple btn-light collapsed"
                       data-bs-toggle="collapse" href="#collapseExample" role="button"
                       aria-expanded="false"><i class="fa fa-filter pe-2"></i>@lang('app.receivers_filter')
                    </a>
                </div>
                <div>

                    <div class="collapse show" id="collapseExample" style="">
                        <div class="mt-4">
                            <form class="datatables_parameters">
                                <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12"> <!--div-->
                                    <div class="row row-sm">
                                        <div class="col-lg">
                                            <livewire:locations-drop-down/>
                                                @error('city_id')
                                                <div class="text-danger"> {{$message}}</div>
                                                @enderror
                                                @error('area_id')
                                                <div class="text-danger"> {{$message}}</div>
                                                @enderror
                                        </div>
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <livewire:company-with-branch-and-departments company_name="company_id" branch_name="branch_id"/>
                                                @error('branch_id')
                                                <div class="text-danger"> {{$message}}</div>
                                                @enderror
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="card-footer">
                                    <div class="form-group mb-0 mt-3 justify-content-end">
                                        <div>
                                            <button type="submit" class="search_datatable btn btn-primary"><i class="fa fa-search pe-2"></i>@lang('app.search')</button>
                                            <button type="reset" class="reset_form_data btn btn-primary">@lang('app.reset')</button>
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

