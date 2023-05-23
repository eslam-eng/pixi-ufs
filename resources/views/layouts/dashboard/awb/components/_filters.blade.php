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
                            <form>
                                <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12"> <!--div-->
                                    <div class="row row-sm">
                                        <div class="col-lg">
                                            <div class="main-content-label mg-b-5"> Form Input and Textarea</div>
                                            <input class="form-control" placeholder="Input box" type="text">
                                        </div>
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <div class="main-content-label mg-b-5"> Form Input and Textarea</div>
                                            <input class="form-control" placeholder="Input box (readonly)" readonly=""
                                                   type="text">
                                        </div>
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <div class="main-content-label mg-b-5"> Form Input and Textarea</div>
                                            <input class="form-control" disabled="" placeholder="Input box (disabled)"
                                                   type="text">
                                        </div>
                                    </div>
                                    <div class="row row-sm mg-t-20">
                                        <div class="col-lg"><textarea class="form-control" placeholder="Textarea"
                                                                      rows="3"></textarea></div>
                                    </div>

                                </div>

                                <div class="card-footer">
                                    <div class="form-group mb-0 mt-3 justify-content-end">
                                        <div>
                                            <button type="submit" class="btn btn-success"><i class="fa fa-search pe-2"></i>@lang('app.search')</button>
                                            <button type="reset" class="btn btn-secondary ms-4">@lang('app.reset')</button>
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
