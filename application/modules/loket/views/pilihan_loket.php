<section class="content">
	<div class="row">
		<div class="panel">
			<div class="panel-header" style="padding: 1em">
				<!-- <a href="" class="btn-sm bg-purple" > <i class="fa fa-print"></i> Cetak</a> -->
				<center style="margin-top: -1em"><h4><b><?php echo $kategori ?></b></h4>
					<p style="margin-top: -0.7em"><?php echo $bulan_indo != 'setahun' ? '<b>BULAN '.strtoupper($bulan_indo).' ||</b>' : '' ?> <b> TAHUN </b> <?php echo '<b>'.strtoupper($tahun).'</b>' ?></p>
				</center>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-hover" style="font-size: 1.4rem;">
						<thead>
							<tr>
								<th class="text-center" width="10%">#</th>
								<th>Nama Loket</th>
								<th class="text-center">Jumlah</th>
							</tr>
						</thead>
						<tbody>
							<?php if (count($rekap) > 0): ?>
								<?php 
								$no = 1;
								foreach ($rekap as $rekap): ?>
									<tr>
										<td class="text-center"><?php echo $no++ ?></td>
										<td><?php echo $rekap['nama_loket'] ?></td>
										<td class="text-center"><?php echo $rekap['jumlah'] ?></td>
									</tr>
								<?php endforeach ?>
							<?php endif ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>