<style>
	table{
		width: 100%;
		font-size: 15px;
	}

	td{
		padding: 8px;
	}
</style>
<div>
	<div class="box" >
		<div class="box-header">
			<span style="font-size: 18px; margin-right: 15px;"><strong>Rekap Saran</strong></span>
			<a href="<?php echo site_url('admin/cetaksaran') ?>" title="" class="btn-sm btn-success"><i class="fa fa-print"></i> Export</a>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
				</button>
			</div>
		</div>
		<div class="box-body" style="padding: 20px;">
			<table class="table table-hover table-bordered"  id="responden">
				<thead class="bg-purple">
					<tr class="head">
						<th class="text-center" width="5%">No</th>
						<th class="text-center" >ID Responden</th>
						<th class="text-center" >Nama responden</th>
						<th class="text-center" width="40%">Saran</th>
						<th class="text-center" >Tanggapi</th>
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
							<td class="text-center">
								<a href="<?php echo site_url('admin/tanggapisaran/').$saran->id_responden ?>" class="btn-sm bg-purple" onclick="return confirm('Tanggapi Saran Ini?')"><i class="fa fa-check"></i></a>
							</td>
						</tr>	
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
		<div class="box-footer"></div>
	</div>
	<!-- end box -->
</div>

