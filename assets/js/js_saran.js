var base 	= document.getElementById('base').value;
var saran 	= document.getElementById('saran');
var id 		= document.getElementById('id_responden');
var tx_saran= document.getElementById('tx_saran');

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
			$.ajax({
				url: base+'survey/upload_jawaban/',
				type: 'post',
				dataType: 'json',
				data: {id: id.value, saran : tx_saran.value },
			})
			.done(function(data) {
				//console.log(data)
				location.href = base+"survey";
			})
			.fail(function() {
				console.log("error")
			});
			
		}
	})

}, false);