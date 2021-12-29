<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/' ?>bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url().'assets/css/' ?>mycss.css">

	<title>Survey Kepuasan Masyakarat</title>
	</style>
</head>
<body>
	<div class="container" style="text-align:center; ">

		<form class="col-lg-12 " style="margin-top: 150px;" method="post" action="<?php echo site_url('tes2/pertanyaan') ?>">
			<div class="form-group">
				<h3 class="labelreg">Masukkan NIK KTP Anda</h3>
				<input type="text" class="form-control" name="noreg">
			</div>
			<button type="submit" class="btn btn-primary">Masuk</button>
		</form>
	</div>

	<!-- Optional JavaScript -->
	<script src="<?php echo base_url().'assets/js' ?>/jquery.min.js"></script>
</body>
</html>

