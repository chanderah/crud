<?php

class M_site_id extends CI_Model
{

  public function insert($tabel,$data)
  {
    $this->db->insert($tabel,$data);
  }

  public function select($tabel)
  {
    $query = $this->db->get($tabel);
    return $query->result();
  }

  public function cek_jumlah($tabel,$site_id)
  {
    return  $this->db->select('*')
               ->from($tabel)
               ->where('site_id',$site_id)
               ->get();
  }

  public function get_data_array($tabel,$site_id)
  {
    $query = $this->db->select()
                      ->from($tabel)
                      ->where($site_id)
                      ->get();
    return $query->result_array();
  }

  public function get_data($tabel,$site_id)
  {
    $query = $this->db->select()
                      ->from($tabel)
                      ->where($site_id)
                      ->get();
    return $query->result();
  }

  public function update($tabel,$data,$where)
  {
    $this->db->where($where);
    $this->db->update($tabel,$data);
  }

  public function delete($tabel,$where)
  {
    $this->db->where($where);
    $this->db->delete($tabel);
  }

  public function mengurangi($tabel,$site_id,$batch_)
  {
    $this->db->set("batch_","batch_ - $batch_");
    $this->db->where('site_id',$site_id);
    $this->db->update($tabel);
  }

  public function update_password($tabel,$where,$data)
  {
    $this->db->where($where);
    $this->db->update($tabel,$data);
  }

  public function get_data_gambar($tabel,$username)
  {
    $query = $this->db->select()
                      ->from($tabel)
                      ->where('username_user',$username)
                      ->get();
    return $query->result();
  }

  public function sum($tabel,$field)
  {
    $query = $this->db->select_sum($field)
                      ->from($tabel)
                      ->get();
    return $query->result();
  }

  public function numrows($tabel)
  {
    $query = $this->db->select()
                      ->from($tabel)
                      ->get();
    return $query->num_rows();
  }

  public function kecuali($tabel,$username)
  {
    $query = $this->db->select()
                      ->from($tabel)
                      ->where_not_in('username',$username)
                      ->get();

    return $query->result();
  }
  


}



 ?>
