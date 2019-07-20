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
      <a href="<?php echo base_url( $this->session->userdata('level') .'/form-edit-profil/' .$this->session->userdata('id') ) ?>" class="btn btn-default mr-2 edit-admin">Profil</a>
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
          <li class="nav-item has-treeview <?php echo ($this->uri->segment(2)=='data-pemesanan-produk' || $this->uri->segment(2)=='data-konfirmasi-pembayaran') ? 'menu-open' : null ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-user"></i>
              <p>
                Transaksi
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url() ?>admin/data-pemesanan-produk" class="nav-link <?php echo ($this->uri->segment(2)=='data-pemesanan-produk') ? 'active' : null ?>">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Pembelian Produk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url() ?>admin/data-konfirmasi-pembayaran" class="nav-link <?php echo ($this->uri->segment(2)=='data-konfirmasi-pembayaran') ? 'active' : null ?>">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Konfirmasi Pembayaran</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview <?php echo ($this->uri->segment(2)=='data-admin' || $this->uri->segment(2)=='data-supplier' || $this->uri->segment(2)=='data-kategori' || $this->uri->segment(2)=='data-produk' || $this->uri->segment(2)=='data-pelanggan' || $this->uri->segment(2)=='data-ongkir' ) ? 'menu-open' : null ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-user"></i>
              <p>
                Master Data
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url() ?>admin/data-supplier" class="nav-link <?php echo ($this->uri->segment(2)=='data-supplier') ? 'active' : null ?>">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Supplier</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url() ?>admin/data-kategori" class="nav-link <?php echo ($this->uri->segment(2)=='data-kategori') ? 'active' : null ?>">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Kategori Produk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url() ?>admin/data-produk" class="nav-link <?php echo ($this->uri->segment(2)=='data-produk') ? 'active' : null ?>">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Produk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url() ?>admin/data-pelanggan" class="nav-link <?php echo ($this->uri->segment(2)=='data-pelanggan') ? 'active' : null ?>">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Pelanggan</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="<?php echo base_url() ?>admin/data-ongkir" class="nav-link <?php echo ($this->uri->segment(2)=='data-ongkir') ? 'active' : null ?>">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Ongkir</p>
                </a>
              </li> -->
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>