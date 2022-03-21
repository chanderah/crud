<?php if(!defined('BASEPATH')) exit('No direct script allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Product extends CI_Controller{

    function __construct(){

        parent::__construct();
        $this->load->model("m_admin");
        $this->load->library('upload');
    }

    function index(){

         $data["product"] = $this->m_admin->get_all();
         $this->load->view("product",$data);

    }   

    function import(){
        $path_xlsx = "./xlsx/import_siteid.xlsx";
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load($path_xlsx);
        $d = $spreadsheet->getSheet(0)->toArray();
        unset($d[0]);
        $datas = array();
        foreach ($d as $t) {
            
            $data["title"] = $t[0];
            $data["price"] = $t[1];
            $data["description"] = $t[2];
            array_push($datas,$data);
        }
        $result = $this->m_admin->add_data($datas);
        if($result){
            echo "Data berhasil diimport.";
        }else{
            echo "Data gagal diimport.";
        }
    }


}