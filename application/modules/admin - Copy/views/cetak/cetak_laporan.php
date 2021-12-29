<!DOCTYPE html>
<html>
<head>
	<title>Laporan</title>
	<style>
		table{
			width: 100%;
			text-align: center;
			border-collapse:collapse;
		}
	</style>
</head>
<body>
	<?php 
	header("Content-Type: application/vnd.msword");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("content-disposition: attachment;filename=Laporan-Kepuasan.doc");
	?>
	<p>
		<h4><center>DINAS PENANAMAN MODAL & PELAYANAN TERPADU SATU PINTU (DPMPTSP) <br>
			JANUARI s/d <?php echo strtoupper($tgl_indo).' '.date('Y') ?>
		</center></h4>
	</p>
	<p>
		<h4>Hasil Survey <br> Karakteristik Responden</h4>
	</p>
	<p>
		Dalam Survey Kepuasan Masyarakat di DINAS PENANAMAN MODAL & PELAYANAN TERPADU SATU PINTU (DPMPTSP) Jepara periode Januari s/d <?php echo $tgl_indo.' '.date('Y') ?> menggunakan sampel sebanyak <?php echo $pengunjung ?> orang pengunjung / pengguna layanan dan dari <?php echo $pengunjung ?> kuesioner yang disediakan semuanya kembali dengan jawaban lengkap dan layak untuk digunakan analisis.
	</p>
	<p>
		Berikut ini dipaparkan karakteristik responden secara umum menurut umur, dan jenis kelamin dan mata pencaharian di DINAS PENANAMAN MODAL & PELAYANAN TERPADU SATU PINTU (DPMPTSP) Jepara
	</p>
	<p>
		<ol type="a">
			<li>Karakteristik Responden Berdasarkan Kelompok Umur</li>
			<p>Karakteristik responden yang menjadi subyek dalam penelitian ini menurut umur dibagi berdasarkan nilai mean yaitu 3.49. Hal ini dapat ditunjukkan dalam tabel berikut : </p>
			<p>Tabel Karakteristik Responden Berdasarkan Umur</p>
			<p>
				<table border="1px">
					<thead>
						<tr>
							<th>Umur</th>
							<th>Jumlah</th>
							<th>Presentase (%)</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$umursum = 0; $presentase = 0;
						foreach ($umur as $um): ?>
							<tr>
								<td><?php echo $um['index'] ?></td>
								<td><?php echo $um['jumlah'] ?></td>
								<td><?php echo $um['presentase'] ?> %</td>
							</tr>

							<?php
							$umursum 	+= $um['jumlah'];
							$presentase += $um['presentase'];
						endforeach ?>
						<tr>
							<td><strong>Total</strong></td>
							<td><strong><?php echo $umursum; ?></strong></td>
							<td><strong><?php echo $presentase; ?> % </strong></td>
						</tr>
					</tbody>
				</table>
			</p>
			<p>
				Berdasarkan tabel di atas dapat diketahui kelompok umur dibawah 40 tahun sebanyak <?php echo $umur['up40']['jumlah'] ?> orang (<?php echo $umur['up40']['presentase'] ?>%) dan di atas sama dengan 40 tahun sebanyak <?php echo $umur['min40']['jumlah'] ?> orang (<?php echo $umur['min40']['presentase'] ?>%)  
			</p>
			<li>Karakteristik Responden Berdasarkan Jenis Kelamin</li>
			<p>
				Karakteristik responden pada penelitian ini menurut jenis kelamin dapat diketahui berdasarkan tabel sebagai berikut : 
			</p>
			<p>Tabel Karakteristik Responden Berdasarkan Jenis Kelamin</p>
			<p>
				<table border="1px">
					<thead>
						<tr>
							<th>Jenis Kelamin</th>
							<th>Jumlah</th>
							<th>Presentase (%)</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$sumjk	= 0; $presentasejk = 0;
						foreach ($jk as $j): ?>
							<tr>
								<td><?php echo $j['jk'] ?></td>
								<td><?php echo $j['jumlah'] ?></td>
								<td><?php echo $j['presentase'] ?></td>
							</tr>
							<?php 
							$sumjk += $j['jumlah'];
							$presentasejk += $j['presentase'];
						endforeach ?>
						<tr>
							<td><strong>Total</strong></td>
							<td><strong><?php echo $sumjk; ?></strong></td>
							<td><strong><?php echo $presentasejk; ?> % </strong></td>
						</tr>
					</tbody>
				</table>
			</p>
			<p>
				Berdasarkan tabel diatas menunjukkan bahwa responden yang berjenis kelamin laki-laki sebanyak <?php echo $jk['laki']['jumlah'] ?>  orang (<?php echo $jk['laki']['presentase'] ?>%), dan yang berjenis kelamin perempuan sebanyak  <?php echo $jk['pr']['jumlah'] ?>  orang ( <?php echo $jk['pr']['presentase'] ?>%)
			</p>
		</ol>	
	</p>

	<p>
		<h4>Deskripsi Jawaban Responden</h4>
	</p>
	<p>Berikut ini disajikan tabel nilai rata-rata unsur pelayanan hasil pengisian kuesioner yang dilakukan oleh responden di DINAS PENANAMAN MODAL & PELAYANAN TERPADU SATU PINTU (DPMPTSP) Jepara.</p>
	<p>Tabel Nilai Rata-Rata Unsur Pelayanan di DINAS PENANAMAN MODAL & PELAYANAN TERPADU SATU PINTU (DPMPTSP) Jepara Tahun <?php echo date('Y') ?></p>
	<p>
		<table border="1px">
			<thead>
				<tr>
					<th colspan="2">Unsur SKM</th>
					<th><?php echo date('Y') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($hasil as $h): ?>
					<tr>
						<td><strong><?php echo $h['id_soal'] ?></strong></td>
						<td><?php echo $h['kategori'] ?></td>
						<td><?php echo $h['kepuasan'] ?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</p>
	<p>
		Dari nilai rata-rata yang ada maka dapat ditarik kesimpulan nilai SKM yang diperoleh adalah <?php echo $tingkat_kepuasan['presentase'] ?> <br>
		Sehingga dapat diperoleh hasil sebagai berikut : <br>
		Mutu pelayanan <strong><?php echo $tingkat_kepuasan['index'] ?></strong> <br>
		Kinerja unit pelayanan <strong><?php echo $tingkat_kepuasan['mutu'] ?></strong>
	</p>
	<p>
		<h4>Analisis</h4>
		Dari tabel dapat dilihat bahwa dengan nilai SKM <?php echo $tingkat_kepuasan['presentase'] ?> disimpulkan bahwa Kategorisasi Mutu Pelayanan "<?php echo $tingkat_kepuasan['mutu'] ?>" dan Kinerja Unit Pelayanan adalah Sangat Baik. Jika dilihat dari Nilai Rata-Rata (NRR) unsur pelayanan, unsur yang memiliki nilai tertinggi adalah unsur "<?php echo $max['kategori'] ?>" (NRR <?php echo $max['kepuasan'] ?>), sedangkan unsur dengan Nilai Rata-Rata terendah adalah unsur "<?php echo $min['kategori'] ?>" (NRR <?php echo $min['kepuasan'] ?>). Angka ini menunjukkan bahwa tingkat pelayanan paling tinggi diperoleh dari <strong><?php echo $max['kategori'] ?></strong>, sedangkan tingkat kepuasan paling rendah berada pada unsur <strong><?php echo $min['kategori'] ?></strong>.
	</p>
	<p>Secara umum capaian di DINAS PENANAMAN MODAL & PELAYANAN TERPADU SATU PINTU (DPMPTSP) Jepara ditingkatkan sebagai berikut:</p>
	<p>
		<table border="1px">
			<thead>
				<tr>
					<th>No</th>
					<th>Unsur SKM</th>
					<th>Nilai Rata - rata</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$x = 'a';
				foreach ($hasil as $h): ?>
					<tr>
						<td><strong><?php echo $x++ ?></strong></td>
						<td><?php echo $h['kategori'] ?></td>
						<td><?php echo $h['kepuasan'] ?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</p>
	<h4>
		<p>Permasalahan yang dihadapi :</p>

		<p>
			Solusi yang diharapkan :
		</p>
		<p>
			Persentase Survey Responden Terhadap Kelompok Pelayanan :
		</p>
	</h4>
</body>
</html>