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
                      <thead class="text-center">
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
                            $th_tahun .= "<th colspan='{$col_tahun}'>Tahun {$value->tahun_penilaian}</th>";
                          }

                          echo "
                            <tr>
                              <th rowspan='2'>No</th>
                              <th rowspan='2'>Name</th>
                              <th rowspan='2'>Divisi</th>
                              {$th_tahun}
                              <th rowspan='2'>&nbsp</th>
                            </tr>
                            <tr>
                              {$th_bulan}
                            </tr>
                          ";
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
                                <td>0.7(contoh)</td>
                                <td>0.8(contoh)</td>
                                <td>
                                  <div class='btn-group'>
                                    <button type='button' class='btn btn-default'>Action</button>
                                    <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                                      <span class='caret'></span>
                                      <span class='sr-only'>Toggle Dropdown</span>
                                    </button>
                                    <div class='dropdown-menu' role='menu' x-placement='top-start' style='position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(67px, -165px, 0px);'>
                                      <a class='dropdown-item form-load' href='".base_url( $this->session->userdata('level') .'/detail-hasil-akhir/' .$value->id_user)."' title='Edit Informasi Karyawan'>Edit</a>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                            ";
                            $no++;
                          }
                          echo $tbody;
                        ?>
                      </tbody>
                      <!-- <tfoot>
                        <tr>
                          <th>No</th>
                          <th>Name</th>
                          <th>Divisi</th>
                          <th>Tanggal&nbspPenilaian</th>
                        </tr>
                      </tfoot> -->
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