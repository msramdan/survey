<div class="row">
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
						<a href="<?= base_url() ?>bidang_instansi" class="btn btn-warning">Reset</a>
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
				<a href="#modal_add" class="btn-sm btn-success" data-toggle="modal"><i class="fa fa-plus-circle"></i> Tambah Bidang Instansi</a>
			</div>
			<div class="box-body">
				<table class="table table-hover table-bordered">
					<thead>
						<tr>
							<th class="text-left" width="5%">#</th>
							<th class="text-left">Bidang Instansi</th>
							<th class="text-left">Instansi</th>
							<th class="text-left">Jumlah Respond</th>
							<th class="text-left">Kepuasan (%)</th>
							<th class="text-left">Cetak Laporan</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$data_bidang_instansi = $this->db->query("SELECT tb_bidang_instansi.*,tb_loket.nama_loket from tb_bidang_instansi
							 join tb_loket on tb_loket.id_loket = tb_bidang_instansi.instansi_id")->result();
						$no = 1;

						foreach ($data_bidang_instansi as $row) : ?>
							<?php if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
								$dari = $_GET['startDate'];
								$ke = $_GET['endDate'];
								$jml = $this->db->query("SELECT * FROM tb_detil_responden where created_date >= '$dari' AND created_date <= '$ke' AND  bidang_instansi_id='$row->bidang_instansi_id'");
								$jml_res = $jml->num_rows();
							} else {
								//jml responden
								$jml = $this->db->query("SELECT * FROM tb_detil_responden where bidang_instansi_id='$row->bidang_instansi_id'");
								$jml_res = $jml->num_rows();
							} ?>
							<tr>
								<td class="text-left"><?php echo $no++ ?></td>
								<td><a title="Edit Data" class="modal_edit" href="#modal_edit" data-toggle="modal" data-id="<?php echo $row->bidang_instansi_id ?>" style="color: black;"><?php echo $row->nama_bidang_instansi ?></a></td>
								<td><a style="color: black;"><?php echo $row->nama_loket ?></a></td>
								<td><a style="color: black;"><?php echo $jml_res ?></a></td>
								<?php
								//persentase nilai
								if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
									$dari = $_GET['startDate'];
									$ke = $_GET['endDate'];
									$q_total_soal = $this->db->query("SELECT * FROM tb_pertanyaan");
									$total_soal = $q_total_soal->num_rows();
									$nilai_persentase = $this->db->query("SELECT tb_hasil.*,tb_detil_responden.bidang_instansi_id FROM tb_hasil join tb_detil_responden on tb_detil_responden.id = tb_hasil.detail_responden_id
										where tb_hasil.created_date >= '$dari' AND tb_hasil.created_date <= '$ke' And bidang_instansi_id='$row->bidang_instansi_id'")->result();
									$total = 0;
									$x = 1;
									foreach ($nilai_persentase as $n) {
										if ($n->jawaban == 'd') {
											$n = 4;;
										} else if ($n->jawaban == 'c') {
											$n = 3;
										} else if ($n->jawaban == 'b') {
											$n = 2;
										} else {
											$n = 1;
										}
										$nilai[$x] = [
											'jawaban' => $n
										];
										$total += $nilai[$x]['jawaban'];
										$x++;
									}
									$nilai_max = $total_soal * 4 * $jml_res;
									$nilai_max = $total_soal * 4 * $jml_res;
									if ($jml_res > 0) { ?>
										<td><a style="color: black;"><?php echo round(($total / $nilai_max) * 100, 2) ?> % </a></td>
									<?php } else { ?>
										<td><a style="color: black;">0 %</a></td>
									<?php }
								} else {
									$q_total_soal = $this->db->query("SELECT * FROM tb_pertanyaan");
									$total_soal = $q_total_soal->num_rows();
									$nilai_persentase = $this->db->query("SELECT tb_hasil.*,tb_detil_responden.bidang_instansi_id FROM tb_hasil join tb_detil_responden on tb_detil_responden.id = tb_hasil.detail_responden_id where bidang_instansi_id='$row->bidang_instansi_id'")->result();
									$total = 0;
									$x = 1;
									foreach ($nilai_persentase as $n) {
										if ($n->jawaban == 'd') {
											$n = 4;;
										} else if ($n->jawaban == 'c') {
											$n = 3;
										} else if ($n->jawaban == 'b') {
											$n = 2;
										} else {
											$n = 1;
										}
										$nilai[$x] = [
											'jawaban' => $n
										];
										$total += $nilai[$x]['jawaban'];
										$x++;
									}
									$nilai_max = $total_soal * 4 * $jml_res;
									if ($jml_res > 0) { ?>
										<td><a style="color: black;"><?php echo round(($total / $nilai_max) * 100, 2) ?> % </a></td>
									<?php } else { ?>
										<td><a style="color: black;">0 %</a></td>
								<?php }
								} ?>
								<?php if (isset($_GET['startDate']) && isset($_GET['endDate'])) { ?>
									<td><a href="<?= base_url() ?>bidang_instansi/pdf/<?php echo $row->bidang_instansi_id ?>/<?= $_GET['startDate'] ?>/<?= $_GET['endDate'] ?>" style="color: black;" target="_blank"><i class="fa fa-print"></i> Cetak</a></td>
								<?php } else { ?>
									<td><a href="<?= base_url() ?>bidang_instansi/pdf/<?php echo $row->bidang_instansi_id ?>" style="color: black;" target="_blank"><i class="fa fa-print"></i> Cetak</a></td>
								<?php } ?>
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
				<h4 class="modal-title" id="exampleModalLongTitle">Tambah <strong>Bidang Instansi</strong></h4>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo site_url('bidang_instansi/tambah_bidang_instansi') ?>">
					<div class="form-group">
						<label for="staticEmail" class="col-form-label">Nama Bidang Instansi</label>
						<input required name="nama_bidang_instansi" class="form-control" />
					</div>
					<div class="form-group">
						<label for="loket_id" class="col-form-label">Instansi</label>
						<select required class="form-control" name="loket_id" id="loket_id">
							<option value="">-- Pilih --</option>
							<?php
							foreach ($loket as $row) : ?>
								<option value="<?php echo $row->id_loket ?>"><?php echo $row->nama_loket ?></option>
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
				<h4 class="modal-title" id="exampleModalLongTitle">Edit <strong>bidang_instansi</strong></h4>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo site_url('bidang_instansi/update_bidang_instansi') ?>">
					<div class="form-group">
						<label for="staticEmail" class="col-form-label">Nama bidang_instansi</label>
						<input type="hidden" name="bidang_instansi_id" />
						<input id="nama_bidang_instansi" name="nama_bidang_instansi" class="form-control" />
					</div>
					<div class="form-group">
						<label for="bidang_instansi_id2" class="col-form-label">Kategori Instansi</label>
						<select required id="bidang_instansi_id2" class="form-control" name="loket_id">
							<option value="">-- Pilih --</option>
							<?php foreach ($loket as $row) { ?>
								<option value="<?php echo $row->id_loket ?>"><?php echo $row->nama_loket ?></option>
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


<script src="<?php echo base_url('assets/js/jsbaru/js_bidang_instansi.js') ?>" type="text/javascript"></script>