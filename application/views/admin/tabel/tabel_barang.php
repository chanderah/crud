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
<body>
    <div class="div"style="margin:20px">
      <table id="site_datatable" class="table table-bordered table-striped" style="">
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
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php $no = 1; ?>
            <?php foreach ($list_data as $dd) : ?>
              <td><?= $no ?></td>
              <td><?= $dd->site_id ?></td>
              <?php 
                $where = array('site_id' => $dd->site_id);
                $count_data_keluar = $this->M_admin->count_exported_site($where);
              ?>
              <td><?=$count_data_keluar ?></td> 
              <td><?= $dd->region ?></td>
              <td><?= $dd->provinsi ?></td>
              <td><?= $dd->kabupaten ?></td>
              <td><?= $dd->kecamatan ?></td>
              <td><?= $dd->desa ?></td>
              <td><?= $dd->paket ?></td>
              <td><?= $dd->batch_ ?></td>
              <td><?= $dd->ctrm ?></td>
              <td><?= $dd->ctsi ?></td>

              <?php if(is_numeric($dd->amount_insured)){ ?>
                <td>IDR<?= number_format($dd->amount_insured, 2) ?></td>

              <?php }else{ ?>
                <td>IDR0.00</td>
              <?php } ?>

              <td><?= $dd->keterangan ?></td>    </tr>
          <?php $no++; ?>
        <?php endforeach; ?>
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
  
  <!-- DataTables Export -->
  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/JSZip-2.5.0/jszip.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/pdfmake-0.1.36/vfs_fonts.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/Buttons-2.2.3/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/Buttons-2.2.3/js/buttons.colVis.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/Buttons-2.2.3/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/Buttons-2.2.3/js/buttons.print.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/JSZip-2.5.0/jszip.min.js"></script>
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
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': false,
        'scrollX': true,
        lengthMenu: [10, 50, 100, 200, 500, 1000, 10000],
      })
    });
  </script>
</body>

</html>