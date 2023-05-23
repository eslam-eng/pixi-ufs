@section('styles')
    <!--- Internal Select2 css-->
    <link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection

<div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 mt-2 mb-4">
            <div class="main-content-label mg-b-5">@lang('app.companies')</div>
            <select name="country" class="form-control form-select select2 js-example-basic-single"
                    data-bs-placeholder="Select Country" data-select2-id="1" tabindex="-1" aria-hidden="true">
                <option value="br" data-select2-id="13">Brazil</option>
                <option value="cz" data-select2-id="14">Czech Republic</option>
                <option value="de" data-select2-id="15">Germany</option>
                <option value="pl" selected="" data-select2-id="3">Poland</option>
            </select>
        </div>
    </div>

    {{--    <div class="row mb-4">--}}

    {{--        <div class="col-lg-6 col-md-6 col-sm-12">--}}
    {{--            <div class="main-content-label mg-b-5">@lang('app.phone')</div>--}}
    {{--            <input class="form-control" type="text" id="branch_phone" disabled readonly/>--}}
    {{--        </div>--}}

    {{--        <div class="col-lg-6 col-md-6 col-sm-12">--}}
    {{--            <div class="main-content-label mg-b-5">@lang('app.address')</div>--}}
    {{--            <input class="form-control" type="text" id="branch_address" disabled readonly/>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--    --}}
    {{--    <div class="row">--}}

    {{--        <div class="col-lg-6 col-md-6 col-sm-12">--}}
    {{--            <div class="main-content-label mg-b-5">@lang('app.city')</div>--}}
    {{--            <input class="form-control" type="text" id="branch_city" disabled readonly/>--}}
    {{--        </div>--}}

    {{--        <div class="col-lg-6 col-md-6 col-sm-12">--}}
    {{--            <div class="main-content-label mg-b-5">@lang('app.area')</div>--}}
    {{--            <input class="form-control" type="text" id="branch_area" disabled readonly/>--}}
    {{--        </div>--}}
    {{--    </div>--}}
</div>


