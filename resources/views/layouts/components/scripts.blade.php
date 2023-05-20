		<!-- BACK-TO-TOP -->
		<a href="#top" id="back-to-top"><i class="las la-arrow-up"></i></a>

		<!-- JQUERY JS -->
		<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>

		<!-- BOOTSTRAP JS -->
		<script src="{{asset('assets/plugins/bootstrap/js/popper.min.js')}}"></script>
		<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

		<!-- IONICONS JS -->
		<script src="{{asset('assets/plugins/ionicons/ionicons.js')}}"></script>

		<!-- MOMENT JS -->
		<script src="{{asset('assets/plugins/moment/moment.js')}}"></script>

		<!-- P-SCROLL JS -->
		<script src="{{asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
		<script src="{{asset('assets/plugins/perfect-scrollbar/p-scroll.js')}}"></script>

		<!-- SIDEBAR JS -->
		<script src="{{asset('assets/plugins/side-menu/sidemenu.js')}}"></script>

		<!-- STICKY JS -->
		<script src="{{asset('assets/js/sticky.js')}}"></script>

		<!-- Chart-circle js -->
		<script src="{{asset('assets/plugins/circle-progress/circle-progress.min.js')}}"></script>

		<!-- RIGHT-SIDEBAR JS -->
		<script src="{{asset('assets/plugins/sidebar/sidebar.js')}}"></script>
		<script src="{{asset('assets/plugins/sidebar/sidebar-custom.js')}}"></script>

        @yield('scripts')

		<!-- EVA-ICONS JS -->
		<script src="{{asset('assets/plugins/eva-icons/eva-icons.min.js')}}"></script>

		<!-- THEME-COLOR JS -->
		<script src="{{asset('assets/js/themecolor.js')}}"></script>

		<!-- CUSTOM JS -->
		<script src="{{asset('assets/js/custom.js')}}"></script>

		<!-- exported JS -->
		<script src="{{asset('assets/js/exported.js')}}"></script>

        <script src="{{asset('assets/plugins/toastr/js/toastr.min.js')}}"></script>

        <script>
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr.error("testttttttttttttttttt","error");

        </script>
