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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
                        <th style="width: 10%;">No</th>
                        <th style="width: 50%;">Instansi</th>
                        <th style="width: 20%;">Jumlah Responden</th>
                        <th style="width: 20%;">Kepuasan (%)</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $data_instansi = $this->db->query("SELECT * from tb_loket where kategori_instansi_id='$a->kategori_instansi_id'");
                      ?>
                      <?php
                      $no = 1;
                      foreach ($data_instansi->result() as $loket) {
              $jml = $this->db->query("SELECT tb_detil_responden.*, tb_bidang_instansi.instansi_id FROM tb_detil_responden
              join tb_bidang_instansi on tb_bidang_instansi.bidang_instansi_id =tb_detil_responden.bidang_instansi_id where instansi_id='$loket->id_loket'");
              $jml_res = $jml->num_rows();
                        
                        ?>
                      
                        <tr>
                          <td><?= $no++ ?></td>
                          <td><a id="view_data" href="#exampleModal" data-toggle="modal"
                          data-nama_loket="<?= $loket->nama_loket ?>"
                          data-id_loket="<?= $loket->id_loket ?>"><b><?= $loket->nama_loket ?></b></a></td>
                          <td><a><?php echo $jml_res ?></a></td>
                          <?php
              

							//persentase nilai
							$q_total_soal = $this->db->query("SELECT * FROM tb_pertanyaan");
							$total_soal = $q_total_soal->num_rows();

							  $bidang_instansi = $this->db->query("SELECT tb_detil_responden.bidang_instansi_id,tb_bidang_instansi.instansi_id FROM tb_detil_responden
								join tb_bidang_instansi on tb_bidang_instansi.bidang_instansi_id =tb_detil_responden.bidang_instansi_id
								where instansi_id='$loket->id_loket' GROUP BY bidang_instansi_id")->result();
							

							$total = 0;
							$x = 0;
							$total_instansi = 0;
							foreach ($bidang_instansi as $n) {
									$jml_res_bidang_q = $this->db->query("SELECT * FROM tb_detil_responden where bidang_instansi_id='$n->bidang_instansi_id'");
									$jml_res_bidang = $jml_res_bidang_q->num_rows();

									$nilai_bidang = $this->db->query("SELECT tb_hasil.*,tb_detil_responden.bidang_instansi_id FROM tb_hasil
									join tb_detil_responden on tb_detil_responden.id = tb_hasil.detail_responden_id where bidang_instansi_id='$n->bidang_instansi_id'")->result();
									$nilai_total_bidang = 0;
									$nilai_fix_bidang = 0;
									$x_bidang = 1;
									foreach ($nilai_bidang as $b) {
										if ($b->jawaban == 'd') {
											$n = 4;;
										} else if ($b->jawaban == 'c') {
											$n = 3;
										} else if ($b->jawaban == 'b') {
											$n = 2;
										} else {
											$n = 1;
										}
										$nilai[$x_bidang] = [
											'jawaban' => $n
										];
										$nilai_total_bidang += $nilai[$x_bidang]['jawaban'];
										$x_bidang++;
									}
									$nilai_max_bidang = $total_soal * 4 * $jml_res_bidang;

									if ($jml_res_bidang > 0) {
										$nilai_fix_bidang = ($nilai_total_bidang / $nilai_max_bidang) * 100;
									} else {
										$nilai_fix_bidang = 0;
									}
									$x++;
									$total = $total + $nilai_fix_bidang;
									$total_instansi = $total / $x;
							}
							
							?>
							<td><a style="color: black;"><?php echo  round($total_instansi, 2)  ?> %</a></td>
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><span id="nama_loket"></span></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Bidang Pelayanan</th>
                  <th scope="col">Jumlah Responden</th>
                  <th scope="col">Kepuasan (%)</th>
                </tr>
              </thead>
              <tbody id="data_table_bidang">
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
      text: 'Statistik / kategori soal'
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
      text: 'Responden berdasarkan pendidikan'
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
      text: 'Responden berdasarkan pekerjaan'
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

<script type="text/javascript">
  $(document).on('click', '#view_data', function() {
    var nama_loket = $(this).data('nama_loket');
    var id = $(this).data('id_loket');
    $('#exampleModal #nama_loket').text(nama_loket);
    $.ajax({
      url: "<?= base_url() ?>survey/modal_data",
      method: "POST",
      data: {id:id},
      dataType: '',
      success: function(data) {
        console.log(data)
        $('#exampleModal #data_table_bidang').html(data);
      }
    })

  })
</script>