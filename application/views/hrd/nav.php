<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <div class="navbar-nav ml-auto">
      <a href="<?php echo base_url( $this->session->userdata('level') .'/form-hrd/' .$this->session->userdata('id') ) ?>" class="btn btn-default mr-2 form-load" title="Edit Informasi Profil">Profil</a>
      <a href="<?php echo base_url('auth/logout'); ?>" class="btn btn-default">Logout</a>
      
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
        <i class="fa fa-th-large"></i>
      </a>
    
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url( $this->session->userdata('level') ) ?>" class="brand-link">
      <b>SPK</b>
      <span class="brand-text font-weight-light">JogjaBay</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?php echo base_url( $this->session->userdata('level') ) ?>" class="nav-link <?php echo ( empty($this->uri->segment(2)) ) ? 'active' : null ?>">
              <i class="nav-icon fa fa-user-circle-o"></i>
              <p>
                Beranda
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview <?php echo ($this->uri->segment(2)=='karyawan' || $this->uri->segment(2)=='manajer' || $this->uri->segment(2)=='kategori' || $this->uri->segment(2)=='kriteria' || $this->uri->segment(2)=='divisi')  ? 'menu-open' : null ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-archive"></i>
              <p>
                Master Data
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url( $this->session->userdata('level') ) ?>/manajer" class="nav-link <?php echo ($this->uri->segment(2)=='manajer') ? 'active' : null ?>">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Manajer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url( $this->session->userdata('level') ) ?>/karyawan" class="nav-link <?php echo ($this->uri->segment(2)=='karyawan') ? 'active' : null ?>">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Karyawan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url( $this->session->userdata('level') ) ?>/divisi" class="nav-link <?php echo ($this->uri->segment(2)=='divisi') ? 'active' : null ?>">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Divisi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url( $this->session->userdata('level') ) ?>/kriteria" class="nav-link <?php echo ($this->uri->segment(2)=='kriteria') ? 'active' : null ?>">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Kriteria</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url( $this->session->userdata('level') ) ?>/kategori" class="nav-link <?php echo ($this->uri->segment(2)=='kategori') ? 'active' : null ?>">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Kategori Kriteria</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview <?php echo ($this->uri->segment(2)=='penilaian' || $this->uri->segment(2)=='hasil-akhir')  ? 'menu-open' : null ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-book"></i>
              <p>
                Laporan
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url( $this->session->userdata('level') ) ?>/penilaian" class="nav-link <?php echo ($this->uri->segment(2)=='penilaian') ? 'active' : null ?>">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Penilaian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url( $this->session->userdata('level') ) ?>/hasil-akhir" class="nav-link <?php echo ($this->uri->segment(2)=='hasil-akhir') ? 'active' : null ?>">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Hasil Akhir</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url( $this->session->userdata('level') ) ?>/karyawan-terbaik" class="nav-link <?php echo ($this->uri->segment(2)=='karyawan-terbaik') ? 'active' : null ?>">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Karywan Terbaik</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>