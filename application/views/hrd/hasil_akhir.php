<div class="content-wrapper">
  <!-- <div class="bg-success" style="padding: 20px 30px; z-index: 999999; font-size: 16px; font-weight: 600;">
    <a href="" style="color: rgba(255, 255, 255, 0.9); display: inline-block; margin-right: 10px; text-decoration: none;"><b>Info Histori Penilaian !</b> Belum Pernah Ada Penilaian</a>
  </div> -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Laporan Hasil Akhir Penilaian</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url( $this->session->userdata('level') ) ?>">Beranda</a></li>
            <li class="breadcrumb-item active">Laporan Hasil Akhir Penilaian</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <?php
  // echo '<pre>';
  // print_r($karyawan);
  // print_r($kriteria);
  // print_r($penilaian);
  // print_r($duplicate);
  // echo '</pre>';
  ?>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <form action="<?php echo base_url( $this->session->userdata('level') ) ?>/store-penilaian" method="post" class="data-store">
              <!-- /.card-header -->
              <div class="card-body">
              <div class="table-responsive">
                  <table id="example1X" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Name</th>
                          <th>Divisi</th>
                          <th>Bulan</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $no = 1;
                          $tbody= '';
                          foreach ($karyawan as $key => $value) {
                            $tbody .= "
                              <tr>
                                <td>{$no}</td>
                                <td>{$value->nama}</td>
                                <td>{$value->nama_divisi}</td>
                                <td>{$value->nama_divisi}</td>
                              </tr>
                            ";
                            $no++;
                          }
                        ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>No</th>
                          <th>Name</th>
                          <th>Divisi</th>
                          <th>Tanggal&nbspPenilaian</th>
                        </tr>
                      </tfoot>
                  </table>
              </div>
              </div>
              <!-- /.card-body -->
          </form>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>