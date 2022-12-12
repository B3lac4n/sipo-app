<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title ?> | UPT Puskesmas Keritang Hulu</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url() ?>/public/vendor/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= base_url() ?>/public/vendor/adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?= base_url() ?>/public/vendor/adminlte/plugins/toastr/toastr.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url() ?>/public/vendor/adminlte/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/public/vendor/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url() ?>/public/vendor/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url() ?>/public/vendor/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/public/vendor/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/public/vendor/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= base_url() ?>/public/vendor/adminlte/plugins/jqvmap/jqvmap.min.css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>/public/vendor/adminlte/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link
    rel="stylesheet"
    href="<?= base_url() ?>/public/vendor/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css"
  />
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?= base_url() ?>/public/vendor/adminlte/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url() ?>/public/vendor/adminlte/plugins/summernote/summernote-bs4.min.css" />
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-success navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
          <a href="/" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li> -->
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>

        <!-- profile options -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-user"></i>
            <span class="badge badge-warning navbar-badge"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="<?= base_url('/pengguna/profil/' . user()->id) ?>" class="dropdown-item">
              <i class="fas fa-user mr-2"></i> Profil Saya
            </a>
            <div class="dropdown-divider"></div>
            <a href="<?= base_url('logout') ?>" class="dropdown-item">
              <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-success elevation-4">
      <!-- Brand Logo -->
      <a href="<?= base_url('/') ?>" class="brand-link">
        <img src="<?= base_url() ?>/public/assets/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SI PERSEDIAAN OBAT</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?= base_url() ?>/public/assets/img/user.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <span class="d-block text-uppercase"><?= user()->fullname ?></span>
            <!-- <a href="#" class="d-block">ADMINISTRATOR</a> -->
          </div>
        </div>

        <?= $this->include('layout/sidebar-menu') ?>
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <?= $this->renderSection('content') ?>
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
      </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- Default to the left -->
      <strong>Copyright &copy; 2022 Sistem Informasi Persediaan Obat.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="<?= base_url() ?>/public/vendor/adminlte/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?= base_url() ?>/public/vendor/adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
  <script>
    $.widget.bridge("uibutton", $.ui.button);=
  </script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>/public/vendor/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="<?= base_url() ?>/public/vendor/adminlte/plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="<?= base_url() ?>/public/vendor/adminlte/plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="<?= base_url() ?>/public/vendor/adminlte/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="<?= base_url() ?>/public/vendor/adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?= base_url() ?>/public/vendor/adminlte/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- jquery-validation -->
  <script src="<?= base_url() ?>/public/vendor/adminlte/plugins/jquery-validation/jquery.validate.min.js"></script>
  <script src="<?= base_url() ?>/public/vendor/adminlte/plugins/jquery-validation/additional-methods.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="<?= base_url() ?>/public/vendor/adminlte/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toastr -->
  <script src="<?= base_url() ?>/public/vendor/adminlte/plugins/toastr/toastr.min.js"></script>
  <!-- Select2 -->
  <script src="<?= base_url() ?>/public/vendor/adminlte/plugins/select2/js/select2.full.min.js"></script>
  <!-- InputMask -->
  <script src="<?= base_url() ?>/public/vendor/adminlte/plugins/moment/moment.min.js"></script>
  <script src="<?= base_url() ?>/public/vendor/adminlte/plugins/inputmask/jquery.inputmask.min.js"></script>
  <!-- date-range-picker -->
  <script src="<?= base_url() ?>/public/vendor/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?= base_url() ?>/public/vendor/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="<?= base_url() ?>/public/vendor/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>/public/vendor/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>/public/vendor/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url() ?>/public/vendor/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>/public/vendor/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= base_url() ?>/public/vendor/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>/public/vendor/adminlte/plugins/jszip/jszip.min.js"></script>
  <script src="<?= base_url() ?>/public/vendor/adminlte/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?= base_url() ?>/public/vendor/adminlte/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?= base_url() ?>/public/vendor/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?= base_url() ?>/public/vendor/adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?= base_url() ?>/public/vendor/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  
  <!-- Summernote -->
  <script src="<?= base_url() ?>/public/vendor/adminlte/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?= base_url() ?>/public/vendor/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>/public/vendor/adminlte/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE dashboard demo -->
  <script src="<?= base_url() ?>/public/vendor/adminlte/dist/js/pages/dashboard.js"></script>
  <script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })

      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    })

    //Date picker
    $('#tgl_dokumen').datetimepicker({
        format: 'YYYY-MM-DD',
        defaultDate: new Date(),
        locale: 'id'
    });
  </script>

  <?= $this->renderSection('scripts') ?>
</body>
</html>
