
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>HRD</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="themes/adminlte/code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="themes/adminlte/adminlte.io/themes/dev/adminlte/dist/css/adminlte.min.css?v=0.2">
  <!-- iCheck -->
  <link rel="stylesheet" href="themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/datatables/dataTables.bootstrap4.css">
  <!-- jQuery -->
  <script src="themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/jquery/jquery.min.js"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapperX">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <form action="result.php" method="post">
                <!-- /.card-header -->
                <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Divisi</th>
                                <th>Attitude</th>
                                <th>Grooming</th>
                                <th>Ketelitian</th>
                                <th>Service Excellent</th>
                                <th>Personal Selling</th>
                                <th>Kerjasama Tim</th>
                                <th>Kedisiplinan</th>
                                <th>Kejujuran</th>
                                <th>Inisiatif</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $data =[
                                    [
                                        'id_user'       => 1,
                                        'nama'          => 'Karyawan 1',
                                        'nama_divisi'   => 'Pramuniaga',
                                    ],
                                    [
                                        'id_user'       => 2,
                                        'nama'          => 'Karyawan 2',
                                        'nama_divisi'   => 'Kasir',
                                    ],
                                    [
                                        'id_user'       => 3,
                                        'nama'          => 'Karyawan 3',
                                        'nama_divisi'   => 'Security',
                                    ],
                                    [
                                        'id_user'       => 4,
                                        'nama'          => 'Karyawan 4',
                                        'nama_divisi'   => 'Logistik',
                                    ],
                                ];
                                foreach ($data as $key => $value) {
                                    echo '
                                        <tr>
                                            <input class="id_user" name="id_user[]" type="hidden" value="'.$value['id_user'].'">
                                            <td>Karyawan 1</td>
                                            <td>Pramuniaga</td>
                                            <td>
                                                <input required="" value="0.5" type="number" name="id_kriteria_'.$value['id_user'].'[1]" placeholder="0.1 s.d 1" step="0.1" min="0.1" max="1" class="form-control" >
                                            </td>
                                            <td>
                                                <input required="" value="0.5" type="number" name="id_kriteria_'.$value['id_user'].'[2]" placeholder="0.1 s.d 1" step="0.1" min="0.1" max="1" class="form-control" >
                                            </td>
                                            <td>
                                                <input required="" value="0.5" type="number" name="id_kriteria_'.$value['id_user'].'[3]" placeholder="0.1 s.d 1" step="0.1" min="0.1" max="1" class="form-control" >
                                            </td>
                                            <td>
                                                <input required="" value="0.5" type="number" name="id_kriteria_'.$value['id_user'].'[4]" placeholder="0.1 s.d 1" step="0.1" min="0.1" max="1" class="form-control" >
                                            </td>
                                            <td>
                                                <input required="" value="0.5" type="number" name="id_kriteria_'.$value['id_user'].'[5]" placeholder="0.1 s.d 1" step="0.1" min="0.1" max="1" class="form-control" >
                                            </td>
                                            <td>
                                                <input required="" value="0.5" type="number" name="id_kriteria_'.$value['id_user'].'[6]" placeholder="0.1 s.d 1" step="0.1" min="0.1" max="1" class="form-control" >
                                            </td>
                                            <td>
                                                <input required="" value="0.5" type="number" name="id_kriteria_'.$value['id_user'].'[7]" placeholder="0.1 s.d 1" step="0.1" min="0.1" max="1" class="form-control" >
                                            </td>
                                            <td>
                                                <input required="" value="0.5" type="number" name="id_kriteria_'.$value['id_user'].'[8]" placeholder="0.1 s.d 1" step="0.1" min="0.1" max="1" class="form-control" >
                                            </td>
                                            <td>
                                                <input required="" value="0.5" type="number" name="id_kriteria_'.$value['id_user'].'[9]" placeholder="0.1 s.d 1" step="0.1" min="0.1" max="1" class="form-control" >
                                            </td>
                                        </tr>
                                    ';
                                }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Divisi</th>
                                <th>Attitude</th>
                                <th>Grooming</th>
                                <th>Ketelitian</th>
                                <th>Service Excellent</th>
                                <th>Personal Selling</th>
                                <th>Kerjasama Tim</th>
                                <th>Kedisiplinan</th>
                                <th>Kejujuran</th>
                                <th>Inisiatif</th>
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
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<!-- DataTables -->
<script src="themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="themes/adminlte/code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Morris.js charts -->
<script src="themes/adminlte/cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="themes/adminlte/cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="themes/adminlte/adminlte.io/themes/dev/adminlte/dist/js/adminlte.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#example1').DataTable({
            columnDefs: [{
                orderable: false,
                // targets: [1,2,3]
            }]
        });
    
        // $('form').on('submit', function() {
        //     // var data = table.$('input, select').serialize();
        //     var data = table.$('input').serializeArray();
        //     console.log(data)
        //     // var post=[];
        //     $.each($('tbody tr'),function(i,item){
        //         console.log(item.name==`row-`? '1': '0')
        //     })
        //     return false;
        // } );

        function inputValidation()
        {
            
        }

    } );
</script>
</body>

</html>