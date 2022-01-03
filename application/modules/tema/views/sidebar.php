<?php 
$menu_admin = ['pertanyaan', 'publish','saran'];
$menu_news  = ['news', 'faq'];
$menu_instansi = ['loket', 'kategori_instansi','bidang_instansi'];
?>


<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url().'assets/'?>dist/img/app.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $this->session->userdata('ses_disp') ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i>Online</a>

      </div>
    </div>
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header" style="color:black">MENU UTAMA</li>
      <!-- <li>
        <a href="<?php echo site_url('admin') ?>">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li> -->
      <li <?php echo $menu=='home' ? 'class="active"' : '' ?>>
          <a href="<?php echo site_url('home') ?>" id="cetak">
            <i class="fa fa-home fa-black"></i>
            <span>Home</span>
          </a>
        </li>

      <li class="treeview" >
        <a href="#">
          <i class="fa fa-tasks fa-black"></i>
          <span>Survey</span>
        </a>
        <ul class="treeview-menu" <?php if(in_array($menu, $menu_admin , true)) {echo 'style="display : block"';} ?> >
          <li <?php echo $menu=='pertanyaan' ? 'class="active"' : '' ?>><a href="<?php echo site_url('admin/pertanyaan') ?>"><i class="fa  fa-edit"></i>Pertanyaan</a></li>
          <li <?php echo $menu=='publish' ? 'class="active"' : '' ?>><a href="<?php echo site_url('admin/publish') ?>"><i class="fa fa-send"></i>Publish</a></li>
          <li <?php echo $menu=='saran' ? 'class="active"' : '' ?>><a href="<?php echo site_url('admin/saran') ?>"><i class="fa fa-file"></i>Kritik dan Saran</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-bullhorn fa-black"></i>
          <span>News & FAQ</span>
        </a>
        <ul id="menu_surat" class="treeview-menu" <?php if(in_array($menu, $menu_news , true)) {echo 'style="display : block"';} ?>>
          <li <?php echo $menu=='news' ? 'class="active"' : '' ?>><a href="<?php echo site_url('news/index') ?>"><i class="fa fa-rss-square"></i>News</a></li>
          <li <?php echo $menu=='faq' ? 'class="active"' : '' ?>><a href="<?php echo site_url('news/FAQ') ?>"><i class="fa  fa-question"></i>FAQ</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-bank fa-black"></i>
          <span>Daftar Instansi</span>
        </a>
        <ul id="menu_surat" class="treeview-menu" <?php if(in_array($menu, $menu_instansi , true)) {echo 'style="display : block"';} ?>>
        <li <?php echo $menu=='kategori_instansi' ? 'class="active"' : '' ?>><a href="<?php echo site_url('kategori_instansi') ?>"><i class="fa fa-circle-o"></i>Kategori Instansi</a></li>  
        <li <?php echo $menu=='loket' ? 'class="active"' : '' ?>><a href="<?php echo site_url('loket') ?>"><i class="fa fa-circle-o"></i>Instansi</a></li>
        <li <?php echo $menu=='bidang_instansi' ? 'class="active"' : '' ?>><a href="<?php echo site_url('bidang_instansi') ?>"><i class="fa fa-circle-o"></i>Bidang Instansi</a></li>
          
        </ul>
      </li>
        
      
    </section>
    <!-- /.sidebar -->
  </aside>