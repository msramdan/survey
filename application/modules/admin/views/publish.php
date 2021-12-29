<style>
	table{
		font-size: 15px;
	}
</style>
<div class="box">
	<div class="box-body">
		<input type="hidden" id="base" value="<?php echo site_url() ?>">
		<table class="table" id="responden">
			<thead>
				<tr>
					<th class="text-center">No</th>
					<th class="text-center">id responden</th>
					<th class="text-center">Score Rata-rata</th>
					<th class="text-center">#</th>
				</tr>
			</thead>
			<tbody>
				<?php $no=1; foreach ($rekap as $data): ?>
				<tr>
					<td class="text-center"><?php echo $no++; ?></td>
					<td><strong><?php echo $data['id_responden'] ?></strong></td>
					<td class="text-center"><?php echo $data['rata'] ?></td>
					<td class="text-center"><a href="<?php echo site_url('admin/detil/').$data['id_responden'] ?>" class="btn-sm btn-warning"  title="detil"><i class="fa fa-eye"></i></a></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>
</div>