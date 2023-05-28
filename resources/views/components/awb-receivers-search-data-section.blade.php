@section('styles')
    <!--- Internal Select2 css-->
    <link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection

<div>
    <div class="row mb-4">
        <div class="col-lg-12 col-md-12 col-sm-12 mt-2 mb-3">
            <div class="main-content-label mg-b-5">@lang('app.receivers')</div>
            <select id="receivers_search" name="receiver_id"
                    class="form-control form-select select2 js-example-basic-single"
                    data-bs-placeholder="Select receiver" data-select2-id="1" tabindex="-1" aria-hidden="true">
                <option selected disabled>@lang('app.search_receivers')</option>
            </select>
        </div>
    </div>

    <div class="row mb-4">

        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="main-content-label mg-b-5">@lang('app.receiving_company')</div>
            <input class="form-control" type="text" id="receiving_company" disabled readonly/>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="main-content-label mg-b-5">@lang('app.receiver_branch')</div>
            <input class="form-control" type="text" id="branch_name" disabled readonly/>
        </div>
    </div>

    <div class="row mb-4">

        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="main-content-label mg-b-5">@lang('app.phone')</div>
            <input class="form-control" type="text" id="phone" disabled readonly/>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="main-content-label mg-b-5">@lang('app.address')</div>
            <input class="form-control" type="text" id="address" disabled readonly/>
        </div>
    </div>

    <div class="row mb-4">

        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="main-content-label mg-b-5">@lang('app.city')</div>
            <input class="form-control" type="text" id="receiver_city" disabled readonly/>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="main-content-label mg-b-5">@lang('app.area')</div>
            <input class="form-control" type="text" id="receiver_area" disabled readonly/>
        </div>
    </div>
</div>
@section('scripts')
    <!-- Internal Select2.min js -->
    <script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <script>

        $(document).ready(function () {
            $("#receivers_search").select2({
                ajax: {
                    url: "{{route('receivers.search')}}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            keyword: params.term, // search term
                            page: params.page,
                        };
                    },
                    processResults: function (data, params) {
                        params.page = params.page || 1;
                        return {
                            results: $.map(data.data, function (receiver) {
                                return {
                                    id: receiver.id,
                                    text: receiver.name,
                                    phone:receiver.phone,
                                    receiving_company:receiver.receiving_company,
                                    branch:receiver.branch.name,
                                    address:receiver.default_address.address,
                                    city:receiver.default_address.city.title,
                                    area:receiver.default_address.area.title,
                                }
                            }),
                            pagination: {
                                more: (params.page * 10) < data.count_filtered
                            }
                        };
                    },
                    cache: true
                },
                minimumInputLength: 3,
                allowClear: true,
                closeOnSelect: true,
                selectOnClose: true,
            }).on('select2:select', function (e) {
                var data = e.params.data;
                $('#receiving_company').val(data.receiving_company);
                $('#branch_name').val(data.branch);
                $('#phone').val(data.phone);
                $('#address').val(data.address);
                $('#receiver_city').val(data.city);
                $('#receiver_area').val(data.area);
            });

        });
    </script>
@endsection


