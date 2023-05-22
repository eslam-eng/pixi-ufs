<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="Nowa – Laravel Bootstrap 5 Admin & Dashboard Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="Keywords"
          content="admin dashboard, admin dashboard laravel, admin panel template, blade template, blade template laravel, bootstrap template, dashboard laravel, laravel admin, laravel admin dashboard, laravel admin panel, laravel admin template, laravel bootstrap admin template, laravel bootstrap template, laravel template"/>

    <!-- Title -->
    <title> UFS - Control Panel </title>

    @include('layouts.components.styles')

    <livewire:styles />
</head>

<body class="ltr main-body app sidebar-mini">

<!-- Loader -->
<div id="global-loader">
    <img src="{{asset('assets/img/loader.svg')}}" class="loader-img" alt="Loader">
</div>
<!-- /Loader -->

<!-- Page -->
<div class="page">

    <div>

        @include('layouts.components.app-header')

        @include('layouts.components.app-sidebar')

    </div>

    <!-- main-content -->
    <div class="main-content app-content">

        <!-- container -->
        <div class="main-container container-fluid">

            @yield('content')

        </div>
        <!-- Container closed -->
    </div>
    <!-- main-content closed -->

    @include('layouts.components.sidebar-right')

    @include('layouts.components.modal')

    @yield('modal')

    @include('layouts.components.footer')

</div>
<!-- End Page -->

@include('layouts.components.scripts')
@include('layouts.components.toastr')


<script>
    function destroy(url) {
        swal({
            title: "{{__('lang.are_you_sure')}}",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((confirmed) => {
            if (confirmed) {
                $.ajax({
                    method: 'DELETE',
                    url: url,
                    dataType: 'json',
                    data:{
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function(result) {
                        if (result.status)
                        {
                            toastr.success(result.message);
                            $('.dataTable').DataTable().ajax.reload(null, false);
                        }
                        else
                            toastr.error(result.message);
                    }
                });
            }
        });
    }
</script>
<livewire:scripts />
</body>
</html>
