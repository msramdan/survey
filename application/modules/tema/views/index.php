  <?php 
  $this->load->view('header');
  $this->load->view('sidebar');
  ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <input type="hidden" id="base" value="<?php echo site_url() ?>">
      <h1>
        <?php echo $title ?>
        <small><?php echo $sub ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa <?php echo $icon ?>"></i> <?php echo $title ?></a></li>
        <li class="active"><?php echo $sub ?></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
     <?php if($this->session->flashdata('success')){ ?>  
       <div class="alert alert-success alert-dismissible fade in"> 
        <a class="close" data-dismiss="alert" aria-label="close">&times;</a> 
        <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>  
        </div><?php } else if($this->session->flashdata('error')){ ?>  
          <div class="alert alert-danger alert-dismissible fade in">  
            <a class="close" data-dismiss="alert" aria-label="close">&times;</a> 
            <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>  
          </div>  
        <?php } else if($this->session->flashdata('warning')){?> 
          <div class="alert alert-warning alert-dismissible fade in">  
            <a class="close" data-dismiss="alert" aria-label="close">&times;</a> 
            <strong>warning!</strong> <?php echo $this->session->flashdata('warning'); ?>  
          </div>  
        <?php } ?>
        <?php echo $contents ?>
      </section>
      <!-- /.content -->
    </div>
    <?php 

    $this->load->view('right_pane');
    $this->load->view('footer');
    $this->load->view('script_js');
    ?>



