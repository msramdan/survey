 <header class="main-header">
  <!-- Logo -->
  <a href="<?php echo site_url('') ?>" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>SKM</b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>SURVEY</b> SKM</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav" >
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
           <img src="<?php echo base_url().'assets/'?>dist/img/app.jpg" class="user-image" alt="User Image">
           <span class="hidden-xs"><?php echo $this->session->userdata('ses_disp'); ?></span>

         </a>
         <ul class="dropdown-menu">
          <!-- User image -->
          <li class="user-header">
           <img src="<?php echo base_url().'assets/'?>dist/img/app.jpg" class="img-circle" alt="User Image">

           <p>
            <span style="font-size: 13px;"><?php echo $this->session->userdata('ses_disp'); ?></span>
            <small>SURVEY SKM</small>
          </p>
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
          <div class="pull-left">
            <a href="<?php echo site_url('admin/edit_admin') ?>" class="btn btn-default btn-flat">Edit</a>
          </div>
          <div class="pull-right">
            <a onclick="return confirm('Keluar Aplikasi?')" href="<?php echo site_url('admin/log_out') ?>" class="btn btn-default btn-flat">Sign out</a>
          </div>
        </li>
      </ul>
    </li>
  </ul>
</div>
</nav>
</header>