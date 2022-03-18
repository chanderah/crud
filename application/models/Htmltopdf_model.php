<?php
class Htmltopdf_model extends CI_Model
{
 function fetch()
 {
  $this->db->order_by('site_id', 'region');
  return $this->db->get('tb_site_out');
 }
 function fetch_single_details($site_id)
 {
  $this->db->where('site_id', $site_id);
  $data = $this->db->get('tb_site_out');
  $output = '<table width="100%" cellspacing="5" cellpadding="5">';
  foreach($data->result() as $row)
  {
   $output .= '
   <tr>
    <td width="25%"><img src="'.base_url().'images/'.$row->paket.'" /></td>
    <td width="75%">
     <p><b>Name : </b>'.$row->kecamatan.'</p>
     <p><b>Address : </b>'.$row->region.'</p>
     <p><b>City : </b>'.$row->desa.'</p>
     <p><b>Postal Code : </b>'.$row->region.'</p>
     <p><b>Country : </b> '.$row->region.' </p>
    </td>
   </tr>
   ';
  }
  $output .= '
  <tr>
   <td colspan="2" align="center"><a href="'.base_url().'htmltopdf" class="btn btn-primary">Back</a></td>
  </tr>
  ';
  $output .= '</table>';
  return $output;
 }
}

?>
