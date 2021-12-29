<style type="text/css" media="screen">
  .table-wrapper{
    margin: 10px 70px 70px;
    box-shadow: 0px 35px 50px rgba( 0, 0, 0, 0.2 );
  }

  .fl-table {
    border-radius: 5px;
    font-size: 12px;
    font-weight: normal;
    border: none;
    border-collapse: collapse;
    width: 100%;
    max-width: 100%;
    white-space: nowrap;
    background-color: white;
  }

  .fl-table td, .fl-table th {
    text-align: center;
    padding: 8px;
  }

  .fl-table td {
    border-right: 1px solid #f8f8f8;
    font-size: 12px;
  }

  .fl-table thead th {
    color: #ffffff;
    background: #4FC3A1;
  }



  .fl-table tr:nth-child(even) {
    background: #F8F8F8;
  }

</style>
<section id="statistik" style="margin-top: -20px;">
  <div class="container">
    <div class="row" >
      <div class="col-md-7 col-xs-12" data-aos="fade-right">
       <div class="card" style="margin-bottom: 5px;">
        <div class="card-body">
         <br>
         <div id="chart" ></div>
       </div>
     </div>
   </div>
   <!-- diagram -->
   <div class="col-md-5 col-xs-12" data-aos="fade-up">
     <div class="row">
      <div class="col-md-12">
       <div class="card">
        <div class="card-body">
          <div id="piepend">

          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row" style="margin-top: 5px;">
    <div class="col-md-12">
     <div class="card">
      <div class="card-body">
        <div id="piepek">

        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>

<div class="card" style="margin-top: 15px;">

  <div class="card-body">
    <p><strong>Detil Jawaban Responden Per Kategori</strong></p>
    <div class="table-responsive" style="margin-top: 10px;">
      <table class="fl-table" >
        <thead style="background-color: #f4f4f2;" >
          <tr >
            <th class="text-center" rowspan="2" style="vertical-align: middle;">No</th>
            <th class="text-center" width="50%" rowspan="2" style="vertical-align: middle;">Unsur Pelayanan</th>
            <th class="text-center" rowspan="1"  colspan="4">Jumlah Responden Yang Menjawab (orang)</th>
            <th class="text-center" rowspan="2" style="vertical-align: middle;">Nilai Rata2</th>
            <th class="text-center" rowspan="2" style="vertical-align: middle;">Kategori Mutu</th>
          </tr>
          <tr >
           <th class="text-center" width="10%">Sangat Puas</th>
           <th class="text-center" width="10%" >Puas</th>
           <th class="text-center" width="10%">Kurang Puas</th>
           <th class="text-center" width="10%" >Kecewa</th>
         </tr>
       </thead>
       <tbody>
        <?php foreach ($rekap as $data): 
          $kepuasan = $data['kepuasan'];
          if ($kepuasan >= 1 && $kepuasan <= 2.5996 ) {
            $index = 'D';
          }else if($kepuasan >= 2.60 && $kepuasan <= 3.064){
            $index = 'C';
          }else if($kepuasan >= 3.0644 && $kepuasan < 3.532){
            $index = 'B';
          } else if($kepuasan >= 3.5324 && $kepuasan <= 4){
            $index = 'A';
          } else {
            $index = null;
          }
          ?>
          <tr>
            <td class="text-center" style="font-weight: bold;"><?php echo $data['id_soal'] ?></td>
            <td class="text-left"><?php echo $data['kategori'] ?></td>
            <td class="text-center"><?php echo $data['sp'] != null ? '<strong>'.$data['sp'].'</strong>' : '-' ?></td>
            <td class="text-center"><?php echo $data['p'] != null ? '<strong>'.$data['p'].'</strong>' : '-' ?></td>
            <td class="text-center"><?php echo $data['tp'] != null ? '<strong>'.$data['tp'].'</strong>' : '-' ?></td>
            <td class="text-center"><?php echo $data['kec'] != null ? '<strong>'.$data['kec'].'</strong>' : '-' ?></td>
            <td class="text-center" style="font-weight: bold;"><?php echo $data['kepuasan'] ?></td>
            <td  class="text-center" style="font-weight: bold;"><?php echo $index ?></td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>
</div>


</div>

</section>

<?php 
if (count($rekap) > 0) {
 $no= 1;
 foreach ($rekap as $rekap) {
  $data[$no] = [
    'id_soal' => $rekap['id_soal'],
    'kepuasan'  => number_format($rekap['kepuasan'],2)
  ];
  $no++;
}
$kepuasan = array_column($data, 'kepuasan');
$id_soal  = array_column($data, 'id_soal');

}

//data pie
if ($hasil) {
 $h = 1;
 foreach ($hasil as $hasil) {
  $dt[$h] = [
    'nilai' => $hasil['y'],
    'label' => $hasil['name']
  ];
  $h++;
}
$nilai_pie  = array_column($dt, 'nilai');
$label      = array_column($dt, 'label');
}


//data pendikan
if (count($pendidikan)>0) {
  $l = 1;
  foreach ($pendidikan as $p) {
    $pk[$l] = [
      'jumlah'            => $p['jumlah'],
      'pendidikan'        => $p['pendidikan']
    ];
    $l++;
  }
  $j_pend     = array_column($pk, 'jumlah');
  $l_pend     = array_column($pk, 'pendidikan');

}

//data pendikan
if (count($pekerjaan) > 0) {
 $m = 1;
 foreach ($pekerjaan as $pk) {
  $pkr[$m] = [
    'jumlah'            => $pk['jumlah'],
    'pekerjaan'         => $pk['pekerjaan']
  ];
  $m++;
}
$j_pek     = array_column($pkr, 'jumlah');
$l_pek     = array_column($pkr, 'pekerjaan');
}

?>

<script>
 var options = {
  title : {text : 'Statistik Pilihan Responden per kategori soal'},
  chart: {
    type: 'bar'
  },
  series: [{
    name: 'Mutu',
    data: <?php echo $kepuasan == true ?  json_encode($kepuasan) : [] ?>
  }],
  xaxis: {
    categories: <?php echo $id_soal == true ? json_encode($id_soal) : [] ?>
  }
}

var chart = new ApexCharts(document.querySelector("#chart"), options);

chart.render(); 


/*pie chart pendidikan*/
var options = {
  title : {text : 'responden berdasarkan pendidikan' },
  series: <?php echo $j_pend== true ? json_encode($j_pend) : [] ?>,
  chart: {
    width : "100%",
    type: 'pie',
  },
  labels: <?php echo $l_pend==true ? json_encode($l_pend) : [] ?>,
  responsive: [{
    breakpoint: undefined,
    options: {
      chart: {
        width : "100%"
      },
      legend: {
        position: 'bottom'
      }
    }
  }]
};

var chart = new ApexCharts(document.querySelector("#piepend"), options);
chart.render();

/*pie chart pekerjaan*/
var options = {
  title : {text : 'responden berdasarkan pekerjaan' },
  series: <?php echo $j_pek == true ? json_encode($j_pek) : []?>,
  chart: {
    width : "100%",
    type: 'pie',
  },
  labels: <?php echo $l_pek==true ? json_encode($l_pek) : [] ?>,
  responsive: [{
    breakpoint: undefined,
    options: {
      chart: {
       width : "100%"
     },
     legend: {
      position: 'bottom'
    }
  }
}]
};

var chart = new ApexCharts(document.querySelector("#piepek"), options);
chart.render();
</script>