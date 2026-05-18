<!-- Footer Start -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <script>
                    document.write(new Date().getFullYear())
                </script> &copy; LCW Lighting by <a target="_blank" href="https://www.mplussoft.com/">Mplussoft</a>
            </div>

        </div>
    </div>
</footer>
<!-- end Footer -->



<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- Vendor -->
<script src="{{URL::asset('package_assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{URL::asset('package_assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{URL::asset('package_assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{URL::asset('package_assets/libs/node-waves/waves.min.js')}}"></script>
<script src="{{URL::asset('package_assets/libs/waypoints/lib/jquery.waypoints.min.js')}}"></script>
<script src="{{URL::asset('package_assets/libs/jquery.counterup/jquery.counterup.min.js')}}"></script>
<script src="{{URL::asset('package_assets/libs/feather-icons/feather.min.js')}}"></script>

<!--Morris Chart-->
<script src="{{URL::asset('package_assets/libs/morris.js06/morris.min.js')}}"></script>
<script src="{{URL::asset('package_assets/libs/chart.js/Chart.bundle.min.js')}}"></script>
<script src="{{URL::asset('package_assets/libs/raphael/raphael.min.js')}}"></script>

<!-- Init js -->
<script src="{{URL::asset('package_assets/js/pages/chartjs.init.js')}}"></script>
<script src="{{URL::asset('package_assets/js/pages/morris.init.js')}}"></script>

<!-- App js -->
<script src="{{URL::asset('package_assets/js/app.min.js')}}"></script>

<!-- knob plugin -->
<script src="{{URL::asset('package_assets/libs/jquery-knob/jquery.knob.min.js')}}"></script>

<!-- Dashboar init js-->
<script src="{{URL::asset('package_assets/js/pages/dashboard.init.js')}}"></script>

<!-- App js-->
<script src="{{URL::asset('package_assets/js/pages/datatables.init.js')}}"></script>

<!-- third party js -->
<script src="{{URL::asset('package_assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('package_assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{URL::asset('package_assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('package_assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js')}}"></script>
<script src="{{URL::asset('package_assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('package_assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js')}}"></script>
<script src="{{URL::asset('package_assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('package_assets/libs/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
<script src="{{URL::asset('package_assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('package_assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
<script src="{{URL::asset('package_assets/libs/datatables.net-select/js/dataTables.select.min.js')}}"></script>
<script src="{{URL::asset('package_assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('package_assets/libs/pdfmake/build/vfs_fonts.js')}}"></script>
<!-- third party js ends -->

<!-- Plugins js -->
<script src="{{URL::asset('package_assets/libs/dropzone/min/dropzone.min.js')}}"></script>
<script src="{{URL::asset('package_assets/libs/dropify/js/dropify.min.js')}}"></script>
<script src="{{URL::asset('package_assets/libs/tippy.js/tippy.all.min.js')}}"></script>
<!-- <script src="assets/libs/tippy.js/tippy.all.min.js"></script> -->

<!-- Init js-->
<script src="{{URL::asset('package_assets/js/pages/form-fileuploads.init.js')}}"></script>

<!-- Toaster Js -->
<script src="{{ URL::asset('package_assets/libs/toastr/build/toastr.min.js') }}"></script>

<!-- Common Delete And Status Change Js -->
<script src="{{ URL::asset('admin_panel/Common/common.js') }}"></script>

<!-- Validation Js -->
<script src="{{ URL::asset('package_assets/libs/validation/validate.min.js') }}"></script>

<!-- Summernote Js -->
<script src="{{ URL::asset('package_assets/libs/summernote/summernote.min.js') }}"></script>

<!-- select2 dropdown -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<!-- Toaster Code -->
<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
    }

    @if(Session::has('success'))
    toastr.success("{{ Session::get('success') }}");
    @endif

    @if(Session::has('info'))
    toastr.info("{{ Session::get('info') }}");
    @endif

    @if(Session::has('warning'))
    toastr.warning("{{ Session::get('warning') }}");
    @endif

    @if(Session::has('error'))
    toastr.error("{{ Session::get('error') }}");
    @endif
</script>

<script>
    function success_toast(title = '', message = '') {
        toastr.success(message);
    }

    function error_toast(title = '', message = '') {
        toastr.error(message);
    }
</script>
<script>
    $(document).ready(function() {
        $('.required-star').append('<span style="color:red"> *</span>');
        $('.dropify-clear').remove();
    });
</script>

<script>
    $('.required-field').append('<span class="text-danger">*</span>');

    function capitalizeFirstLetter(input) {
        let val = input.val();
        if (val.length > 0) {
          let capitalized = val.charAt(0).toUpperCase() + val.slice(1);
          input.val(capitalized);
        }
      }

      $('.capitalize-input').on('blur keyup paste', function () {
        // Use a short timeout for paste to ensure value is updated
        let input = $(this);
        setTimeout(function () {
          capitalizeFirstLetter(input);
        }, 0);
      });

    $('input[type=text],input[type=number],input[type=date],input[type=email]').attr('autocomplete', 'off');
    $('.isNumber').attr('onkeypress', 'return /[0-9]/i.test(event.key)');
    $('.isAlpha').attr('onkeypress', 'return /[a-z A-Z]/i.test(event.key)');
    $('.isAlphaNumber').attr('onkeypress', 'return /[a-z A-Z 0-9]/i.test(event.key)');
    $('.isEmail').attr('onkeypress', 'return /[0-9 a-z A-Z _-@.]/i.test(event.key)');
    $('.startWithAlphaNumber').attr('onkeypress', 'return /^[A-Za-z][A-Za-z0-9]*$/i.test(event.key)');
    $('.txtUpper').css('text-transform', 'uppercase');
    $('.txtLower').css('text-transform', 'lowercase');
    $('.txtUcwords').css('text-transform', 'capitalize');

</script>

@yield('script')