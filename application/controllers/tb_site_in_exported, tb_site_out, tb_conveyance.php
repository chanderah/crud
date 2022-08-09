<?php


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

  //delete old data
  $this->M_admin->delete('tb_site_in_exported', $where_old);

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
          'cmop' => '2003110722000001/MCOC/VI/2022',
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

  if ($this->form_validation->run() == TRUE) {
    $this->M_admin->update('tb_site_out', $siteOut, $where_old);
    $this->session->set_flashdata('msg_berhasil', 'Data Berhasil Ditambahkan');
    // redirect(base_url('admin/tabel_barangkeluar'));
  } else {
    $this->session->set_flashdata('msg_berhasil', 'Data Berhasil Diupdate');
  }

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

  if ($conveyance_by[0] != "" && $conveyance_type[0] != "") {
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

  if ($conveyance_ship_name[0] != "" && $conveyance_ship_type[0] != "") {
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

  if ($conveyance_plane_type[0] != "" && $conveyance_plane_AWB[0] != "") {
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
  $this->M_admin->delete('tb_conveyance', $where_old);
}
