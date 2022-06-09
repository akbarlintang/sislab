<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $pageTitle; ?></title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <!-- Bootstrap 3.3.4 -->
  <link href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- FontAwesome 4.3.0 -->
  <link href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <!-- Ionicons 2.0.0 -->
  <link href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css" rel="stylesheet" type="text/css" />
  <!-- Theme style -->
  <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
  <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
  <link href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
  <style>
    .error {
      color: red;
      font-weight: normal;
    }
  </style>
  <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
  <script type="text/javascript">
    var baseURL = "<?php echo base_url(); ?>";
  </script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="<?php echo base_url(); ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <!-- <span class="logo-mini"><b>CI</b>AS</span> -->
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>SISLAB</b>-MPOK SITI</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown tasks-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                <i class="fa fa-history"></i>
              </a>

              <ul class="dropdown-menu">
                <li class="header"> Last Login : <i class="fa fa-clock-o"></i> <?= empty($last_login) ? "First Time Login" : $last_login; ?></li>
              </ul>
            </li>
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?php echo base_url(); ?>assets/dist/img/avatar.png" class="user-image" alt="User Image" />
                // <span class="hidden-xs"><?php echo $name; ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">

                  <img src="<?php echo base_url(); ?>assets/dist/img/avatar.png" class="img-circle" alt="User Image" />
                  <p>
                    <?php echo $name; ?>
                    <small><?php echo $role; ?></small>
                  </p>

                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?php echo base_url(); ?>profile" class="btn btn-warning btn-flat"><i class="fa fa-user-circle"></i> Profil </a>
                  </div>
                  <div class="pull-right">
                    <a href="<?php echo base_url(); ?>logout" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Log Out </a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>
          <li>
            <a href="<?php echo base_url(); ?>dashboard">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
            </a>
          </li>

          <?php
          if ($role == ROLE_ADMIN || $role == ROLE_MANAGER) {
          ?>
            <li>
              <a href="<?php echo base_url(); ?>Permohonanlab">
                <i class="fa fa-ticket"></i>
                <span>Permohonan</span>
              </a>
            </li>
          <?php } ?>

          <li>
            <a href="<?php echo base_url(); ?>Penilaian">
              <i class="fa fa-ticket"></i>
              <span>Penilaian</span>
            </a>
          </li>


          <?php
          if ($role == ROLE_ADMIN || $role == ROLE_MANAGER) {
          ?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>Referensi</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <!-- <li><a href="<?php echo base_url(); ?>Parameteruji"><i class="fa fa-circle-o"></i>Parameter Uji</a></li> -->
                <!-- <li><a href="<?php echo base_url(); ?>Petugas"><i class="fa fa-circle-o"></i>Petugas</a></li> -->
                <!-- <li><a href="<?php echo base_url(); ?>Pelanggan"><i class="fa fa-circle-o"></i>Pelanggan</a></li> -->
                <li><a href="<?php echo base_url(); ?>Settinglhu"><i class="fa fa-circle-o"></i>Setting LHU</a></li>
                <!-- <li><a href="<?php echo base_url(); ?>Masterppk"><i class="fa fa-circle-o"></i>Transfer LHU</a></li> -->
                <!-- <li><a href="<?php echo base_url(); ?>Ruanglingkup"><i class="fa fa-circle-o"></i>Ruang Lingkup</a></li> -->
                <!-- <li><a href="<?php echo base_url(); ?>pelanggan/daftarPelanggan"><i class="fa fa-circle-o"></i>Pelanggan</a></li> -->
                <li><a href="<?php echo base_url(); ?>wadah/daftarWadah"><i class="fa fa-circle-o"></i>Wadah</a></li>
                <li><a href="<?php echo base_url(); ?>bentuk/daftarBentuk"><i class="fa fa-circle-o"></i>Bentuk</a></li>
                <li><a href="<?php echo base_url(); ?>trader/daftarTrader"><i class="fa fa-circle-o"></i>Trader</a></li>
                <li><a href="<?php echo base_url(); ?>pegawai/daftarPegawai"><i class="fa fa-circle-o"></i>Pegawai</a></li>
                <li><a href="<?php echo base_url(); ?>panelis/daftarPanelis"><i class="fa fa-circle-o"></i>Panelis</a></li>
                <li><a href="<?php echo base_url(); ?>organoleptik/daftarOrganoleptik"><i class="fa fa-circle-o"></i>Organoleptik</a></li>
                <!--<li><a href="<?php echo base_url(); ?>laporan_hasil"><i class="fa fa-circle-o"></i>LHUS</a></li>
                <li><a href="<?php echo base_url(); ?>ikan/daftarIkan"><i class="fa fa-circle-o"></i>Ikan</a></li> -->
                <li><a href="<?php echo base_url(); ?>kode_asal/daftarKode_asal"><i class="fa fa-circle-o"></i>Kode Asal Sampel</a></li>
                <li><a href="<?php echo base_url(); ?>permintaan_uji/daftarPermintaan_uji"><i class="fa fa-circle-o"></i>Permintaan Uji</a></li>

              </ul>
            </li>
            <!-- <li>
              <a href="<?php echo base_url(); ?>Laporanuji">
                <i class="fa fa-ticket"></i>
                <span>Laporan Hasil Uji</span>
              </a>
            </li> -->
            <!-- <li>
              <a href="<?php echo base_url(); ?>SKHS" >
                <i class="fa fa-ticket"></i>
                <span>SKH. Survailance</span>
              </a>
            </li> -->

          <?php
          }
          if ($role == ROLE_ADMIN) {
          ?>
            <!-- <li>
              <a href="<?php echo base_url(); ?>userListing">
                <i class="fa fa-users"></i>
                <span>Users</span>
              </a>
            </li> -->
            <!-- <li>
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Reports</span>
              </a>
            </li> -->
          <?php
          }
          ?>

          <li>
            <a href="<?php echo base_url(); ?>RekapNilai">
              <i class="fa fa-ticket"></i>
              <span>Rekap Penilaian</span>
            </a>
          </li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>