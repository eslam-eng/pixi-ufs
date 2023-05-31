$(document).ready(function () {
    $('#branch_id').on('change', function () {
        var selectedOption = $(this).find(':selected');
        var phone = selectedOption.data('phone');
        var address = selectedOption.data('address');
        var city = selectedOption.data('city');
        var area = selectedOption.data('area');
        $("#branch_phone").text(phone);
        $("#branch_address").text(address);
        $("#branch_city").text(city);
        $("#branch_area").text(area);
    });
    $("#collection").css('display', 'none');
    if ($("#payment_type").val() == 4)
        $("#collection").css('display', 'block');

    $('#payment_type').on('change', function () {
        var selectedOption = $(this).val();
        if (selectedOption == 4)
            $("#collection").css('display', 'block');
        else
            $("#collection").css('display', 'none');
    });
});
