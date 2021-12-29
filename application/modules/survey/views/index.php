<?php $this->load->view('sesi/header') ?>

<body>

<?php $this->load->view('sesi/navbar')  ?>
<?php $this->load->view('sesi/wall') ?>

  <main id="main">
<?php $this->load->view('sesi/count') ?>
<?php $this->load->view('sesi/presentase_pie') ?>
<?php $this->load->view('sesi/statistik') ?>
<?php //$this->load->view('sesi/detil') ?>
<?php $this->load->view('sesi/faq') ?>
<?php $this->load->view('sesi/contact') ?>
  </main>
<?php $this->load->view('sesi/footer') ?>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
  <div id="preloader"></div>

<?php $this->load->view('sesi/script') ?>
<script src="<?php echo base_url().'assets/js' ?>/wall.js"></script>

</body>

</html>