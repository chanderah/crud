    $this->form_validation->set_rules('region','Kota','required');

tanggal
<div class="form-group">
    <label for="tanggal" style="margin-left:220px;display:inline;">Region</label>
    <input type="text" name="tanggal" style="margin-left:66px;width:20%;display:inline;" class="form-control" readonly="readonly" value="<?=$d->region?>">
</div>

select
<div class="form-group" style="display:inline-block;">
    <label for="paket" style="width:73%;">Paket</label>
    <select class="form-control" name="paket" style="width:110%;margin-right: 18px;">
    <option value="<?=$d->paket?>" selected=""><?=$d->paket?></option>
    <?php }else{?>
    <option value="<?=$s->kode_satuan?>"><?=$s->nama_satuan?></option>
        <?php } ?>
        <?php } ?>
    </select>
</div>

    {
      $site_id = $this->input->post('site_id',TRUE);
      $region = $this->input->post('region',TRUE);
      $provinsi = $this->input->post('provinsi',TRUE);
      $kabupaten = $this->input->post('kabupaten',TRUE);
      $kecamatan = $this->input->post('kecamatan',TRUE);
      $desa = $this->input->post('desa',TRUE);
      $paket = $this->input->post('paket',TRUE);
      $batch_ = $this->input->post('batch_',TRUE);
      $ctrm = $this->input->post('ctrm',TRUE);
      $ctsi = $this->input->post('ctsi',TRUE);
      $amount_insured = $this->input->post('amount_insured',TRUE);
      $no_sertif = $this->input->post('no_sertif',TRUE);
      $keterangan = $this->input->post('keterangan',TRUE);
      //$terbit = $this->input->post('terbit',TRUE);

      $where = array('site_id' => $site_id);
      $data = array(
            'site_id' => $site_id,
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
            'no_sertif' => $no_sertif,
            'keterangan' => $keterangan