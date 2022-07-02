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
    <div class="div" style="width:100%;margin:20px">
      <table id="site_datatable" class="table table-bordered table-striped" style="">
        <thead>
          <tr>
            <th rowspan="2">No.</th>
            <th rowspan="2">Certificate No.</th>
            <th rowspan="2">Endorsement No.</th>
            <th rowspan="2">Site ID</th>
            <th rowspan="2">Master Open Police</th>
            <th rowspan="2">Site</th>
            <th rowspan="2">From</th>
            <th rowspan="2">To</th>
            <th rowspan="2">Date of Sailing</th>
            <th rowspan="2">Interest Insured</th> 
            <th colspan="4">Conveyance</th>
            <th rowspan="2">Created At</th>
          </tr>
          <tr>
            <th>C. Name</th>
            <th>C. Type</th>
            <th>C. GRT</th>
            <th>C. Y.O.B</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php $no = 1; ?>
            <?php foreach ($list_data as $dd) : ?>
              <td><?=$no?></td>
              <td><?=$dd->header_sertif?></td>  
              <td>Endorsement No.</td>  
              <td><?=$dd->site_id?></td>
              <td><?=$dd->linked_mop?></td>
              <td>Total Site</td>
              <td><?=$dd->destination_from?></td>
              <td><?=$dd->destination_to?></td>
              <td><?=$dd->sailing_date?></td>
              <td><?=$dd->itemInsured?></td>
              <td><?=$dd->conveyance_name?></td>
              <td><?=$dd->conveyance_type?></td>
              <td><?=$dd->conveyance_grt?></td>
              <td><?=$dd->conveyance_yob?></td>
              <td><?=$dd->issuedDate?></td>
          </tr>
          <?php $no++; ?>
          <?php endforeach; ?>
        </tbody>
        <tfoot>
          <tr>
            <th>No.</th>
            <th>Certificate No.</th>
            <th>Endorsement No.</th>
            <th>Site ID</th>
            <th>Master Open Police</th>
            <th>Site</th>
            <th>From</th>
            <th>To</th>
            <th>Date of Sailing</th>
            <th>Interest Insured</th> 
            <th>Name</th>
            <th>Type</th>
            <th>GRT</th>
            <th>Y.O.B</th>
            <th>Created At</th>
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
  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/JSZip-2.5.0/jszip.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/ColReorder-1.5.6/js/dataTables.colReorder.min.js"></script>
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
        "columnDefs": [
          { "width": "2%", "targets": 0 }
        ],
        searchHighlight: true,
        colReorder: true,
        buttons: [
            {
                extend: 'excel',
                text: 'Export current data',
                exportOptions: {
                    modifier: {
                        page: 'current'
                    }
                }
            }
        ],
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': true,
        'scrollX': true,
        lengthMenu: [10, 50, 100, 200, 500, 1000, 10000],
      })
    });
  </script>
</body>

</html>