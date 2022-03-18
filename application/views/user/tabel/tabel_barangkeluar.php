<br><br><br>
    <div class="container text-center" style="margin: 2em auto;">
    <h2 class="tex-center">Tabel Data Keluar</h2>
    <a href="<?=base_url('report/barangKeluarManual')?>" style="margin-bottom:10px;float:left;" type="button" class="btn btn-danger" name="laporan_data"><i class="fa fa-file-text" aria-hidden="true"></i> Invoice Manual</a>
    <div class="tabel" style="margin-top:80px">
    <table class="table table-bordered table-striped" style="margin: 2em auto;" id="tabel_barangkeluar">
    <thead>
      <tr>
        <th>No</th>
        <th>ID_Transaksi</th>
        <th>Region</th>
        <th>Provinsi</th>
        <th>Kota</th>
        <th>Kecamatan</th>
        <th>Desa</th>
        <th>Paket</th>
        <th>Batch</th>
        <th>Invoice</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <?php if(is_array($list_data)){ ?>
        <?php $no = 1;?>
        <?php foreach($list_data as $dd): ?>
          <td><?=$no?></td>
          <td><?=$dd->site_id?></td>
          <td><?=$dd->region?></td>
          <td><?=$dd->provinsi?></td>
          <td><?=$dd->region?></td>
          <td><?=$dd->kecamatan?></td>
          <td><?=$dd->desa?></td>
          <td><?=$dd->paket?></td>
          <td><?=$dd->batch_?></td>
          <td><a type="button" class="btn btn-danger btn-report"  href="<?=base_url('report/dataKeluar/'.$dd->site_id.'/'.$dd->provinsi)?>" name="btn_report" style="margin:auto;"><i class="fa fa-file-text" aria-hidden="true"></i></a></td>
      </tr>
    <?php $no++; ?>
    <?php endforeach;?>
    <?php }else { ?>
          <td colspan="7" align="center"><strong>Data Kosong</strong></td>
    <?php } ?>
    </tbody>
  </table>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    $('#tabel_barangkeluar').DataTable();
  });
</script>
