  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Informasi Karyawan Terbaik</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url( $this->session->userdata('level') ) ?>">Beranda</a></li>
              <li class="breadcrumb-item active">Informasi Karyawan Terbaik</li>
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
            <!-- /.card-header -->
            <div class="card-body">
            <div class="row">
							<div class="col-md-6">
								<!-- Widget: user widget style 1 -->
								<div class="card card-widget widget-user">
									<!-- Add the bg color to the header using any of the bg-* classes -->
									<div class="widget-user-header bg-info-active">
										<h3 class="widget-user-username"><?php echo $total['nama'].' ('.$total['nama_divisi'].')' ?></h3>
										<h5 class="widget-user-desc">Karyawan dengan total nilai terbaik</h5>
									</div>
									<div class="card-footer">
										<div class="row">
											<div class="col-sm-5 border-right">
												<div class="description-block">
													<h5 class="description-header"><?php echo $total['total_penilaian'] ?></h5>
													<span class="description-text">Total</span>
												</div>
												<!-- /.description-block -->
											</div>
											<!-- /.col -->
											<div class="col-sm-5 border-right">
												<div class="description-block">
													<h5 class="description-header"><?php echo $total['mean'] ?></h5>
													<span class="description-text">Mean</span>
												</div>
												<!-- /.description-block -->
											</div>
											<!-- /.col -->
											<div class="col-sm-2 border-right">
												<div class="description-block">
													<?php echo "<a class='btn btn-primary form-load' href='".base_url( $this->session->userdata('level') .'/detail-hasil-akhir/' .$value->id_user)."' title='Detail Hasil Akhir'>Detail Nilai Akhir</a>" ?>
												</div>
												<!-- /.description-block -->
											</div>
											<!-- /.col -->
										</div>
										<!-- /.row -->
									</div>
								</div>
								<!-- /.widget-user -->
							</div>
							<!-- /.col -->
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
  <!-- /.content-wrapper -->