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
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <form action="<?php echo base_url( $this->session->userdata('level') ) ?>store-penilaian" method="post" id="dataStore">
              <!-- /.card-header -->
              <div class="card-body">
              <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>No</th>
                              <th>Name</th>
                              <th>Divisi</th>
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
                              $form_sub= '';
                              foreach ($kriteria as $key_sub => $value_sub) {
                                $form_sub .= '
                                  <td>
                                      <input required="" value="" type="number" name="id_kriteria_'.$value->id_user.'['.$value_sub->id_kriteria.']" placeholder="0.1 s.d 1" step="0.01" min="0.1" max="1" class="form-control" >
                                  </td>
                                ';
                              }
                              echo '
                                  <tr>
                                      <input class="id_user" name="id_user[]" type="hidden" value="'.$value->id_user.'">
                                      <td>'.$no.'</td>
                                      <td>'.$value->nama.'</td>
                                      <td>'.$value->nama_divisi.'</td>
                                      '.$form_sub.'
                                  </tr>
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