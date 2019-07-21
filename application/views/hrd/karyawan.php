  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Informasi Karyawan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url( $this->session->userdata('level') ) ?>">Beranda</a></li>
              <li class="breadcrumb-item active">Informasi Karyawan</li>
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
            <div class="card-header">
              <a href="<?php echo base_url( $this->session->userdata('level') ) ?>/store-karyawan" class="btn btn-default float-right form-add-new" title="Tambah Informasi Karyawan"><i class="fa fa-plus"></i> Add New</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Karyawan</th>
                  <th>Jenis Kelamin</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                //   foreach ($rows as $key => $value) {
                    echo "
                      <tr>
                        <td>{value}</td>
                        <td>{value}</td>
                        <td>{value}</td>
                        <td>
                          <div class='btn-group'>
                            <button type='button' class='btn btn-default'>Action</button>
                            <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                              <span class='caret'></span>
                              <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu' x-placement='top-start' style='position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(67px, -165px, 0px);'>
                              <a class='dropdown-item form-edit' href='".base_url( $this->session->userdata('level') .'/form-edit-karyawan/' )."' title='Edit Informasi Karyawan'>Edit</a>
                            </div>
                          </div>
                        </td>
                      </tr>
                    ";
                //   }
                ?>
                
                </tbody>
              </table>
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
  <!-- /.content-wrapper -->