<div class="box">
	<div class="box-header">
		<i class="ion ion-clipboard"></i>
		<h3 class="box-title">Detil Jawaban</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			</button>
		</div>
	</div>
	<div class="box-body">
		<div class="table-responsive">
			<table class="table" style="font-size: 15px;">
				<thead>
					<tr>
						<th width="10%">Kode</th>
						<th>Pertanyaan</th>
						<th width="10%" class="text-center">Bobot Jawaban</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$n = 0;
					foreach ($rekap as $v): 
					$id_responden = $v->id_responden; ?>
						
						<tr>
							<td><?php echo $v->id_soal ?></td>
							<td style="word-wrap: break-word;"><?php echo $v->soal ?></td>
							<?php $nilai = $v->jawaban;
							if ($nilai == 'a') {
								$bobot = 1;
							} else if ($nilai == 'b') {
								$bobot = 2;
							} else if ($nilai == 'c') {
								$bobot = 3;
							} else {
								$bobot = 4;
							}
							?>
							<td class="text-center"><?php echo $bobot ?></td>
						</tr>

						<?php 
						$n += $bobot;
					endforeach ?>
					<tr>
						<td colspan="2" class="text-center"><strong>Rata - Rata</strong></td>
						<td class="text-center" ><strong><?php echo number_format(($n/9),2)?></strong></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="box-footer">
		<div style="float: right; margin-right: 15px;">
			<a href="<?php echo site_url('admin/aksipublish/').$id_responden ?>" class="btn btn-success"><i class="fa fa-send"></i>publish</a> 
		</div>
	</div>
</div>