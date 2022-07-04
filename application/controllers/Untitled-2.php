<?php

function proses_datakeluar_update()
{
    $old_dummy_id =$this->input->post("dummy_id");

    $sha1 = random_string('alpha', 10);
    $sha2 = random_string('sha1');
    $new_dummy_id = $sha1 . $sha2;   
    
    $no_sertif =$this->input->post("no_sertif");

    $the_insured =$this->input->post("the_insured");
    $address_ =$this->input->post("address_");
    $conveyance =$this->input->post("conveyance");
    $itemInsured =$this->input->post("itemInsured");

    $destination_from =$this->input->post("destination_from");
    $destination_to =$this->input->post("destination_to");
    $sailing_date =$this->input->post("sailing_date");
    $issuedDate =$this->input->post("issuedDate");
    $amount_insured =$this->input->post("amount_insured");
    preg_replace('~\D~', '', $amount_insured);

    $conveyance =$this->input->post("conveyance");
    $conveyance_by =$this->input->post("conveyance_by");
    $conveyance_type =$this->input->post("conveyance_type");
    $conveyance_total =$this->input->post("conveyance_total");
    $conveyance_policeno =$this->input->post("conveyance_policeno");
    $conveyance_age =$this->input->post("conveyance_age");
    $conveyance_driver =$this->input->post("conveyance_driver");
    $conveyance_ship_name =$this->input->post("conveyance_ship_name");
    $conveyance_ship_type =$this->input->post("conveyance_ship_type");
    $conveyance_ship_birth =$this->input->post("conveyance_ship_birth");
    $conveyance_ship_GRT =$this->input->post("conveyance_ship_GRT");
    $conveyance_ship_containerno =$this->input->post("conveyance_ship_containerno");
    $conveyance_plane_type =$this->input->post("conveyance_plane_type");
    $conveyance_plane_AWB =$this->input->post("conveyance_plane_AWB");
    
    $site_id =$this->input->post("site_id");
    $site_id = str_replace(' ', '', $site_id);

    $site_unique = array_unique(explode(',', $site_id));

    $getAllMop = array();

    foreach ($site_unique as $d){
      //check site_in db first
      $where = array('site_id' => $d);
      $data2 = $this->M_admin->get_data('tb_site_in', $where);

      if ($data2=='empty'){
        //site_in not found
        $siteNA = array(
          'dummy_id' => $new_dummy_id,
          'site_id' => $d,
          'cmop' => '0608032100000',
          'keterangan' => 'N/A',
        );  
        $this->M_admin->insert('tb_site_in_exported', $siteNA);
      }

      else{
        //site_in found
        foreach($data2 as $d2){
          $where = array('keterangan' => $d2->keterangan);
          $getMop = $this->M_admin->get_data('tb_mop', $where);
          
          foreach ($getMop as $dd2){
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
      //delete old data
      $where2 = array('dummy_id' => $old_dummy_id);
      $this->M_admin->delete('tb_site_in_exported', $where2);
    }
    
    $input2 =$this->input->post("linked_with");
    $excludeSpace2 = str_replace(' ', '', $input2);

    //get header sertif
    $str_length = 5;
    $no_sertif_5 = substr("00000{$no_sertif}", -$str_length);

    $yearIssued = date("y", strtotime($issuedDate));

    $numToRoman = new IntToRoman();
    $roman = $numToRoman->filter(date("m", strtotime($issuedDate)));
    $monthIssued = $roman;
    //end 

    $header_sertif = 'JIS'.$yearIssued.'-0608032100001-'.$monthIssued.'-'.$no_sertif_5;

    $site_id_out = implode(',',array_unique(explode(',', $site_id)));
    
    sort($getAllMop);
    $linked_cmop = array_unique($getAllMop);
    $linked_cmop = implode(', ',$linked_cmop);

    $where = array('dummy_id' => $old_dummy_id);
    $siteOut = array(
      'dummy_id' => $new_dummy_id,
      'site_id' => $site_id_out,
      'linked_with' => $LinkedWithUnique,

      'linked_mop' => $linked_cmop,
  
      'no_sertif' => $no_sertif,
      'header_sertif' => $header_sertif,

      'the_insured' => $the_insured,
      'address_' => $address_,
      'itemInsured' => $itemInsured,
      'issuedDate' => $issuedDate,

      'destination_from' => $destination_from,
      'destination_to' => $destination_to,
      'amount_insured' => $amount_insured,
      'sailing_date' => $sailing_date,

      'conveyance' => $conveyance,
    );

    if ($conveyance=="Darat"){
        $dataConveyance = [
            'conveyance_by' => $conveyance_by,
            'conveyance_type' => $conveyance_type,
            //'conveyance_total' => $conveyance_total,
            'conveyance_policeno' => $conveyance_policeno,
            'conveyance_age' => $conveyance_age,
            'conveyance_driver' => $conveyance_driver
        ];
    }
    elseif ($conveyance=="Laut"){
        $dataConveyance = [
            'conveyance_ship_name' => $conveyance_ship_name,
            'conveyance_ship_type' => $conveyance_ship_type,
            'conveyance_ship_birth' => $conveyance_ship_birth,
            'conveyance_ship_GRT' => $conveyance_ship_GRT,
            'conveyance_ship_containerno' => $conveyance_ship_containerno
        ];
    }
    elseif ($conveyance=="Udara"){
        $dataConveyance = [
            'conveyance_plane_type' => $conveyance_plane_type,
            'conveyance_plane_AWB' => $conveyance_plane_AWB,
        ];
    }
    
    $mergeArr = array_merge($siteOut,$dataConveyance);

    $this->M_admin->update('tb_site_out', $mergeArr, $where);
    $this->session->set_flashdata('msg_berhasil', 'Data Berhasil Diupdate');
    redirect(base_url('admin/tabel_barangkeluar'));
  
}
