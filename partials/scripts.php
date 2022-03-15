<script src="../public/js/bootstrap.bundle.min.js"></script>
<script src="../public/js/jquery.min.js"></script>
<script src="../public/js/default/internet-status.js"></script>
<script src="../public/js/waypoints.min.js"></script>
<script src="../public/js/jquery.easing.min.js"></script>
<script src="../public/js/wow.min.js"></script>
<script src="../public/js/owl.carousel.min.js"></script>
<script src="../public/js/jquery.counterup.min.js"></script>
<script src="../public/js/jquery.countdown.min.js"></script>
<script src="../public/js/imagesloaded.pkgd.min.js"></script>
<script src="../public/js/isotope.pkgd.min.js"></script>
<script src="../public/js/jquery.magnific-popup.min.js"></script>
<script src="../public/js/default/dark-mode-switch.js"></script>
<script src="../public/js/ion.rangeSlider.min.js"></script>
<script src="../public/js/jquery.dataTables.min.js"></script>
<script src="../public/js/jquery.dataTables.min.js"></script>
<script src="../public/js/default/active.js"></script>
<script src="../public/js/default/clipboard.js"></script>
<!-- PWA-->
<script src="../public/js/pwa.js"></script>
<!-- Responsive Data Tables -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<!-- Toastr -->
<script src="../assets/plugins/toastr/toastr.min.js"></script>
<!-- Load Table -->
<script>
    $(document).ready(function() {
        $('#report').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'print'
            ]
        });
    });
    /* Ajax Scripts */
    function GetServiceDetails(val) {
        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: 'ServiceName=' + val,
            success: function(data) {
                //alert(data);
                $('#ServiceID').val(data);
            }
        });

    }
</script>

<!-- Init  Alerts -->
<?php if (isset($success)) { ?>
    <!-- Pop Success Alert -->
    <script>
        toastr.success('<?php echo $success; ?>')
    </script>

<?php }
if (isset($err)) { ?>
    <script>
        toastr.error('<?php echo $err; ?>')
    </script>
<?php }
if (isset($info)) { ?>
    <script>
        toastr.warning('<?php echo $info; ?>')
    </script>
<?php }
?>