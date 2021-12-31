var base = document.getElementById('base').value;
var nsoal = document.getElementById('n_soal').value;

/*button*/
var lanjut = document.getElementById('lanjut');
var reset  = document.getElementById('reset');
var selesai = document.getElementById('selesai');

/*deklarasi variable*/
var id_soal 	= document.getElementById('id_soal');
var idreg 		= document.getElementById('noreg');
var nama 		= document.getElementById('nama');
var umur 		= document.getElementById('umur');
var jk 				= document.getElementById('jk');
var pekerjaan 		= document.getElementById('pekerjaan');
var pendidikan 		= document.getElementById('pendidikan');
var bidang_instansi_id 		= document.getElementById('bidang_instansi_id');


/*label untuk checkbox*/
var a 			= document.getElementById('a');
var b 			= document.getElementById('b');
var c 			= document.getElementById('c');
var d 			= document.getElementById('d');

/*event klik save / lanjut*/
var no = 1;
lanjut.addEventListener('click', function(){
	jawaban();
	soal();
	
}, false);

reset.addEventListener('click', function(){
	var result = confirm('Anda Akan Me-reset Jawaban Anda? Jawaban Sebelumnya Akan Dihapus Dari..');
	if (result==true) {
		location.href = base+'survey/reset/'+idreg.value;
	}
}, false);


/*menampilkan soal*/
function soal(){
	$.ajax({
		url: base+"tes2/get_soal/"+ no++,
		type: 'get',
		dataType: 'json'
	})
	.done(function(data) {
		id_soal.value = data['id_soal'];
		pertanyaan.innerHTML = data['soal'];
		a.innerHTML = data['a'];
		b.innerHTML = data['b'];
		c.innerHTML = data['c'];
		d.innerHTML = data['d'];

		/*reset checkbox*/
		["c1", "c2", "c3", "c4"].forEach(function(id) {
			document.getElementById(id).checked = false;
		});
	})
	.fail(function(data) {
		// location.href = base+"survey/saran/"+idreg.value+'/'+nama.value+'/'+umur.value+'/'+jk.value+'/'+pekerjaan.value+'/'+pendidikan.value+'/'+bidang_instansi_id.value;
			location.href = base+"survey/saran/"+idreg.value+'?nama='+nama.value+'&umur='+umur.value+'&jk='+jk.value+'&pekerjaan='+pekerjaan.value+'&pendidikan='+pendidikan.value+'&bidang_instansi_id='+bidang_instansi_id.value;
	});
}

/*upload saran*/


/*post jawaban*/
function jawaban(){
	var jawaban = document.querySelector('input[type=radio][name=pilihan]:checked').value;
	var data = {
		"id_soal"		: id_soal.value,
		"id_responden"	: idreg.value,
		"jawaban"		: jawaban
	}

	$.ajax({
		url: base+'/survey/jawaban',
		type: 'post',
		dataType: 'json',
		data: data,
	})
	.done(function(data) {
		console.log(data);
	})
	.fail(function(data) {
		console.log(data);
	});

}