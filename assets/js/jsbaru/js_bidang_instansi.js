$(document).on('click', '.modal_edit', function(event) {
	var id 	= $(this).data('id')
	var base = $('#base').val()

	$('input[name="bidang_instansi_id"]').val(id)

	$.ajax({
		url:base+'bidang_instansi/detil_bidang_instansi/'+id,
		type: 'get',
		dataType: 'json',
	})
	.done(function(data) {
		$('input[name="nama_bidang_instansi"]').val(data.nama_bidang_instansi)
        $('#bidang_instansi_id2').val(data.instansi_id);
	})
	.fail(function(data) {
		alert("error");
	});

	$('#btn_hapus').click(function(event) {
		Swal.fire({
			title: 'Apakah Anda Yakin?',
			text: "Data Terhapus Tidak Dapat Dikembalikan!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, Tetap Hapus!',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if (result.isConfirmed) {
				location.href = base + "bidang_instansi/hapus_bidang_instansi/"+id
			}
		})
	});
});
