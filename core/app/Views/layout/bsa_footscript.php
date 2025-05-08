<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?php echo base_url() ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?php echo base_url() ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url() ?>/plugins/select2/js/select2.full.min.js"></script>
<!-- jsGrid -->
<script src="<?php echo base_url() ?>/plugins/jsgrid/demos/db.js"></script>
<script src="<?php echo base_url() ?>/plugins/jsgrid/jsgrid.min.js"></script>
<!-- InputMask -->
<script src="<?php echo base_url() ?>/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url() ?>/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="<?php echo base_url() ?>/plugins/daterangepicker/daterangepicker.js"></script>

<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url() ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

	<script src="<?php echo base_url() ?>/plugins/cropper/cropper.min.js"></script>

<!-- AdminLTE -->
<script src="<?php echo base_url() ?>/dist/js/adminlte.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url() ?>/dist/js/demo.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="<?php echo base_url() ?>/plugins/chart.js/Chart.min.js"></script>
<!--<script src="<?php echo base_url() ?>/dist/js/demo.js"></script>
<script src="<?php echo base_url() ?>/dist/js/pages/dashboard3.js"></script>-->

<!-- DataTables -->
<script src="<?php echo base_url() ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url() ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<!--<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>-->
<script src="<?php echo base_url() ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<?php if($PageJS!="") { echo $PageJS; }  ?>
<?php if($AppJS!="") {  ?>
	<script type="text/javascript" src="<?php echo $AppJS; ?>"></script>
<?php }  ?>
