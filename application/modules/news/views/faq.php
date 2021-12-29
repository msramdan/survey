<section class="content">
	<div class="row">
		<div class="panel">
			<div class="panel-body">
				<a href="#modaladd" data-toggle="modal" class="btn-sm btn-success" ><i class="fa fa-plus"></i> Tambah</a>
				<table class="table table-hover" style="font-size: 16px;margin-top: 20px;">
					<thead>
						<tr>
							<th width="10%">No</th>
							<th width="35%">Pertanyaan</th>
							<th width="40%">Jawaban</th>
							<th class="text-center" width="15%">action</th>
						</tr>
					</thead>
					<tbody>
						<?php if ($faq): ?>
							<?php $no = 1; foreach ($faq as $faq): ?>
							<tr>
								<td><?php echo $no++ ?></td>
								<td><?php echo $faq->pertanyaan ?></td>
								<td><?php echo $faq->jawaban ?></td>
								<td class="text-center">
									<a href="#exampleModalCenter" data-id="<?php echo $faq->id ?>" data-toggle="modal" class="btn-sm btn-success modal-edit"><i class="fa fa-pencil"></i></a>
									<a onclick="return confirm('anda akan menghapus FAQ ini?')" href="<?php echo site_url('news/hapusfaq/').$faq->id ?>" class="btn-sm btn-danger"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
						<?php endforeach ?>
					<?php endif ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</section>

<!-- Modal edit -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<input type="hidden" id="base" value="<?php echo site_url() ?>">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Edit <strong>(FAQ)</strong></h5>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo site_url('news/updatefaq') ?>">
					<input type="hidden" name="id_faq" value="">
					<div class="form-group row">
						<label for="staticEmail" class="col-sm-2 col-form-label">Pertanyaan</label>
						<div class="col-sm-10">
							<textarea name="pertanyaan" id="pertanyaan" rows="3" class="form-control"></textarea>
							
						</div>
					</div>
					<div class="form-group row">
						<label for="inputPassword" class="col-sm-2 col-form-label">Jawaban</label>
						<div class="col-sm-10">
							<textarea name="jawaban" id="jawaban" class="form-control" rows="3"></textarea>
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

<!-- Modal add -->
<div class="modal fade" id="modaladd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<input type="hidden" id="base" value="<?php echo site_url() ?>">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Posting <strong>(FAQ)</strong></h5>
			</div>
			<div class="modal-body">
				<form action="<?php echo site_url('news/addfaq') ?>" method="post">
					<input type="hidden" name="id_faq" value="">
					<div class="form-group row">
						<label for="staticEmail" class="col-sm-2 col-form-label">Pertanyaan</label>
						<div class="col-sm-10">
							<textarea name="pertanyaan" rows="3" class="form-control"></textarea>
							
						</div>
					</div>
					<div class="form-group row">
						<label for="inputPassword" class="col-sm-2 col-form-label">Jawaban</label>
						<div class="col-sm-10">
							<textarea name="jawaban" class="form-control" rows="3"></textarea>
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$(document).on('click', '.modal-edit', function(event) {
		var id 	= $(this).data('id')
		var base = $('#base').val()

		$('input[name="id_faq"]').val(id)


		$.ajax({
			url:base+'news/detilfaq/'+id,
			type: 'get',
			dataType: 'json',
		})
		.done(function(data) {
			$('#pertanyaan').text(data.pertanyaan)
			$('#jawaban').text(data.jawaban)
		})
		.fail(function(data) {
			console.log("error");
		});
		

	});
</script>

