<section class="content">
	<div class="row">
		<div class="panel">
			<div class="panel-header" style="padding: 0.8em">
				<div class="row" style="margin-right: 1em">
					<div class="col-md-7">
						<a  href="#modal_add" class="btn-sm btn-success" data-toggle="modal"><i class="fa fa-user-circle"></i> Tambah Loket</a>
					</div>
					<div class="col-md-2 col-xs-12 text-right" style="margin-top: 0.4em">
						<select id="bulan_loket" name="bulan" class="form-control" required>
							<option value="">Bulan..</option>
							<option <?php echo $f_bulan == 'setahun' ? 'selected' : '' ?> value="setahun">Setahun</option>
							<?php foreach ($bulan as $b): ?>
								<option <?php echo $f_bulan == $b->id_bulan ? 'selected' : '' ?>  value="<?php echo $b->id_bulan ?>"><?php echo $b->bulan ?></option>}
							<?php endforeach ?>
						</select>
					</div>
					<div class="col-md-2 col-xs-12 text-right" style="margin-top: 0.4em">
						<select id="tahun_loket" name="bulan" class="form-control" required>
							<option value="">Tahun..</option>
							<?php foreach ($tahun as $t): ?>
								<option <?php echo $f_tahun == $t->tahun ? 'selected' : '' ?> value="<?php echo $t->tahun ?>"><?php echo $t->tahun ?></option>}
							<?php endforeach ?>
						</select>
					</div>
					<div class="col-md-1 col-xs-12 text-right" style="margin-top: 0.4em">
						<button id="btn_filter_loket" class="btn bg-purple"><i class="fa fa-filter"></i> Filter</button>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-hover" style="font-size: 1.4rem;">
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
									<td class="text-center"><?php echo $loket['responden'] != 0 ? $loket['responden'] : '-' ?></td>
									<td class="text-center" style="font-weight: bold;"><?php echo $loket['nilai'] != null ? number_format($loket['nilai'],2)."%" : '-' ?> </td>
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
				<h4 class="modal-title" id="exampleModalLongTitle">Tambah <strong>Loket</strong></h4>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo site_url('loket/tambah_loket') ?>">
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
				<form method="post" action="<?php echo site_url('loket/update_loket') ?>">
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