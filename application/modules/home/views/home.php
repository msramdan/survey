<div class="box" style="margin-top: -10px">
	<div class="box-body">
		<form method="GET" class="date-range nice">
			<div class="form-group row">
				<div class="col-sm-3 col-xs-12 text-right" style="margin-top: 0.3em">
					<div class="form-group">
						<input required placeholder="Tanggal Awal" autocomplete="off" id="start-date" class="form-control" type="text" name="startDate" tabindex="1" <?php if (isset($_GET['startDate'])) { ?> value="<?= $_GET['startDate'] ?>" <?php } ?>>
					</div>
				</div>
				<div class="col-sm-3 col-xs-12 text-right" style="margin-top: 0.3em">
					<div class="form-group">
						<input required placeholder="Tanggal Akhir" autocomplete="off" id="end-date" class="form-control" type="text" name="endDate" tabindex="2" <?php if (isset($_GET['endDate'])) { ?> value="<?= $_GET['endDate'] ?>" <?php } ?>>
					</div>
				</div>
				<div class="col-sm-3 col-xs-12" style="margin-top: 0.3em">
					<button type="submit" class="btn btn-primary">Filter</button>
					<?php if (isset($_GET['startDate']) && isset($_GET['endDate'])) { ?>
						<a href="<?= base_url() ?>home" class="btn btn-warning"><i class="fa fa-refresh"></i> Reset</a>
						<a href="<?= base_url() ?>home/pdf/<?= $_GET['startDate'] ?>/<?= $_GET['endDate'] ?>" class="btn btn-danger" target="_blank"> <i class="fa fa-file-pdf-o"></i> Cetak</a>
						
					<?php } ?>
					
				</div>
			</div>
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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


<div class="row">
	<!-- card -->
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-aqua"><i class="fa  fa-pie-chart"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Index Kepuasan</span>
						<span class="info-box-text">Terhadap PEMDA</span>
					<?php
					$kira = array();
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
									$kira[] = $total_instansi;
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
									$kira[] = $total_instansi;
								}
							
							}
							
							?>
							
					<?php endforeach ?>
					<?php
						$jml = count($kira);
						$sum = array_sum($kira);
					?>
						<span class="info-box-number"><?= round($sum / $jml , 2) ?><small>%</small></span>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-red"><i class="ion ion-ios-people-outline"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">Responden</span>
						<span class="info-box-number">
							<?php if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
								$dari = $_GET['startDate'];
								$ke = $_GET['endDate'];
								$jml = $this->db->query("SELECT * FROM tb_detil_responden where created_date >= '$dari' AND created_date <= '$ke'");
								echo $jml->num_rows();
							} else {
								//jml responden
								$jml = $this->db->query("SELECT * FROM tb_detil_responden ");
								echo $jml->num_rows();
							} ?>
						</span>
					</div>
				</div>
			</div>
			<div class="clearfix visible-sm-block"></div>

			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-green"><i class="fa fa-bank"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">Instansi</span>
						<span class="info-box-number">
							<?php $query = $this->db->query('SELECT * FROM tb_loket');
							echo $query->num_rows(); ?>
						</span>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-yellow"><i class="fa fa-bank"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Bidang Instansi</span>
						<span class="info-box-number"><?php $query = $this->db->query('SELECT * FROM tb_bidang_instansi');
														echo $query->num_rows(); ?></span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- table -->
	<section class="col-lg-12 connectedSortable ui-sortable">
		<div class="box box-primary">
			<div class="box-header ui-sortable-handle" style="cursor: move;">
				<i class="ion ion-clipboard"></i>
				<h3 class="box-title">Statistik</h3>
				<!-- <a href="#" style="margin-left: 20px;" class="btn-sm btn-success" id="cetak_rekap_index" title="cetak"><i class="fa fa-file-excel-o"></i> export</a>
				<a href="#" style="margin-left: 10px;" class="btn-sm btn-success" id="cetak_rekap_index_detil" title="cetak"><i class="fa fa-file-excel-o"></i> Export Detil</a> -->

				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>

					</button>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<div class="table-responsive">
					<table class="fl-table">
						<thead>
							<tr style="background-color: #1f6f8b; color: white;">
								<th class="text-center" rowspan="2" style="vertical-align: middle;">No</th>
								<th class="text-center" width="50%" rowspan="2" style="vertical-align: middle;">Unsur Pelayanan</th>
								<th class="text-center" rowspan="1" style="background-color: #68b0ab; color: white;" colspan="4">Jumlah Responden Yang Menjawab (orang)</th>
								<th class="text-center" rowspan="2" style="vertical-align: middle;">Nilai Rata2</th>
								<th class="text-center" rowspan="2" style="vertical-align: middle;">Kategori Mutu</th>
								<!-- <th class="text-center" rowspan="2" style="vertical-align: middle;">Prioritas</th> -->
							</tr>
							<tr style="color: white;">
								<th class="text-center" width="10%" style="vertical-align: middle; background-color: #0278ae">Sangat Puas</th>
								<th class="text-center" width="10%" style="vertical-align: middle; background-color: #01c5c4">Puas</th>
								<th class="text-center" width="10%" style="vertical-align: middle; background-color: #f0a500">Kurang Puas</th>
								<th class="text-center" width="10%" style="vertical-align: middle; background-color: red;">Kecewa</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$pertanyaan  = "SELECT * From tb_pertanyaan ORDER BY id_soal ASC";
							$result_pertanyaan = $this->db->query($pertanyaan);
							?>
							<?php
							foreach ($result_pertanyaan->result() as $row) { ?>
								<tr>
									<td class="text-center" style="font-weight: bold;"><?= $row->id_soal ?></td>
									<td class="text-left" align="left" style="text-align:left !important; font-weight: bold;"><?= $row->kategori ?></td>
									<td class="text-center" style="cursor: pointer"><strong>
											<?php
											if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
												$dari = $_GET['startDate'];
												$ke = $_GET['endDate'];
												$query = $this->db->query("SELECT * FROM tb_hasil where created_date >= '$dari' AND created_date <= '$ke' and jawaban='d' and id_soal='$row->id_soal'");
												echo $query->num_rows();
											} else {
												$query = $this->db->query("SELECT * FROM tb_hasil where jawaban='d' and id_soal='$row->id_soal'");
												echo $query->num_rows();
											}
											?>
										</strong></td>
									<td class="text-center" style="cursor: pointer"><strong>
											<?php
											if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
												$dari = $_GET['startDate'];
												$ke = $_GET['endDate'];
												$query = $this->db->query("SELECT * FROM tb_hasil where created_date >= '$dari' AND created_date <= '$ke' and jawaban='c' and id_soal='$row->id_soal'");
												echo $query->num_rows();
											} else {
												$query = $this->db->query("SELECT * FROM tb_hasil where jawaban='c' and id_soal='$row->id_soal'");
												echo $query->num_rows();
											}
											?>
										</strong></td>
									<td class="text-center" style="cursor: pointer"> <strong>
											<?php
											if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
												$dari = $_GET['startDate'];
												$ke = $_GET['endDate'];
												$query = $this->db->query("SELECT * FROM tb_hasil where created_date >= '$dari' AND created_date <= '$ke' and jawaban='b' and id_soal='$row->id_soal'");
												echo $query->num_rows();
											} else {
												$query = $this->db->query("SELECT * FROM tb_hasil where jawaban='b' and id_soal='$row->id_soal'");
												echo $query->num_rows();
											}
											?>
										</strong></td>
									<td class="text-center" style="cursor: pointer"> <strong>
											<?php
											if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
												$dari = $_GET['startDate'];
												$ke = $_GET['endDate'];
												$query = $this->db->query("SELECT * FROM tb_hasil where created_date >= '$dari' AND created_date <= '$ke' and jawaban='a' and id_soal='$row->id_soal'");
												echo $query->num_rows();
											} else {
												$query = $this->db->query("SELECT * FROM tb_hasil where jawaban='a' and id_soal='$row->id_soal'");
												echo $query->num_rows();
											}
											?>
										</strong></td>
									<td class="text-center" style="font-weight: bold;">
										<?php
										if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
											$dari = $_GET['startDate'];
											$ke = $_GET['endDate'];
											$result_cek = $this->db->query("SELECT * FROM tb_hasil where created_date >= '$dari' AND created_date <= '$ke' and id_soal='$row->id_soal'");
											$jml_data =  $result_cek->num_rows();
											$total = 0;
											foreach ($result_cek->result() as $row) {
												if ($row->jawaban == 'd') {
													$n = 4;
												} else if ($row->jawaban == 'c') {
													$n = 3;
												} elseif ($row->jawaban == 'b') {
													$n = 2;
												} else {
													$n = 1;
												}
												$total = $total + $n;
											}
											$hasil = $total / $jml_data;
											echo $hasil;
											if ($hasil <= 1.75) {
												echo '<td class="text-center" style="font-weight: bold;">D</td>';
											}elseif ($hasil >= 1.76 && $hasil <=2.5) {
												echo '<td class="text-center" style="font-weight: bold;">C</td>';
											}elseif($hasil >= 2.51 && $hasil <=3.25){
												echo '<td class="text-center" style="font-weight: bold;">B</td>';
											}elseif($hasil >= 3.26){
												echo '<td class="text-center" style="font-weight: bold;">A</td>';
											}
										} else {
											$result_cek = $this->db->query("SELECT * FROM tb_hasil where id_soal='$row->id_soal'");
											$jml_data =  $result_cek->num_rows();
											$total = 0;
											foreach ($result_cek->result() as $row) {
												if ($row->jawaban == 'd') {
													$n = 4;
												} else if ($row->jawaban == 'c') {
													$n = 3;
												} elseif ($row->jawaban == 'b') {
													$n = 2;
												} else {
													$n = 1;
												}
												$total = $total + $n;
											}
											$hasil = $total / $jml_data;
											echo round($hasil,2);
											if ($hasil <= 1.75) {
												echo '<td class="text-center" style="font-weight: bold;">D</td>';
											}elseif ($hasil >= 1.76 && $hasil <=2.5) {
												echo '<td class="text-center" style="font-weight: bold;">C</td>';
											}elseif($hasil >= 2.51 && $hasil <=3.25){
												echo '<td class="text-center" style="font-weight: bold;">B</td>';
											}elseif($hasil >= 3.26){
												echo '<td class="text-center" style="font-weight: bold;">A</td>';
											}
										}
										?>
									</td>
									<!-- <td class="text-center" style="font-weight: bold;">1</td> -->
								</tr>
							<?php } ?>

						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- /.box -->
	</section>
	<!-- rata2 -->
	<section class="col-xl-3 col-lg-6 col-md-6 col-xs-12 connectedSortable ui-sortable">
		<div class="box box-solid">
			<div class="box-header ui-sortable-handle" style="cursor: move;">
				<i class="fa fa-th"></i>

				<h3 class="box-title">Rata Rata Pilihan Responden</h3>

				<div class="box-tools pull-right">
					<button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
			<div class="box-body border-radius-none" style="position: relative;">
				<div>
					<canvas id="myChartRata" height="350px" height="350"></canvas>
				</div>
			</div>
		</div>
	</section>

	<section class="col-xl-3 col-lg-6 col-md-6 col-xs-12 connectedSortable ui-sortable">
		<div class="box box-solid">
			<div class="box-header ui-sortable-handle" style="cursor: move;">
				<i class="fa fa-th"></i>

				<h3 class="box-title">Data Pilihan</h3>

				<div class="box-tools pull-right">
					<button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
			<div class="box-body border-radius-none" style="position: relative;">
				<div>
					<canvas id="myChartPilihan" height="350px" height="350"></canvas>
				</div>
			</div>
		</div>
	</section>

	<section class="col-xl-3 col-lg-6 col-md-6 col-xs-12 connectedSortable ui-sortable">
		<div class="box box-solid">
			<div class="box-header ui-sortable-handle" style="cursor: move;">
				<i class="fa fa-th"></i>

				<h3 class="box-title">Responden Berdasarkan Pendidikan</h3>

				<div class="box-tools pull-right">
					<button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
			<div class="box-body border-radius-none" style="position: relative;">
				<div>
					<canvas id="myChartPendidikan" height="350px" height="350"></canvas>
				</div>
			</div>
		</div>
	</section>

	<section class="col-xl-3 col-lg-6 col-md-6 col-xs-12 connectedSortable ui-sortable">
		<div class="box box-solid">
			<div class="box-header ui-sortable-handle" style="cursor: move;">
				<i class="fa fa-th"></i>

				<h3 class="box-title">Responden Berdasarkan Pekerjaan</h3>

				<div class="box-tools pull-right">
					<button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
			<div class="box-body border-radius-none" style="position: relative;">
				<div>
					<canvas id="myChart" height="350px" height="350"></canvas>
				</div>
			</div>
		</div>
	</section>
</div>

<?php

//query  rata2 jawaban
if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
	$dari = $_GET['startDate'];
	$ke = $_GET['endDate'];
	$rata  = "SELECT jawaban,COUNT(id_kuis) as jml_data FROM tb_hasil where created_date >= '$dari' AND created_date <= '$ke' GROUP BY jawaban";
	$result_rata = $this->db->query($rata);
	$i = 0;
	$labels_rata = [];
	$jml_rata = [];
	foreach ($result_rata->result() as $row) {
		if ($row->jawaban == 'd') {
			$n = 'Sangat Puas';
		} else if ($row->jawaban == 'c') {
			$n = 'Puas';
		} elseif ($row->jawaban == 'b') {
			$n = 'Tidak Puas';
		} else {
			$n = 'Kecewa';
		}
		$labels_rata[] = $n;
		$jml_rata[] = $row->jml_data;
		$i++;
	}
} else {
	$rata  = "SELECT jawaban,COUNT(id_kuis) as jml_data FROM tb_hasil GROUP BY jawaban";
	$result_rata = $this->db->query($rata);
	$i = 0;
	$labels_rata = [];
	$jml_rata = [];
	foreach ($result_rata->result() as $row) {
		if ($row->jawaban == 'd') {
			$n = 'Sangat Puas';
		} else if ($row->jawaban == 'c') {
			$n = 'Puas';
		} elseif ($row->jawaban == 'b') {
			$n = 'Tidak Puas';
		} else {
			$n = 'Kecewa';
		}
		$labels_rata[] = $n;
		$jml_rata[] = $row->jml_data;
		$i++;
	}
}


// data pilih
// cek last data
if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
	$dari = $_GET['startDate'];
	$ke = $_GET['endDate'];

	$last  = "SELECT * FROM tb_hasil where created_date >= '$dari' AND created_date <= '$ke' ORDER by id_soal and created_date ASC limit 1";
	$result_last = $this->db->query($last)->row();
	$last_data = $result_last->id_kuis;

	$rata  = "SELECT * FROM tb_hasil where created_date >= '$dari' AND created_date <= '$ke' ORDER by id_soal";
	$result_rata = $this->db->query($rata);
	$i = 0;
	$total_looping = 0;
	$labels_data_pilihan = [];
	$jml_data_pilihan = [];
	$jml_blm = 0;
	foreach ($result_rata->result() as $row) {
		if ($row->jawaban == 'd') {
			$n = 4;
		} else if ($row->jawaban == 'c') {
			$n = 3;
		} elseif ($row->jawaban == 'b') {
			$n = 2;
		} else {
			$n = 1;
		}

		if ($i == 0) {
			$jml_blm =  $jml_blm + $n;
			$total_looping = $total_looping = +1;
			$id_soal_terakhir = $row->id_soal;
		} else {
			if ($id_soal_terakhir == $row->id_soal) {
				$jml_blm =  $jml_blm + $n;
				$total_looping = $total_looping + 1;
				if ($row->id_kuis == $last_data) {
					$labels_data_pilihan[] = $id_soal_terakhir;
					$jml_data_pilihan[] = $jml_blm / $total_looping;
				}
			} else {
				//masukan array
				$labels_data_pilihan[] = $id_soal_terakhir;

				if ($row->id_kuis == $last_data) {
					if ($jml_blm > 0 && $total_looping > 0) {
						$jml_data_pilihan[] = $jml_blm / $total_looping;
					}
					$labels_data_pilihan[] = $row->id_soal;
					$jml_data_pilihan[] = ($jml_blm) / $total_looping;
				} else {
					if ($jml_blm > 0 && $total_looping > 0) {
						$jml_data_pilihan[] = $jml_blm / $total_looping;
					}
				}
				$id_soal_terakhir = $row->id_soal;
				$total_looping = 1;
				$jml_blm =  $n;
			}
		}
		$i++;
	}
} else {
	$last  = "SELECT * FROM tb_hasil ORDER by id_soal and created_date ASC limit 1";
	$result_last = $this->db->query($last)->row();
	$last_data = $result_last->id_kuis;

	$rata  = "SELECT * FROM tb_hasil ORDER by id_soal";
	$result_rata = $this->db->query($rata);
	$i = 0;
	$total_looping = 0;
	$labels_data_pilihan = [];
	$jml_data_pilihan = [];
	$jml_blm = 0;
	foreach ($result_rata->result() as $row) {
		if ($row->jawaban == 'd') {
			$n = 4;
		} else if ($row->jawaban == 'c') {
			$n = 3;
		} elseif ($row->jawaban == 'b') {
			$n = 2;
		} else {
			$n = 1;
		}

		if ($i == 0) {
			$jml_blm =  $jml_blm + $n;
			$total_looping = $total_looping = +1;
			$id_soal_terakhir = $row->id_soal;
		} else {
			if ($id_soal_terakhir == $row->id_soal) {
				$jml_blm =  $jml_blm + $n;
				$total_looping = $total_looping + 1;
				if ($row->id_kuis == $last_data) {
					$labels_data_pilihan[] = $id_soal_terakhir;
					$jml_data_pilihan[] = $jml_blm / $total_looping;
				}
			} else {
				//masukan array
				$labels_data_pilihan[] = $id_soal_terakhir;

				if ($row->id_kuis == $last_data) {
					if ($jml_blm > 0 && $total_looping > 0) {
						$jml_data_pilihan[] = $jml_blm / $total_looping;
					}
					$labels_data_pilihan[] = $row->id_soal;
					$jml_data_pilihan[] = ($jml_blm) / $total_looping;
				} else {
					if ($jml_blm > 0 && $total_looping > 0) {
						$jml_data_pilihan[] = $jml_blm / $total_looping;
					}
				}
				$id_soal_terakhir = $row->id_soal;
				$total_looping = 1;
				$jml_blm =  $n;
			}
		}
		$i++;
	}
	// print_r($labels_data_pilihan);
	print_r($jml_data_pilihan);

}





// query berdasarkan pekerjaan
if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
	$dari = $_GET['startDate'];
	$ke = $_GET['endDate'];
	$query_rangking  = "SELECT pekerjaan,COUNT(id) as jml FROM tb_detil_responden where created_date >= '$dari' AND created_date <= '$ke' GROUP BY pekerjaan;";
	$result = $this->db->query($query_rangking);
	$i = 0;
	$labels_pekerjaan = [];
	$jml_pekerjaan = [];
	foreach ($result->result() as $row) {
		$labels_pekerjaan[] = $row->pekerjaan;
		$jml_pekerjaan[] = $row->jml;
		$i++;
	}
} else {
	$query_rangking  = "SELECT pekerjaan,COUNT(id) as jml FROM tb_detil_responden  GROUP BY pekerjaan;";
	$result = $this->db->query($query_rangking);
	$i = 0;
	$labels_pekerjaan = [];
	$jml_pekerjaan = [];
	foreach ($result->result() as $row) {
		$labels_pekerjaan[] = $row->pekerjaan;
		$jml_pekerjaan[] = $row->jml;
		$i++;
	}
}


//query berdasarkan pendidikan
if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
	$dari = $_GET['startDate'];
	$ke = $_GET['endDate'];
	$pendidikan  = "SELECT pendidikan,COUNT(id) as jml_pendidikan FROM tb_detil_responden where created_date >= '$dari' AND created_date <= '$ke' GROUP BY pendidikan";
	$result_pendidikan = $this->db->query($pendidikan);
	$i = 0;
	$labels_pendidikan = [];
	$jml_pendidikan = [];
	foreach ($result_pendidikan->result() as $row) {
		$labels_pendidikan[] = $row->pendidikan;
		$jml_pendidikan[] = $row->jml_pendidikan;
		$i++;
	}
} else {
	$pendidikan  = "SELECT pendidikan,COUNT(id) as jml_pendidikan FROM tb_detil_responden GROUP BY pendidikan;";
	$result_pendidikan = $this->db->query($pendidikan);
	$i = 0;
	$labels_pendidikan = [];
	$jml_pendidikan = [];
	foreach ($result_pendidikan->result() as $row) {
		$labels_pendidikan[] = $row->pendidikan;
		$jml_pendidikan[] = $row->jml_pendidikan;
		$i++;
	}
}

?>



<script src="<?php echo base_url('assets/js/jsbaru/js_bidang_instansi.js') ?>" type="text/javascript"></script>
<!-- Pilihan -->
<script>
	const ctx69 = document.getElementById('myChartPilihan').getContext('2d');
	const myChartPilihan = new Chart(ctx69, {
		type: 'bar',
		data: {
			labels: <?= json_encode($labels_data_pilihan); ?>,
			datasets: [{
				label: 'Grafik Rangking',
				data: <?= json_encode($jml_data_pilihan); ?>,
				fill: true,
				backgroundColor: getRandomColor,
				// borderColor: getRandomColor2,
				borderWidth: 1
			}]
		},
		options: {
			plugins: {
				legend: {
					display: false
				}
			},
			maintainAspectRatio: false,
			scales: {
				y: {
					beginAtZero: true
				}
			}
		}
	});


	function getRandomColor() {
		var num = Math.round(0xffffff * Math.random());
		var r = num >> 16;
		var op = 0.7;
		var g = num >> 8 & 255;
		var b = num & 255;
		return 'rgb(' + r + ', ' + g + ', ' + b + ', ' + op + ')';
	}
</script>


<!-- pekerjaan -->
<script>
	const ctx = document.getElementById('myChart').getContext('2d');
	const myChart = new Chart(ctx, {
		type: 'pie',
		data: {
			labels: <?= json_encode($labels_pekerjaan); ?>,
			datasets: [{
				label: 'Grafik Rangking',
				data: <?= json_encode($jml_pekerjaan); ?>,
				fill: true,
				backgroundColor: [
					'rgba(255, 99, 132, 0.5)',
					'rgba(54, 162, 235, 0.5)',
					'rgba(255, 206, 86, 0.5)',
					'rgba(128, 128, 128, 0.5)',
					'rgba(75, 192, 192, 0.5)',
					'rgba(153, 102, 255, 0.5)',
					'rgba(255, 159, 64, 0.5)'
				],
				borderColor: [
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(128, 128, 128,1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					'rgba(255, 159, 64, 1)'
				],
				borderWidth: 1
			}]
		},
		options: {
			plugins: {
				legend: {
					display: true
				}
			},
			maintainAspectRatio: false,
			scales: {
				y: {
					beginAtZero: true
				}
			}
		}
	});
</script>


<!-- Pendidikan -->
<script>
	const ctx2 = document.getElementById('myChartPendidikan').getContext('2d');
	const myChartPendidikan = new Chart(ctx2, {
		type: 'pie',
		data: {
			labels: <?= json_encode($labels_pendidikan); ?>,
			datasets: [{
				label: 'Grafik Rangking',
				data: <?= json_encode($jml_pendidikan); ?>,
				fill: true,
				backgroundColor: [
					'rgba(255, 99, 132, 0.5)',
					'rgba(54, 162, 235, 0.5)',
					'rgba(255, 206, 86, 0.5)',
					'rgba(128, 128, 128, 0.5)',
					'rgba(75, 192, 192, 0.5)',
					'rgba(153, 102, 255, 0.5)',
					'rgba(255, 159, 64, 0.5)'
				],
				borderColor: [
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(128, 128, 128, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					'rgba(255, 159, 64, 1)'
				],
				borderWidth: 1
			}]
		},
		options: {
			plugins: {
				legend: {
					display: true
				}
			},
			maintainAspectRatio: false,
			scales: {
				y: {
					beginAtZero: true
				}
			}
		}
	});
</script>

<!-- Rata Rata -->
<script>
	const ctx3 = document.getElementById('myChartRata').getContext('2d');
	const myChartRata = new Chart(ctx3, {
		type: 'pie',
		data: {
			labels: <?= json_encode($labels_rata); ?>,
			datasets: [{
				label: 'Grafik Rangking',
				data: <?= json_encode($jml_rata); ?>,
				fill: true,
				backgroundColor: [
					'rgba(255, 99, 132, 0.5)',
					'rgba(54, 162, 235, 0.5)',
					'rgba(255, 206, 86, 0.5)',
					'rgba(128, 128, 128, 0.5)',
					'rgba(75, 192, 192, 0.5)',
					'rgba(255, 159, 64, 0.5)',
					'rgba(153, 102, 255, 0.5)'

				],
				borderColor: [
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(128, 128, 128, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(255, 159, 64, 1)',
					'rgba(153, 102, 255, 1)'

				],
				borderWidth: 1
			}]
		},
		options: {
			plugins: {
				legend: {
					display: true
				}
			},
			maintainAspectRatio: false,
			scales: {
				y: {
					beginAtZero: true
				}
			}
		}
	});
</script>