	$(document).on('click', '.modal-edit', function(event) {
		var id 	= $(this).data('id')
		var base = $('#base').val()

		$('input[name="id_soal"]').val(id)

		$.ajax({
			url:base+'admin/detilpertanyaan/'+id,
			type: 'get',
			dataType: 'json',
		})
		.done(function(data) {
			$('#kategori').val(data.kategori)
			$('textarea[name="pertanyaan"]').text(data.soal)
			$('input[name="a"]').val(data.a)
			$('input[name="b"]').val(data.b)
			$('input[name="c"]').val(data.c)
			$('input[name="d"]').val(data.d)
		})
		.fail(function(data) {
			console.log("error");
		});

		$('#btn_hapus').click(function(event) {
			var result = confirm('Anda Akan Menghapus Data Ini?')
			if (result == true) {
				location.href = base + "admin/hapuspertanyaan/"+id
			}
		});
	});