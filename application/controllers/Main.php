<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('error_reporting', 0);
class Main extends CI_Controller {

    public function __construct() {		
		parent::__construct();
		$this->load->model("m_admin");
    }

    public function index() {
		$this->add();
    }
    public function add() {
		$this->load->view('admin/add_bill');
    }
    
    public function input_datamasuk() {
        
        $name =$this->input->post("site_id");
        $site_id =$this->input->post("site_id");
        $sha1 = random_string('alpha', 10);
        $sha2 = random_string('sha1');

        $dummy_id = $sha1.$sha2;
        $the_insured =$this->input->post("the_insured");
        $address_ =$this->input->post("address_");
        $conveyance =$this->input->post("conveyance");
        $destination_from =$this->input->post("destination_from");
        $destination_to =$this->input->post("destination_to");
        $sailing_date =$this->input->post("sailing_date");
        $amount_insured =$this->input->post("amount_insured");
        $lampiran_BL =$this->input->post("lampiran_BL");
        $lampiran_LC =$this->input->post("lampiran_LC");
        $lampiran_invoice =$this->input->post("lampiran_invoice");
        $lampiran_PL =$this->input->post("lampiran_PL");
        $lampiran_DO =$this->input->post("lampiran_DO");
        
        $id = $max_id=$this->m_admin->get_max_id('id','tb_site_in');

        $list = array();
        $title =$this->input->post("txtTitle");
        for($i=0; $i<count($title); $i++) {
            $data = [
                //tb_site_items
                //'site_id2' => $site_id,
                'dummy_id' => $dummy_id,
                'bill_id' => $id,
                'title' => $this->input->post("txtTitle")[$i],
				'description' => $this->input->post("txtDescription")[$i]
            ];
            array_push($list,$data);
        }
        $data = [
            //tb_site_in
            'dummy_id' => $dummy_id,
            'the_insured' => $the_insured,
            'address_' => $address_,
            'conveyance' => $conveyance,
            'destination_from' => $destination_from,
            'destination_to' => $destination_to,
            'sailing_date' => $sailing_date,
            'amount_insured' => $amount_insured,
            'lampiran_BL' => $lampiran_BL,
            'lampiran_LC' => $lampiran_LC,
            'lampiran_invoice' => $lampiran_invoice,
            'lampiran_PL' => $lampiran_PL,
            'lampiran_DO' => $lampiran_DO,
            
            //'site_id' => $site_id,
            'id' => $id,
            'name' => $name,
            'status' => "1",
        ];

        if( $this->m_admin->insert_into_table("tb_site_in", $data) and 
            $this->m_admin->insert_batch_into_table("tb_site_items", $list)) {
                
                echo '<div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> Bill is created successfully.
                    </div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong> Something went wrong.
                </div>';
        }
    }

    public function update_datamasuk() {
        
        $site_id =$this->input->post("site_id");

        $the_insured =$this->input->post("the_insured");
        $address_ =$this->input->post("address_");
        $conveyance =$this->input->post("conveyance");
        $itemInsured =$this->input->post("itemInsured");

        $destination_from =$this->input->post("destination_from");
        $destination_to =$this->input->post("destination_to");
        $sailing_date =$this->input->post("sailing_date");
        $issuedDate =$this->input->post("issuedDate");
        $amount_insured =$this->input->post("amount_insured");
        $lampiran_BL =$this->input->post("lampiran_BL");
        $lampiran_LC =$this->input->post("lampiran_LC");
        $lampiran_invoice =$this->input->post("lampiran_invoice");
        $lampiran_PL =$this->input->post("lampiran_PL");
        $lampiran_DO =$this->input->post("lampiran_DO");
        
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

        $sha1 = random_string('alpha', 10);
        $sha2 = random_string('sha1');
        $dummy_id = $sha1.$sha2;
        
        $id = $max_id=$this->m_admin->get_max_id('id','tb_site_out');
        $no_sertif = $max_id=$this->m_admin->get_max_id('no_sertif','tb_site_out');

        // $list = array();
        // $title =$this->input->post("txtTitle");
        // for($i=0; $i<count($title); $i++) {
        //     $data = [
        //         //tb_site_items
        //         'dummy_id' => $dummy_id,
        //         'bill_id' => $id,
        //         'title' => $this->input->post("txtTitle")[$i],
		// 		'description' => $this->input->post("txtDescription")[$i]
        //     ];
        //     array_push($list,$data);
        // }
        
        // $explodeLink = explode(', ', $d->linked_with);
        $input =$this->input->post("linked_with");
        $excludeSpace = str_replace('   ', '', $input);
        $excludeSpace = str_replace('  ', '', $input);
        $excludeSpace = str_replace(' ', '', $excludeSpace);
        $excludeSpace = str_replace(',', ', ', $excludeSpace);
        
        $data =       
        [   
            'site_id' => $site_id,
            'linked_with' => $excludeSpace,
        
            'the_insured' => $the_insured,
            'address_' => $address_,
            'itemInsured' => $itemInsured,
            'issuedDate' => $issuedDate,

            'conveyance' => $conveyance,
            'destination_from' => $destination_from,
            'destination_to' => $destination_to,
            'sailing_date' => $sailing_date,
            'amount_insured' => $amount_insured,
            
            // 'lampiran_BL' => $lampiran_BL,
            // 'lampiran_LC' => $lampiran_LC,
            // 'lampiran_invoice' => $lampiran_invoice,
            // 'lampiran_PL' => $lampiran_PL,
            // 'lampiran_DO' => $lampiran_DO,

            // 'id' => $id,
            
            // //--------------DARAT---------------
            // 'conveyance_by' => $conveyance_by,
            // 'conveyance_type' => $conveyance_type,
            // //'conveyance_total' => $conveyance_total,
            // 'conveyance_policeno' => $conveyance_policeno,
            // 'conveyance_age' => $conveyance_age,
            // 'conveyance_driver' => $conveyance_driver,
            // //--------------LAUT---------------
            // 'conveyance_ship_name' => $conveyance_ship_name,
            // 'conveyance_ship_type' => $conveyance_ship_type,
            // 'conveyance_ship_birth' => $conveyance_ship_birth,
            // 'conveyance_ship_GRT' => $conveyance_ship_GRT,
            // 'conveyance_ship_containerno' => $conveyance_ship_containerno,
            // //--------------UDARA---------------
            // 'conveyance_plane_type' => $conveyance_plane_type,
            // 'conveyance_plane_AWB' => $conveyance_plane_AWB,
        ];

        $where = array('dummy_id' => $dummy_id);

        $this->M_admin->update('tb_site_out', $data, $where);
        $this->session->set_flashdata('msg_berhasil', 'Data Keluar Berhasil Diupdate');
        redirect(base_url('admin/tabel_barangmasuk'));
    }
    
    public function move_datamasuk() {
        
        $site_id =$this->input->post("site_id");

        $the_insured =$this->input->post("the_insured");
        $address_ =$this->input->post("address_");
        $conveyance =$this->input->post("conveyance");
        $itemInsured =$this->input->post("itemInsured");

        $destination_from =$this->input->post("destination_from");
        $destination_to =$this->input->post("destination_to");
        $sailing_date =$this->input->post("sailing_date");
        $issuedDate =$this->input->post("issuedDate");
        $amount_insured =$this->input->post("amount_insured");
        $lampiran_BL =$this->input->post("lampiran_BL");
        $lampiran_LC =$this->input->post("lampiran_LC");
        $lampiran_invoice =$this->input->post("lampiran_invoice");
        $lampiran_PL =$this->input->post("lampiran_PL");
        $lampiran_DO =$this->input->post("lampiran_DO");
        
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

        $sha1 = random_string('alpha', 10);
        $sha2 = random_string('sha1');
        $dummy_id = $sha1.$sha2;
        
        $id = $max_id=$this->m_admin->get_max_id('id','tb_site_out');
        $no_sertif = $max_id=$this->m_admin->get_max_id('no_sertif','tb_site_out');

        // $list = array();
        // $title =$this->input->post("txtTitle");
        // for($i=0; $i<count($title); $i++) {
        //     $data = [
        //         //tb_site_items
        //         'dummy_id' => $dummy_id,
        //         'bill_id' => $id,
        //         'title' => $this->input->post("txtTitle")[$i],
		// 		'description' => $this->input->post("txtDescription")[$i]
        //     ];
        //     array_push($list,$data);
        // }
        
        // $explodeLink = explode(', ', $d->linked_with);
        $input =$this->input->post("linked_with");
        $excludeSpace = str_replace('   ', '', $input);
        $excludeSpace = str_replace('  ', '', $input);
        $excludeSpace = str_replace(' ', '', $excludeSpace);
        $excludeSpace = str_replace(',', ', ', $excludeSpace);
        
        $data =       
        [   
            'dummy_id' => $dummy_id,
            'no_sertif' => $no_sertif,
            'site_id' => $site_id,
            'linked_with' => $excludeSpace,
        
            'the_insured' => $the_insured,
            'address_' => $address_,
            'itemInsured' => $itemInsured,
            'issuedDate' => $issuedDate,

            'conveyance' => $conveyance,
            'destination_from' => $destination_from,
            'destination_to' => $destination_to,
            'sailing_date' => $sailing_date,
            'amount_insured' => $amount_insured,
            
            
            // 'lampiran_BL' => $lampiran_BL,
            // 'lampiran_LC' => $lampiran_LC,
            // 'lampiran_invoice' => $lampiran_invoice,
            // 'lampiran_PL' => $lampiran_PL,
            // 'lampiran_DO' => $lampiran_DO,

            'id' => $id,
            
            //--------------DARAT---------------
            'conveyance_by' => $conveyance_by,
            'conveyance_type' => $conveyance_type,
            //'conveyance_total' => $conveyance_total,
            'conveyance_policeno' => $conveyance_policeno,
            'conveyance_age' => $conveyance_age,
            'conveyance_driver' => $conveyance_driver,
            //--------------LAUT---------------
            'conveyance_ship_name' => $conveyance_ship_name,
            'conveyance_ship_type' => $conveyance_ship_type,
            'conveyance_ship_birth' => $conveyance_ship_birth,
            'conveyance_ship_GRT' => $conveyance_ship_GRT,
            'conveyance_ship_containerno' => $conveyance_ship_containerno,
            //--------------UDARA---------------
            'conveyance_plane_type' => $conveyance_plane_type,
            'conveyance_plane_AWB' => $conveyance_plane_AWB,
        ];

        // if( $this->m_admin->insert_into_table("tb_site_out", $data) and 
        //     $this->m_admin->insert_batch_into_table("tb_site_items", $list)) {   
        if($this->m_admin->insert_into_table("tb_site_out", $data)) {                                 
            echo '<div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> Data Berhasil Keluar.
                </div>';

        } else {
            echo '<div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong> Something went wrong.
                </div>';
        }
    }
    
    public function move_datamasuk_permintaan() {
        
        $site_id =$this->input->post("site_id");
        $dummy_id =$this->input->post("dummy_id");

        $the_insured =$this->input->post("the_insured");
        $address_ =$this->input->post("address_");
        $conveyance =$this->input->post("conveyance");
        $destination_from =$this->input->post("destination_from");
        $destination_to =$this->input->post("destination_to");
        $sailing_date =$this->input->post("sailing_date");
        $amount_insured =$this->input->post("amount_insured");
        $lampiran_BL =$this->input->post("lampiran_BL");
        $lampiran_LC =$this->input->post("lampiran_LC");
        $lampiran_invoice =$this->input->post("lampiran_invoice");
        $lampiran_PL =$this->input->post("lampiran_PL");
        $lampiran_DO =$this->input->post("lampiran_DO");
        
        $conveyance =$this->input->post("conveyance");
        $conveyance_type =$this->input->post("conveyance_type");
        $conveyance_total =$this->input->post("conveyance_total");
        $conveyance_policeno =$this->input->post("conveyance_policeno");
        $conveyance_age =$this->input->post("conveyance_age");
        $conveyance_driver =$this->input->post("conveyance_driver");
        $conveyance_ship_name =$this->input->post("conveyance_ship_name");
        $conveyance_ship_type =$this->input->post("conveyance_ship_type");
        $conveyance_ship_birth =$this->input->post("conveyance_ship_birth");
        $conveyance_ship_GRT =$this->input->post("conveyance_ship_GRT");
        $conveyance_plane_type =$this->input->post("conveyance_plane_type");
        $conveyance_plane_AWB =$this->input->post("conveyance_plane_AWB");
        
        $id = $max_id=$this->m_admin->get_max_id('id','tb_site_out');
        $no_sertif = $max_id=$this->m_admin->get_max_id('no_sertif','tb_site_out');

        $list = array();
        $title =$this->input->post("txtTitle");
        for($i=0; $i<count($title); $i++) {
            $data = [
                //tb_site_items
                //'site_id2' => $site_id,
                'dummy_id' => $dummy_id,
                'bill_id' => $id,
                'title' => $this->input->post("txtTitle")[$i],
				'description' => $this->input->post("txtDescription")[$i]
            ];
            array_push($list,$data);
        }
        
        $explodeLink = explode(', ', $d->linked_with);
        $linked_with =$this->input->post("linked_with");
        
        $data =       
        [   
            'dummy_id' => $dummy_id,
            'no_sertif' => $no_sertif,
            'site_id' => $site_id,
            'linked_with' => $linked_with,
        
            'the_insured' => $the_insured,
            'address_' => $address_,
            'conveyance' => $conveyance,
            'destination_from' => $destination_from,
            'destination_to' => $destination_to,
            'sailing_date' => $sailing_date,
            'amount_insured' => $amount_insured,
            'lampiran_BL' => $lampiran_BL,
            'lampiran_LC' => $lampiran_LC,
            'lampiran_invoice' => $lampiran_invoice,
            'lampiran_PL' => $lampiran_PL,
            'lampiran_DO' => $lampiran_DO,
            //'site_id' => $site_id,
            'id' => $id,
            
            //--------------DARAT---------------
            'conveyance_type' => $conveyance_type,
            //'conveyance_total' => $conveyance_total,
            'conveyance_policeno' => $conveyance_policeno,
            'conveyance_age' => $conveyance_age,
            'conveyance_driver' => $conveyance_driver,
            //--------------LAUT---------------
            'conveyance_ship_name' => $conveyance_ship_name,
            'conveyance_ship_type' => $conveyance_ship_type,
            'conveyance_ship_birth' => $conveyance_ship_birth,
            'conveyance_ship_GRT' => $conveyance_ship_GRT,
            //--------------UDARA---------------
            'conveyance_plane_type' => $conveyance_plane_type,
            'conveyance_plane_AWB' => $conveyance_plane_AWB,
        ];

        $dummy_id =$this->input->post("dummy_id");
        $where = array('dummy_id' => $dummy_id);

        if( $this->m_admin->insert_into_table("tb_site_out", $data)) {  
            $this->m_admin->delete_record_from_table('tb_request_in',$where);
                echo '<div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong> Data Berhasil Keluar.
                    </div>';
                    // $this->M_admin->delete('tb_request_in',$where);       


        } else {
            echo '<div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong> Something went wrong.
                </div>';
        }
    }
    
    public function input_suratpermohonan() {
        
        $the_insured =$this->input->post("the_insured");
        $address_ =$this->input->post("address_");
        $conveyance =$this->input->post("conveyance");
        $destination_from =$this->input->post("destination_from");
        $destination_to =$this->input->post("destination_to");
        $sailing_date =$this->input->post("sailing_date");
        $amount_insured =$this->input->post("amount_insured");
        $lampiran_BL =$this->input->post("lampiran_BL");
        $lampiran_LC =$this->input->post("lampiran_LC");
        $lampiran_invoice =$this->input->post("lampiran_invoice");
        $lampiran_PL =$this->input->post("lampiran_PL");
        $lampiran_DO =$this->input->post("lampiran_DO");
        
        $conveyance =$this->input->post("conveyance");
        $conveyance_type =$this->input->post("conveyance_type");
        $conveyance_total =$this->input->post("conveyance_total");
        $conveyance_policeno =$this->input->post("conveyance_policeno");
        $conveyance_age =$this->input->post("conveyance_age");
        $conveyance_driver =$this->input->post("conveyance_driver");
        $conveyance_ship_name =$this->input->post("conveyance_ship_name");
        $conveyance_ship_type =$this->input->post("conveyance_ship_type");
        $conveyance_ship_birth =$this->input->post("conveyance_ship_birth");
        $conveyance_ship_GRT =$this->input->post("conveyance_ship_GRT");
        $conveyance_plane_type =$this->input->post("conveyance_plane_type");
        $conveyance_plane_AWB =$this->input->post("conveyance_plane_AWB");

        $sha1 = random_string('alpha', 10);
        $sha2 = random_string('sha1');
        $dummy_id = $sha1.$sha2;
        
        $id = $max_id=$this->m_admin->get_max_id('id','tb_request_in');

        $list = array();
        $title =$this->input->post("txtTitle");
        for($i=0; $i<count($title); $i++) {
            $data = [
                //tb_site_items
                //'site_id2' => $site_id,
                'dummy_id' => $dummy_id,
                'bill_id' => $id,
                'title' => $this->input->post("txtTitle")[$i],
				'description' => $this->input->post("txtDescription")[$i]
            ];
            array_push($list,$data);
        }
        
        $data =       
        [
            'dummy_id' => $dummy_id,
        
            'the_insured' => $the_insured,
            'address_' => $address_,
            'conveyance' => $conveyance,
            'destination_from' => $destination_from,
            'destination_to' => $destination_to,
            'sailing_date' => $sailing_date,
            'amount_insured' => $amount_insured,
            'lampiran_BL' => $lampiran_BL,
            'lampiran_LC' => $lampiran_LC,
            'lampiran_invoice' => $lampiran_invoice,
            'lampiran_PL' => $lampiran_PL,
            'lampiran_DO' => $lampiran_DO,
            //'site_id' => $site_id,
            'id' => $id,
            
            //--------------DARAT---------------
            'conveyance_type' => $conveyance_type,
            //'conveyance_total' => $conveyance_total,
            'conveyance_policeno' => $conveyance_policeno,
            'conveyance_age' => $conveyance_age,
            'conveyance_driver' => $conveyance_driver,
            //--------------LAUT---------------
            'conveyance_ship_name' => $conveyance_ship_name,
            'conveyance_ship_type' => $conveyance_ship_type,
            'conveyance_ship_birth' => $conveyance_ship_birth,
            'conveyance_ship_GRT' => $conveyance_ship_GRT,
            //--------------UDARA---------------
            'conveyance_plane_type' => $conveyance_plane_type,
            'conveyance_plane_AWB' => $conveyance_plane_AWB,
        ];

        if( $this->m_admin->insert_into_table("tb_request_in", $data) and 
            $this->m_admin->insert_batch_into_table("tb_site_items", $list)) {                                    
                                    
                echo '<div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> Data Berhasil Masuk.
                    </div>';

        } else {
            echo '<div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong> Something went wrong.
                </div>';
        }
    }


}
?>