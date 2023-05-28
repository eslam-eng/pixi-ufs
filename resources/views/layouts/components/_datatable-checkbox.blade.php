<td class="text-end">
    <label class="custom-control custom-checkbox custom-control-md">
        <input type="checkbox" class="custom-control-input datatable-checkboxes"
               name="{{$name}}" value="{{$value}}">
        <span
            class="custom-control-label custom-control-label-md  tx-17"></span>
    </label>
</td>
<script>
    $(document).ready(function () {
        var selected_ids = [];

        $('.datatable-checkboxes').change(function() {
            if ($(this).is(':checked')) {
                // Perform action when checkbox is checked
                selected_ids.push($(this).val())
                console.log('Checkbox is checked.');
            } else {
                // Perform action when checkbox is unchecked
                selected_ids.pop($(this).val())
                console.log('Checkbox is unchecked.');
            }
        });
        $(".delete-selected-btn").click(function () {
            if (selected_ids.length)
            {
                var url = $(this).data('url');
                var csrf = $(this).data('csrf')
                $.ajax({
                    url: url,
                    type: 'post',
                    data: {
                        _token:csrf,
                        ids:selected_ids,
                        _method:'delete'
                    },
                    success: function(response) {
                        if (response.status)
                        {
                            toastr.success(response.message);
                            $('.dataTable').DataTable().ajax.reload(null, false);
                        }
                        else
                            toastr.error(response.message);
                    },
                    error: function(xhr) {
                        toastr.error(result.message);
                    }
                });
            }else{
                swal({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'please select at least one to delete!',
                })
            }

        });
    });

</script>
