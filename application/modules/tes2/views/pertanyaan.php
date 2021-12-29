<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/' ?>bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/' ?>mycss.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url().'assets/' ?>font-awesome/css/font-awesome.min.css">
	<script src="<?php echo base_url().'assets/js/' ?>sweetalert2@10.js"></script>

	<title>Survey Kepuasan Masyakarat</title>
	


</head>
<body>
	<div class="container">
		<div class="card">
			<div class="card-body">
				<input type="hidden" id="base" value="<?php echo site_url() ?>">
				<input type="hidden" id="noreg" value="<?php echo $noreg ?>">
				<input type="hidden" id="n_soal" value="<?php echo $nsoal ?>">
				<input type="hidden" id="id_soal" value="<?php echo $soal[0]->id_soal ?>">
				<p id="pertanyaan"><?php echo $soal[0]->soal ?></p>
				<div class="row">
					<div class="col">
						<div class="form-check form-check-inline">
							<input required class="form-check-input" type="radio" name="pilihan" id="c1" value="a">
							<label class="form-check-label" for="inlineRadio1" id="a">a</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="pilihan" id="c2" value="b">
							<label class="form-check-label" for="inlineRadio1" id="b">b</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="pilihan" id="c3" value="c">
							<label class="form-check-label" for="inlineRadio1" id="c">c</label>
						</div>
					</div>
				</div>
				<div class="row mb-4">
					<div class="col">
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="pilihan" id="c4" value="d">
							<label class="form-check-label" for="inlineRadio1" id="d">d</label>
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<button id="lanjut" class="btn btn-success float-right">Selanjutnya  <i class="fa fa-arrow-circle-right"></i></button>
			</div>
		</div>

	</div>
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="<?php echo base_url().'assets/js' ?>/jquery.min.js"></script>
	<script src="<?php echo base_url().'assets/js' ?>/jsku.js"></script>

</body>
</html>

