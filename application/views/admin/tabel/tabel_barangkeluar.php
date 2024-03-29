<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>JIS - Tabel Data Keluar</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/web_admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/web_admin/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/web_admin/bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/web_admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/web_admin/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/sweetalert/dist/sweetalert.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/web_admin/dist/css/skins/_all-skins.min.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url('admin')?>" class="logo">
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
              <?php foreach($avatar as $a){ ?>
              <img src="<?php echo base_url('assets/upload/user/img/'.$a->nama_file)?>" class="user-image" alt="User Image">
              <?php } ?>
              <span class="hidden-xs"><?=$this->session->userdata('name')?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <?php foreach($avatar as $a){ ?>
                <img src="<?php echo base_url('assets/upload/user/img/'.$a->nama_file)?>" class="img-circle" alt="User Image">
                <?php } ?>
                <p>
                  <?=$this->session->userdata('name')?> - Admin
                  <small>Last Login : <?=$this->session->userdata('last_login')?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?= base_url('admin/profile')?>" class="btn btn-default btn-flat"><i class="fa fa-cogs" aria-hidden="true"></i> Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?= base_url('admin/sigout')?>" class="btn btn-default btn-flat"><i class="fa fa-sign-out" aria-hidden="true"></i> Sign out</a>
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
          <?php foreach($avatar as $a){ ?>
          <img src="<?php echo base_url('assets/upload/user/img/'.$a->nama_file)?>" class="img-circle" alt="User Image">
          <?php } ?>
        </div>
        <div class="pull-left info">
          <p><?=$this->session->userdata('name')?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="<?= base_url('admin')?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <!-- <i class="fa fa-angle-left pull-right"></i> -->
            </span>
          </a>
          <!-- <ul class="treeview-menu">
            <li><a href="<?php echo base_url()?>assets/web_admin/index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="<?php echo base_url('admin')?>"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
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
            <li><a href="<?= base_url('admin/form_barangmasuk')?>"><i class="fa fa-circle-o"></i> Tambah Data Masuk</a></li>
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
            <!-- <li><a href="<?= base_url('admin/tabel_permintaanmasuk')?>"><i class="fa fa-circle-o"></i> Tabel Permintaan Masuk</a></li> -->
            <li><a href="<?= base_url('admin/tabel_perubahan_site') ?>"><i class="fa fa-circle-o"></i> Tabel Perubahan SITE ID</a></li>
            <li><a href="<?= base_url('admin/tabel_barangmasuk')?>"><i class="fa fa-circle-o"></i> Tabel Database SITE ID</a></li>
            <li class="active"><a href="<?= base_url('admin/tabel_barangkeluar')?>"><i class="fa fa-circle-o"></i> Tabel Data Keluar</a></li>
            <li><a href="<?= base_url('admin/tabel_MOP')?>"><i class="fa fa-circle-o"></i> Tabel MOP</a></li> 
           </ul>
        </li>
        <li class="header">MANAGE</li>
        <li>
          <a href="<?php echo base_url('admin/profile')?>">
         <i class="fa fa-cogs" aria-hidden="true"></i> <span>Profile</span></a>
        </li>
        <li>
          <a href="<?php echo base_url('admin/users')?>">
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
        Tabel Data Keluar
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url('admin')?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Tables</li>
        <li class="active"><a href="<?=base_url('admin/tabel_barangkeluar')?>">Tabel Data Keluar</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content"  >
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
          <div class="box" style="width:80%;padding:10px">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-table" aria-hidden="true"></i> Data Keluar</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php if($this->session->flashdata('msg_berhasil')){ ?>
                <div class="alert alert-success alert-dismissible" style="width:100%">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong><br> <?php echo $this->session->flashdata('msg_berhasil');?>
               </div>
              <?php } ?>
              <a href="<?=base_url('admin/tabel_barangmasuk')?>" style="margin-bottom:10px;" type="button" class="btn btn-primary" name="tambah_data"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Data Keluar</a>
              <a href="<?= base_url('admin/move_data') ?>" style="margin-bottom:10px" type="button" class="btn btn-primary" name="tambah_data"><i class="fa fa-plus-circle" aria-hidden="true"></i> Export n/a Data</a>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width:2%">No</th>
                  <th>SITE ID</th>
                  <th>Insurance</th>
                  <th>Sertifikat</th>
                  <th>Header</th>
                  <th>Issued At</th>
                  <th>Created At</th>
                  <th>Update</th>
                  <th>Delete</th>
                  <th>Invoice</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <?php if(is_array($list_data)){ 
                  $no = 1;
                  foreach($list_data as $dd): ?>
                    <td><?=$no?></td>
                    <td><?=$dd->site_id?><br></td>
                    <td><?=$dd->insurance?><br></td>
                    <td><?=$dd->no_sertif?></td>  
                    <td><?=$dd->header_sertif?></td>  
                    <td><?=$dd->issuedDate?></td>
                    <td><?=$dd->created_at?></td>
                    <td><a type="button" class="btn btn-info" href="<?= base_url('admin/update_datakeluar/' . $dd->dummy_id) ?>" name="btn_update" style="margin:auto;"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                    <td><a type="button" class="btn btn-danger btn-delete" href="<?=base_url('admin/delete_datakeluar/'.$dd->dummy_id)?>" name="btn_delete" style="margin:auto;"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                    <?php if($dd->insurance == "Malacca"){ ?>
                      <td>
                          <a type="button" class="btn btn-danger btn-report" href="<?=base_url('report4/dataKeluar/'.$dd->dummy_id)?>" target="blank" name="btn_report" style="margin:auto;"><i class="fa fa-file-text" aria-hidden="true"></i></a>
                          <a type="button" class="btn btn-danger btn-report" href="<?=base_url('report3/dataKeluar/'.$dd->dummy_id)?>" target="blank" name="btn_report" style="margin:auto;"><i class="fa fa-file-text" aria-hidden="true"></i></a>
                      </td>
                    <?php }else{ ?>
                      <td>
                          <a type="button" class="btn btn-danger btn-report" href="<?=base_url('report2/dataKeluar/'.$dd->dummy_id)?>" target="blank" name="btn_report" style="margin:auto;"><i class="fa fa-file-text" aria-hidden="true"></i></a>
                          <a type="button" class="btn btn-danger btn-report" href="<?=base_url('report/dataKeluar/'.$dd->dummy_id)?>" target="blank" name="btn_report" style="margin:auto;"><i class="fa fa-file-text" aria-hidden="true"></i></a>
                      </td>
                    <?php } ?>

                </tr>
                  <?php $no++; ?>
                  <?php endforeach;?>
                  <?php }else { ?>
                        <td colspan="7" align="center"><strong>Data Kosong</strong></td>
                  <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>SITE ID</th>
                  <th>Insurance</th>
                  <th>Sertifikat</th>
                  <th>Header</th>
                  <th>Issued At</th>
                  <th>Created At</th>
                  <th>Update</th>
                  <th>Delete</th>
                  <th>Invoice</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        <!-- /.col -->
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
    <strong>PT. Jasmine Indah Servistama. Copyright &copy; <?=date('Y')?></strong>
  </footer>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="<?php echo base_url()?>assets/web_admin/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url()?>assets/js/dataTables.searchHighlight.min"></script>
<script src="<?php echo base_url()?>assets/sweetalert/dist/sweetalert.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url()?>assets/web_admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url()?>assets/web_admin/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/web_admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url()?>assets/web_admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url()?>assets/web_admin/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()?>assets/web_admin/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url()?>assets/web_admin/dist/js/demo.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/plug-ins/1.12.1/features/searchHighlight/dataTables.searchHighlight.css"/>
<script type="text/javascript" src="https:////cdn.datatables.net/plug-ins/1.12.1/features/searchHighlight/dataTables.searchHighlight.min.js"></script>
<script type="text/javascript" src="https://bartaz.github.io/sandbox.js/jquery.highlight.js"></script>
<!-- page script -->
<script>
jQuery(document).ready(function($){
      $('.btn-delete').on('click',function(){
          var getLink = $(this).attr('href');
          swal({
                  title: 'Delete Data',
                  text: 'Yakin ingin menghapus data?',
                  html: true,
                  confirmButtonColor: '#d9534f',
                  showCancelButton: true,
                  },function(){
                  window.location.href = getLink
              });
          return false;
      });
  });
  $(function () {
    $('#example1').DataTable({
      "columnDefs": [
          { 
            "width": "7%", "targets": [1],
            // "render": function (data, type, row) {return data.split("\n").join("<br/>")},"targets": [9], 
            "render": function (data, type, row) {return data.split(",").join("\n")},"targets": [1], 
          }
        ], 
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        searchHighlight: true,
        'info': true,
        'autoWidth': true,
        'scrollX': true,
    })
  });
</script>
</body>
</html>
