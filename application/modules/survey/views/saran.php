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

</style>
<?= $this->load->view('sesi/header') ?>

<body>
  <?= $this->load->view('sesi/navbar2')  ?>
  <main id="main">
    <section id="details" class="details" >
      <div class="container"  style="margin-top:3%; ">
        <div class="row content">
          <div class="col-md-8 pt-4" data-aos="fade-up">
            <p class="font-italic">
              Saran :
            </p>
            <div class="row">
              <input type="hidden" id="id_responden" value="<?php echo $responden ?>">
              <textarea name="saran" id="tx_saran" class="form-control" rows="5"></textarea>
            </div>
            <p>
              <button id="saran" class="btn btn-success float-right"> Selesai<i class="fa fa-arrow-circle-right"></i></button>
            </p>
          </div>
          <div class="col-md-4" data-aos="fade-right">
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
  <script src="<?php echo base_url().'assets/js' ?>/js_saran.js"></script>

</body>

</html>