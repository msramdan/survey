<!DOCTYPE html>
 <html><head>
    <title>Laporan Responden</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }

            .word-table2 {
                border: 0px solid #CCC !important; 
                border-collapse: collapse !important;
                width: 100%;
            }

            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 1px 2px;
            }

        </style>
</head><body >
    <table border="0" cellpadding="0" align="center" style="line-height: 14px;">
    <tr>
                        <td style="width: 100%;text-align: center;">
                            <h3>INDEKS KEPUASAN MASYARAKAT</h3>
                            <h3>DINAS PEMERINTAH KOTA TUAL</h3>
                            <?php $jml = $this->db->query("SELECT * FROM tb_bidang_instansi where bidang_instansi_id='$bidang_instansi_id'")->row();
                            $nama = $jml->nama_bidang_instansi; ?>
                            <h3>BIDANG PELAYANAN <?= $nama ?> </h3>
                            <?php if(isset($dari) && isset($ke)){ ?>
                              <h3>PRIODE <?= $dari ?> s/d <?= $ke ?> </h3>
                            <?php } ?>
                        </td>
                    </tr>
    </table><br>
    <table class="word-table">
        <tr> 
          <th style="width: 50%;text-align:center; font-size:14px" >NILAI IKM</th>
          <th style="width: 50%;text-align:center; font-size:14px">PEMERINTAH KOTA TUAL</th>
        </tr>
        <tr> 
          <td style="text-align:center; font-size:12px" >
          <table style="width: 100%;padding:2px">
                <?php if(isset($dari) && isset($ke)){
                    $jml = $this->db->query("SELECT * FROM tb_detil_responden where bidang_instansi_id='$bidang_instansi_id' and created_date >= '$dari' AND created_date <= '$ke'");
                    $jml_res = $jml->num_rows();
                  }else{
                    $jml = $this->db->query("SELECT * FROM tb_detil_responden where bidang_instansi_id='$bidang_instansi_id'");
				            $jml_res =  $jml->num_rows();
                  } ?> 
                    <tr> 
                        <td style="width: 100%;text-align:center; font-size:12px" colspan="3" height="100px" ><span style="font-size: 50;">
                        <?php
								if (isset($dari) && isset($ke)) {
									$q_total_soal = $this->db->query("SELECT * FROM tb_pertanyaan");
									$total_soal = $q_total_soal->num_rows();
									$nilai_persentase = $this->db->query("SELECT tb_hasil.*,tb_detil_responden.bidang_instansi_id FROM tb_hasil join tb_detil_responden on tb_detil_responden.id = tb_hasil.detail_responden_id
										where tb_hasil.created_date >= '$dari' AND tb_hasil.created_date <= '$ke' And bidang_instansi_id='$bidang_instansi_id'")->result();
									$total = 0;
									$x = 1;
									foreach ($nilai_persentase as $n) {
                      if ($n->jawaban == 'd') {
                        $n = 4;;
                      } else if ($n->jawaban == 'c') {
                        $n = 3;
                      } else if ($n->jawaban == 'b') {
                        $n = 2;
                      } else {
                        $n = 1;
                      }
                      $nilai[$x] = [
                        'jawaban' => $n
                      ];
                      $total += $nilai[$x]['jawaban'];
                      $x++;
                    }
                    $nilai_max = $total_soal * 4 * $jml_res;
                    $nilai_max = $total_soal * 4 * $jml_res;
                    if ($jml_res > 0) {
                      echo round(($total / $nilai_max) * 100, 2);
                    } else {
                      echo '0';
                    }
                  } else {
                    $q_total_soal = $this->db->query("SELECT * FROM tb_pertanyaan");
                    $total_soal = $q_total_soal->num_rows();
                    $nilai_persentase = $this->db->query("SELECT tb_hasil.*,tb_detil_responden.bidang_instansi_id FROM tb_hasil join tb_detil_responden on tb_detil_responden.id = tb_hasil.detail_responden_id where bidang_instansi_id='$bidang_instansi_id'")->result();
                    $total = 0;
                    $x = 1;
                    foreach ($nilai_persentase as $n) {
                      if ($n->jawaban == 'd') {
                        $n = 4;;
                      } else if ($n->jawaban == 'c') {
                        $n = 3;
                      } else if ($n->jawaban == 'b') {
                        $n = 2;
                      } else {
                        $n = 1;
                      }
                      $nilai[$x] = [
                        'jawaban' => $n
                      ];
                      $total += $nilai[$x]['jawaban'];
                      $x++;
                    }
                    $nilai_max = $total_soal * 4 * $jml_res;
                    if ($jml_res > 0) {
                      echo round(($total / $nilai_max) * 100, 2);
                    } else {
                      echo '0';
                    }
                  } ?>
                      </span></td>
                    </tr>
                    <tr> 
                        <th style="width: 5%;text-align:center; font-size:12px" >No.</th>
                        <th style="width: 90%;text-align:center; font-size:12px">Unsur Pelayanan</th>
                        <th style="width: 5%;text-align:center; font-size:12px">Rata Rata Nilai</th>
                    </tr>
                    
                    <?php
                      $pertanyaan  = "SELECT * From tb_pertanyaan ORDER BY id_soal ASC";
                      $result_pertanyaan = $this->db->query($pertanyaan);
                    ?>
                <!-- paste   -->
                <?php
							foreach ($result_pertanyaan->result() as $row) { ?>
                    <tr> 
                        <td style="width: 5%;text-align:center; font-size:12px" ><?= $row->id_soal ?></td>
                        <td style="width: 90%;text-align:center; font-size:12px"><?= $row->kategori ?></td>
                        <td style="width: 5%;text-align:center; font-size:12px">
                        <?php
                        if (isset($dari) && isset($ke)) {
                          $result_cek = $this->db->query("SELECT tb_hasil.*,tb_detil_responden.bidang_instansi_id FROM tb_hasil join tb_detil_responden on tb_detil_responden.id = tb_hasil.detail_responden_id  where bidang_instansi_id='$bidang_instansi_id' and tb_hasil.created_date >= '$dari' AND tb_hasil.created_date <= '$ke' and id_soal='$row->id_soal'");
                        }else{
                          $result_cek = $this->db->query("SELECT tb_hasil.*,tb_detil_responden.bidang_instansi_id FROM tb_hasil join tb_detil_responden on tb_detil_responden.id = tb_hasil.detail_responden_id  where bidang_instansi_id='$bidang_instansi_id' and id_soal='$row->id_soal'");
                        }
                        
                        
											$jml_data =  $result_cek->num_rows();
											$total = 0;
											foreach ($result_cek->result() as $row) {
												if ($row->jawaban == 'd') {
													$n = 4;
												} else if ($row->jawaban == 'c') {
													$n = 3;
												} elseif ($row->jawaban == 'b') {
													$n = 2;
												} else {
													$n = 1;
												}
												$total = $total + $n;
											}
											$hasil = $total / $jml_data;
											echo $hasil; ?>
                      </td>
                    </tr>
              <?php } ?>    
            </table>
        </td> 
          <td style="width: 50%;text-align:center; font-size:12px">
          <table class="word-table2">
              <tr style="border: none;">
                  <td style="vertical-align: top;text-align: left;  border:0px !important;">Jumlah Responden</td>
                  <td style="vertical-align: top;text-align: left;  border:0px !important;">:</td>
                  <td style="vertical-align: top;text-align: left;  border:0px !important;">
                  <?php echo $jml_res; ?> 
                  </td>
              </tr>
              <tr style="border: none;">
                  <td style="vertical-align: top;text-align: left;border:0px !important;">Jenis Kelamin</td>
                  <td style="vertical-align: top;text-align: left;border:0px !important;" >:</td>
                  <td style="vertical-align: top;text-align: left;border:0px !important;">
                      <span>Laki Laki =
                <?php if(isset($dari) && isset($ke)){
                    $jk_laki = $this->db->query("SELECT * FROM tb_detil_responden where bidang_instansi_id='$bidang_instansi_id' and created_date >= '$dari' AND created_date <= '$ke' and jk='Laki-laki'");
                    echo $jk_laki->num_rows();
                  }else{
                    $jk_laki = $this->db->query("SELECT * FROM tb_detil_responden where bidang_instansi_id='$bidang_instansi_id' and jk='Laki-laki'");
				            echo $jk_laki->num_rows();
                  } ?> 
                    </span>
                    <p>Perempuan =
                
                    <?php if(isset($dari) && isset($ke)){
                    $jk_perempuan = $this->db->query("SELECT * FROM tb_detil_responden where bidang_instansi_id='$bidang_instansi_id' and jk='Perempuan' and created_date >= '$dari' AND created_date <= '$ke' and jk='Perempuan'");
                    echo $jk_perempuan->num_rows();
                  }else{
                    $jk_perempuan = $this->db->query("SELECT * FROM tb_detil_responden where jk='Perempuan' and bidang_instansi_id='$bidang_instansi_id'");
				        echo $jk_perempuan->num_rows();
                  } ?> 
                    </p>
                </td>
              </tr>
              <tr style="border: none;">
                  <td style="vertical-align: top;text-align: left;border:0px !important;">Pendidikan</td>
                  <td style="vertical-align: top;text-align: left;border:0px !important;" >:</td>
                  <td style="vertical-align: top;text-align: left;border:0px !important;">
                      <span>SD Kebawah = 
              <?php if(isset($dari) && isset($ke)){
                    $jk_sd_bawah = $this->db->query("SELECT * FROM tb_detil_responden where bidang_instansi_id='$bidang_instansi_id' AND created_date >= '$dari' AND created_date <= '$ke' and pendidikan='SD Kebawah'");
                    echo $jk_sd_bawah->num_rows();
                  }else{
                    $jk_sd_bawah = $this->db->query("SELECT * FROM tb_detil_responden where bidang_instansi_id='$bidang_instansi_id' AND pendidikan='SD Kebawah'");
				        echo $jk_sd_bawah->num_rows();
                  } ?> 
                      </span>
                      <p>SMP =

                <?php if(isset($dari) && isset($ke)){
                    $jk_smp = $this->db->query("SELECT * FROM tb_detil_responden where bidang_instansi_id='$bidang_instansi_id' AND created_date >= '$dari' AND created_date <= '$ke' and pendidikan='SMP'");
                    echo $jk_smp->num_rows();
                  }else{
                    $jk_smp = $this->db->query("SELECT * FROM tb_detil_responden where bidang_instansi_id='$bidang_instansi_id' and pendidikan='SMP'");
				        echo $jk_smp->num_rows();
                  } ?> 

                      </p>
                      <p>SMA =
              <?php if(isset($dari) && isset($ke)){
                    $jk_sma = $this->db->query("SELECT * FROM tb_detil_responden where bidang_instansi_id='$bidang_instansi_id' AND created_date >= '$dari' AND created_date <= '$ke' and pendidikan='SMA'");
                    echo $jk_sma->num_rows(); 
                  }else{
                    $jk_sma = $this->db->query("SELECT * FROM tb_detil_responden where bidang_instansi_id='$bidang_instansi_id' AND pendidikan='SMA'");
				        echo $jk_sma->num_rows(); 
                  } ?> 

                
                      </p>
                      <p>S1 = 

                <?php if(isset($dari) && isset($ke)){
                    $jk_s1 = $this->db->query("SELECT * FROM tb_detil_responden where bidang_instansi_id='$bidang_instansi_id' AND created_date >= '$dari' AND created_date <= '$ke' and pendidikan='S1'");
                    echo $jk_s1->num_rows(); 
                  }else{
                    $jk_s1 = $this->db->query("SELECT * FROM tb_detil_responden where bidang_instansi_id='$bidang_instansi_id' and pendidikan='S1'");
				        echo $jk_s1->num_rows(); 
                  } ?> 

                      </p>
                      <p>S2 Keatas = 
              <?php if(isset($dari) && isset($ke)){
                    $jk_s2 = $this->db->query("SELECT * FROM tb_detil_responden where bidang_instansi_id='$bidang_instansi_id' AND created_date >= '$dari' AND created_date <= '$ke' and pendidikan='S2 Keatas'");
                    echo $jk_s2->num_rows(); 
                  }else{
                    $jk_s2 = $this->db->query("SELECT * FROM tb_detil_responden where bidang_instansi_id='$bidang_instansi_id' and pendidikan='S2 Keatas'");
				        echo $jk_s2->num_rows(); 
                  } ?> 

                      </p>
                </td>
              </tr>

              <tr style="border: none;">
                  <td style="vertical-align: top;text-align: left;border:0px !important;">Pekerjaan</td>
                  <td style="vertical-align: top;text-align: left;border:0px !important;" >:</td>
                  <td style="vertical-align: top;text-align: left;border:0px !important;">
                      <span>PNS/TNI/POLRI =

                <?php if(isset($dari) && isset($ke)){
                    $a = $this->db->query("SELECT * FROM tb_detil_responden where  bidang_instansi_id='$bidang_instansi_id' AND created_date >= '$dari' AND created_date <= '$ke' and pekerjaan='PNS/TNI/POLRI'");
                    echo $a->num_rows(); 
                  }else{
                    $a = $this->db->query("SELECT * FROM tb_detil_responden where  bidang_instansi_id='$bidang_instansi_id' and pekerjaan='PNS/TNI/POLRI'");
				            echo $a->num_rows(); 
                  } ?> 
                
              
              </span>
                      <p>Pegawai Swasta =

                  <?php if(isset($dari) && isset($ke)){
                    $b = $this->db->query("SELECT * FROM tb_detil_responden where  bidang_instansi_id='$bidang_instansi_id' AND created_date >= '$dari' AND created_date <= '$ke' and pekerjaan='Pegawai Swasta'");
                    echo $b->num_rows();
                  }else{
                    $b = $this->db->query("SELECT * FROM tb_detil_responden where  bidang_instansi_id='$bidang_instansi_id' and pekerjaan='Pegawai Swasta'");
				        echo $b->num_rows();
                  } ?> 


                      </p>
                      <p>Wiraswasta = 
                  <?php if(isset($dari) && isset($ke)){
                    $c = $this->db->query("SELECT * FROM tb_detil_responden where bidang_instansi_id='$bidang_instansi_id' AND created_date >= '$dari' AND created_date <= '$ke' and pekerjaan='Wiraswasta'");
                    echo $c->num_rows(); 
                  }else{
                    $c = $this->db->query("SELECT * FROM tb_detil_responden where bidang_instansi_id='$bidang_instansi_id' and pekerjaan='Wiraswasta'");
				            echo $c->num_rows(); 
                  } ?> 

                      </p>
                      <p>Pelajar/Mahasiswa =
                <?php if(isset($dari) && isset($ke)){
                    $d = $this->db->query("SELECT * FROM tb_detil_responden where bidang_instansi_id='$bidang_instansi_id' AND created_date >= '$dari' AND created_date <= '$ke' and pekerjaan='Pelajar/Mahasiswa'");
                    echo $d->num_rows();
                  }else{
                    $d = $this->db->query("SELECT * FROM tb_detil_responden where bidang_instansi_id='$bidang_instansi_id' and pekerjaan='Pelajar/Mahasiswa'");
				        echo $d->num_rows();
                  } ?> 


                      </p>
                      <p>Lainnya =

                <?php if(isset($dari) && isset($ke)){
                    $e = $this->db->query("SELECT * FROM tb_detil_responden where bidang_instansi_id='$bidang_instansi_id' AND created_date >= '$dari' AND created_date <= '$ke' and pekerjaan='Lainnya'");
                    echo $e->num_rows(); 
                  }else{
                    $e = $this->db->query("SELECT * FROM tb_detil_responden where bidang_instansi_id='$bidang_instansi_id' and pekerjaan='Lainnya'");
				            echo $e->num_rows(); 
                  } ?> 

                      </p>
                </td>
              </tr>

              <?php if(isset($dari) && isset($ke)){ ?>
                <tr style="border: none;">
                  <td style="vertical-align: top;text-align: left;border:0px !important;width:100px">Priode Survei</td>
                  <td style="vertical-align: top;text-align: left;border:0px !important;width:5px">:</td>
                  <td style="vertical-align: top;text-align: left;border:0px !important;"> <?= $dari ?> s/d <?= $ke ?>
                </td>
              </tr>
            <?php } ?>
          </table>
        </td>
        </tr>    
    </table>
    <br>
    <br>
    <table class="word-table" align="center"  style="line-height: 5px;">
                    <tr> 
                        <td style="width: 50%;text-align:center; font-size:12px" colspan="2" height="75px" >
                       <h4>TERIMA KASIH ATAS PENILAIAN YANG TELAH ANDA BERIKAN</h4>
                       <h4>MASUKAN ANDA SANGAT BERMANFAAT UNTUK KEMAJUAN</h4>
                       <h4>UNIT KERJA KAMI AGAR TERUS MEMPERBAIKI DAN MENINGKATKAN</h4>
                       <h4>KUALITAS PELAYANAN KAMI BAGI MASYARAKAT</h4>
                    </td>
                    </tr>        
            </table>
    
            <table class="" style="margin-top: 30px; width: 200px;text-align: center; margin-left: 375px">
        <tr> 
          <td width="200px">Bekasi, <?= date('d F Y') ?></td> 
        </tr>
        <tr>
          <td style="height: 70px;"></td>
        </tr>
        <tr>
          <td>Admin Aplikasi</td>
        </tr>
                
</table>