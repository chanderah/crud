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
  <link rel="stylesheet" href="<?php echo base_url()?>assets/web_admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/web_admin/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/web_admin/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/web_admin/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/web_admin/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/datetimepicker/css/bootstrap-datetimepicker.css">
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
              <?php foreach($avatar as $a){?>
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
                  <small>Last Login: <?=$this->session->userdata('last_login')?></small>
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
            <li><a href="<?php echo base_url()?>assets/web_admin/index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
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
            <li><a href="<?= base_url('admin/form_barangmasuk')?>"><i class="fa fa-circle-o"></i> Tambah Data</a></li>
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
            <!-- <li class="active"><a href="<?= base_url('admin/tabel_permintaanmasuk')?>"><i class="fa fa-circle-o"></i> Tabel Permintaan Masuk</a></li> -->
            <li><a href="<?= base_url('admin/tabel_perubahan_site') ?>"><i class="fa fa-circle-o"></i> Tabel Perubahan SITE ID</a></li>
            <li><a href="<?= base_url('admin/tabel_barangmasuk')?>"><i class="fa fa-circle-o"></i> Tabel Database SITE ID</a></li>
            <li><a href="<?= base_url('admin/tabel_barangkeluar')?>"><i class="fa fa-circle-o"></i> Tabel Data Keluar</a></li>
            <li><a href="<?= base_url('admin/tabel_MOP')?>"><i class="fa fa-circle-o"></i> Tabel MOP</a></li> 
           </ul>
        </li>
        <li>
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
        Export Data
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
            <div class="container">
              <form id="form_insert_site" method="post" autocomplete="off" accept-charset="utf-8"style="width:95%;margin-left:10px">   
                <div class="form-group" style="display:inline-block; margin-left:75px">
                  <button type="reset" class="btn btn-basic" name="btn_reset" style="width:95px;margin-left:-70px;"><i class="fa fa-eraser" aria-hidden="true"></i> Reset</button>
                </div>
              
                <!-- START -->
              <?php foreach($list_data as $d){ ?>
                <div class="form-group form-group-lg col-md-12" style="display:none;">
                  <label for="dummy_id">Dummy ID</label>
                  <input type="text" name="dummy_id" required="true" class="form-control" placeholder="Dummy ID" value="<?=$d->dummy_id?>">
                </div>

                <div class="form-group form-group-lg col-md-12">
                  <label for="site_id" style="display:inline;">SITE ID</label>
                  <input type="text" name="site_id" style="  display:inline;" required="true" class="form-control" placeholder="Site ID" value="<?=$d->site_id?>">
                </div>
 
                <div class="form-group form-group-lg col-md-12">
                  <label for="the_insured">1. Nama Tertanggung</label>
                  <input type="text" name="the_insured" class="form-control" readonly="readonly" placeholder="Dari"value="<?=$d->the_insured?>">
                </div>
               
                <div class="form-group form-group-lg col-md-12">
                  <label for="address_">2. Alamat</label>
                  <input type="text" name="address_" readonly="readonly" class="form-control" value="<?=$d->address_?>">
                </div>
                 
                <div class="form-group form-group-lg col-md-6" style="margin-bottom:-1px">
                  <label for="">3. Jenis Barang yang Dikirim</label>
                  <!-- <input type="text" name="destination_from" readonly="readonly" class="form-control"> -->
                </div>

                <div class="form-group form-group-lg col-md-6"style="margin-bottom:-1px">
                  <label for="">Quantity</label>
                  <!-- <input type="text" name="destination_from" readonly="readonly" class="form-control"> -->
                </div>

                <?php foreach($list_data_desc as $d2){ ?>
                  <div class="form-group form-group-lg col-md-6">
                    <input type="text" name="title" readonly="readonly" class="form-control" value="<?=$d2->title?>">
                  </div>
                  <div class="form-group form-group-lg col-md-6">
                    <input type="text" name="description" readonly="readonly" class="form-control" value="<?=$d2->description?> Pcs">
                  </div>
                <?php } ?>

                <div class="form-group form-group-lg col-md-12">
                  <label for="conveyance">4. Pengiriman Melalui</label>
                  <input type="text" name="conveyance" readonly="readonly" class="form-control" value="<?=$d->conveyance?>">
                </div>

                <?php if($d->conveyance=='Darat'){ ?>
                  <div class="form-group form-group-lg col-md-3">
                    <label for="conveyance_type">By</label>
                    <input type="text" name="conveyance_type" readonly="readonly" class="form-control" value="<?=$d->conveyance_type?>">
                  </div>
                  <div class="form-group form-group-lg col-md-3">
                    <label for="conveyance_policeno">Plat Nomor</label>
                    <input type="text" name="conveyance_policeno" readonly="readonly" class="form-control" value="<?=$d->conveyance_policeno?>">
                  </div>
                  <div class="form-group form-group-lg col-md-3">
                    <label for="conveyance_age">Usia Kendaraan</label>
                    <input type="text" name="conveyance_age" readonly="readonly" class="form-control" value="<?=$d->conveyance_age?>">
                  </div>
                  <div class="form-group form-group-lg col-md-3">
                    <label for="conveyance_driver">No. SIM / Registrasi Pengemudi</label>
                    <input type="text" name="conveyance_driver" readonly="readonly" class="form-control" value="<?=$d->conveyance_driver?>">
                  </div>
                <?php } ?>
                
                <?php if($d->conveyance=='Laut'){ ?>
                  <div class="form-group form-group-lg col-md-3">
                    <label for="conveyance_ship_name">Nama Kapal</label>
                    <input type="text" name="conveyance_ship_name" readonly="readonly" class="form-control" value="<?=$d->conveyance_ship_name?>">
                  </div>
                  <div class="form-group form-group-lg col-md-3">
                    <label for="conveyance_ship_type">Jenis Kapal</label>
                    <input type="text" name="conveyance_ship_type" readonly="readonly" class="form-control" value="<?=$d->conveyance_ship_type?>">
                  </div>
                  <div class="form-group form-group-lg col-md-3">
                    <label for="conveyance_ship_age">Usia Kapal</label>
                    <input type="text" name="conveyance_ship_age" readonly="readonly" class="form-control" value="<?=$d->conveyance_ship_age?>">
                  </div>
                  <div class="form-group form-group-lg col-md-3">
                    <label for="conveyance_ship_GRT">GRT Kapal</label>
                    <input type="text" name="conveyance_ship_GRT" readonly="readonly" class="form-control" value="<?=$d->conveyance_ship_GRT?>">
                  </div>
                <?php } ?>
                
                <?php if($d->conveyance=='Udara'){ ?>
                  <div class="form-group form-group-lg col-md-6">
                    <label for="conveyance_plane_type">Jenis Pesawat</label>
                    <input type="text" name="conveyance_plane_type" readonly="readonly" class="form-control" value="<?=$d->conveyance_plane_type?>">
                  </div>
                  <div class="form-group form-group-lg col-md-6">
                    <label for="conveyance_plane_AWB">No. AWB</label>
                    <input type="text" name="conveyance_plane_AWB" readonly="readonly" class="form-control" value="<?=$d->conveyance_plane_AWB?>">
                  </div>
                <?php } ?>
                
              <!-- Start -->
              <!-- End -->

                <div class="form-group form-group-lg col-md-6">
                  <label for="destination_from">5. Tempat Keberangkatan</label>
                  <input type="text" name="destination_from" readonly="readonly" class="form-control" value="<?=$d->destination_from?>">
                </div>

                <div class="form-group form-group-lg col-md-6">
                  <label for="destination_to">Tujuan Akhir</label>
                  <input type="text" name="destination_to" readonly="readonly" class="form-control" value="<?=$d->destination_to?>">
                </div>

                <div class="form-group form-group-lg col-md-12">
                  <label for="sailing_date">6. Tanggal Keberangkatan</label>
                  <input type="text" name="sailing_date" readonly="readonly" class="form-control" value="<?=$d->sailing_date?>">
                </div>

                <div class="form-group form-group-lg col-md-12">
                  <label for="amount_insured">7. Nilai Barang yang Diangkut</label>
                  <input type="text" name="amount_insured" readonly="readonly" class="form-control" value="<?=$d->amount_insured?>">
                </div>

                <div class="form-group form-group-lg col-md-12">
                  <label for="lampiran">8. Lampiran Data Pendukung</label>
                </div>
                <div class="form-group form-group-lg col-md-4">
                  <label for="lampiran_BL">Bill of Lading (B/L)</label>
                  <input type="text" name="lampiran_BL" readonly="readonly" class="form-control" value="<?=$d->lampiran_BL?>">
                </div>
                <div class="form-group form-group-lg col-md-4">
                  <label for="lampiran_LC">Letter of Credit (L/C) *</label>
                  <input type="text" name="lampiran_LC" readonly="readonly" class="form-control" value="<?=$d->lampiran_LC?>">
                </div>
                <div class="form-group form-group-lg col-md-4">
                  <label for="lampiran_invoice">Invoice</label>
                  <input type="text" name="lampiran_invoice" readonly="readonly" class="form-control" value="<?=$d->lampiran_invoice?>">
                </div>
                <div class="form-group form-group-lg col-md-6">
                  <label for="lampiran_PL">Packing List</label>
                  <input type="text" name="lampiran_PL" readonly="readonly" class="form-control" value="<?=$d->lampiran_PL?>">
                </div>
                <div class="form-group form-group-lg col-md-6">
                  <label for="lampiran_DO">Delivery Order (DO)</label>
                  <input type="text" name="lampiran_DO" readonly="readonly" class="form-control" value="<?=$d->lampiran_DO?>">
                </div>          
                <?php } ?>
                <!-- END -->

                <div class="box-footer col-md-12" style="width:100%; margin-left:30px; margin-bottom:10px; margin-top:5px">
                  <a type="button" class="btn btn-default" style="width:10%;margin-right:26%" onclick="history.back(-1)" name="btn_kembali"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
                  <a type="button" class="btn btn-info" style="width:18%;margin-right:20%" href="<?=base_url('admin/tabel_barangmasuk')?>" name="btn_listbarang">
                  <i class="fa fa-table" aria-hidden="true"></i> Lihat List Data Masuk</a>
                  <button type="submit" input type="submit" style="width:20%" id="btnSave" class="btn btn-md btn-success"><i class="fa fa-check" aria-hidden="true"></i>Export</button>
                </div>
                <div id="user_message" style="display:inline-block"></div>
              </form>

              
            </div>
          </div>
          
          <!-- /.box -->

          <!-- Form Element sizes -->

          <!-- /.box -->


          <!-- /.box -->

          <!-- Input addon -->

          <!-- /.box -->

            </div>
        <!--/.col (left) -->
        <!-- right column -->
        <!-- <div class="col-md-6">
          <!-- Horizontal Form -->

          <!-- /.box -->
          <!-- general form elements disabled -->

          <!-- /.box -->

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
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url()?>assets/web_admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url()?>assets/web_admin/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url()?>assets/web_admin/dist/js/adminlte.min.js"></script>
  <script src="<?php echo base_url()?>assets/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url()?>assets/web_admin/dist/js/demo.js"></script>

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

  <script src="<?php echo base_url("assets/js/jquery.min.js");?>"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>

    <script type="text/javascript">
        var i = 1, max = 50;
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
                    if(max > i) {
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
        var display_bill_table = "";
        $(document).ready(function() {

            $('#form_insert_site').submit(function(e) {
                e.preventDefault(); 
                var data = $("#form_insert_site").serialize();
                $.ajax({
                    type:"POST",
                    url:'<?php echo base_url("main/move_datamasuk_permintaan"); ?>',
                    data: data,
                    success: function(data) {
                        $("#user_message").html(data);
                        $(":text").val('');
                        display_bill_table.ajax.reload();
                    },
                });
            });
            //end
        });

    </script>
  
  </body>

  
  </html>
