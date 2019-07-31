<div class="content-wrapper">
  <div class="bg-success" style="padding: 20px 30px; z-index: 999999; font-size: 16px; font-weight: 600;">
    <a href="" style="color: rgba(255, 255, 255, 0.9); display: inline-block; margin-right: 10px; text-decoration: none;"><h2><span class="badge badge-light">Laporan Hasil Penilaian Bulan: <?php echo "{$start_end_penilaian->start_bulan} {$start_end_penilaian->start_tahun} s.d {$start_end_penilaian->end_bulan} {$start_end_penilaian->end_tahun} " ?></span></h2></a>
  </div>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Laporan Penilaian Karyawan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url( $this->session->userdata('level') ) ?>">Beranda</a></li>
            <li class="breadcrumb-item active">Laporan Penilaian Karyawan</li>
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
                                <th>'.$value->nama_kriteria.'</th>
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
                          // $count_duplicate= count($duplicate);
                          // $next_td= '';
                          // foreach ($duplicate as $key_duplicate => $value_duplicate) {
                          //   if ( $key_duplicate==0 ) {
                          //     $next_td .= '<td>'.$value_duplicate->tanggal_mod.'</td>';
                          //     foreach ($kriteria as $key_kriteria => $value_kriteria) {
                          //       foreach ($penilaian as $key_penilaian => $value_penilaian) {
                          //         if ( ($value_penilaian->id_user==$value->id_user) && ($value_penilaian->id_kriteria==$value_kriteria->id_kriteria) && $value_penilaian->tanggal==$value_duplicate->tanggal )
                          //         $next_td .= '<td>'.$value_penilaian->nilai.'</td>';
                          //       }
                          //     }
                          //     $next_td .= '</tr>';
                              
                          //   } else {
                          //     $next_td .= '<tr>';
                          //     $next_td .= '<td>'.$value_duplicate->tanggal_mod.'</td>';
                          //     foreach ($kriteria as $key_kriteria => $value_kriteria) {
                          //       foreach ($penilaian as $key_penilaian => $value_penilaian) {
                          //         if ( ($value_penilaian->id_user==$value->id_user) && ($value_penilaian->id_kriteria==$value_kriteria->id_kriteria) && $value_penilaian->tanggal==$value_duplicate->tanggal )
                          //         $next_td .= '<td>'.$value_penilaian->nilai.'</td>';
                          //       }
                          //     }
                          //     $next_td .= '</tr>';
                          //   }
                            
                          // }
                          // echo '
                          //   <tr>
                          //     <td rowspan="'.$count_duplicate.'">'.$no.'</td>
                          //     <td rowspan="'.$count_duplicate.'">'.$value->nama.'</td>
                          //     <td rowspan="'.$count_duplicate.'">'.$value->nama_divisi.'</td>
                          //     '.$next_td.'
                          // ';
                          // $no++;

                          $next_td= '';
                          foreach ($duplicate as $key_duplicate => $value_duplicate) {
                            $next_td .= '<tr>';
                            $next_td .= '<td>'.$no.'</td>';
                            $next_td .= '<td>'.$value->nama.'</td>';
                            $next_td .= '<td>'.$value->nama_divisi.'</td>';
                            $next_td .= '<td>'.$value_duplicate->tanggal_mod.'</td>';
                            foreach ($kriteria as $key_kriteria => $value_kriteria) {
                              $id_kriteria=[];
                              foreach ($penilaian as $key_penilaian => $value_penilaian) {
                                if ( ($value_penilaian->id_user==$value->id_user) && ($value_penilaian->id_kriteria==$value_kriteria->id_kriteria) && $value_penilaian->tanggal==$value_duplicate->tanggal ){
                                  $next_td .= '<td>'.$value_penilaian->nilai.'</td>';
                                  array_push($id_kriteria,$value_penilaian->id_kriteria);
                                }
                              }
                              if ( ! in_array($value_kriteria->id_kriteria,$id_kriteria) ) {
                                $next_td .= '<td>-</td>';
                              }
                            }
                            $next_td .= '</tr>';
                            $no++;
                          }
                          echo $next_td;
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
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>