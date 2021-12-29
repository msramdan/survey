<!DOCTYPE html>
<html>
<head>
	<title>cetak Saran</title>
	<style>
		.head{
			height: 40px;
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
		}
	</style>
</head>
<body
 <?php 
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename= SURVEY_KEPUASAN_MASYARAKAT_SARAN.xls");
    ?>>
	<center><H4>Rekap Saran</H4></center>
	<table border="1px" id="responden">
		<thead>
			<tr class="head">
				<th class="text-center" width="5%">No</th>
				<th class="text-center"  width="30%">ID Responden</th>
				<th class="text-center"  width="30%">Nama Responden</th>
				<th class="text-center" width="65%">Saran</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$no = 1;
			foreach ($rekap as $saran): ?>
				<tr>
					<td class="text-center"><?php echo  $no++ ?></td>
					<td class="text-center"><?php echo  $saran->id_responden ?></td>
					<td class="text-center"><?php echo  $saran->nama ?></td>
					<td style="word-wrap: break-word;"><?php echo  $saran->saran ?></td>
				</tr>	
			<?php endforeach ?>
		</tbody>
	</table>
</body>
</html>


