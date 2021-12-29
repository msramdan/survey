<!DOCTYPE html>
<html>
<head>
	<title>cetak rekap</title>
	<style>
		.head{
			height: 40px;
			background-color: blue;
			color: white;
			vertical-align: middle;
			text-align: center;
		}
		table{
			width: 100%;
			font-size: 15px;
			border-collapse: collapse;
		}

		td{
			padding: 8px;
			text-align: center;
		}
		th{
			font-weight: bold;
		}
	</style>
</head>
<body>
	<?php 
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename= SURVEY_KEPUASAN_MASYARAKAT_PER_RESPONDEN.xls");
	?>
	
	<center>
		<strong>PENGOLAHAN SURVEY KEPUASAN MASYARAKAT PER RESPONDEN</strong><br>
		<strong>DAN PER UNSUR PELAYANAN TAHUN <?php echo date('Y'); ?></strong>
	</center>
	<br>
	<table border="1px">
		<thead>
			<tr>
				<th rowspan="2" width="10%" height="60px">No.Responden</th>
				<th colspan="9">Nilai Unsur Pelayanan</th>
			</tr>
			<tr>
				<?php foreach ($soal as $soal): ?>
					<th><?php echo $soal->id_soal ?></th>
				<?php endforeach ?>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($rekap as $rekap): ?>	
				<tr>
					<td><?php echo $rekap['id_responden'] ?></td>
					<?php foreach ($rekap['jawaban'] as $j): ?>
						<td><?php echo $j[0] ?></td>
					<?php endforeach ?>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</body>
</html>
