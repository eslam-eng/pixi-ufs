<script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap5.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/dataTables.responsive.min.js')}}"></script>
{!! $dataTable->scripts() !!}
<script src="{{asset('assets/js/datatable-filter.js')}}"></script>
<script>
    $(document).ready(function(){
        $('.datatable-checkboxes').change(function() {
            if ($(this).is(':checked')) {
                // Perform action when checkbox is checked
                console.log('Checkbox is checked.');
            } else {
                // Perform action when checkbox is unchecked
                console.log('Checkbox is unchecked.');
            }
        });
    });
</script>
