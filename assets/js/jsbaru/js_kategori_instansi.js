$(document).on('click', '.modal_edit', function(event) {
	var id 	= $(this).data('id')
	var base = $('#base').val()

	$('input[name="kategori_instansi_id"]').val(id)

	$.ajax({
		url:base+'kategori_instansi/detil_kategori_instansi/'+id,
		type: 'get',
		dataType: 'json',
	})
	.done(function(data) {
		$('input[name="nama_kategori_instansi"]').val(data.nama_kategori_instansi)
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
				location.href = base + "kategori_instansi/hapus_kategori_instansi/"+id
			}
		})
	});
});
