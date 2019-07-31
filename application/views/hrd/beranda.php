  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="bg-success" style="padding: 20px 30px; z-index: 999999; font-size: 16px; font-weight: 600;">
      <a href="" style="color: rgba(255, 255, 255, 0.9); display: inline-block; margin-right: 10px; text-decoration: none;"><b>Info !</b> Selamat Datang di Sistem Penilaian Karyawan JogjaBay</a>
    </div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $count_karyawan ?></h3>

                <p>Informasi Karyawan</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-contacts"></i>
              </div>
              <a href="<?php echo base_url( $this->session->userdata('level') ) ?>/karyawan" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $count_kriteria ?></h3>

                <p>Informasi Kriteria</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-list"></i>
              </div>
              <a href="<?php echo base_url( $this->session->userdata('level') ) ?>/kriteria" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $count_total ?></h3>

                <p>Total Penilaian</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-done-all"></i>
              </div>
              <a href="<?php echo base_url( $this->session->userdata('level') ) ?>/penilaian" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $count_bulan ?></h3>

                <p>Penilaian Bulan Ini</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-alarm-clock"></i>
              </div>
              <a href="<?php echo base_url( $this->session->userdata('level') ) ?>/penilaian" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>