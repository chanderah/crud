<?php

class M_admin extends CI_Model
{
  public function select($table)
  {
    $query = $this->db->get($table);
    return $query->result();
  }

  public function get_data($table, $dummy_id)
  {
    $query = $this->db->select()
      ->from($table)
      ->where($dummy_id)
      ->get();

    if ($query->num_rows() > 0) {
      return $query->result();
    }
  }

  public function get_data_array($table, $site_id)
  {
    $query = $this->db->select()
      ->from($table)
      ->where($site_id)
      ->get();
    return $query->result_array();
  }

  public function insert($table, $data)
  {
    $this->db->insert($table, $data);
  }

  public function insert_batch_into_table($table_name, $data)
  {
    return $this->db->insert_batch($table_name, $data);
  }

  public function update($table, $data, $where)
  {
    $this->db->where($where);
    $this->db->update($table, $data);
  }

  public function delete($table, $where)
  {
    $this->db->where($where);
    $this->db->delete($table);
  }

  public function count_conveyance($dummy_id, $conveyance)
  {
    $array = array('dummy_id' => $dummy_id, 'conveyance' => $conveyance);

    $query = $this->db->select()
      ->from('tb_conveyance')
      ->where($array)
      ->get();

      if ($query->num_rows() > 0) {
        return $query->result();
      }
  } 
  
  public function kecuali($table, $username)
  {
    $query = $this->db->select()
      ->from($table)
      ->where_not_in('username', $username)
      ->get();

    return $query->result();
  }

  public function update_password($table, $where, $data)
  {
    $this->db->where($where);
    $this->db->update($table, $data);
  }

  public function get_data_gambar($table, $username)
  {
    $query = $this->db->select()
      ->from($table)
      ->where('username_user', $username)
      ->get();
    return $query->result();
  }
 
  public function numrows($table)
  {
    $query = $this->db->select()
      ->from($table)
      ->get();
    return $query->num_rows();
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
}
