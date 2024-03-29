<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Data Masuk | CRUD Database</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/web_admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/web_admin/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/web_admin/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/web_admin/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/web_admin/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/datetimepicker/css/bootstrap-datetimepicker.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <header class="main-header">
      <!-- Logo -->
      <a href="<?php echo base_url('admin') ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>JIS </b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">PT <b> Jasmine</b></span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php foreach ($avatar as $a) { ?>
                  <img src="<?php echo base_url('assets/upload/user/img/' . $a->nama_file) ?>" class="user-image" alt="User Image">
                <?php } ?>
                <span class="hidden-xs"><?= $this->session->userdata('name') ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <?php foreach ($avatar as $a) { ?>
                    <img src="<?php echo base_url('assets/upload/user/img/' . $a->nama_file) ?>" class="img-circle" alt="User Image">
                  <?php } ?>
                  <p>
                    <?= $this->session->userdata('name') ?> - Admin
                    <small>Last Login: <?= $this->session->userdata('last_login') ?></small>
                  </p>
                </li>
                <!-- Menu Body -->
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?= base_url('admin/profile') ?>" class="btn btn-default btn-flat"><i class="fa fa-cogs" aria-hidden="true"></i> Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?= base_url('admin/sigout') ?>" class="btn btn-default btn-flat"><i class="fa fa-sign-out" aria-hidden="true"></i> Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <?php foreach ($avatar as $a) { ?>
              <img src="<?php echo base_url('assets/upload/user/img/' . $a->nama_file) ?>" class="img-circle" alt="User Image">
            <?php } ?>
          </div>
          <div class="pull-left info">
            <p><?= $this->session->userdata('name') ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <!-- search form -->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>
          <li>
            <a href="<?= base_url('admin') ?>">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              <span class="pull-right-container">
                <!-- <i class="fa fa-angle-left pull-right"></i> -->
              </span>
            </a>
            <!-- <ul class="treeview-menu">
            <li><a href="<?php echo base_url() ?>assets/web_admin/index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="<?php echo base_url() ?>assets/web_admin/index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul> -->
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-edit"></i> <span>Forms</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?= base_url('admin/form_barangmasuk') ?>"><i class="fa fa-circle-o"></i> Tambah Data</a></li>
            </ul>
          </li>
          <li class="treeview active">
            <a href="#">
              <i class="fa fa-table"></i> <span>Tables</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <!-- <li><a href="<?= base_url('admin/tabel_permintaanmasuk') ?>"><i class="fa fa-circle-o"></i> Tabel Permintaan Masuk</a></li> -->
              <li><a href="<?= base_url('admin/tabel_perubahan_site') ?>"><i class="fa fa-circle-o"></i> Tabel Perubahan SITE ID</a></li>
              <li><a href="<?= base_url('admin/tabel_barangmasuk') ?>"><i class="fa fa-circle-o"></i> Tabel Database SITE ID</a></li>
              <li class="active"><a href="<?= base_url('admin/tabel_barangkeluar') ?>"><i class="fa fa-circle-o"></i> Tabel Data Keluar</a></li>
            <li><a href="<?= base_url('admin/tabel_MOP')?>"><i class="fa fa-circle-o"></i> Tabel MOP</a></li> 
           </ul>
          </li>
          <li>
          <li class="header">MANAGE</li>
          <li>
            <a href="<?php echo base_url('admin/profile') ?>">
              <i class="fa fa-cogs" aria-hidden="true"></i> <span>Profile</span></a>
          </li>
          <li>
            <a href="<?php echo base_url('admin/users') ?>">
              <i class="fa fa-fw fa-users" aria-hidden="true"></i> <span>Users</span></a>
          </li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Update Data
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Forms</a></li>
          <li class="active">Data</li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content"  >
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <div class="container">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-archive" aria-hidden="true"></i> Export Data</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

              <?php foreach ($data_barang_update as $d) { ?>
                <div class="container">
                  <form action="<?=base_url('admin/proses_datakeluar_update')?>" role="form" method="post" autocomplete="on" accept-charset="utf-8" style="width:95%;margin-left:10px">
                    <div class="form-group" style="display:inline-block; margin-left:75px">
                      <button type="reset" class="btn btn-basic" name="btn_reset" style="width:95px;margin-left:-70px;margin-top:10px"><i class="fa fa-eraser" aria-hidden="true"></i> Reset</button>
                    </div>
                    <div class="form-group">
                      <label for="dummy_id" style="display:none;">Old Dummy ID</label>
                      <input type="text" name="dummy_id" style="  display:none;" class="form-control"   value="<?=$d->dummy_id?>">
                    </div> 
                    <div class="form-group">
                      <label for="no_sertif" style="display:none;">No. Sertif</label>
                      <input type="text" name="no_sertif" style="  display:none;" class="form-control"   value="<?=$d->no_sertif?>">
                    </div> 
                    <div class="form-group form-group-lg col-md-12">
                      <label for="site_id" style="display:inline;width:auto">SITE ID (Separate by Comma)</label>
                      <input type="text" name="site_id" style="display:inline;margin-top:10px" class="form-control" placeholder="Site ID" value="<?= $d->site_id ?>">
                    </div>
                    <div class="form-group form-group-lg col-md-12">
                      <label for="insurance">Insurance</label>
                      <input type="text" name="insurance" style="display:inline;margin-top:10px" readonly="true" class="form-control" placeholder="Insurance" value="<?= $d->insurance ?>">

                    </div>
                    
                    <div class="form-group form-group-lg col-md-12">
                        <label for="itemInsured" style="display:inline;">Jenis Barang yang Dikirim</label>
                        <textarea class="form-control" style="margin-top:10px;" id="itemInsured" rows="5" name="itemInsured"><?= $d->itemInsured ?></textarea>
                    </div>                

                    <div class="form-group form-group-lg col-md-12"  >
                      <label for="conveyance">Pengiriman Melalui</label>
                        <select class="form-control" id="conveyance" name="conveyance">
                          <option value="Darat" <?php if($d->conveyance=="Darat"){echo "selected";} ?> >Darat</option>
                          <option value="Laut" <?php if($d->conveyance=="Laut"){echo "selected";} ?> >Laut</option>
                          <option value="Udara" <?php if($d->conveyance=="Udara"){echo "selected";} ?> >Udara</option>
                        </select>
                    </div>

                    <div class="conveyance_select" id="Darat">
                      <div class="form-group form-group-lg col-md-3">
                        <label for="conveyance_type">Dengan</label>
                          <select class="form-control" id="conveyance_by" name="conveyance_by">
                            <option value="Car" <?php if($d->conveyance=="Car"){echo "selected";} ?> >Car</option>
                            <option value="Truck" <?php if($d->conveyance=="Truck"){echo "selected";} ?> >Truck</option>
                            <option value="Pick Up" <?php if($d->conveyance=="Pick Up"){echo "selected";} ?> >Pick Up</option>
                            <option value="Container" <?php if($d->conveyance=="Container"){echo "selected";} ?> >Container</option>
                          </select>
                      </div>
                      <div class="form-group form-group-lg col-md-3">
                        <label for="conveyance_type">Jenis Kendaraan</label>
                        <input type="text" class="form-control" name="conveyance_type" placeholder="Type" value="<?= $d->conveyance_type ?>">
                      </div>
                      <div class="form-group form-group-lg col-md-3">
                        <label for="conveyance_policeno">Plat Nomor</label>
                        <input type="text" class="form-control" name="conveyance_policeno" placeholder="Police Number" value="<?= $d->conveyance_policeno ?>">
                      </div>
                      <div class="form-group form-group-lg col-md-3">
                        <label for="conveyance_driver">Pengemudi</label>
                        <input type="text" class="form-control" name="conveyance_driver" placeholder="Driver" value="<?= $d->conveyance_driver ?>">
                      </div>
                    </div>
                    <div class="conveyance_select" id="Laut">
                      <div class="form-group form-group-lg col-md-4">
                        <label for="conveyance_ship_name">Nama Kapal</label>
                        <input type="text" class="form-control" name="conveyance_ship_name" placeholder="Ship Name" value="<?= $d->conveyance_ship_name ?>">
                      </div>
                      <div class="form-group form-group-lg col-md-4">
                        <label for="conveyance_ship_type">Jenis Kapal</label>
                        <input type="text" class="form-control" name="conveyance_ship_type" placeholder="Ship Type" value="<?= $d->conveyance_ship_type ?>">
                      </div>
                      <div class="form-group form-group-lg col-md-4">
                        <label for="conveyance_ship_birth">Tahun Pembuatan Kapal</label>
                        <input type="number" class="form-control" name="conveyance_ship_birth" placeholder="Year of Build" value="<?= $d->conveyance_ship_birth ?>">
                      </div>
                      <div class="form-group form-group-lg col-md-6">
                        <label for="conveyance_ship_GRT">GRT Kapal</label>
                        <input type="text" class="form-control" name="conveyance_ship_GRT" placeholder="GRT Kapal" value="<?= $d->conveyance_ship_GRT ?>">
                      </div>
                      <div class="form-group form-group-lg col-md-6">
                        <label for="conveyance_ship_containerno">Container No.</label>
                        <input type="text" class="form-control" name="conveyance_ship_containerno" placeholder="Container Number" value="<?= $d->conveyance_ship_containerno ?>">
                      </div>
                    </div>
                    <div class="conveyance_select" id="Udara">
                      <div class="form-group form-group-lg col-md-6">
                        <label for="conveyance_plane_type">Jenis Pesawat</label>
                        <select class="form-control" id="conveyance_plane_type" name="conveyance_plane_type">
                          <option value="Cargo" <?php if($d->conveyance=="Cargo"){echo "selected";} ?> >Cargo</option>
                          <option value="Penumpang" <?php if($d->conveyance=="Penumpang"){echo "selected";} ?> >Penumpang</option>
                          <option value="Helicopter" <?php if($d->conveyance=="Helicopter"){echo "selected";} ?> >Helicopter</option>
                          <option value="Charter" <?php if($d->conveyance=="Charter"){echo "selected";} ?> >Charter</option>
                        </select>
                      </div>
                      <div class="form-group form-group-lg col-md-6">
                        <label for="conveyance_plane_AWB">No. AWB</label>
                        <input type="text" class="form-control" name="conveyance_plane_AWB" placeholder="No. AWB" value="<?= $d->conveyance_plane_AWB ?>">
                      </div>
                    </div>
                    
                    <div class="form-group form-group-lg col-md-6">
                      <label for="destination_from">Tempat Keberangkatan</label>
                      <textarea class="form-control" id="destination_from" name="destination_from" placeholder="From" rows="3"><?= $d->destination_from ?></textarea>
                    </div>
                    <div class="form-group form-group-lg col-md-6">
                      <label for="destination_to">Tujuan Akhir</label>
                      <textarea class="form-control" id="destination_to" name="destination_to" placeholder="To" rows="3"><?= $d->destination_to ?></textarea>
                    </div>
                    <div class="form-group form-group-lg col-md-12">
                      <label for="sailing_date">Tanggal Keberangkatan</label>
                      <input type="date" placeholder="Sailing Date" name="sailing_date" required="required" class="form-control" value="<?= $d->sailing_date ?>"/>
                    </div>
                    <div class="form-group form-group-lg col-md-12">
                      <label for="amount_insured">Nilai Barang yang Diangkut</label>
                      <select class="form-control" id="currency" name="currency" style="margin-bottom:5px;width:fit-content" >
                          <option value="IDR">IDR</option>
                      </select>
                      <input id="amount_insured" type="number" name="amount_insured" placeholder="Nilai Barang" required="required" class="form-control" value="<?= $d->amount_insured ?>"/>
                    </div>
                    <div class="form-group form-group-lg col-md-12">
                      <label for="issuedDate">Tanggal Penerbitan</label>
                      <input type="date" value="<?= $d->issuedDate ?>" name="issuedDate" required="required" class="form-control" />
                    </div>               

                    <div class="box-footer col-md-12" style="width:100%; margin-left:30px; margin-bottom:10px; margin-top:5px">
                      <a type="button" class="btn btn-default" style="width:10%;margin-right:26%" onclick="history.back(-1)" name="btn_kembali"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
                      <a type="button" class="btn btn-info" style="width:18%;margin-right:20%" href="<?= base_url('admin/tabel_barangkeluar') ?>" name="btn_listbarang">
                        <i class="fa fa-table" aria-hidden="true"></i> Lihat Data Keluar</a>
                      <button type="submit" input type="submit" style="width:20%" id="btnSave" class="btn btn-md btn-success"><i class="fa fa-check" aria-hidden="true"></i>Update</button>
                    </div>
                    <div id="user_message" style="display:inline-block"></div>
                  </form>
                </div>
              <?php } ?>
              </div>
            </div>
          </div>
        </div>
        <!--/.col (right) -->
    </div>
    <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1
    </div>
    <strong>Copyright &copy; <?= date('Y') ?></strong>
  </footer>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->
  <!-- jQuery 3 -->
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url() ?>assets/web_admin/dist/js/adminlte.min.js"></script>
  <script src="<?php echo base_url() ?>assets/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url() ?>assets/web_admin/dist/js/demo.js"></script>
  <script type="text/javascript">
    $(".form_datetime").datetimepicker({
      format: 'dd/mm/yyyy',
      autoclose: true,
      todayBtn: true,
      pickTime: false,
      minView: 2,
      maxView: 4,
    });
  </script>
  <script src="<?php echo base_url("assets/js/jquery.min.js"); ?>"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>

  <script>
    var conveyance="<?php echo $d->conveyance ;?>";  

    function loadConveyanceData() {
      $('.conveyance_select').hide();
        $('#'+conveyance).show();
    }

    window.onload = loadConveyanceData;

    $(document).ready(function() {
      $('#conveyance').change(function() {
        $('.conveyance_select').hide();
        $('#' + $(this).val()).show();
      });
    });
  </script>
  
</body>
</html>