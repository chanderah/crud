<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('M_user');
    $this->load->model('M_admin');
  }

  public function index()
  {
    if($this->session->userdata('status') == 'login' && $this->session->userdata('role') == 0)
    {
      $this->load->view('user/templates/header.php');
      $this->load->view('user/index');
      $this->load->view('user/templates/footer.php');
      $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
      $data['jumlahPermintaan'] = $this->M_admin->numrows('tb_site_in');
      $data['jumlahSite'] = $this->M_admin->numrows('tb_site_out');      
      $data['dataUser'] = $this->M_admin->numrows('user');
    }else {
      $this->load->view('login/login');
      
    }
  }

  public function token_generate()
  {
    return $tokens = md5(uniqid(rand(), true));
  }

  private function hash_password($password)
  {
    return password_hash($password,PASSWORD_DEFAULT);
  }

  public function setting()
  {
      $data['token_generate'] = $this->token_generate();
      $this->session->set_userdata($data);

      $this->load->view('user/templates/header.php');
      $this->load->view('user/setting',$data);
      $this->load->view('user/templates/footer.php');
  }

  public function proses_new_password()
  {
    $this->form_validation->set_rules('new_password','New Password','required');
    $this->form_validation->set_rules('confirm_new_password','Confirm New Password','required|matches[new_password]');

    if($this->form_validation->run() == TRUE)
    {
      if($this->session->userdata('token_generate') === $this->input->post('token'))
      {
        $username = $this->input->post('username');
        $new_password = $this->input->post('new_password');

        $data = array(
            'password' => $this->hash_password($new_password)
        );

        $where = array(
            'id' =>$this->session->userdata('id')
        );

        $this->M_user->update_password('user',$where,$data);

        $this->session->set_flashdata('msg_berhasil','Password Telah Diganti');
        redirect(base_url('user/setting'));
      }
    }else {
      $this->load->view('user/setting');
    }
  }

  public function signout()
  {
      session_destroy();
      redirect(base_url());
  }

  ####################################
        // DATA Data Masuk
  ####################################

  public function form_suratpermohonan()
  {
    $this->load->view('user/templates/header.php');
    $data['list_data'] = $this->M_user->select('tb_request_in');
    $this->load->view('user/form/surat_permohonan',$data);
    $this->load->view('user/templates/footer.php');
  }


  ####################################
        // DATA Data Keluar
  ####################################

  public function tabel_barangkeluar()
  {
    $this->load->view('user/templates/header.php');
    $data['list_data'] = $this->M_user->select('tb_site_out');
    $this->load->view('user/tabel/tabel_barangkeluar',$data);
    $this->load->view('user/templates/footer.php');
  }

  
  

  ####################################
        // Form Input
  ####################################


  public function proses_datamasuk_insert()
  {
    $this->form_validation->set_rules('site_id','site_id','required');

    if($this->form_validation->run() == TRUE)
    {        
      $sha1 = random_string('alpha', 10);
      $sha2 = random_string('sha1');
      $dummy_id = $sha1.$sha2;
      
      $site_id = $this->input->post('site_id',TRUE);
      $provinsi = $this->input->post('provinsi',TRUE);
      $region = $this->input->post('region',TRUE);
      $kecamatan = $this->input->post('kecamatan',TRUE);
      $desa = $this->input->post('desa',TRUE);
      $paket = $this->input->post('paket',TRUE);
      $batch_ = $this->input->post('batch_',TRUE);
  
      $data = array(
            'dummy_id' => $dummy_id,
            'site_id' => $site_id,
            'provinsi' => $provinsi,
            'region' => $region,
            'kecamatan' => $kecamatan,
            'desa' => $desa,
            'paket' => $paket,
            'batch_' => $batch_
      );

      $this->M_admin->insert('tb_site_in',$data);

      $this->session->set_flashdata('msg_berhasil','Data Barang Berhasil Ditambahkan');
      redirect(base_url('user/index'));
    }else {
      //$this->load->view('user/tabel/tabel_barangmasuk');
      $this->tabel_barangmasuk();
      //$this->load->view('user/tabel/tabel_barangmasuk',data);
      $this->session->set_flashdata('msg_error_gambar','Data Gagal');

    }


  }

}

?>
