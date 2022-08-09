<?php

class M_admin extends CI_Model
{

  public function insert($tabel, $data)
  {
    $this->db->insert($tabel, $data);
  }

  public function select($tabel)
  {
    $query = $this->db->get($tabel);
    return $query->result();
  }

  public function cek_jumlah($tabel, $site_id)
  {
    return  $this->db->select('*')
      ->from($tabel)
      ->where('site_id', $site_id)
      ->get();
  }

  public function get_data_array($tabel, $site_id)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where($site_id)
      ->get();
    return $query->result_array();
  }

  public function get_data($tabel, $dummy_id)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where($dummy_id)
      ->get();

    if ($query->num_rows() > 0) {
      return $query->result();
    }
  }

  public function count_exported_site($site_id)
  {

    $query = $this->db->select()
      ->from('tb_site_in_exported')
      ->where($site_id)
      ->get();

    if ($query->num_rows() > 0) {
      if ($query->num_rows() != 1) {
        return $query->num_rows() . ' times';
      } else {
        return $query->num_rows() . ' time';
      }
    }
  }

  public function update($tabel, $data, $where)
  {
    $this->db->where($where);
    $this->db->update($tabel, $data);
  }

  public function delete($tabel, $where)
  {
    $this->db->where($where);
    $this->db->delete($tabel);
  }

  public function delete_data($tabel, $where)
  {
    $this->db->where($where);
    $this->db->delete($tabel);
  }

  public function mengurangi($tabel, $site_id, $batch_)
  {
    $this->db->set("batch_", "batch_ - $batch_");
    $this->db->where('site_id', $site_id);
    $this->db->update($tabel);
  }

  public function update_password($tabel, $where, $data)
  {
    $this->db->where($where);
    $this->db->update($tabel, $data);
  }

  public function get_data_gambar($tabel, $username)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where('username_user', $username)
      ->get();
    return $query->result();
  }

  public function sum($tabel, $field)
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

  public function kecuali($tabel, $username)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where_not_in('username', $username)
      ->get();

    return $query->result();
  }

  public function get_max_id($table_id, $table_name)
  {
    $row = $this->db->select_max($table_id)
      ->get($table_name)->row_array();
    $max_id = $row[$table_id] + 1;
    return $max_id;
  }

  public function get_max_id_where($table_id, $table_name, $column, $value)
  {
    $this->db->select($column)->from($table_name)->where($column, $value);
    $this->db->select_max($table_id);
    $query = $this->db->get()->row_array();

    $max_id = $query[$table_id] + 1;
    return $max_id;
  }

  public function add_data($datas)
  {
    return $this->db->insert_batch("tb_site_in", $datas);
  }

  public function insert_batch_into_table($table_name, $data)
  {
    return $this->db->insert_batch($table_name, $data);
  }
}
