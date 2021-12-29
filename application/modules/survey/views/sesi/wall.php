  <section id="hero">
    <div class="container">
      <div class="row">
        <div class="col-lg-7 pt-5 pt-lg-0 order-2 order-lg-1 d-flex align-items-center">
          <div data-aos="zoom-out">
            <?php if ($this->session->flashdata('error')): ?>
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>OPPPS!</strong>  <?php echo $this->session->flashdata('error') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php endif ?>
            <form action="<?php echo site_url('survey/cek_user') ?>" method="post">
             <h3 style="color:#FFF;">IKUTI <span>SURVEY</span></h3>
             <div class="form-group">
              <input type="text" class="form-control" name="noreg" id="noreg" placeholder="NIK KTP"/>
            </div>
            <h2>* Hanya 5 Menit</h2>
            <div class="text-center text-lg-left">
              <button type="submit" id="ikut" class="btn-get-started">Mulai</button>
            </div>
          </form>
        </div>
      </div>
      <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="300">
        <img src="<?php echo base_url().'assets/bot/'?>img/new-hero.png" class="img-fluid animated" alt="">
      </div>
    </div>
  </div>
  <input type="hidden" id="base" value="<?php echo site_url() ?>" />
  <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
    <defs>
      <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
      </defs>
      <g class="wave1">
        <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
        </g>
        <g class="wave2">
          <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
          </g>
          <g class="wave3">
            <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
            </g>
          </svg>

        </section>