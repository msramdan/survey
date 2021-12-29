<style>
	.head{
		height: 40px;
		vertical-align: middle;
		background-color: #f6f6f6;
		text-align: center;
	}
	table{
		font-size: 15px;
	}

	td{
		padding: 8px;
	}
	a{
		color: black;
	}
</style>
<div class="col-12">
	<div class="box" >
		<div class="box-header"  style="cursor: pointer;">
			<h3 class="box-title"><strong>Daftar Pertanyaan</strong></h3>

			<a href="#modal_add" data-toggle="modal" style="margin-left: 15px;" class="btn-sm btn-success" ><i class="fa fa-plus"></i> Tambah Soal</a>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
				</button>
			</div>
		</div>
		<div class="box-body" style="padding: 20px;">
			<table border="1px">
				<thead>
					<tr class="head">
						<th class="text-center" width="5%">No</th>
						<th class="text-center"  width="60%">Pertanyaan</th>
						<th class="text-center" >Jawaban</th>
						<th class="text-center"  width="5%">Point</th>
					</tr>
				</thead>
				<?php 
				foreach ($soal as $soal): ?>
					<tr>
						<td rowspan="4" class="text-center"><?php echo $soal->id_soal ?></td>
						<td rowspan="4" style="word-wrap: break-word;"><a href="#modal_edit" data-id="<?php echo $soal->id_soal ?>" data-toggle="modal" class="modal-edit"><?php echo $soal->soal ?></a></td>
						<td><?php echo $soal->a ?></td>
						<td class="text-center">1</td>
					</tr>
					<tr>
						<td><?php echo $soal->b ?></td>
						<td class="text-center">2</td>
					</tr>
					<tr>
						<td><?php echo $soal->c ?></td>
						<td class="text-center">3</td>
					</tr>
					<tr>
						<td><?php echo $soal->d ?></td>
						<td class="text-center">4</td>
					</tr>
				<?php endforeach ?>
				
			</table>
		</div>
		<div class="box-footer"></div>
	</div>
	<!-- end box -->
</div>

<!-- Modal edit -->
<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<input type="hidden" id="base" value="<?php echo site_url() ?>">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-blue">
				<h5 class="modal-title" id="exampleModalLongTitle">Edit <strong>(Pertanyaan)</strong></h5>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo site_url('admin/updatepertanyaan') ?>">
					<input type="hidden" name="id_soal" value="">
					<div class="form-group">
						<label for="staticEmail" class="col-form-label">Kategori</label>
						<input  id="kategori" name="kategori" rows="3" class="form-control"/>
					</div>
					<div class="form-group">
						<label for="staticEmail" class="col-form-label">Pertanyaan</label>
						<textarea name="pertanyaan" rows="3" class="form-control"></textarea>
					</div>
					<center><h4>---opsi jawaban---</h4></center><br>
					<div class="row">
						<div class="form-group col-md-3">
							<label for="staticEmail" class="col-form-label">Opsi A point 1</label>
							<input type="text" class="form-control" name="a" placeholder="Opsi A point 1">
						</div>
						<div class="form-group col-md-3">
							<label for="staticEmail" class="col-form-label">Opsi B point 2</label>
							<input type="text" class="form-control" name="b" placeholder="Opsi B point 2">
						</div>
						<div class="form-group col-md-3">
							<label for="staticEmail" class="col-form-label">Opsi C point 3</label>
							<input type="text" class="form-control" name="c" placeholder="Opsi C Point 3">
						</div>
						<div class="form-group col-md-3">
							<label for="staticEmail" class="col-form-label">Opsi D point 4</label>
							<input type="text" class="form-control" name="d" placeholder="Opsi D point 4">
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<a style="float: left" id="btn_hapus" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> hapus</a>
					<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan Perubahan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal add -->
<div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-blue">
				<h5 class="modal-title" id="exampleModalLongTitle">Edit <strong>(Pertanyaan)</strong></h5>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo site_url('admin/addpertanyaan') ?>">
					<div class="form-group">
						<label class="col-form-label">Nomor Pertanyaan</label>
						<input name="id_soal" class="form-control"/>
					</div>
					<div class="form-group">
						<label for="staticEmail" class="col-form-label">Kategori</label>
						<input  id="kategori" name="kategori" rows="3" class="form-control"/>
					</div>
					<div class="form-group">
						<label for="staticEmail" class="col-form-label">Pertanyaan</label>
						<textarea name="pertanyaan" rows="3" class="form-control"></textarea>
					</div>
					<center><h4>---opsi jawaban---</h4></center><br>
					<div class="row">
						<div class="form-group col-md-3">
							<label for="staticEmail" class="col-form-label">Opsi A point 1</label>
							<input type="text" class="form-control" name="a" placeholder="Opsi A point 1">
						</div>
						<div class="form-group col-md-3">
							<label for="staticEmail" class="col-form-label">Opsi B point 2</label>
							<input type="text" class="form-control" name="b" placeholder="Opsi B point 2">
						</div>
						<div class="form-group col-md-3">
							<label for="staticEmail" class="col-form-label">Opsi C point 3</label>
							<input type="text" class="form-control" name="c" placeholder="Opsi C Point 3">
						</div>
						<div class="form-group col-md-3">
							<label for="staticEmail" class="col-form-label">Opsi D point 4</label>
							<input type="text" class="form-control" name="d" placeholder="Opsi D point 4">
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan Perubahan</button>
				</div>
			</form>
		</div>
	</div>
</div>


<script src="<?php echo base_url('assets/js/jsbaru/js_pertanyaan.js') ?>" type="text/javascript"></script>