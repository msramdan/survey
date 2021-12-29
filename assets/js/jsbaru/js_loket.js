$(document).on('click', '.modal_edit', function(event) {
	var id 	= $(this).data('id')
	var base = $('#base').val()

	$('input[name="id_loket"]').val(id)

	$.ajax({
		url:base+'loket/detil_loket/'+id,
		type: 'get',
		dataType: 'json',
	})
	.done(function(data) {
		$('input[name="nama_loket"]').val(data.nama_loket)
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
				location.href = base + "loket/hapus_loket/"+id
			}
		})
	});
});

/*FILTER LOKET*/
$('#btn_filter_loket').click(function(event) {
	var base = $('#base').val()
	var bulan = $('#bulan_loket').val()
	var tahun = $('#tahun_loket').val()

	if (bulan == '' || tahun == '') {
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'Parameter Belum Diisi!',
			footer: 'silahkan isi kolom bulan dan tahun',
		})
	}
	else
	{
		location.href = base+'loket/index/'+bulan+'/'+tahun
	}
});