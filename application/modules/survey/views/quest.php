<link rel="stylesheet" href="<?php echo base_url().'assets/' ?>font-awesome/css/font-awesome.min.css">
<script src="<?php echo base_url().'assets/js/' ?>sweetalert2@10.js"></script>
<style type="text/css">
  .row{
    margin-bottom: 20px;
  }
  .form-check-label{
    font-size: 20px;
    margin-left: 10px;
  }

  #lanjut{
    margin-right: 50px;
    width: 150px;
    margin-top: 3%;
  } 

  #reset{
    margin-right: 10px;
    width: 150px;
    color: white;
    margin-top: 3%;
  }

  /* For mobile phones: */
  [class*="col-"] {
    width: 100%;
  }
}
</style>
<?= $this->load->view('sesi/header') ?>

<body>
  <?= $this->load->view('sesi/navbar2')  ?>
  <main id="main">
    <section id="details" class="details" >
      <div class="container"  style="margin-top:3%; ">

        <div class="row content">
          <div class="col-md-8" data-aos="fade-up">
            <div class="card">
             <div class="card-header bg-white" >
               <h3 id="pertanyaan"><?php echo $soal[0]->soal ?></h3>
             </div>
             <div class="card-body">
               <p class="font-italic">
                Pilihan :
              </p>
              <ul>
               <div class="row">
                <div class="col">
                  <div class="form-check form-check-inline">
                    <input required class="form-check-input" type="radio" name="pilihan" id="c1" value="a">
                    <label style="cursor: pointer;" class="form-check-label" for="c1" id="a"><?php echo $soal[0]->a ?></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="pilihan" id="c2" value="b">
                    <label style="cursor: pointer;" class="form-check-label" for="c2" id="b"><?php echo $soal[0]->b ?></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="pilihan" id="c3" value="c">
                    <label style="cursor: pointer;" class="form-check-label" for="c3" id="c"><?php echo $soal[0]->c ?></label>
                  </div>
                </div>
              </div>
              <div class="row mb-4">
                <div class="col">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="pilihan" id="c4" value="d">
                    <label style="cursor: pointer;" class="form-check-label" for="c4" id="d"><?php echo $soal[0]->d ?></label>
                  </div>
                </div>
              </div>
            </ul>
            <p>
              <button id="lanjut" class="btn btn-success float-left" style="margin-right: -5px">Selanjutnya  <i class="fa fa-arrow-circle-right"></i></button>
              <button id="reset" class="btn btn-default float-right" style="color: grey; border : 1px solid grey;">Reset  <i class="fa fa-refresh"></i></button>
            </p>
          </div>
        </div>
      </div>


      <div class="col-md-4" data-aos="fade-right">
        <img src="<?php echo base_url().'assets/bot/'?>img/details-1.png" class="img-fluid" alt="">
      </div>
    </div>

  </div>
</section>
<input type="hidden" id="id_detil" value="<?php echo $id_detil ?>">
<input type="hidden" id="base" value="<?php echo site_url() ?>">
<input type="hidden" id="noreg" value="<?php echo $noreg ?>">
<input type="hidden" id="n_soal" value="<?php echo $nsoal ?>">
<input type="hidden" id="id_soal" value="<?php echo $soal[0]->id_soal ?>">
</main>
<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
<div id="preloader"></div>

<?= $this->load->view('sesi/script') ?>
<script src="<?php echo base_url().'assets/js' ?>/jsku.js"></script>

</body>

</html>