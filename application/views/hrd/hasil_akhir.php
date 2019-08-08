<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
.ui-datepicker-calendar {
  display: none;
}
</style>
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
  // print_r($bulan_penilaian);
  // echo '</pre>';
  ?>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <!-- /.card-header -->
          <div class="card-body">
            <form class="form-inline" action="">
              <label>Pilih Periode : </label>
              <input name="start_date" id="startDate" class="date-picker form-control ml-3 mr-3" />
              <label>Sampai</label>
              <input name="end_date" id="endDate" class="date-picker form-control ml-3 mr-3" />
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <hr>
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead class="text-center">
                      <?php
                        $th_tahun= '';
                        $tr_bulan= '';
                        $th_bulan= '';
                        foreach ($tahun_penilaian as $key => $value) {
                          $col_tahun= 0;
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
                            <th colspan='2'>Nilai</th>
                            <th rowspan='2'>&nbsp</th>
                          </tr>
                          <tr>
                            {$th_bulan}
                            <th>Total</th>
                            <th>Mean(rata-rata)</th>
                          </tr>
                        ";
                      ?>
                    </thead>
                    <tbody>
                      <?php
                        $no = 1;
                        $tbody= '';
                        foreach ($karyawan as $key => $value) {
                          /* start generate nilai saw perbulan */
                          $tes='';
                          $nilai= $hasil_per_bulan[$value->id_user]['penilaian'];
                          $nilai_total= 0;
                          $nilai_rows= count($nilai);
                          foreach ($nilai as $key_nilai => $value_nilai) {
                            $tes .= '<td>'.$value_nilai['nilai'].'</td>';
                            $nilai_total += $value_nilai['nilai'];
                          }
                          $nilai_mean= ($nilai_total/$nilai_rows);
                          /* end generate nilai saw perbulan */

                          $tbody .= "
                            <tr>
                              <td>{$no}</td>
                              <td>{$value->nama}</td>
                              <td>{$value->nama_divisi}</td>
                              {$tes}
                              <td>{$nilai_total}</td>
                              <td>{$nilai_mean}</td>
                              <td>
                                <div class='btn-group'>
                                  <button type='button' class='btn btn-default'>Action</button>
                                  <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                                    <span class='caret'></span>
                                    <span class='sr-only'>Toggle Dropdown</span>
                                  </button>
                                  <div class='dropdown-menu' role='menu' x-placement='top-start' style='position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(67px, -165px, 0px);'>
                                    <a class='dropdown-item form-load' href='".base_url( $this->session->userdata('level') .'/detail-hasil-akhir/' .$value->id_user)."' title='Detail Hasil Akhir'>Detail Nilai Akhir</a>
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
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>