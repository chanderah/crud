<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>JIS | Tabel Data Masuk</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/web_admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/web_admin/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/web_admin/bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/web_admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/web_admin/dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="<?php echo base_url() ?>assets/sweetalert/dist/sweetalert.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/web_admin/dist/css/skins/_all-skins.min.css">

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
        <span class="logo-mini"><b>JIS</b></span>
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
                    <small>Last Login : <?= $this->session->userdata('last_login') ?></small>
                  </p>
                </li>
                <!-- Menu Body -->

                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?= base_url('admin/sigout') ?>" class="btn btn-default btn-flat"><i class="fa fa-cogs" aria-hidden="true"></i> Profile</a>
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
            <!--<ul class="treeview-menu">
            <li><a href="<?php echo base_url() ?>assets/web_admin/index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="<?php echo base_url('admin') ?>"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
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
              <li class="active"><a href="<?= base_url('admin/tabel_barangmasuk') ?>"><i class="fa fa-circle-o"></i> Tabel Database SITE ID</a></li>
              <li><a href="<?= base_url('admin/tabel_barangkeluar') ?>"><i class="fa fa-circle-o"></i> Tabel Data Keluar</a></li>
              <li><a href="<?= base_url('admin/tabel_MOP') ?>"><i class="fa fa-circle-o"></i> Tabel MOP</a></li>
            </ul>
          </li>
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
          Tabel Database SITE ID
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li>Tables</li>
          <li class="active"><a href="<?= base_url('admin/tabel_barangmasuk') ?>">Tabel Database SITE ID</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="col-md-12">
          <div class="nav-tabs-custom"  >
            <ul class="nav nav-tabs">
              <li><a href="#main"   data-toggle="tab"></a></li>
              <li class="active"><a href="#main"   data-toggle="tab">Main</a></li>
              <!-- <li><a href="#counter"   data-toggle="tab">Counter</a></li> -->
              <li><a href="#import"   data-toggle="tab">Import</a></li>
              <li><a href="#delete_batch"   data-toggle="tab">Batch Delete</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane mb-4 active" id="delete_batch">
                <div class="column">
                  <form class="form-horizontal" onsubmit="confirmDelete(site_from,site_to)" method="post" enctype="multipart/form-data">
                    <div class="form-group" style="margin-left:10px">
                      <label for="site_from" class="control-label">Delete SITE ID From</label>
                      <input type="text" name="site_from" id="site_from" class="form-control" style="width:25%" required="required">
                    </div>
                    <div class="form-group" style="margin-left:10px">
                      <label for="site_to" class="control-label">To</label>
                      <input type="text" name="site_to" id="site_to" class="form-control" style="width:25%" required="required">
                    </div>
                    <button type="submit" class="btn btn-danger" style="margin-left:10px;margin-bottom:10px"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Delete</button>
                  </form>

                </div>
              </div>
              <div class="tab-pane mb-4" id="import">
                <form class="form-horizontal" action="<?= base_url('admin/download') ?>" method="post" enctype="multipart/form-data">
                  <div class="form-group" style="width:25%;margin:10px">
                    <button type="download" class="btn btn-download"><i class="fa fa-download" aria-hidden="true"></i> Download Format</button>
                  </div>

                </form>
                <div class="column">
                  <?php $fname = 'importsite_format.xlsx'; ?>
                  <form class="form-horizontal" action="<?= base_url('admin/proses_excel_upload') ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group" style="width:25%;margin:5px">
                      <label for="username" class="col-sm-12 control-label" style="text-align:left">Upload .xlsx File</label>
                      <input type="file" name="xlsx_file" class="form-control" id="username"><br>
                      <button type="submit" class="btn btn-success"><i class="fa fa-send" aria-hidden="true"></i>&nbsp;Submit</button>
                    </div>
                  </form>

                </div>
              </div>

              <div class="tab-pane" id="main">
                <a href="<?= base_url('admin/form_barangmasuk') ?>" style="margin-bottom:10px" type="button" class="btn btn-primary" name="tambah_data"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Data</a>
                <a href="<?= base_url('admin/move_data') ?>" style="margin-bottom:10px" type="button" class="btn btn-primary" name="tambah_data"><i class="fa fa-plus-circle" aria-hidden="true"></i> Export n/a Data</a>
                <?php if ($this->session->flashdata('msg_berhasil')) { ?>
                  <div class="alert alert-success alert-dismissible" style="width:100%">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong><br> <?php echo $this->session->flashdata('msg_berhasil'); ?>
                  </div>
                <?php } ?>

                <?php if ($this->session->flashdata('msg_berhasil_keluar')) { ?>
                  <div class="alert alert-success alert-dismissible" style="width:100%">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong><br> <?php echo $this->session->flashdata('msg_berhasil_keluar'); ?>
                  </div>
                <?php } ?>

                <!-- start datatable -->
                <table id="site_datatable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="width:2%">No</th>
                      <th>SITE ID</th>
                      <th style="width:2%">Exported</th>
                      <th>Region</th>
                      <th>Provinsi</th>
                      <th>Kota</th>
                      <th>Kecamatan</th>
                      <th>Desa</th>
                      <th>Paket</th>
                      <th>Batch</th>
                      <th>TRM</th>
                      <th>TSI</th>
                      <th>Amount Insured</th>
                      <th>Keterangan</th>
                      <th>Update</th>
                      <th>Delete</th>
                      <th>Keluarkan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php if (is_array($list_data)) { ?>
                        <?php $no = 1; ?>
                        <?php foreach ($list_data as $dd) : ?>
                          <td><?= $no ?></td>
                          <td><?= $dd->site_id ?></td>
                          <?php
                          $where = array('site_id' => $dd->site_id);
                          $count_data_keluar = $this->M_admin->count_exported_site($where);
                          ?>
                          <td><?= $count_data_keluar ?></td>
                          <td><?= $dd->region ?></td>
                          <td><?= $dd->provinsi ?></td>
                          <td><?= $dd->kabupaten ?></td>
                          <td><?= $dd->kecamatan ?></td>
                          <td><?= $dd->desa ?></td>
                          <td><?= $dd->paket ?></td>
                          <td><?= $dd->batch_ ?></td>
                          <td><?= $dd->ctrm ?></td>
                          <td><?= $dd->ctsi ?></td>

                          <?php if (is_numeric($dd->amount_insured)) { ?>
                            <td>IDR<?= number_format($dd->amount_insured, 2) ?></td>

                          <?php } else { ?>
                            <td>IDR0.00</td>
                          <?php } ?>

                          <td><?= $dd->keterangan ?></td>
                          <td><a type="button" class="btn btn-info" href="<?= base_url('admin/update_datamasuk/' . $dd->dummy_id) ?>" name="btn_update" style="margin:auto;"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                          <td><a type="button" class="btn btn-danger btn-delete" href="<?= base_url('admin/delete_data/' . $dd->dummy_id) ?>" name="btn_delete" style="margin:auto;"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                          <td><a type="button" class="btn btn-success btn-barangkeluar" href="<?= base_url('admin/move_data/' . $dd->dummy_id) ?>" name="btn_barangkeluar" style="margin:auto;"><i class="fa fa-sign-out" aria-hidden="true"></i></a></td>


                    </tr>
                    <?php $no++; ?>
                  <?php endforeach; ?>
                <?php } else { ?>
                  <td colspan="7" align="center"><strong>Data Kosong</strong></td>
                <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>SITE ID</th>
                      <th>Exported</th>
                      <th>Region</th>
                      <th>Provinsi</th>
                      <th>Kota</th>
                      <th>Kecamatan</th>
                      <th>Desa</th>
                      <th>Paket</th>
                      <th>Batch</th>
                      <th>TRM</th>
                      <th>TSI</th>
                      <th>Amount Insured</th>
                      <th>Keterangan</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
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
  <script src="<?php echo base_url() ?>assets/sweetalert/dist/sweetalert.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- DataTables -->
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url() ?>assets/web_admin/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url() ?>assets/web_admin/dist/js/demo.js"></script>

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/plug-ins/1.12.1/features/searchHighlight/dataTables.searchHighlight.css" />
  <script type="text/javascript" src="https:////cdn.datatables.net/plug-ins/1.12.1/features/searchHighlight/dataTables.searchHighlight.min.js"></script>
  <script type="text/javascript" src="https://bartaz.github.io/sandbox.js/jquery.highlight.js"></script>

  <!-- page script -->
  <script>
    jQuery(document).ready(function($) {
      $('.btn-delete').on('click', function() {
        var getLink = $(this).attr('href');
        swal({
          title: 'Delete Data',
          text: 'Yakin ingin menghapus data?',
          html: true,
          confirmButtonColor: '#d9534f',
          showCancelButton: true,
        }, function() {
          window.location.href = getLink
        });
        return false;
      });
    });

    $(function() {
      $('#site_datatable').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': true,
        'scrollX': true,
        searchHighlight: true,
      });
    });

    function confirmDelete(){
      var link = <?= base_url('admin/proses_delete_batch_data') ?>;
      var site_from = $('.site_from').val();
      var site_to = $('.site_to').val();
        swal({
          title: 'Delete Data',
          text: 'Yakin ingin menghapus data SITE ID ' + site_from + ' sampai ' + site_to + '?',
          html: true,
          confirmButtonColor: '#d9534f',
          showCancelButton: true,
        }, function() {
          window.location.href = link;
        });
        return false;
    }
  </script>
</body>

</html>


<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Romans\Filter\IntToRoman;

class Admin extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('M_admin');
    $this->load->library('upload');
  }

  public function proses_delete_batch_data()
  {
    echo "chandra!";
  }

  public function maintenance()
  {
    $this->load->view('admin/maintenance');
  }

  public function admin_true()
  {
    // if ($this->session->userdata('name') != 'chanderah') {
    //   //maintenance warn
    //   redirect(base_url('admin/maintenance'));
    // }

    if ($this->session->userdata('status') != 'login' && $this->session->userdata('role') != 1) {
      $this->load->view('login/login');
    }
  }

  public function index()
  {
    $this->admin_true();

    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
    $data['jumlahPermintaan'] = $this->M_admin->numrows('tb_site_in');
    $data['jumlahSite'] = $this->M_admin->numrows('tb_site_out');
    $data['dataUser'] = $this->M_admin->numrows('user');
    $this->load->view('admin/index', $data);
  }

  public function sigout()
  {
    session_destroy();
    redirect('login');
  }


  ####################################
  // Profile
  ####################################

  public function profile()
  {
    $data['token_generate'] = $this->token_generate();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
    $this->session->set_userdata($data);
    $this->load->view('admin/profile', $data);
  }

  public function token_generate()
  {
    return $tokens = md5(uniqid(rand(), true));
  }

  private function hash_password($password)
  {
    return password_hash($password, PASSWORD_DEFAULT);
  }

  public function proses_new_password()
  {
    $this->form_validation->set_rules('email', 'Email', 'required');
    $this->form_validation->set_rules('new_password', 'New Password', 'required');
    $this->form_validation->set_rules('confirm_new_password', 'Confirm New Password', 'required|matches[new_password]');

    if ($this->form_validation->run() == TRUE) {
      if ($this->session->userdata('token_generate') === $this->input->post('token')) {
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $new_password = $this->input->post('new_password');

        $data = array(
          'email'    => $email,
          'password' => $this->hash_password($new_password)
        );

        $where = array(
          'id' => $this->session->userdata('id')
        );

        $this->M_admin->update_password('user', $where, $data);

        $this->session->set_flashdata('msg_berhasil', 'Password Telah Diganti');
        redirect(base_url('admin/profile'));
      }
    } else {
      $this->load->view('admin/profile');
    }
  }

  public function proses_gambar_upload()
  {
    $config =  array(
      'upload_path'     => "./assets/upload/user/img/",
      'allowed_types'   => "gif|jpg|png|jpeg",
      'encrypt_name'    => False, //
      'max_size'        => "50000",  // ukuran file gambar
      'max_height'      => "9680",
      'max_width'       => "9024"
    );
    $this->load->library('upload', $config);
    $this->upload->initialize($config);

    if (!$this->upload->do_upload('userpicture')) {
      $this->session->set_flashdata('msg_error_gambar', $this->upload->display_errors());
      $this->load->view('admin/profile');
    } else {
      $upload_data = $this->upload->data();
      $nama_file = $upload_data['file_name'];
      $ukuran_file = $upload_data['file_size'];

      //resize img + thumb Img -- Optional
      $config['image_library']     = 'gd2';
      $config['source_image']      = $upload_data['full_path'];
      $config['create_thumb']      = FALSE;
      $config['maintain_ratio']    = TRUE;
      $config['width']             = 150;
      $config['height']            = 150;

      $this->load->library('image_lib', $config);
      $this->image_lib->initialize($config);
      if (!$this->image_lib->resize()) {
        $data['pesan_error'] = $this->image_lib->display_errors();
        $this->load->view('admin/profile', $data);
      }

      $where = array(
        'username_user' => $this->session->userdata('name')
      );

      $data = array(
        'nama_file' => $nama_file,
        'ukuran_file' => $ukuran_file
      );

      $this->M_admin->update('tb_upload_gambar_user', $data, $where);
      $this->session->set_flashdata('msg_berhasil_gambar', 'Gambar Berhasil Di Upload');
      redirect(base_url('admin/profile'));
    }
  }

  public function proses_excel_upload()
  {
    $config =  array(
      'upload_path'     => "./xlsx/",
      'file_name'     => "import_siteid.xlsx",
      'allowed_types'   => "xls|xlsx",
      'encrypt_name'    => False, //
      'max_size'        => "50000000000000000000000000", 
      "overwrite" => true
    );
    $this->load->library('upload', $config);
    $this->upload->initialize($config);

    if (!$this->upload->do_upload('xlsx_file')) {
      $this->session->set_flashdata('msg_error_gambar', $this->upload->display_errors());
      redirect(base_url('admin/tabel_barangmasuk'));
    } else {
      $upload_data = $this->upload->data();
      $nama_file = $upload_data['file_name'];
      $ukuran_file = $upload_data['file_size'];

      $this->import_excel();
      $this->session->set_flashdata('msg_berhasil_gambar', 'Excel Berhasil Di Upload');
      redirect(base_url('admin/tabel_barangmasuk'));
    }
  }

  public function download($filename = 'importsite_format.xlsx')
  {
    $this->load->helper('download');
    $path = file_get_contents(base_url() . "xlsx/" . $filename); // get file name
    $name = $filename; // new name for your file
    force_download($name, $path); // start download`
  }

  public function import_excel()
  {
    $path_xlsx = "./xlsx/import_siteid.xlsx";
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    $spreadsheet = $reader->load($path_xlsx);
    $d = $spreadsheet->getSheet(0)->toArray();
    unset($d[0]);
    $datas = array();

    foreach ($d as $t) {
      $sha1 = random_string('alpha', 10);
      $sha2 = random_string('sha1');
      $dummy_id = $sha1 . $sha2;

      $data["dummy_id"] = $dummy_id;
      $data["site_id"] = $t[0];
      $data["region"] = $t[1];
      $data["provinsi"] = $t[2];
      $data["kabupaten"] = $t[3];
      $data["kecamatan"] = $t[4];
      $data["desa"] = $t[5];
      $data["paket"] = $t[6];
      $data["batch_"] = $t[7];
      $data["ctrm"] = $t[8];
      $data["ctsi"] = $t[9];

      $keepNumeric = preg_replace('~\D~', '', $t[10]);
      $data["amount_insured"] = $keepNumeric;

      $keepNumeric2 = preg_replace('~\D~', '', $t[11]);
      $keteranganSite = $keepNumeric2 . ' Site';

      $data["keterangan"] = $keteranganSite;

      array_push($datas, $data);

      array_map('trim', $data);
    }
    $result = $this->add_data($datas);
    if ($result) {
      echo "Data berhasil diimport.";
    } else {
      echo "Data gagal diimport.";
    }
  }

  public function add_data($datas)
  {
    return $this->db->insert_batch("tb_site_in", $datas);
  }

  ####################################
  // End Profile
  ####################################



  ####################################
  // Users
  ####################################
  public function users()
  {
    $data['list_users'] = $this->M_admin->kecuali('user', $this->session->userdata('name'));
    $data['token_generate'] = $this->token_generate();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
    $this->session->set_userdata($data);
    $this->load->view('admin/users', $data);
  }

  public function form_user()
  {
    $data['token_generate'] = $this->token_generate();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
    $this->session->set_userdata($data);
    $this->load->view('admin/form_users/form_insert', $data);
  }

  public function update_user()
  {
    $id = $this->uri->segment(3);
    $where = array('id' => $id);
    $data['token_generate'] = $this->token_generate();
    $data['list_data'] = $this->M_admin->get_data('user', $where);
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
    $this->session->set_userdata($data);
    $this->load->view('admin/form_users/form_update', $data);
  }

  public function proses_delete_user()
  {
    $id = $this->uri->segment(3);
    $where = array('id' => $id);
    $this->M_admin->delete('user', $where);
    $this->session->set_flashdata('msg_berhasil', 'User Behasil Di Delete');
    redirect(base_url('admin/users'));
  }

  public function proses_tambah_user()
  {
    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required');
    $this->form_validation->set_rules('confirm_password', 'Confirm password', 'required|matches[password]');

    if ($this->form_validation->run() == TRUE) {
      if ($this->session->userdata('token_generate') === $this->input->post('token')) {

        $username     = $this->input->post('username', TRUE);
        $email        = $this->input->post('email', TRUE);
        $password     = $this->input->post('password', TRUE);
        $role         = $this->input->post('role', TRUE);

        $data = array(
          'username'     => $username,
          'email'        => $email,
          'password'     => $this->hash_password($password),
          'role'         => $role,
        );
        $this->M_admin->insert('user', $data);

        $this->session->set_flashdata('msg_berhasil', 'User Berhasil Ditambahkan');
        redirect(base_url('admin/form_user'));
      }
    } else {
      $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
      $this->load->view('admin/form_users/form_insert', $data);
    }
  }

  public function proses_update_user()
  {
    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

    if ($this->form_validation->run() == TRUE) {
      if ($this->session->userdata('token_generate') === $this->input->post('token')) {
        $id           = $this->input->post('id', TRUE);
        $username     = $this->input->post('username', TRUE);
        $email        = $this->input->post('email', TRUE);
        $role         = $this->input->post('role', TRUE);

        $where = array('id' => $id);
        $data = array(
          'username'     => $username,
          'email'        => $email,
          'role'         => $role,
        );
        $this->M_admin->update('user', $data, $where);
        $this->session->set_flashdata('msg_berhasil', 'Data User Berhasil Diupdate');
        redirect(base_url('admin/users'));
      }
    } else {
      $this->load->view('admin/form_users/form_update');
    }
  }

  ####################################
  // End Users
  ####################################

  ####################################
  // DATA Data Masuk
  ####################################

  public function form_barangmasuk()
  {
    $this->admin_true();

    $data['list_keterangan'] = $this->M_admin->select('tb_mop');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
    $this->load->view('admin/form_barangmasuk/form_insert', $data);
  }

  public function move_data()
  {
    $this->admin_true();

    $uri = $this->uri->segment(3);
    $where = array('dummy_id' => $uri);
    $data['list_data'] = $this->M_admin->get_data('tb_site_in', $where);
    $data['list_data_out'] = $this->M_admin->get_data('tb_site_out', $where);
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));

    $this->load->view('admin/form_barangmasuk/form_move', $data);
  }

  public function export_data()
  {
    $this->admin_true();

    $uri = $this->uri->segment(3);
    $where = array('dummy_id' => $uri);
    $data['list_data'] = $this->M_admin->get_data('tb_site_in', $where);
    $data['list_data_out'] = $this->M_admin->get_data('tb_site_out', $where);
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
    $this->load->view('admin/form_barangmasuk/form_move2', $data);
  }

  public function move_data_permintaan()
  {
    $this->admin_true();

    $uri = $this->uri->segment(3);
    $where = array('dummy_id' => $uri);
    $data['list_data'] = $this->M_admin->get_data('tb_request_in', $where);
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
    $this->load->view('admin/form_permintaan/form_move_permintaan', $data);
  }

  public function tabel_permintaanmasuk()
  {
    $this->admin_true();

    $data = array(
      'list_data' => $this->M_admin->select('tb_request_in'),
      'avatar'    => $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'))
    );
    $this->load->view('admin/tabel/tabel_permintaanmasuk', $data);
  }

  public function tabel_barangmasuk()
  {
    $this->admin_true();

    $data = array(
      'list_data' => $this->M_admin->select('tb_site_in'),
      'avatar'    => $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'))
    );
    $this->load->view('admin/tabel/tabel_barangmasuk', $data);
  }

  public function tabel_barang()
  {
    $this->admin_true();

    $data = array(
      'list_data' => $this->M_admin->select('tb_site_out'),
      'avatar'    => $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'))
    );
    $this->load->view('admin/tabel/tabel_barang', $data);
  }

  public function tabel_perubahan_site()
  {
    $this->admin_true();

    $data = array(
      'list_data' => $this->M_admin->select('tb_site_in_changes'),
      'avatar'    => $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'))
    );
    $this->load->view('admin/tabel/tabel_perubahan_site', $data);
  }

  public function update_datamasuk($dummy_id)
  {
    $this->admin_true();

    $where = array('dummy_id' => $dummy_id);

    $data['data_barang_update'] = $this->M_admin->get_data('tb_site_in', $where);
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
    $this->load->view('admin/form_barangmasuk/form_update', $data);
  }

  public function update_datakeluar($dummy_id)
  {
    $this->admin_true();

    $where = array('dummy_id' => $dummy_id);

    $data['cDarat'] = $this->M_admin->count_conveyance($dummy_id,'Darat');
    $data['cLaut'] = $this->M_admin->count_conveyance($dummy_id,'Laut');
    $data['cUdara'] = $this->M_admin->count_conveyance($dummy_id,'Udara');

    $data['data_barang_update'] = $this->M_admin->get_data('tb_site_out', $where);
    $data['data_conveyance'] = $this->M_admin->get_data('tb_conveyance', $where);
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
    $this->load->view('admin/form_barangmasuk/form_update_keluar', $data);
  }

  public function info_datamasuk($dummy_id)
  {
    $this->admin_true();

    $where = array('dummy_id' => $dummy_id);
    $data['data_barang_info'] = $this->M_admin->get_data('tb_request_in', $where);
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
    $this->load->view('admin/form_permintaan/form_request_info', $data);
  }

  public function delete_data($dummy_id)
  {
    $where = array('dummy_id' => $dummy_id);
    $this->M_admin->delete('tb_site_in', $where);
    redirect(base_url('admin/tabel_barangmasuk'));
  }

  public function delete_data_permintaan($dummy_id)
  {
    $where = array('dummy_id' => $dummy_id);
    $this->M_admin->delete('tb_request_in', $where);
    redirect(base_url('admin/tabel_permintaanmasuk'));
  }

  public function delete_datakeluar($dummy_id)
  {
    $where = array('dummy_id' => $dummy_id);
    $this->M_admin->delete('tb_site_in_exported', $where);
    $this->M_admin->delete('tb_site_out', $where);
    $this->M_admin->delete('tb_conveyance', $where);

    $this->session->set_flashdata('msg_berhasil', 'Data Berhasil Dihapus');
    redirect(base_url('admin/tabel_barangkeluar'));
  }

  public function proses_datamasuk_insert()
  {
    $this->load->helper('string');
    $this->form_validation->set_rules('site_id', 'site_id', 'required');

    $site_id = $this->input->post('site_id', TRUE);
    $site_id = str_replace(' ', '', $site_id);

    $region = $this->input->post('region', TRUE);
    $provinsi = $this->input->post('provinsi', TRUE);
    $kabupaten = $this->input->post('kabupaten', TRUE);
    $kecamatan = $this->input->post('kecamatan', TRUE);
    $desa = $this->input->post('desa', TRUE);
    $paket = $this->input->post('paket', TRUE);
    $batch_ = $this->input->post('batch_', TRUE);
    $ctrm = $this->input->post('ctrm', TRUE);
    $ctsi = $this->input->post('ctsi', TRUE);
    $amount_insured = $this->input->post('amount_insured', TRUE);
    $keterangan = $this->input->post('keterangan', TRUE);

    $sha1 = random_string('alpha', 10);
    $sha2 = random_string('sha1');
    $dummy_id = $sha1 . $sha2;

    $data = array(
      'dummy_id' => $dummy_id,
      'site_id' => $site_id,
      'keterangan' => $keterangan,

      'region' => $region,
      'provinsi' => $provinsi,
      'kabupaten' => $kabupaten,
      'kecamatan' => $kecamatan,
      'desa' => $desa,
      'paket' => $paket,
      'batch_' => $batch_,
      'ctrm' => $ctrm,
      'ctsi' => $ctsi,
      'amount_insured' => $amount_insured,
    );

    if ($this->form_validation->run() == TRUE) {
      $this->M_admin->insert('tb_site_in', $data);
      $this->session->set_flashdata('msg_berhasil', 'Data Berhasil Ditambahkan');
      redirect(base_url('admin/tabel_barangmasuk'));
    } else {
      redirect(base_url('admin/form_barangmasuk'));
      $this->session->set_flashdata('msg_berhasil', 'Data Gagal Ditambahkan');
      // $this->load->view('admin/form_barangmasuk/form_insert', $data);
    }
  }

  public function proses_datamasuk_update()
  {
    $this->form_validation->set_rules('dummy_id', 'dummy_id', 'required');
    $dummy_id = $this->input->post('dummy_id', TRUE);
    $site_id = $this->input->post('site_id', TRUE);
    $site_id = str_replace(' ', '', $site_id);

    $region = $this->input->post('region', TRUE);
    $provinsi = $this->input->post('provinsi', TRUE);
    $kabupaten = $this->input->post('kabupaten', TRUE);
    $kecamatan = $this->input->post('kecamatan', TRUE);
    $desa = $this->input->post('desa', TRUE);
    $paket = $this->input->post('paket', TRUE);
    $batch_ = $this->input->post('batch_', TRUE);
    $ctrm = $this->input->post('ctrm', TRUE);
    $ctsi = $this->input->post('ctsi', TRUE);
    $amount_insured = $this->input->post('amount_insured', TRUE);
    $keterangan = $this->input->post('keterangan', TRUE);

    $where = array('keterangan' => $keterangan);
    $getMop = $this->M_admin->get_data('tb_mop', $where);
    $cmop = $getMop->mop;

    $where = array('dummy_id' => $dummy_id);
    $data = array(
      'dummy_id' => $dummy_id,
      'site_id' => $site_id,
      'keterangan' => $keterangan,
      'cmop' => $cmop,

      'region' => $region,
      'provinsi' => $provinsi,
      'kabupaten' => $kabupaten,
      'kecamatan' => $kecamatan,
      'desa' => $desa,
      'paket' => $paket,
      'batch_' => $batch_,
      'ctrm' => $ctrm,
      'ctsi' => $ctsi,
      'amount_insured' => $amount_insured,
    );

    $data2 = $this->M_admin->get_data('tb_site_in', $where);
    foreach ($data2 as $d) {
      $newSiteID = array(
        'dummy_id' => $dummy_id,
        'old_site_id' => $d->site_id,
        'new_site_id' => $site_id,
      );
    }

    //if input post same as serven data
    if ($d->site_id !== $site_id) {
      $this->M_admin->insert('tb_site_in_changes', $newSiteID);
    }

    if ($this->form_validation->run() == TRUE) {
      $this->M_admin->update('tb_site_in', $data, $where);
      $this->session->set_flashdata('msg_berhasil', 'Data Berhasil Diupdate');
      redirect(base_url('admin/tabel_barangmasuk'));
    } else {
      $this->load->view('admin/form_barangmasuk/form_update', $data);
    }
  }
  ####################################
  // END DATA Data Masuk
  ####################################

  ####################################
  // DATA MASUK KE DATA KELUAR
  ####################################


  public function proses_datakeluar_insert()
  {
    $this->load->helper('string');
    $this->form_validation->set_rules('site_id', 'site_id', 'required');

    $insurance = $this->input->post("insurance");

    $id = $this->M_admin->get_max_id('id', 'tb_site_out');
    $no_sertif = $this->M_admin->get_max_id_where('no_sertif', 'tb_site_out', 'insurance', $insurance);

    $sha1 = random_string('alpha', 10);
    $sha2 = random_string('sha1');
    $dummy_id = $sha1 . $sha2;
    $site_id = $this->input->post('site_id', TRUE);
    $site_id = str_replace(' ', '', $site_id);

    $site_unique = array_unique(explode(',', $site_id));
    $getAllMop = array();

    foreach ($site_unique as $d) {
      //check site_in db first
      $where = array('site_id' => $d);
      $data2 = $this->M_admin->get_data('tb_site_in', $where);

      if (!$data2) {
        //site_in not found
        if ($insurance == 'Malacca') {
          $siteNA = array(
            'dummy_id' => $dummy_id,
            'site_id' => $d,
            'cmop' => '2003110722000000/MCOC/VI/2022',
            'keterangan' => 'N/A',
          );
        } else {
          $siteNA = array(
            'dummy_id' => $dummy_id,
            'site_id' => $d,
            'cmop' => '0608032100000',
            'keterangan' => 'N/A',
          );
        }
        $this->M_admin->insert('tb_site_in_exported', $siteNA);
      } else {
        //site_in found
        foreach ($data2 as $d2) {
          $where = array('insurance' => $insurance, 'keterangan' => $d2->keterangan);
          $getMop = $this->M_admin->get_data('tb_mop', $where);
          //belooom
          foreach ($getMop as $dd2) {
            $cmop = $dd2->mop;
            $getAllMop[] = $dd2->mop;
          }

          $siteExported = array(
            'dummy_id' => $dummy_id,
            'site_id' => $d2->site_id,
            'region' => $d2->region,
            'provinsi' => $d2->provinsi,
            'kabupaten' => $d2->kabupaten,
            'kecamatan' => $d2->kecamatan,
            'desa' => $d2->desa,
            'paket' => $d2->paket,
            'batch_' => $d2->batch_,
            'ctrm' => $d2->ctrm,
            'cmop' => $cmop,
            'ctsi' => $d2->ctsi,
            'amount_insured' => $d2->amount_insured,
            'keterangan' => $d2->keterangan
          );

          $this->M_admin->insert('tb_site_in_exported', $siteExported);
        }
      }
    }

    $the_insured = 'PT. FiberHome Technologies Indonesia and/or BAKTI 
                  (Badan Aksesibilitas Telekomunikasi dan Informasi)';
    $address_ = 'APL Tower, 30 Floor, Grogol, West Jakarta';


    $destination_from = $this->input->post("destination_from");
    $destination_to = $this->input->post("destination_to");
    $issuedDate = $this->input->post("issuedDate");
    $amount_insured2 = $this->input->post("amount_insured");
    preg_replace('~\D~', '', $amount_insured2);

    //get header sertif
    $str_length = 5;
    $no_sertif_5 = substr("00000{$no_sertif}", -$str_length);

    $yearIssued = date("y", strtotime($issuedDate));

    $numToRoman = new IntToRoman();
    $roman = $numToRoman->filter(date("m", strtotime($issuedDate)));
    $monthIssued = $roman;

    if ($insurance == 'Malacca') {
      //JIS22-2003110722000001/MCOC/VI/2022-VII-01353
      $header_sertif = 'JIS' . $yearIssued . '-' . '2003110722000001/MCOC/VI/2022' . '-' . $monthIssued . '-' . $no_sertif_5;
    } else {
      //JIS22-0608032100001-VI-01311
      $header_sertif = 'JIS' . $yearIssued . '-0608032100001-' . $monthIssued . '-' . $no_sertif_5;
    }

    $site_id_out = implode(',', array_unique(explode(',', $site_id)));

    sort($getAllMop);
    $linked_cmop = array_unique($getAllMop);
    $linked_cmop = implode(', ', $linked_cmop);

    $itemInsured = $this->input->post("itemInsured");

    $replacedItemInsured = str_replace('-', ' ', $itemInsured);
    $replacedItemInsured = str_replace('  ', ' ', $replacedItemInsured);
    $replacedItemInsured = str_replace('  ', ' ', $replacedItemInsured);

    $explodedItemInsured = explode("\n", $replacedItemInsured);

    $repairedItems = [];
    foreach ($explodedItemInsured as $a) {
      //1. Cat 6 UTP Patch Cord - 2 Meters 1 PCS
      $a = trim($a);

      $a = explode(' ', $a);
      $last_two_word = implode(' ', array_splice($a, -2));
      $upper_last_two = strtoupper($last_two_word);
      $except_last_two = implode(' ', $a);

      $repairedItems[] = $except_last_two . ' - ' . $upper_last_two;
    }

    $item_insured = implode(PHP_EOL, $repairedItems);

    $sailDate = $this->input->post("sailing_date");
    $countSailDate = count($sailDate); //2

    $sailing_dates = array();

    for ($i = 0; $i < count($sailDate); $i++) {
      $sailing_dates[] = $sailDate[$i];
    }

    $lastSailingDate = array_pop($sailing_dates);

    if ($countSailDate > 1) {
      $allSailingDate = implode(',', $sailing_dates) . ',' . $lastSailingDate;
    } elseif ($countSailDate == 1) {
      $allSailingDate = $lastSailingDate;
    }

    $siteOut = array(
      'id' => $id,
      'dummy_id' => $dummy_id,
      'site_id' => $site_id_out,
      'linked_mop' => $linked_cmop,
      'insurance' => $insurance,
      'no_sertif' => $no_sertif,
      'header_sertif' => $header_sertif,
      'the_insured' => $the_insured,
      'address_' => $address_,
      'itemInsured' => $item_insured,
      'issuedDate' => $issuedDate,
      'destination_from' => $destination_from,
      'destination_to' => $destination_to,
      'amount_insured' => $amount_insured2,
      'sailing_date' => $allSailingDate,
    );

    $this->M_admin->insert('tb_site_out', $siteOut);

    //darat
    $conveyance_by = $this->input->post("conveyance_by");
    $conveyance_type = $this->input->post("conveyance_type");
    $conveyance_policeno = $this->input->post("conveyance_policeno");
    $conveyance_age = $this->input->post("conveyance_age");
    $conveyance_driver = $this->input->post("conveyance_driver");
    //laut
    $conveyance_ship_name = $this->input->post("conveyance_ship_name");
    $conveyance_ship_type = $this->input->post("conveyance_ship_type");
    $conveyance_ship_birth = $this->input->post("conveyance_ship_birth");
    $conveyance_ship_GRT = $this->input->post("conveyance_ship_GRT");
    $conveyance_ship_containerno = $this->input->post("conveyance_ship_containerno");
    //udara
    $conveyance_plane_type = $this->input->post("conveyance_plane_type");
    $conveyance_plane_AWB = $this->input->post("conveyance_plane_AWB");


    $totalDarat = count($conveyance_type);
    $totalLaut = count($conveyance_ship_type);
    $totalUdara = count($conveyance_plane_AWB);

    if ($conveyance_by[0] != "") {
      //darat
      $list = array();
      for ($i = 0; $i < $totalDarat; $i++) {
        $data = [
          'dummy_id' => $dummy_id,
          'conveyance' => "Darat",
          'conveyance_by' => $conveyance_by[$i],
          'conveyance_type' => $conveyance_type[$i],
          'conveyance_policeno' => $conveyance_policeno[$i],
          'conveyance_driver' => $conveyance_driver[$i],
        ];
        array_push($list, $data);
      }
      $this->M_admin->insert_batch_into_table("tb_conveyance", $list);
    }

    if ($conveyance_ship_name[0] != ""){
      //laut
      $list = array();
      for ($i = 0; $i < $totalLaut; $i++) {
        $data = [
          'dummy_id' => $dummy_id,
          'conveyance' => "Laut",
          'conveyance_ship_name' => $conveyance_ship_name[$i],
          'conveyance_ship_type' => $conveyance_ship_type[$i],
          'conveyance_ship_birth' => $conveyance_ship_birth[$i],
          'conveyance_ship_GRT' => $conveyance_ship_GRT[$i],
          'conveyance_ship_containerno' => $conveyance_ship_containerno[$i],
        ];
        array_push($list, $data);
      }
      $this->M_admin->insert_batch_into_table("tb_conveyance", $list);
    }

    if ($conveyance_plane_type[0] != ""){
      //udara
      $list = array();
      for ($i = 0; $i < $totalUdara; $i++) {
        $data = [
          'dummy_id' => $dummy_id,
          'conveyance' => "Udara",
          'conveyance_plane_type' => $conveyance_plane_type[$i],
          'conveyance_plane_AWB' => $conveyance_plane_AWB[$i],
        ];
        array_push($list, $data);
      }
      $this->M_admin->insert_batch_into_table("tb_conveyance", $list);
    }

    $this->session->set_flashdata('msg_berhasil', 'Data Berhasil Ditambahkan');
  }

  public function proses_datakeluar_update()
  {
    $old_dummy_id = $this->input->post("dummy_id");
    $where_old = array('dummy_id' => $old_dummy_id);

    $sha1 = random_string('alpha', 10);
    $sha2 = random_string('sha1');
    $new_dummy_id = $sha1 . $sha2;

    $no_sertif = $this->input->post("no_sertif");

    $the_insured = 'PT. FiberHome Technologies Indonesia and/or BAKTI 
                    (Badan Aksesibilitas Telekomunikasi dan Informasi)';
    $address_ = 'APL Tower, 30 Floor, Grogol, West Jakarta';
    $insurance = $this->input->post("insurance");

    $destination_from = $this->input->post("destination_from");
    $destination_to = $this->input->post("destination_to");
    $issuedDate = $this->input->post("issuedDate");
    $amount_insured2 = $this->input->post("amount_insured");
    preg_replace('~\D~', '', $amount_insured2);

    $site_id = $this->input->post("site_id");
    $site_id = str_replace(' ', '', $site_id);

    $site_unique = array_unique(explode(',', $site_id));

    $getAllMop = array();

    $this->delete_old_data($where_old);

    foreach ($site_unique as $d) {
      //check site_in db first
      $where = array('site_id' => $d);
      $data2 = $this->M_admin->get_data('tb_site_in', $where);

      if (!$data2) {
        //site_in not found        
        if ($insurance == 'Malacca') {
          $siteNA = array(
            'dummy_id' => $new_dummy_id,
            'site_id' => $d,
            'cmop' => '2003110722000000/MCOC/VI/2022',
            'keterangan' => 'N/A',
          );
        } else {
          $siteNA = array(
            'dummy_id' => $new_dummy_id,
            'site_id' => $d,
            'cmop' => '0608032100000',
            'keterangan' => 'N/A',
          );
        }
        $this->M_admin->insert('tb_site_in_exported', $siteNA);
      } else {
        //site_in found
        foreach ($data2 as $d2) {
          $where = array('insurance' => $insurance, 'keterangan' => $d2->keterangan);
          $getMop = $this->M_admin->get_data('tb_mop', $where);

          foreach ($getMop as $dd2) {
            $cmop = $dd2->mop;
            $getAllMop[] = $dd2->mop;
          }

          $siteExported = array(
            'dummy_id' => $new_dummy_id,
            'site_id' => $d2->site_id,
            'region' => $d2->region,
            'provinsi' => $d2->provinsi,
            'kabupaten' => $d2->kabupaten,
            'kecamatan' => $d2->kecamatan,
            'desa' => $d2->desa,
            'paket' => $d2->paket,
            'batch_' => $d2->batch_,
            'ctrm' => $d2->ctrm,
            'cmop' => $cmop,
            'ctsi' => $d2->ctsi,
            'amount_insured' => $d2->amount_insured,
            'keterangan' => $d2->keterangan
          );

          $this->M_admin->insert('tb_site_in_exported', $siteExported);
        }
      }
    }

    //get header sertif
    $str_length = 5;
    $no_sertif_5 = substr("00000{$no_sertif}", -$str_length);

    $yearIssued = date("y", strtotime($issuedDate));

    $numToRoman = new IntToRoman();
    $roman = $numToRoman->filter(date("m", strtotime($issuedDate)));
    $monthIssued = $roman;
    //end 

    if ($insurance == 'Malacca') {
      //JIS22-2003110722000001/MCOC/VI/2022-VII-01353
      $header_sertif = 'JIS' . $yearIssued . '-' . '2003110722000001/MCOC/VI/2022' . '-' . $monthIssued . '-' . $no_sertif_5;
    } else {
      //JIS22-0608032100001-VI-01311
      $header_sertif = 'JIS' . $yearIssued . '-0608032100001-' . $monthIssued . '-' . $no_sertif_5;
    }

    $site_id_out = implode(',', array_unique(explode(',', $site_id)));

    sort($getAllMop);
    $linked_cmop = array_unique($getAllMop);
    $linked_cmop = implode(', ', $linked_cmop);

    $itemInsured = $this->input->post("itemInsured");

    $replacedItemInsured = str_replace('-', ' ', $itemInsured);
    $replacedItemInsured = str_replace('  ', ' ', $replacedItemInsured);
    $replacedItemInsured = str_replace('  ', ' ', $replacedItemInsured);

    $explodedItemInsured = explode("\n", $replacedItemInsured);

    $repairedItems = [];

    foreach ($explodedItemInsured as $a) {
      //1. Cat 6 UTP Patch Cord - 2 Meters 1 PCS
      $a = trim($a);

      $a = explode(' ', $a);
      $last_two_word = implode(' ', array_splice($a, -2));
      $upper_last_two = strtoupper($last_two_word);
      $except_last_two = implode(' ', $a);

      $repairedItems[] = $except_last_two . ' - ' . $upper_last_two;
    }

    $item_insured = implode(PHP_EOL, $repairedItems);

    $sailDate = $this->input->post("sailing_date");
    $countSailDate = count($sailDate); //2

    $sailing_dates = array();

    for ($i = 0; $i < count($sailDate); $i++) {
      $sailing_dates[] = $sailDate[$i];
    }

    $lastSailingDate = array_pop($sailing_dates);

    if ($countSailDate > 1) {
      $allSailingDate = implode(',', $sailing_dates) . ',' . $lastSailingDate;
    } elseif ($countSailDate == 1) {
      $allSailingDate = $lastSailingDate;
    }

    $siteOut = array(
      'dummy_id' => $new_dummy_id,
      'site_id' => $site_id_out,
      'insurance' => $insurance,
      'linked_mop' => $linked_cmop,
      'no_sertif' => $no_sertif,
      'header_sertif' => $header_sertif,
      'the_insured' => $the_insured,
      'address_' => $address_,
      'itemInsured' => $item_insured,
      'issuedDate' => $issuedDate,
      'destination_from' => $destination_from,
      'destination_to' => $destination_to,
      'amount_insured' => $amount_insured2,
      'sailing_date' => $allSailingDate,
    );

    //darat
    $conveyance_by = $this->input->post("conveyance_by");
    $conveyance_type = $this->input->post("conveyance_type");
    $conveyance_policeno = $this->input->post("conveyance_policeno");
    $conveyance_age = $this->input->post("conveyance_age");
    $conveyance_driver = $this->input->post("conveyance_driver");
    //laut
    $conveyance_ship_name = $this->input->post("conveyance_ship_name");
    $conveyance_ship_type = $this->input->post("conveyance_ship_type");
    $conveyance_ship_birth = $this->input->post("conveyance_ship_birth");
    $conveyance_ship_GRT = $this->input->post("conveyance_ship_GRT");
    $conveyance_ship_containerno = $this->input->post("conveyance_ship_containerno");
    //udara
    $conveyance_plane_type = $this->input->post("conveyance_plane_type");
    $conveyance_plane_AWB = $this->input->post("conveyance_plane_AWB");

    $totalDarat = count($conveyance_type);
    $totalLaut = count($conveyance_ship_type);
    $totalUdara = count($conveyance_plane_AWB);

    if ($conveyance_by[0] != "") {
      //darat
      $list = array();
      for ($i = 0; $i < $totalDarat; $i++) {
        $data = [
          'dummy_id' => $new_dummy_id,
          'conveyance' => "Darat",
          'conveyance_by' => $conveyance_by[$i],
          'conveyance_type' => $conveyance_type[$i],
          'conveyance_policeno' => $conveyance_policeno[$i],
          'conveyance_driver' => $conveyance_driver[$i],
        ];
        array_push($list, $data);
      }
      $this->M_admin->insert_batch_into_table("tb_conveyance", $list);
    }

    if ($conveyance_ship_name[0] != ""){
      //laut
      $list = array();
      for ($i = 0; $i < $totalLaut; $i++) {
        $data = [
          'dummy_id' => $new_dummy_id,
          'conveyance' => "Laut",
          'conveyance_ship_name' => $conveyance_ship_name[$i],
          'conveyance_ship_type' => $conveyance_ship_type[$i],
          'conveyance_ship_birth' => $conveyance_ship_birth[$i],
          'conveyance_ship_GRT' => $conveyance_ship_GRT[$i],
          'conveyance_ship_containerno' => $conveyance_ship_containerno[$i],
        ];
        array_push($list, $data);
      }
      $this->M_admin->insert_batch_into_table("tb_conveyance", $list);
    }

    if ($conveyance_plane_type[0] != ""){
      //udara
      $list = array();
      for ($i = 0; $i < $totalUdara; $i++) {
        $data = [
          'dummy_id' => $new_dummy_id,
          'conveyance' => "Udara",
          'conveyance_plane_type' => $conveyance_plane_type[$i],
          'conveyance_plane_AWB' => $conveyance_plane_AWB[$i],
        ];
        array_push($list, $data);
      }
      $this->M_admin->insert_batch_into_table("tb_conveyance", $list);
    }

    $this->M_admin->update('tb_site_out', $siteOut, $where_old);
    $this->session->set_flashdata('msg_berhasil', 'Data Berhasil Diubah');

  }

  public function delete_old_data($where_old)
  {
    $this->M_admin->delete('tb_conveyance', $where_old);
    $this->M_admin->delete('tb_site_in_exported', $where_old);
  }
  ####################################
  // END DATA MASUK KE DATA KELUAR
  ####################################


  ####################################
  // DATA Data Keluar
  ####################################

  public function tabel_barangkeluar()
  {
    $this->admin_true();

    $data['list_data'] = $this->M_admin->select('tb_site_out');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
    $this->load->view('admin/tabel/tabel_barangkeluar', $data);
  }

  ####################################
  // Tabel MOP
  ####################################

  public function tabel_mop()
  {
    $this->admin_true();

    $data = array(
      'list_data' => $this->M_admin->select('tb_mop'),
      'avatar'    => $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'))
    );
    $this->load->view('admin/tabel/tabel_mop', $data);
  }

  public function form_datamop()
  {
    $this->admin_true();

    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
    $this->load->view('admin/form_datamop/form_insert', $data);
  }

  public function proses_datamop_insert()
  {
    $id = $this->M_admin->get_max_id('id', 'tb_mop');

    $this->load->helper('string');

    $insurance = $this->input->post('insurance');
    $mop = $this->input->post('mop');
    $keterangan = $this->input->post('keterangan');
    $keteranganSite = $keterangan . ' Site';

    $data = array(
      'id' => $id,
      'insurance' => $insurance,
      'keterangan' => $keteranganSite,
      'mop' => $mop,
    );

    $this->M_admin->insert('tb_mop', $data);

    $this->session->set_flashdata('msg_berhasil', 'Data Berhasil Ditambahkan');
    redirect(base_url('admin/tabel_mop'));
  }

  public function proses_datamop_update()
  {
    $this->load->helper('string');

    $id = $this->input->post('id', TRUE);
    $mop = $this->input->post('mop');
    $keterangan = $this->input->post('keterangan');
    $insurance = $this->input->post('insurance');

    $keteranganSite = str_replace('Site', '', $keterangan);
    $keteranganSite = trim($keteranganSite);
    $keteranganSite = $keteranganSite . ' Site';

    $data = array(
      'insurance' => $insurance,
      'keterangan' => $keteranganSite,
      'mop' => $mop,
    );

    $where = array('id' => $id);
    $this->M_admin->update('tb_mop', $data, $where);

    $this->session->set_flashdata('msg_berhasil', 'Data Berhasil Diupdate');
    redirect(base_url('admin/tabel_mop'));
  }

  public function update_mop($id)
  {
    $where = array('id' => $id);

    $data['data_barang_update'] = $this->M_admin->get_data('tb_mop', $where);
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
    $this->load->view('admin/form_datamop/form_update', $data);
  }

  public function delete_mop($id)
  {
    $where = array('id' => $id);
    $this->M_admin->delete('tb_mop', $where);

    $this->session->set_flashdata('msg_berhasil', 'Data Berhasil Dihapus');
    redirect(base_url('admin/tabel_mop'));
  }
}

