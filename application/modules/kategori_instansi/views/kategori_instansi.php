<section class="content">
	<div class="row">
		<div class="panel">
			<div class="panel-header" style="padding: 0.8em">
				<div class="row" style="margin-right: 1em">
					<div class="col-md-7">
						<a  href="#modal_add" class="btn-sm btn-success" data-toggle="modal"><i class="fa fa-plus-circle"></i> Tambah Kategori Instansi</a>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-hover" style="font-size: 1.4rem;">
						<thead>
							<tr>
								<th class="text-center" width="10%">#</th>
								<th class="text-center" width="40%">Nama Kategori Instansi</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$no = 1;
							foreach ($kategori_instansi as $kategori_instansi): ?>
								<tr>
									<td class="text-center"><?php echo $no++ ?></td>
									<td class="text-center" width="40%"><a title="Edit Data" class="modal_edit" href="#modal_edit" data-toggle="modal" data-id="<?php echo $kategori_instansi->kategori_instansi_id ?>" style="color: black;"><?php echo $kategori_instansi->nama_kategori_instansi ?></a></td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Modal add -->
<div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-purple">
				<h4 class="modal-title" id="exampleModalLongTitle">Tambah <strong>kategori instansi</strong></h4>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo site_url('kategori_instansi/tambah_kategori_instansi') ?>">
					<div class="form-group">
						<label for="staticEmail" class="col-form-label">Nama kategori instansi</label>
						<input name="nama_kategori_instansi" class="form-control"/>
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
				<h4 class="modal-title" id="exampleModalLongTitle">Edit <strong>kategori instansi</strong></h4>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo site_url('kategori_instansi/update_kategori_instansi') ?>">
					<div class="form-group">
						<label for="staticEmail" class="col-form-label">Nama kategori instansi</label>
						<input  type="hidden" name="kategori_instansi_id"/>
						<input  id="nama_kategori_instansi" name="nama_kategori_instansi" class="form-control"/>
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

<script src="<?php echo base_url('assets/js/jsbaru/js_kategori_instansi.js') ?>" type="text/javascript"></script>