<?php

ob_start();
defined('BASEPATH') or exit('No direct script access allowed');
use Romans\Filter\IntToRoman;

class Report extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('Pdf');
        $this->load->model('M_admin');
    }
    public function dataKeluar()
    {
        $this->load->helper('text');
        $id = $this->uri->segment(3);
        $ls = array('dummy_id' => $id);
        //$ls   = array('site_id' => $id ,'provinsi' => $tgl1.'/'.$tgl2.'/'.$tgl3);
        $data = $this->M_admin->get_data('tb_site_out', $ls);
        $data2 = $this->M_admin->get_data('tb_site_items', $ls);
        //create
        $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        //
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('PT. Jasmine Indah Servistama');
        $pdf->SetTitle('Invoice');
        $pdf->SetSubject('Invoice');
        $pdf->SetKeywords('PDF, Invoice');
        // 
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        //
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        //
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        //
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        //
        // $pdf->setLanguageArray($l);
        // ---------------------------------------------------------
        // set font
        //$pdf->SetFont('times', '', 15); 
        foreach ($data as $d) {
                // add a page
                $pdf->AddPage();
                // create some HTML content    
                $sailing_date = date("F j<\s\up>S</\s\up>, Y", strtotime($d->sailing_date));
                $dateIssued = date("F j<\s\up>S</\s\up>, Y", strtotime($d->issuedDate));
                $yearIssued = date("y", strtotime($d->issuedDate));
                $yearIssued2 = date("Y", strtotime($d->issuedDate));

                $numToRoman = new IntToRoman();
                $roman = $numToRoman->filter(date("m", strtotime($d->issuedDate)));
                $monthIssued = $roman;

                //$data = 'ABC Company';
                $invoice_ref_id = '2013/12/03/0001';
                $namaPerusahaan = 'PT. ASURANSI MAXIMUS GRAHA PERSADA, Tbk';
                $nosertifHeader =  '<font face="narrowi">
                                        <table cellpadding="5">
                                            <tr>
                                                <td align="center"><font size="13" font face="monotype">No. </font><font size="11" font face="narrowi">JIS'.$yearIssued.'-{MOP_Header}-'.$monthIssued.'-{no_sertif}</font></td>
                                            </tr>
                                        </table>   
                                    </font>';
                $nopolisHeader =   '<font face="lucida" font size="10">
                                        <table cellpadding="5" border="0">
                                            <tr>
                                                <td colspan="1" align="left" class="">THIS TO CERTIFY that insurance has been effected as per Open Policy No. {MOP}</td>
                                            </tr>
                                        </table>
                                    </font>';

                $replacedItemInsured = str_replace(',', '-', $d->itemInsured);
                $replacedItemInsured = str_replace('-', ' - ', $replacedItemInsured);
                $replacedItemInsured = str_replace('pcs', 'PCS', $replacedItemInsured);
                $replacedItemInsured = str_replace('Pcs', 'PCS', $replacedItemInsured);
                $replacedItemInsured = str_replace('set', 'SET', $replacedItemInsured);
                $replacedItemInsured = str_replace('Set', 'SET', $replacedItemInsured);

                // $foo = preg_replace('/\s+/', ' ', $foo);
                // $replacedItemInsured = str_replace('  ', ' ', $replacedItemInsured);
                // $replacedItemInsured = str_replace('   ', ' ', $replacedItemInsured);

                $pdf->SetFont('lucida', '', 9.5);
                $html .= $nosertifHeader;
                $style = array('width' => 0.2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
                $pdf->Line(181.5, 51, 25, 51, $style);
                // (length,start,marginstart,end,)
                $html .= $nopolisHeader;
                $pdf->setListIndentWidth(4.75);

                $html .= '<style>'.file_get_contents(base_url()."pdf/".'stylesheet.css').'</style>';

                $html .= '
                <table border="0" cellpadding="3">
                    <tr><br>
                        <td colspan="2"><b>The Insured</b></td>
                        <td colspan="1" align="right">:</td>
                        <td colspan="8" align="justify">' . $d->the_insured . ' and/or subsidiary and/or affiliated companies including those required or incorporated during the period of insurance for their respective rights and interest.</td>   
                    </tr>
                    <tr>
                        <td colspan="2">Address</td>
                        <td colspan="1" align="right">:</td>
                        <td colspan="8"align="justify">' . $d->address_ . '</td>
                    </tr>
                    <tr class="">
                        <td colspan="2">Interest Insured</td>
                        <td colspan="1" align="right" style="width:51px">:</td>
                        <td colspan="8">'.nl2br($replacedItemInsured).'</td>
                    </tr>';
                    // $explodedItemInsured = explode("\n", $replacedItemInsured);
                    // $x = 0;
                    // foreach ($explodedItemInsured as $a){
                    // $html .= '
                    //     <td colspan="8">'.$a.'</td>
                    // </tr>';
                    // $x++;
                    // }

                $html .= '</table>';

                // output the HTML content
                $pdf->writeHTML($html, true, false, true, false, '');
                
                // reset pointer to the last page
                // $pdf->lastPage();
                // ---------------------------------------------------------
                //Close and output PDF document
                $pdf_file_name = $d->site_id . ' Certificate of Insurance.pdf';
                $pdf->IncludeJS("print();");
                while (ob_get_level()) {
                    ob_end_clean(); 
                }
                $pdf->Output($pdf_file_name, 'I');
        }
    }
}