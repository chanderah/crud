<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
  class Add_Remove extends CI_Controller {
    public function __construct() {
       parent::__construct();
       $this->load->model('M_admin');
       $this->load->library('upload');
     }    
    public function index(){
        $this->load->view('add_remove');
    }   
    public function store(){
    
    $this->form_validation->set_rules('site_id','SITE ID','required');

    if($this->form_validation->run() == TRUE)
    {
      $dummy_id = $this->input->post('dummy_id',TRUE);
      $site_id = $this->input->post('site_id',TRUE);
      $region = $this->input->post('region',TRUE);
      //$terbit = $this->input->post('terbit',TRUE);

      $where = array('dummy_id' => $dummy_id);
      $data = array(
            'dummy_id' => $dummy_id,
            'site_id' => $site_id,
            'region' => $region
            //'terbit' => $terbit       
      );
      $this->M_admin->insert_batch('tb_tb',$data,$where);
      //$this->session->set_flashdata('msg_berhasil','Data Berhasil Diupdate');
      redirect(base_url('add_remove'));
    }else{
      $this->load->view('add_remove');
    }       
    }       
}