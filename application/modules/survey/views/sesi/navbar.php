  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container d-flex align-items-center">

      <div class="logo mr-auto">
        <h1 class="text-light"><a href="<?php echo site_url().'survey' ?>"><span>Survey Kepuasan Masyarakat</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="<?php echo base_url().'assets/bot/'?>img/logo.png" alt="" class="img-fluid"></a> -->
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="<?php echo site_url().'survey' ?>">Home</a></li>
          <li><a href="#counts">Statistik</a></li>
         <!--  <li><a href="#details">Info</a></li> -->
          <li><a href="#faq">FAQ</a></li>
          <li><a href="#contact">Contact</a></li>
          <?php if ($this->session->userdata('ses_user') != null): ?>
          <li><a href="<?php echo site_url('admin') ?>"><strong>Admin</strong></a></li>
          <?php endif ?>
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->