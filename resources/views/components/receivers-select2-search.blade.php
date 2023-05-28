@section('after_styles')
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
</div>
@section('script_footer')
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
            });
        });
    </script>
@endsection


