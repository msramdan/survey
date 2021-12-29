<section class="content">
	<input type="hidden" id="base" value="<?php echo site_url() ?>">
	<div class="row">
		<div class="panel">
			<div class="panel-body">
				<a  href="#modal_add" class="btn-sm btn-success" data-toggle="modal"><i class="fa fa-user-circle"></i> Tambah Loket</a>
				<table class="table table-hover" style="font-size: 13px; margin-top: 5%;">
					<thead>
						<tr>
							<th class="text-center" width="10%">#</th>
							<th class="text-center" width="40%">Nama Loket</th>
							<th class="text-center" width="20%">Jumlah Responden</th>
							<th class="text-center" width="30%">Kepuasan</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$no = 1;
						foreach ($loket as $loket): ?>
							<tr>
								<td class="text-center"><?php echo $no++ ?></td>
								<td ><a title="Edit Data" class="modal_edit" href="#modal_edit" data-toggle="modal" data-id="<?php echo $loket['id_loket'] ?>" style="color: black;"><?php echo $loket['nama_loket'] ?></a></td>
								<td class="text-center"><?php echo $loket['responden'] ?></td>
								<td class="text-center" style="font-weight: bold;"><?php echo number_format($loket['nilai'],2) ?> %</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>

<!-- Modal add -->
<div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-purple">
				<h4 class="modal-title" id="exampleModalLongTitle">Tambah <strong>Loket</strong></h4>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo site_url('admin/tambah_loket') ?>">
					<div class="form-group">
						<label for="staticEmail" class="col-form-label">Nama Loket</label>
						<input name="nama" class="form-control"/>
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
				<form method="post" action="<?php echo site_url('admin/update_loket') ?>">
					<div class="form-group">
						<label for="staticEmail" class="col-form-label">Nama Loket</label>
						<input  type="hidden" name="id_loket"/>
						<input  id="nama_loket" name="nama_loket" class="form-control"/>
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