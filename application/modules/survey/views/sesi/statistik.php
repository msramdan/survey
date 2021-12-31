<style type="text/css" media="screen">
  .table-wrapper {
    margin: 10px 70px 70px;
    box-shadow: 0px 35px 50px rgba(0, 0, 0, 0.2);
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

  .fl-table td,
  .fl-table th {
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
    <div class="row">
      <div class="col-md-7 col-xs-12" data-aos="fade-right">
        <div class="card" style="margin-bottom: 5px;">
          <div class="card-body">
            <br>
            <div id="chart"></div>
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
        <p><strong>NILAI IKM</strong></p>
        <div class="table-responsive" style="margin-top: 10px;">
          <div class="tabs">
            <ul class="nav nav-tabs">
              <?php
              $nomor = 1;
              $data_kategori_instansi = $this->db->query("SELECT * from tb_kategori_instansi");
              ?>
              <?php foreach ($data_kategori_instansi->result() as $a) { ?>
                <li class="nav-item">
                  <a data-toggle="tab" href="#tab<?= $a->kategori_instansi_id ?>" class="nav-link <?= $nomor == 1 ? 'active' : '' ?> ">
                    <?= $a->nama_kategori_instansi ?>
                  </a>
                </li>
              <?php $nomor++;
              } ?>
            </ul>
            <br>
            <div class="tab-content">
              <?php
              $nomor = 1;
              foreach ($data_kategori_instansi->result() as $a) { ?>
                <div id="tab<?= $a->kategori_instansi_id ?>" class="tab-pane <?= $nomor == 1 ? 'active' : '' ?>">
                  <table id="" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>OPD</th>
                        <th>IKM</th>
                        <th>Nilai</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $data_instansi = $this->db->query("SELECT * from tb_loket where kategori_instansi_id='$a->kategori_instansi_id'");
                      ?>
                      <?php
                      $no = 1;
                      foreach ($data_instansi->result() as $di) { ?>
                        <tr>
                          <td><?= $no++ ?></td>
                          <td><a href="skpd-setda"><b><?= $di->nama_loket ?></b></a></td>
                          <td> 84.11</td>
                          <td>B (Baik)</td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              <?php $nomor++;
              } ?>
            </div>
          </div>
        </div>
      </div>
    </div>

</section>

<?php
if (count($rekap) > 0) {
  $no = 1;
  foreach ($rekap as $rekap) {
    $data[$no] = [
      'id_soal' => $rekap['id_soal'],
      'kepuasan'  => number_format($rekap['kepuasan'], 2)
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
    title: {
      text: 'Statistik Pilihan Responden per kategori soal'
    },
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
    title: {
      text: 'responden berdasarkan pendidikan'
    },
    series: <?php echo $j_pend == true ? json_encode($j_pend) : [] ?>,
    chart: {
      width: "100%",
      type: 'pie',
    },
    labels: <?php echo $l_pend == true ? json_encode($l_pend) : [] ?>,
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
    title: {
      text: 'responden berdasarkan pekerjaan'
    },
    series: <?php echo $j_pek == true ? json_encode($j_pek) : [] ?>,
    chart: {
      width: "100%",
      type: 'pie',
    },
    labels: <?php echo $l_pek == true ? json_encode($l_pek) : [] ?>,
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

  var chart = new ApexCharts(document.querySelector("#piepek"), options);
  chart.render();
</script>