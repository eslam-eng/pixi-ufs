<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card custom-card">
            <div class="card-body">
                <div>
                    <a aria-controls="collapseExample" class="btn ripple btn-light collapsed"
                       data-bs-toggle="collapse" href="#collapseExample" role="button"
                       aria-expanded="false"><i class="fa fa-filter pe-2"></i>@lang('app.filter')
                    </a>
                </div>
                <div>

                    <div class="collapse" id="collapseExample" style="">
                        <div class="mt-4">
                            <form>
                                <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12"> <!--div-->
                                    <div class="row row-sm">
                                        <div class="col-lg-6 col-xs-6 col-sm-6 col-md-6">
                                           <x-receivers-select2-search/>
                                        </div>


                                        <div class="col-lg-6 col-xs-6 col-sm-6 col-md-6">
                                           <livewire:company/>
                                        </div>


                                        <div class="col-lg-6 col-xs-6 col-sm-6 col-md-6">
                                           <livewire:branch/>
                                        </div>

                                        <div class="col-lg-6 col-xs-6 col-sm-6 col-md-6">
                                            <livewire:department/>
                                        </div>


                                        <div class="col-lg-6 col-xs-6 col-sm-6 col-md-6">
                                           filter created at here
                                        </div>

                                    </div>

                                    <div class="row row-sm">
                                        <div class="col-lg">
                                            <livewire:location.cities/>
                                        </div>
                                        <div class="col-lg">
                                            <livewire:location.areas/>
                                        </div>
                                    </div>

                                </div>

                                <div class="card-footer">
                                    <div class="form-group mb-0 mt-3 justify-content-end">
                                        <div>
                                            <button type="submit" class="btn btn-rounded btn-success"><i class="fa fa-search pe-2"></i>@lang('app.search')</button>
                                            <button type="reset" class="btn btn-rounded btn-secondary ms-4">@lang('app.reset')</button>
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
