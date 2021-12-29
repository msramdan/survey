<!-- jQuery 3 -->
<script src="<?php echo base_url().'assets/'?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url().'assets/'?>bower_components/jquery-ui/jquery-ui.min.js"></script>

<!-- DataTables -->
<script src="<?php echo base_url().'assets/'?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url().'assets/'?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
	$.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url().'assets/'?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- datepicker -->
<script src="<?php echo base_url().'assets/'?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url().'assets/'?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url().'assets/'?>bower_components/fastclick/lib/fastclick.js"></script>

<!-- Select2 -->
<script src="<?php echo base_url().'assets/'?>bower_components/select2/dist/js/select2.full.min.js"></script>

<!-- AdminLTE App -->
<script src="<?php echo base_url().'assets/'?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url().'assets/'?>dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url().'assets/'?>dist/js/demo.js"></script>

<!-- Select2 -->
<script src="<?php echo base_url().'assets/'?>bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo base_url().'assets/'?>js/jsbaru/js_filter.js" ></script>

<script>
	$(document).ready( function () {
		$('#responden').DataTable();
	} );
</script>

</body>
</html>
<!-- page script -->