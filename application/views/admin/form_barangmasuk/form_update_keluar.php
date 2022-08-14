<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Data Keluar | CRUD Database</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/web_admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/styling.css">
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
              <li><a href="<?= base_url('admin/tabel_MOP') ?>"><i class="fa fa-circle-o"></i> Tabel MOP</a></li>
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
      <section class="content">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <div class="container">
              <div class="user_message"></div>
              <div class="box box-primary" style="padding-bottom:10px">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-archive" aria-hidden="true"></i> Export Data</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?php if (!$data_barang_update) {
                  redirect(base_url('admin/tabel_barangkeluar'));
                } ?>
                <?php foreach ($data_barang_update as $d) { ?>
                  <form style="margin-left:15px" id="form_insert_site" method="post" autocomplete="off" accept-charset="utf-8">
                    <table id="cart_table" class="table table-stripped table-hover" style="width:95%;margin-left:10px">
                      <tbody>
                        <tr>
                          <td colspan="12">
                            <div class="form-group">
                              <label for="dummy_id" style="display:none;">Old Dummy ID</label>
                              <input type="text" name="dummy_id" readonly="true" style="display:none;" class="form-control" value="<?= $d->dummy_id ?>">
                            </div>
                            <div class="form-group">
                              <label for="no_sertif" style="display:none;">No. Sertif</label>
                              <input type="text" name="no_sertif" readonly="true" style="display:none;" class="form-control" value="<?= $d->no_sertif ?>">
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="12">
                            <div class="form-group">
                              <label for="site_id" style="display:inline">SITE ID (Separate by Comma)</label>
                              <input type="text" name="site_id" class="form-control" placeholder="Site ID" style="margin-top:10px" value="<?= $d->site_id ?>">
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="12">
                            <div class="form-group">
                              <label>Insurance</label>
                              <select name="insurance" class="form-control">
                                <option value="Malacca" <?php if ($d->insurance == "Malacca") {
                                                          echo "selected";
                                                        } ?>>Malacca</option>
                                <option value="Maximus" <?php if ($d->insurance == "Maximus") {
                                                          echo "selected";
                                                        } ?>>Maximus</option>
                              </select>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="12">
                            <div class="form-group">
                              <label for="itemInsured" style="display:inline;">Jenis Barang yang Dikirim</label>
                              <textarea class="form-control" style="margin-top:10px;" id="itemInsured" rows="5" name="itemInsured"><?= $d->itemInsured ?></textarea>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <?php foreach ($data_conveyance as $d2) { ?>
                            <?php if ($d2->conveyance == "Darat") { ?>
                        <tr class="darat">
                          <td>
                            <div class="form-group">
                              <label>Darat</label>
                              <input type="text" name="conveyance_by[]" value="<?= $d2->conveyance_by ?>" placeholder="Car/Truck/Pickup/Container" class="form-control" />
                            </div>
                          </td>
                          <td>
                            <div class="form-group">
                              <label class="white">.</label>
                              <input type="text" name="conveyance_type[]" value="<?= $d2->conveyance_type ?>" placeholder="Jenis Kendaraan" class="form-control" />
                            </div>
                          </td>
                          <td>
                            <div class="form-group">
                              <label class="white">.</label>
                              <input type="text" name="conveyance_policeno[]" value="<?= $d2->conveyance_policeno ?>" placeholder="Plat Nomor" class="form-control" />
                            </div>
                          </td>
                          <td>
                            <div class="form-group">
                              <label class="white">.</label>
                              <input type="text" name="conveyance_driver[]" value="<?= $d2->conveyance_driver ?> " placeholder="Pengemudi" class="form-control" />
                            </div>
                          </td>
                          <td>
                            <div class="form-group">
                            </div>
                          </td>
                          <td>
                            <button id="addItem" name="addItem" type="button" class="btn btn-success btn-block btn-sm add_button"><i style="color:#fff" class="fa fa-plus-circle"></i></button>
                            <button id="removeItem" name="removeItem" type="button" class="btn btn-danger btn-block btn-sm remove_button"><i style="color:#fff;" class="fa fa-trash-o"></i></button>
                          </td>
                        </tr>
                      <?php } ?>

                      <?php if ($d2->conveyance == "Laut") { ?>
                        <tr class="laut">
                          <td>
                            <div class="form-group">
                              <label>Laut</label>
                              <input type="text" name="conveyance_ship_name[]" value="<?= $d2->conveyance_ship_name ?>" placeholder="Nama Kapal" class="form-control" />

                            </div>
                          </td>
                          <td>
                            <div class="form-group">
                              <label class="white">.</label>
                              <input type="text" name="conveyance_ship_type[]" value="<?= $d2->conveyance_ship_type ?>" placeholder="Jenis Kapal" class="form-control" />
                            </div>
                          </td>
                          <td>
                            <div class="form-group">
                              <label class="white">.</label>
                              <input type="text" name="conveyance_ship_birth[]" value="<?= $d2->conveyance_ship_birth ?>" placeholder="Tahun Pembuatan Kapal" class="form-control" />
                            </div>
                          </td>
                          <td>
                            <div class="form-group">
                              <label class="white">.</label>
                              <input type="text" name="conveyance_ship_GRT[]" value="<?= $d2->conveyance_ship_GRT ?>" placeholder="GRT Kapal" class="form-control" />
                            </div>
                          </td>
                          <td>
                            <div class="form-group">
                              <label class="white">.</label>
                              <input type="text" name="conveyance_ship_containerno[]" value="<?= $d2->conveyance_ship_containerno ?>" placeholder="Container No." class="form-control" />
                            </div>
                          </td>
                          <td>
                            <button id="addItem" name="addItem" type="button" class="btn btn-success btn-block btn-sm add_button"><i style="color:#fff" class="fa fa-plus-circle"></i></button>
                            <button id="removeItem" name="removeItem" type="button" class="btn btn-danger btn-block btn-sm remove_button"><i style="color:#fff;" class="fa fa-trash-o"></i></button>
                          </td>
                        </tr>
                      <?php } ?>

                      <?php if ($d2->conveyance == "Udara") { ?>
                        <tr class="udara">
                          <td>
                            <div class="form-group">
                              <label>Udara</label>
                              <input type="text" name="conveyance_plane_type[]" value="<?= $d2->conveyance_plane_type ?>" placeholder="Jenis Pesawat" class="form-control" />
                            </div>
                          </td>
                          <td>
                            <div class="form-group">
                              <label class="white">.</label>
                              <input type="text" name="conveyance_plane_AWB[]" value="<?= $d2->conveyance_plane_AWB ?>" placeholder="No. AWB" class="form-control" />
                            </div>
                          </td>
                          <td>
                            <div class="form-group">
                            </div>
                          </td>
                          <td>
                            <div class="form-group">
                            </div>
                          </td>
                          <td>
                            <div class="form-group">
                            </div>
                          </td>
                          <td>
                            <button id="addItem" name="addItem" type="button" class="btn btn-success btn-block btn-sm add_button"><i style="color:#fff" class="fa fa-plus-circle"></i></button>
                            <button id="removeItem" name="removeItem" type="button" class="btn btn-danger btn-block btn-sm remove_button"><i style="color:#fff;" class="fa fa-trash-o"></i></button>
                          </td>
                        </tr>
                      <?php } ?>
                    <?php } ?>

                    <?php

                    if (!$cDarat) { ?>
                      <tr>
                        <td>
                          <div class="form-group">
                            <label>Darat</label>
                            <input type="text" name="conveyance_by[]" value="<?= $d2->conveyance_by ?>" placeholder="Car/Truck/Pickup/Container" class="form-control" />
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label class="white">.</label>
                            <input type="text" name="conveyance_type[]" placeholder="Jenis Kendaraan" class="form-control" />
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label class="white">.</label>
                            <input type="text" name="conveyance_policeno[]" placeholder="Plat Nomor" class="form-control" />
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label class="white">.</label>
                            <input type="text" name="conveyance_driver[]" placeholder="Pengemudi" class="form-control" />
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                          </div>
                        </td>
                        <td>
                          <button id="addItem" name="addItem" type="button" class="btn btn-success btn-block btn-sm add_button"><i style="color:#fff" class="fa fa-plus-circle"></i></button>
                          <button id="removeItem" name="removeItem" type="button" class="btn btn-danger btn-block btn-sm remove_button"><i style="color:#fff;" class="fa fa-trash-o"></i></button>
                        </td>
                      </tr>
                    <?php } ?>

                    <?php if (!$cLaut) { ?>
                      <tr>
                        <td>
                          <div class="form-group">
                            <label>Laut</label>
                            <input type="text" name="conveyance_ship_name[]" placeholder="Nama Kapal" class="form-control" />

                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label class="white">.</label>
                            <input type="text" name="conveyance_ship_type[]" placeholder="Jenis Kapal" class="form-control" />
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label class="white">.</label>
                            <input type="text" name="conveyance_ship_birth[]" placeholder="Tahun Pembuatan Kapal" class="form-control" />
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label class="white">.</label>
                            <input type="text" name="conveyance_ship_GRT[]" placeholder="GRT Kapal" class="form-control" />
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label class="white">.</label>
                            <input type="text" name="conveyance_ship_containerno[]" placeholder="Container No." class="form-control" />
                          </div>
                        </td>
                        <td>
                          <button id="addItem" name="addItem" type="button" class="btn btn-success btn-block btn-sm add_button"><i style="color:#fff" class="fa fa-plus-circle"></i></button>
                          <button id="removeItem" name="removeItem" type="button" class="btn btn-danger btn-block btn-sm remove_button"><i style="color:#fff;" class="fa fa-trash-o"></i></button>
                        </td>
                      </tr>
                    <?php } ?>

                    <?php if (!$cUdara) { ?>
                      <tr>
                        <td>
                          <div class="form-group">
                            <label>Udara</label>
                            <input type="text" name="conveyance_plane_type[]" placeholder="Jenis Pesawat" class="form-control" />
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label class="white">.</label>
                            <input type="text" name="conveyance_plane_AWB[]" placeholder="No. AWB" class="form-control" />
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                          </div>
                        </td>
                        <td>
                          <button id="addItem" name="addItem" type="button" class="btn btn-success btn-block btn-sm add_button"><i style="color:#fff" class="fa fa-plus-circle"></i></button>
                          <button id="removeItem" name="removeItem" type="button" class="btn btn-danger btn-block btn-sm remove_button"><i style="color:#fff;" class="fa fa-trash-o"></i></button>
                        </td>
                      </tr>
                    <?php } ?>

                    <?php
                    $sailingDate = explode(",", $d->sailing_date);

                    for ($i = 0; $i < count($sailingDate); $i++) {
                    ?>
                      <tr>
                        <td colspan="5">
                          <div class="form-group">
                            <!-- here -->
                            <label>Tanggal Keberangkatan</label>
                            <input type="date" placeholder="Sailing Date" value="<?= $sailingDate[$i] ?>" name="sailing_date[]" required="required" class="form-control" />
                          </div>
                        </td>
                        <td>
                          <button id="addItem" name="addItem" type="button" class="btn btn-success btn-block btn-sm add_button"><i style="color:#fff" class="fa fa-plus-circle"></i></button>
                          <button id="removeItem" name="removeItem" type="button" class="btn btn-danger btn-block btn-sm remove_button"><i style="color:#fff;" class="fa fa-trash-o"></i></button>
                        </td>
                      </tr>
                    <?php } ?>

                    <tr>
                      <td colspan="3">
                        <div class="form-group">
                          <label for="destination_from">Tempat Keberangkatan</label>
                          <textarea class="form-control" id="destination_from<?= $d->dummy_id ?>" name="destination_from" placeholder="From" rows="4"><?= $d->destination_from ?></textarea>
                        </div>
                      </td>
                      <td colspan="3">
                        <div class="form-group">
                          <label for="destination_to">Tujuan Akhir</label>
                          <textarea class="form-control" id="destination_to" name="destination_to" placeholder="To" rows="4"><?= $d->destination_to ?></textarea>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="12">
                        <div class="form-group">
                          <label for="amount_insured">Nilai Barang yang Diangkut</label>
                          <select class="form-control" id="currency" name="currency" style="margin-bottom:5px;width:fit-content">
                            <option value="IDR">IDR</option>
                          </select>
                          <input type="number" name="amount_insured" value="<?= $d->amount_insured ?>" required="required" class="form-control" />
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="12">
                        <div class="form-group">
                          <label for="issuedDate">Tanggal Penerbitan</label>
                          <input type="date" value="<?php echo date("Y-m-d") ?>" name="issuedDate" required="required" class="form-control" />
                        </div>
                      </td>
                    </tr>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="12" class="text-right">
                            <input type="submit" id="btnSave" name="btnSave" value="Create" class="btn btn-md btn-success" />
                          </td>
                        </tr>
                      </tfoot>
                    </table>
                  </form>
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
  <script type="text/javascript">
    var darat = $('#cart_table tbody tr.darat').length;
    var laut = $('#cart_table tbody tr.laut').length;
    var udara = $('#cart_table tbody tr.udara').length;

    var i = darat + laut + udara;
    max = 50;
    var cartTable = {
      options: {
        table: "#cart_table"
      },
      initialize: function() {
        this.setVars().events();
      },
      setVars: function() {
        this.$table = $(this.options.table);
        this.$totalLines = $(this.options.table).find('tr').length - 1;
        return this;
      },
      updateLines: function() {
        var totalLines = $(this.options.table).find('tr').length - 1;
        if (totalLines == 1) {
          $('.add_button').show();
          $('.remove_button').hide();
        }
        return this;
      },
      events: function() {
        var _self = this;
        _self.updateLines();
        this.$table.on('click', 'button.add_button', function(e) {
          e.preventDefault();
          if (max > i) {
            var $tr = $(this).closest('tr');
            var $clone = $tr.clone();
            $clone.find(':text').val('');
            $tr.after($clone);
            if (_self.setVars().$totalLines > 1) {
              $('.remove_button').show();
              $('.add_button').show();
            }
            i++;
          }
        }).on('click', 'button.remove_button', function(e) {
          if (i > 1) {
            e.preventDefault();
            var $tr = $(this).closest('tr');
            $tr.remove();
            //if have delete last button with button add visible, add another button to last tr
            if (_self.setVars().$totalLines > 1) {
              _self.$table.find('tr:last').find('.add').show();
            }
            i--;
          }
        });

        return this;
      }
    };

    function initializeCartTable() {
      cartTable.initialize();
    }
    window.addEventListener('load', initializeCartTable, false);
  </script>

  <script>
    $('#form_insert_site').submit(function(e) {
      e.preventDefault();
      var data = $("#form_insert_site").serialize();
      var url2 = '<?php echo base_url("admin/tabel_barangkeluar"); ?>';
      $.ajax({
        type: "POST",
        url: '<?php echo base_url("admin/proses_datakeluar_update"); ?>',
        data: data,
        success: function(data) {
          // $(":text").val('');
          location.href = url2;
          // window.open(url2, "_blank");
          // $("#user_message").html(data);
        },
      });
    });
    //end 
  </script>

</body>

</html>