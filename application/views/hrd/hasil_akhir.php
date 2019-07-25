<div class="content-wrapper">
  <div class="bg-success" style="padding: 20px 30px; z-index: 999999; font-size: 16px; font-weight: 600;">
    <a href="" style="color: rgba(255, 255, 255, 0.9); display: inline-block; margin-right: 10px; text-decoration: none;"><h2><span class="badge badge-light">Laporan Hasil Akhir Penilaian Bulan: <?php echo "{$start_end_penilaian->start_bulan} {$start_end_penilaian->start_tahun} s.d {$start_end_penilaian->end_bulan} {$start_end_penilaian->end_tahun} " ?></span></h2></a>
  </div>
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
                          <th rowspan="4">No</th>
                          <th rowspan="4">Name</th>
                          <th rowspan="4">Divisi</th>
                          <th colspan="<?php echo count($bulan_penilaian) ?>">Tahun</th>
                        </tr>

                        <?php
                          $th_tahun= '';
                          $tr_bulan= '';
                          $th_bulan= '';
                          foreach ($tahun_penilaian as $key => $value) {
                            $col_tahun= 1;
                            foreach ($bulan_penilaian as $key_bulan => $value_bulan) {
                              if ( $value_bulan->tahun_penilaian==$value->tahun_penilaian ) {
                                $col_tahun++;
                              }
                              $th_bulan .= "<th>{$value_bulan->bulan_penilaian}</th>";
                            }
                            $th_tahun .= "<th colspan='{$col_tahun}'>{$value->tahun_penilaian}</th>";
                            $tr_bulan .= "<tr><th colspan='{$col_tahun}'>Bulan</th></tr>";
                          }
                          echo "<tr>{$th_tahun}</tr>";
                          echo "{$tr_bulan}";
                          echo "<tr>{$th_bulan}</tr>";
                        ?>
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
                          echo $tbody;
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