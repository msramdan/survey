   <style type="text/css" media="screen">
     .small-box{
      height: 150px;
    }
    .a{
      color: white;
    }
    @import url(https://fonts.googleapis.com/css?family=Roboto);

    body {
      font-family: Roboto, sans-serif;
    }
  </style>
  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <a href="" title="">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $kepuasan ?><sup>%</sup></h3>
              <p>Index Kepuasan</p>
              <p style="font-weight: bold; font-size: 20px;"><?php echo strtoupper($tingkat_kepuasan)." " ?><strong>(<?php echo $mutu ?>)</strong></p>
            </div>
            <div class="icon">
              <i class="ion-pie-graph"></i>
            </div>
          </div>
        </a>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <a href="" title="">
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $responden ?></h3>
              <p>Total Responden</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
          </div>
        </a>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <a href="" title="">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $s_publish ?></h3>

              <p>Survey Ter<strong>Publish</strong></p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </a>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <a href="<?php echo site_url('admin/publish') ?>" title="">
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $b_publish ?></h3>

              <p>Survey Belum Di-<strong>Publish</strong></p>
            </div>
            <div class="icon">
              <i class="glyphicon glyphicon-time"></i>
            </div>
          </div>
        </a>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
      <section class="col-lg-12 connectedSortable">

        <!-- Table Data Pilihan -->
        <div class="box box-primary">
          <div class="box-header">
            <i class="ion ion-clipboard"></i>
            <h3 class="box-title">Statistik</h3>
            <a style="margin-left: 20px;" target="_blank" class="btn-sm btn-success" href="<?php echo site_url('admin/cetakrekap') ?>" title="cetak"><i class="fa fa-file-excel-o"></i> export</a>
            <a style="margin-left: 10px;" target="_blank" class="btn-sm btn-success" href="<?php echo site_url('admin/cetakrekapdetil') ?>" title="cetak"><i class="fa fa-file-excel-o"></i> Export Detil</a>
          </button>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>

            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
           <div class="table-responsive">
            <table class="fl-table" border="1px" >
              <thead>
                <tr style="background-color: #1f6f8b; color: white;">
                  <th class="text-center" rowspan="2" style="vertical-align: middle;">No</th>
                  <th class="text-center" width="50%" rowspan="2" style="vertical-align: middle;">Unsur Pelayanan</th>
                  <th class="text-center" rowspan="1" style="background-color: #68b0ab; color: white;" colspan="4">Jumlah Responden Yang Menjawab (orang)</th>
                  <th class="text-center" rowspan="2" style="vertical-align: middle;">Nilai Rata2</th>
                  <th class="text-center" rowspan="2" style="vertical-align: middle;">Kategori Mutu</th>
                  <th class="text-center" rowspan="2" style="vertical-align: middle;">Prioritas</th>
                </tr>
                <tr style="color: white;">
                 <th class="text-center" width="10%" style="vertical-align: middle; background-color: #0278ae" >Sangat Puas</th>
                 <th class="text-center" width="10%" style="vertical-align: middle; background-color: #01c5c4" >Puas</th>
                 <th class="text-center" width="10%" style="vertical-align: middle; background-color: #f0a500">Kurang Puas</th>
                 <th class="text-center" width="10%" style="vertical-align: middle; background-color: red;" >Kecewa</th>
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
                  <td  style="font-weight: bold;"><?php echo $data['kategori'] ?></td>
                  <td class="text-center"><?php echo $data['sp'] != null ? '<strong>'.$data['sp'].'</strong>' : '-' ?></td>
                  <td class="text-center"><?php echo $data['p'] != null ? '<strong>'.$data['p'].'</strong>' : '-' ?></td>
                  <td class="text-center"><?php echo $data['tp'] != null ? '<strong>'.$data['tp'].'</strong>' : '-' ?></td>
                  <td class="text-center"><?php echo $data['kec'] != null ? '<strong>'.$data['kec'].'</strong>' : '-' ?></td>
                  <td class="text-center" style="font-weight: bold;"><?php echo $data['kepuasan'] ?></td>
                  <td  class="text-center" style="font-weight: bold;"><?php echo $index ?></td>
                  <td  class="text-center" style="font-weight: bold;"><?php echo $data['prioritas'] ?></td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- /.box -->
  </section>

  <section class="col-xl-3 col-lg-6 col-md-6 col-xs-12 connectedSortable">
    <!-- solid sales graph -->
    <div class="box box-solid">
      <div class="box-header">
        <i class="fa fa-th"></i>

        <h3 class="box-title">Kategori Pemilih Berdasarkan Pekerjaan</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="box-body border-radius-none">
        <div id="piepekerjaan">
        </div>
      </div>
    </div>
  </section>

  <section class="col-xl-3 col-lg-6 col-md-6 col-xs-12 connectedSortable">
    <!-- solid sales graph -->
    <div class="box box-solid">
      <div class="box-header">
        <i class="fa fa-th"></i>

        <h3 class="box-title">Rata - rata Pilihan Responden</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="box-body border-radius-none">
        <div id="pie">
        </div>
      </div>
    </div>
  </section>

  <section class="col-xl-3 col-lg-6 col-md-6 col-xs-12 connectedSortable">
    <!-- solid sales graph -->
    <div class="box box-solid">
      <div class="box-header">
        <i class="fa fa-th"></i>

        <h3 class="box-title">Kategori Pemilih Berdasarkan Pendidikan</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="box-body border-radius-none">
        <div id="piepend">
        </div>
      </div>
    </div>
  </section>

  <section class="col-xl-3 col-lg-6 col-md-6 col-xs-12 connectedSortable">
    <!-- Diagram Pilihan-->
    <div class="box box-solid">
      <div class="box-header">
        <h3 class="box-title">
          Data Pilihan
        </h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="box-body">
        <div id="chart">
        </div>
      </div>
    </div>
  </section>
  <!-- /.box -->

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
  foreach ($hasil as $hs) {
    $dt[$h] = [
      'nilai' => $hs['y'],
      'label' => $hs['name']
    ];
    $h++;
  }
  $nilai_pie  = array_column($dt, 'nilai');
  $label      = array_column($dt, 'label');
}


//data pendikan
if (count($pendidikan) > 0) {
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
  chart: {
    type: 'bar'
  },
  series: [{
    name: 'Mutu',
    data: <?php echo $kepuasan==true ? json_encode($kepuasan) : [] ?>
  }],
  xaxis: {
    categories: <?php echo $id_soal==true ? json_encode($id_soal) : [] ?>
  }
}

var chart = new ApexCharts(document.querySelector("#chart"), options);

chart.render(); 


/*pie chart*/
var options = {
  series: <?php echo $nilai_pie==true ? json_encode($nilai_pie) : [] ?>,
  chart: {
    width: "90%",
    type: 'pie',
  },
  labels: <?php echo $label==true ? json_encode($label) : [] ?>,
  responsive: [{
    breakpoint: undefined,
    options: {
      chart: {
        width: "100%"
      },
      legend: {
        position: 'bottom'
      }
    }
  }]
};

var chart = new ApexCharts(document.querySelector("#pie"), options);
chart.render();

/*pie chart pendidikan*/
var options = {
  series: <?php echo $j_pend == true ?  json_encode($j_pend) : [] ?>,
  chart: {
    width: "90%",
    type: 'pie',
  },
  labels: <?php echo $l_pend == true?  json_encode($l_pend) : [] ?>,
  responsive: [{
    breakpoint: undefined,
    options: {
      chart: {
        width: "100%"
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
  series: <?php echo $j_pek ?  json_encode($j_pek) : [] ?>,
  chart: {
    width: "90%",
    type: 'pie',
  },
  labels: <?php echo $l_pek ?  json_encode($l_pek) : [] ?>,
  responsive: [{
    breakpoint: undefined,
    options: {
      chart: {
        width: "100%"
      },
      legend: {
        position: 'bottom'
      }
    }
  }]
};

var chart = new ApexCharts(document.querySelector("#piepekerjaan"), options);
chart.render();
</script>