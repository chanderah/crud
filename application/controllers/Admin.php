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

  public function aaa()
  {
    $this->load->view('admin/add_bill');
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
      'allowed_types'   => "xlsx",
      'encrypt_name'    => False, //
      'max_size'        => "50000000000000000000000000",
      'max_height'      => "9680",
      'max_width'       => "9024",
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
            'cmop' => '2003110722000001/MCOC/VI/2022',
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
