<div class="content-wrapper">
  <div class="bg-success" style="padding: 20px 30px; z-index: 999999; font-size: 16px; font-weight: 600;">
    <a href="" style="color: rgba(255, 255, 255, 0.9); display: inline-block; margin-right: 10px; text-decoration: none;"><b>Info Histori Penilaian !</b> Belum Pernah Ada Penilaian</a>
  </div>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Penilaian Karyawan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url( $this->session->userdata('level') ) ?>">Beranda</a></li>
            <li class="breadcrumb-item active">Penilaian Karyawan</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <?php
  echo '<pre>';
  print_r($karyawan);
  print_r($kriteria);
  print_r($penilaian);
  print_r($duplicate);
  echo '</pre>';
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
                  <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>No</th>
                              <th>Name</th>
                              <th>Divisi</th>
                              <th>Tanggal&nbspPenilaian</th>
                              <?php
                                $thead= '';
                                foreach ($kriteria as $key => $value) {
                                  $thead .= '
                                    <th style="min-width: 120px">'.$value->nama_kriteria.'</th>
                                  ';
                                }
                                echo $thead;
                              ?>
                          </tr>
                      </thead>
                      <tbody>
                          <?php
                            $no= 1;
                            foreach ($karyawan as $key => $value) {
                              $count_duplicate= count($duplicate);
                              $next_td= '';
                              foreach ($duplicate as $key_duplicate => $value_duplicate) {
                                if ( $key_duplicate==0 ) {
                                  $next_td .= '<td>'.$duplicate->tanggal_indo.'</td>';
                                  foreach ($kriteria as $key_kriteria => $value_kriteria) {
                                    foreach ($penilaian as $key_penilaian => $value_penilaian) {
                                      if ( ($value_penilaian->id_user==$value->id_user) && ($value_penilaian->id_kriteria==$value_kriteria->id_kriteria) && $value_penilaian->tanggal==$value_duplicate->tanggal )
                                      $next_td .= '<td>'.$value_penilaian->nilai.'</td>';
                                    }
                                  }
                                  $next_td .= '</tr>';
                                  
                                } else {
                                  $next_td .= '<tr>';
                                  $next_td .= '<td>'.$duplicate->tanggal_indo.'</td>';
                                  foreach ($kriteria as $key_kriteria => $value_kriteria) {
                                    foreach ($penilaian as $key_penilaian => $value_penilaian) {
                                      if ( ($value_penilaian->id_user==$value->id_user) && ($value_penilaian->id_kriteria==$value_kriteria->id_kriteria) && $value_penilaian->tanggal==$value_duplicate->tanggal )
                                      $next_td .= '<td>'.$value_penilaian->nilai.'</td>';
                                    }
                                  }
                                  $next_td .= '</tr>';
                                }
                                
                              }
                              echo '
                                <tr>
                                  <td rowspan="'.$count_duplicate.'">'.$no.'</td>
                                  <td rowspan="'.$count_duplicate.'">'.$value->nama.'</td>
                                  <td rowspan="'.$count_duplicate.'">'.$value->nama_divisi.'</td>
                                  '.$next_td.'
                              ';
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
                          <?php echo $thead; ?>
                        </tr>
                      </tfoot>
                  </table>
              </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <button type="submit" class="btn btn-primary float-right" >Simpan Penilaian</button>
              </div>
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