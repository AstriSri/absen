<!-- Bootstrap core JavaScript-->
<script src="{{asset('sbadmin/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('sbadmin/vendor/jquery/popper.min.js')}}"></script>
<script src="{{asset('sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('sbadmin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('sbadmin/js/sb-admin-2.min.js')}}"></script>
<script src="{{asset('sbadmin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('sbadmin/vendor/datatables/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('plugins/select2-4.0.10/dist/js/select2.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            theme: "classic",
            width: "100%"
        });
    });
</script>
@stack('script')