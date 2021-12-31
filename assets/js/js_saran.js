var base 	= document.getElementById('base').value;
var saran 	= document.getElementById('saran');
var id 		= document.getElementById('id_responden');
var tx_saran= document.getElementById('tx_saran');

var nama 		= document.getElementById('nama');
var umur 		= document.getElementById('umur');
var jk 				= document.getElementById('jk');
var pekerjaan 		= document.getElementById('pekerjaan');
var pendidikan 		= document.getElementById('pendidikan');
var bidang_instansi_id 		= document.getElementById('bidang_instansi_id');

saran.addEventListener('click', function(){
	//alert(id.value+tx_saran.value)
	Swal.fire({
		title: 'Terimakasih',
		text: "Anda Sudah Berpartisipasi,.",
		icon: 'success',
		confirmButtonColor: '#3085d6',
		confirmButtonText: 'Tutup'
	}).then((result) => {
		if (result.isConfirmed) {
			var data = {
				"id"		: id.value,
				"saran"	:  tx_saran.value,
				"nama"	:  nama.value,
				"umur"	:  umur.value,
				"jk"	:  jk.value,
				"pekerjaan"	:  pekerjaan.value,
				"pendidikan"	:  pendidikan.value,
				"bidang_instansi_id"	:  bidang_instansi_id.value
			}

			$.ajax({
				url: base+'survey/upload_jawaban/',
				type: 'post',
				dataType: 'json',
				data: data,
			})
			.done(function(data) {
				console.log(data)
				location.href = base+"survey";
			})
			.fail(function() {
				console.log("error")
			});
			
		}
	})

}, false);