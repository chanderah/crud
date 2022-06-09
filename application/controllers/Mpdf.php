<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpdf extends CI_Controller {

	public function index()
	{
        $this->load->model('M_admin');

        $mpdfConfig = array(
            'mode' => 'utf-8', 
            'format' => 'A4',
            'margin_header' => 10,     // 30mm not pixel
            'margin_footer' => 6,     // 10mm
            'orientation' => 'P'    
        );

		$mpdf = new \Mpdf\Mpdf($mpdfConfig);

        $css = file_get_contents(base_url()."pdf/".'stylesheet.css'); // external css

        // Define the Header/Footer before writing anything so they appear on the first page
        $mpdf->SetHTMLHeader(
            '<div class="wrap">
                <img style="float:right;margin-top:25" width="180" src="' . base_url() . 'pdf/maximus.png"/>
                <img style="float:left;margin-top:5" width="100" src="' . base_url() . 'pdf/asuransi.png"/>
             </div>
            ');

        $mpdf->SetHTMLFooter('
            <table width="100%" style="font-size: 6pt; color: #646464;">
                <tr>
                    <td align="center">PT. Asuransi Maximus Graha Persada Tbk</td></tr>
                <tr>
                <tr>
                    <td align="center">d/h PT Asuransi Kresna Mitra Tbk</td></tr>
                <tr>
                <tr>
                    <td align="center">d/Gedung Graha Kirana Lantai 6, Jl. Yos Sudarso Kav 88, Sunter Jakarta Utara 14350, Indonesia</td></tr>
                <tr>
                <tr>
                    <td align="center">T: +62 21 6531 1150     F: +62 21 6531 1160</td></tr>
                <tr>
                    <td width="33%" align="right">Page {PAGENO}/{nbpg}</td>
                </tr>
            </table>');

        $mpdf->Output();


		$mpdf->WriteHTML($css,1);
		$mpdf->WriteHTML($mpdf,2);
		$mpdf->Output();	}
}   