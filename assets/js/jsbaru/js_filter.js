$('#btn_filter_index').click(function(event) {
  var base = $('#base').val()
  var bulan = $('select[name="bulan"]').val()
  var tahun = $('select[name="tahun"]').val()

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
    location.href = base+'admin/index/'+bulan+'/'+tahun
  }
});

$('#cetak_rekap_index').click(function(event) {
 var base = $('#base').val()
 var bulan = $('select[name="bulan"]').val()
 var tahun = $('select[name="tahun"]').val()

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
  location.href = base+'admin/cetakrekap/'+bulan+'/'+tahun
}
});

$('#cetak_rekap_index_detil').click(function(event) {
  var base = $('#base').val()
  var bulan = $('select[name="bulan"]').val()
  var tahun = $('select[name="tahun"]').val()

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
    location.href = base+'admin/cetakrekapdetil/'+bulan+'/'+tahun
  }
});

$('#cetak_laporan_akhir').click(function(event) {
 var base = $('#base').val()
 var bulan = $('select[name="bulan"]').val()
 var tahun = $('select[name="tahun"]').val()

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
  location.href = base+'admin/cetaklaporan/'+bulan+'/'+tahun
}
});


/*membuka detil loket kecewa*/
function kecewa(id) {
 var base = $('#base').val()
 var bulan = $('select[name="bulan"]').val()
 var tahun = $('select[name="tahun"]').val()

 location.href = base+'loket/kecewa/'+id+'/'+bulan+'/'+tahun+'/a'

}

/*membuka detil loket kurang puas*/
function kurang(id) {
 var base = $('#base').val()
 var bulan = $('select[name="bulan"]').val()
 var tahun = $('select[name="tahun"]').val()

 location.href = base+'loket/kecewa/'+id+'/'+bulan+'/'+tahun+'/b'
}

/*membuka detil loket puas*/
function puas(id) {
 var base = $('#base').val()
 var bulan = $('select[name="bulan"]').val()
 var tahun = $('select[name="tahun"]').val()

 location.href = base+'loket/kecewa/'+id+'/'+bulan+'/'+tahun+'/c'
}

/*membuka detil loket sangat puas*/
function sangat_puas(id) {
 var base = $('#base').val()
 var bulan = $('select[name="bulan"]').val()
 var tahun = $('select[name="tahun"]').val()

 location.href = base+'loket/kecewa/'+id+'/'+bulan+'/'+tahun+'/d'

}


