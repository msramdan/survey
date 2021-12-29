<link rel="stylesheet" href="<?php echo base_url().'assets/' ?>font-awesome/css/font-awesome.min.css">
<script src="<?php echo base_url().'assets/js/' ?>sweetalert2@10.js"></script>
<?= $this->load->view('sesi/header') ?>

<body style="background-color: #f1f6f9;">
  <?= $this->load->view('sesi/navbar2')  ?>
  <main id="main">
    <section id="details" class="details" >
      <div class="container"  style="margin-top:1%; ">
        <div class="row content">

          <div class="col-md-8 pt-4" data-aos="fade-up">
            <div class="card">
              <div class="card-header" style="background-color: white;">
                <h5 style="font-weight: bold;">Data responden<h5>
                </div>
                <div class="card-body">
                  <form method="post" action="<?php echo site_url('survey/post_detil_responden') ?>">
                    <div class="form-group">
                      <label for="loket">Loket Pelayanan</label>
                      <select class="form-control" name="loket" id="loket" required>
                        <option value="">--pilih loket--</option>
                        <?php foreach($loket as $loket) :  ?>
                          <option value="<?php echo $loket->id_loket ?>"><?php echo $loket->nama_loket ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <input type="hidden" name="id_responden" value="<?php echo $id_responden ?>">
                      <label for="formGroupExampleInput">Nama</label>
                      <input type="text" class="form-control" name="nama" required placeholder="nama">
                    </div>
                    <div class="form-group row">
                      <div class="col-md-6">
                        <label for="formGroupExampleInput2">Umur (th)</label>
                        <input type="number" required class="form-control" name="umur" placeholder="Umur (th)">
                      </div>
                      <div class="col-md-6">
                        <label for="formGroupExampleInput2">Jenis Kelamin</label>
                        <select name="jk" required class="form-control">
                         <option value="">--chose--</option>
                         <option value="Laki-laki">Laki-laki</option>
                         <option value="Perempuan">Perempuan</option>
                       </select>
                     </div>
                   </div>
                   <div class="form-group">
                    <label for="formGroupExampleInput2">Pekerjaan</label>
                    <select required name="pekerjaan" class="form-control">
                      <option value="">--chose--</option>
                      <?php foreach ($pekerjaan as $pekerjaan): ?>
                        <option value="<?php echo $pekerjaan->pekerjaan ?>"><?php echo $pekerjaan->pekerjaan ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="formGroupExampleInput2">Pendidikan</label>
                    <select required name="pendidikan" class="form-control">
                      <option value="">--chose--</option>
                      <?php foreach ($pendidikan as $pendidikan): ?>
                        <option value="<?php echo $pendidikan->pendidikan ?>"><?php echo $pendidikan->pendidikan ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <p>
                    <button type="submit" class="btn btn-primary float-right col-md-4">Lanjutkan <i class="fa fa-arrow-circle-right"></i></button>
                  </p>
                </form>
              </div>
            </div>


          </div>
          <div class="col-md-4 pt-4" data-aos="fade-right">
            <img src="<?php echo base_url().'assets/bot/'?>img/details-1.png" class="img-fluid" alt="">
          </div>
        </div>

      </div>
    </section>
    <input type="hidden" id="base" value="<?php echo site_url() ?>">
  </main>
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
  <div id="preloader"></div>

  <?= $this->load->view('sesi/script') ?>
</body>

</html>