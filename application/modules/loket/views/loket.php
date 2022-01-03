<div class="col-md-3">
	<div class="box box-primary">
		<form method="GET" class="date-range nice">
			<div class="box-body">
				<div class="form-group">
					<label for="exampleInputPassword1">Tanggal Awal</label>
					<input required placeholder="Tanggal Awal" autocomplete="off" id="start-date" class="form-control" type="text" name="startDate" tabindex="1" <?php if (isset($_GET['startDate'])) { ?> value="<?= $_GET['startDate'] ?>" <?php } ?>>
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Tanggal Akhir</label>
					<input required placeholder="Tanggal Akhir" autocomplete="off" id="end-date" class="form-control" type="text" name="endDate" tabindex="2" <?php if (isset($_GET['endDate'])) { ?> value="<?= $_GET['endDate'] ?>" <?php } ?>>
				</div>
				<button type="submit" class="btn btn-primary">Submit</button>
				<?php if (isset($_GET['startDate']) && isset($_GET['endDate'])) { ?>
					<a href="<?= base_url() ?>loket" class="btn btn-warning">Reset</a>
				<?php } ?>
			</div>
		</form>
	</div>
</div>

<script>
	$(document).ready(function() {
		// Initialize date pickers and form validation:
		$('form.date-range #reset-start-date').click(function(e) {
			e.preventDefault ? e.preventDefault() : e.returnValue = false; // stop link. returnValue is IE stuff
			$('form.date-range #start-date').datepicker('setDate', null); // null means reset
			onStartDate(''); // reset min start date
		});
		$('form.date-range #reset-end-date').click(function(e) {
			e.preventDefault ? e.preventDefault() : e.returnValue = false; // stop link. returnValue is IE stuff
			$('form.date-range #end-date').datepicker('setDate', null); // null means reset
			onEndDate(''); // reset max end date
		});
		var onStartDate = function(date) {
			var minEndDate = (date !== '') ? date : null; // null means no minimum, the default min
			$('form.date-range #end-date').datepicker('option', 'minDate', minEndDate);
		};
		var onEndDate = function(date) {
			var maxStartDate = (date !== '') ? date : 0; // 0 means today, the default max
			$('form.date-range #start-date').datepicker('option', 'maxDate', maxStartDate);
		};
		$('form.date-range #start-date').datepicker({
			maxDate: 0, // nothing past today
			dateFormat: 'yy-mm-dd', // Equiv to ISO-8601 'YYYY-MM-DD' which allows dateISO validation
			changeYear: true,
			changeMonth: true,
			yearRange: '1963:2009',
			onClose: onStartDate
		});
		$('form.date-range #end-date').datepicker({
			maxDate: 0, // nothing past today
			dateFormat: 'yy-mm-dd', // Equiv to ISO-8601 'YYYY-MM-DD' which allows dateISO validation
			changeYear: true,
			changeMonth: true,
			yearRange: '1963:2009',
			onClose: onEndDate
		});
		// $('form.date-range').validate();
	});
</script>

<div class="col-md-9">
	<div class="box box-primary">
		<div class="box-header with-border">
			<a href="#modal_add" class="btn-sm btn-success" data-toggle="modal"><i class="fa fa-plus-circle"></i> Tambah Instansi</a>
		</div>
		<div class="box-body">
			<table class="table table-hover table-bordered" style="font-size: 1.4rem;">
				<thead>
					<tr>
						<th class="text-left" width="5%">#</th>
						<th class="text-left" >Nama Instansi</th>
						<th class="text-left" >Kategori Instansi</th>
						<th class="text-left" >Jumlah Responden</th>
						<th class="text-left" >Kepuasan (%)</th>
						<th class="text-left" >Cetak Laporan</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$data_loket = $this->db->query("SELECT tb_loket.*,tb_kategori_instansi.nama_kategori_instansi from tb_loket
							 join tb_kategori_instansi on tb_kategori_instansi.kategori_instansi_id = tb_loket.kategori_instansi_id")->result();
					$no = 1;
					foreach ($data_loket as $loket) : ?>
						<?php if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
							$dari = $_GET['startDate'];
							$ke = $_GET['endDate'];
							$jml = $this->db->query("SELECT tb_detil_responden.*, tb_bidang_instansi.instansi_id FROM tb_detil_responden
							join tb_bidang_instansi on tb_bidang_instansi.bidang_instansi_id =tb_detil_responden.bidang_instansi_id where created_date >= '$dari' AND created_date <= '$ke' AND instansi_id='$loket->id_loket'");
							$jml_res = $jml->num_rows();
						} else {
							$jml = $this->db->query("SELECT tb_detil_responden.*, tb_bidang_instansi.instansi_id FROM tb_detil_responden
						    join tb_bidang_instansi on tb_bidang_instansi.bidang_instansi_id =tb_detil_responden.bidang_instansi_id where instansi_id='$loket->id_loket'");
							$jml_res = $jml->num_rows();
						} ?>

						<tr>
							<td class="text-left"><?php echo $no++ ?></td>
							<td><a title="Edit Data" class="modal_edit" href="#modal_edit" data-toggle="modal" data-id="<?php echo $loket->id_loket ?>" style="color: black;"><?php echo $loket->nama_loket ?></a></td>
							<td><a style="color: black;"><?php echo $loket->nama_kategori_instansi ?></a></td>
							<td><a style="color: black;"><?php echo $jml_res ?></a></td>
							<?php
							//persentase nilai
							$q_total_soal = $this->db->query("SELECT * FROM tb_pertanyaan");
							$total_soal = $q_total_soal->num_rows();

							if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
								$bidang_instansi = $this->db->query("SELECT tb_detil_responden.bidang_instansi_id,tb_bidang_instansi.instansi_id FROM tb_detil_responden
								join tb_bidang_instansi on tb_bidang_instansi.bidang_instansi_id =tb_detil_responden.bidang_instansi_id
								where created_date >= '$dari' AND created_date <= '$ke' AND instansi_id='$loket->id_loket' GROUP BY bidang_instansi_id")->result();
							}else{
								$bidang_instansi = $this->db->query("SELECT tb_detil_responden.bidang_instansi_id,tb_bidang_instansi.instansi_id FROM tb_detil_responden
								join tb_bidang_instansi on tb_bidang_instansi.bidang_instansi_id =tb_detil_responden.bidang_instansi_id
								where instansi_id='$loket->id_loket' GROUP BY bidang_instansi_id")->result();
							}
							

							$total = 0;
							$x = 0;
							$total_instansi = 0;
							foreach ($bidang_instansi as $n) {
								//jml respond bidang instansi
								if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
									$dari = $_GET['startDate'];
									$ke = $_GET['endDate'];
									$jml_res_bidang_q = $this->db->query("SELECT * FROM tb_detil_responden where created_date >= '$dari' AND created_date <= '$ke' AND bidang_instansi_id='$n->bidang_instansi_id'");
									$jml_res_bidang = $jml_res_bidang_q->num_rows();

									$nilai_bidang = $this->db->query("SELECT tb_hasil.*,tb_detil_responden.bidang_instansi_id FROM tb_hasil
									join tb_detil_responden on tb_detil_responden.id = tb_hasil.detail_responden_id where tb_hasil.created_date >= '$dari' AND tb_hasil.created_date <= '$ke' AND bidang_instansi_id='$n->bidang_instansi_id'")->result();
									$nilai_total_bidang = 0;
									$nilai_fix_bidang = 0;
									$x_bidang = 1;
									foreach ($nilai_bidang as $b) {
										if ($b->jawaban == 'd') {
											$n = 4;;
										} else if ($b->jawaban == 'c') {
											$n = 3;
										} else if ($b->jawaban == 'b') {
											$n = 2;
										} else {
											$n = 1;
										}
										$nilai[$x_bidang] = [
											'jawaban' => $n
										];
										$nilai_total_bidang += $nilai[$x_bidang]['jawaban'];
										$x_bidang++;
									}
									$nilai_max_bidang = $total_soal * 4 * $jml_res_bidang;

									if ($jml_res_bidang > 0) {
										$nilai_fix_bidang = ($nilai_total_bidang / $nilai_max_bidang) * 100;
									} else {
										$nilai_fix_bidang = 0;
									}
									$x++;
									$total = $total + $nilai_fix_bidang;
									$total_instansi = $total / $x;
								} else {
									$jml_res_bidang_q = $this->db->query("SELECT * FROM tb_detil_responden where bidang_instansi_id='$n->bidang_instansi_id'");
									$jml_res_bidang = $jml_res_bidang_q->num_rows();

									$nilai_bidang = $this->db->query("SELECT tb_hasil.*,tb_detil_responden.bidang_instansi_id FROM tb_hasil
									join tb_detil_responden on tb_detil_responden.id = tb_hasil.detail_responden_id where bidang_instansi_id='$n->bidang_instansi_id'")->result();
									$nilai_total_bidang = 0;
									$nilai_fix_bidang = 0;
									$x_bidang = 1;
									foreach ($nilai_bidang as $b) {
										if ($b->jawaban == 'd') {
											$n = 4;;
										} else if ($b->jawaban == 'c') {
											$n = 3;
										} else if ($b->jawaban == 'b') {
											$n = 2;
										} else {
											$n = 1;
										}
										$nilai[$x_bidang] = [
											'jawaban' => $n
										];
										$nilai_total_bidang += $nilai[$x_bidang]['jawaban'];
										$x_bidang++;
									}
									$nilai_max_bidang = $total_soal * 4 * $jml_res_bidang;

									if ($jml_res_bidang > 0) {
										$nilai_fix_bidang = ($nilai_total_bidang / $nilai_max_bidang) * 100;
									} else {
										$nilai_fix_bidang = 0;
									}
									$x++;
									$total = $total + $nilai_fix_bidang;
									$total_instansi = $total / $x;
								}
							}
							
							?>
							<td><a style="color: black;"><?php echo  round($total_instansi, 2)  ?> %</a></td>
							<td><a href="" style="color: black;" target="_blank"><i class="fa fa-print"></i> Cetak</a></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>


		</div>
	</div>
</div>
</div>


<!-- Modal add -->
<div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-purple">
				<h4 class="modal-title" id="exampleModalLongTitle">Tambah <strong>Instansi</strong></h4>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo site_url('loket/tambah_loket') ?>">
					<div class="form-group">
						<label for="staticEmail" class="col-form-label">Nama Instansi</label>
						<input required name="nama" class="form-control" />
					</div>
					<div class="form-group">
						<label for="kategori_instansi_id" class="col-form-label">Kategori Instansi</label>
						<select required class="form-control" name="kategori_instansi_id" id="kategori_instansi_id">
							<option value="">-- Pilih --</option>
							<?php
							foreach ($kategori_instansi as $row) : ?>
								<option value="<?php echo $row->kategori_instansi_id ?>"><?php echo $row->nama_kategori_instansi ?></option>
							<?php endforeach ?>
						</select>
					</div>

			</div>
			<div class="modal-footer">
				<button type="submit" class="btn bg-purple"><i class="fa fa-save"></i> Simpan</button>
			</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal edit -->
<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-purple">
				<h4 class="modal-title" id="exampleModalLongTitle">Edit <strong>Loket</strong></h4>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo site_url('loket/update_loket') ?>">
					<div class="form-group">
						<label for="staticEmail" class="col-form-label">Nama Loket</label>
						<input type="hidden" name="id_loket" />
						<input id="nama_loket" name="nama_loket" class="form-control" />
					</div>
					<div class="form-group">
						<label for="kategori_instansi_id2" class="col-form-label">Kategori Instansi</label>
						<select required id="kategori_instansi_id2" class="form-control" name="kategori_instansi_id">
							<option value="">-- Pilih --</option>
							<?php foreach ($kategori_instansi as $row) { ?>
								<option value="<?php echo $row->kategori_instansi_id ?>"><?php echo $row->nama_kategori_instansi ?></option>
							<?php } ?>
						</select>
					</div>
			</div>
			<div class="modal-footer">
				<button id="btn_hapus" type="button" class="btn btn-default pull-left"><i class="fa fa-trash"></i> Hapus</button>
				<button type="submit" class="btn bg-purple"><i class="fa fa-save"></i> Simpan Perubahan</button>
			</div>
			</form>
		</div>
	</div>
</div>


<script src="<?php echo base_url('assets/js/jsbaru/js_loket.js') ?>" type="text/javascript"></script>