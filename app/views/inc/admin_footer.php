   <!-- Footer Section Start -->
        <div class="footer-section">
            <div class="container-fluid">

                <div class="footer-copyright text-center">
                    <p class="text-body-light">2019 &copy; <a href="https://themeforest.net/user/codecarnival">Codecarnival</a></p>
                </div>

            </div>
        </div><!-- Footer Section End -->

    </div>

    <!-- JS
============================================ -->
 <!-- Global Vendor, plugins & Activation JS -->
    <script src="<?php echo URLROOT; ?>/assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="<?php echo URLROOT; ?>/assets/js/vendor/jquery-3.3.1.min.js"></script>
    <script src="<?php echo URLROOT; ?>/assets/js/vendor/popper.min.js"></script>
    <script src="<?php echo URLROOT; ?>/assets/js/vendor/bootstrap.min.js"></script>
    <!--Plugins JS-->
    <script src="<?php echo URLROOT; ?>/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="<?php echo URLROOT; ?>/assets/js/plugins/tippy4.min.js.js"></script>
    <!--Main JS-->
    <script src="<?php echo URLROOT; ?>/assets/js/main.js"></script>

    <!-- Plugins & Activation JS For Only This Page -->

    <!--Moment-->
    <script src="<?php echo URLROOT; ?>/assets/js/plugins/moment/moment.min.js"></script>

    <!--Daterange Picker-->
    <script src="<?php echo URLROOT; ?>/assets/js/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo URLROOT; ?>/assets/js/plugins/daterangepicker/daterangepicker.active.js"></script>

    <!--Echarts-->
    <script src="<?php echo URLROOT; ?>/assets/js/plugins/chartjs/Chart.min.js"></script>
    <script src="<?php echo URLROOT; ?>/assets/js/plugins/chartjs/chartjs.active.js"></script>

    <!--VMap-->
    <script src="<?php echo URLROOT; ?>/assets/js/plugins/vmap/jquery.vmap.min.js"></script>
    <script src="<?php echo URLROOT; ?>/assets/js/plugins/vmap/maps/jquery.vmap.world.js"></script>
    <script src="<?php echo URLROOT; ?>/assets/js/plugins/vmap/maps/samples/jquery.vmap.sampledata.js"></script>
    <script src="<?php echo URLROOT; ?>/assets/js/plugins/vmap/vmap.active.js"></script>

    <!-- Plugins & Activation JS For Only This Page -->
    <script src="<?php echo URLROOT; ?>/assets/js/plugins/datatables/datatables.min.js"></script>
    <script src="<?php echo URLROOT; ?>/assets/js/plugins/datatables/datatables.active.js"></script>

<!-- START SWEET ALERT FOR ACCOUNT DLEETE  -->


        <script type="text/javascript">
            function archiveFunction() {
event.preventDefault(); // prevent form submit
var form = event.target.form; // storing the form
        swal({
  title: "Are you sure?",
  text: "",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes, delete it!",
  cancelButtonText: "No, cancel please!",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm){
  if (isConfirm) {
    form.submit();          // submitting the form when user press yes
  } else {
    swal("Cancelled", "", "error");
  }
});
}
        </script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">



<!-- END SWEET ALERT FOR ACCOUNT DLEETE  -->


</body>

</html>