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
        $pdf->SetAuthor('Chandra SA');
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
                $sailing_date = date("F jS, Y", strtotime($d->sailing_date));
                $dateIssued = date("F jS, Y", strtotime($d->created_at));
                $yearIssued = date("y", strtotime($d->created_at));

                    $numToRoman = new IntToRoman();
                    $roman = $numToRoman->filter(date("m", strtotime($d->created_at)));
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
                                        <table cellpadding="5">
                                            <tr>
                                                <td colspan="1" align="left">THIS TO CERTIFY that insurance has been effected as per Open Policy No. {MOP}</td>
                                            </tr>
                                        </table>
                                    </font>';
                // *** IMP: The value of $html and $html_terms can come from db
                // But, If these values contain, other language special characters, then
                // PDF is not getting generated. in that case should find such invalid charactes and 
                // make use of its html entity substitute 
                // for ex. If copyright is invalid character then use &copy; in html content
                // set font
                $pdf->SetFont('lucida', '', 9.5);
                $html .= $nosertifHeader;
                $style = array('width' => 0.2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
                $pdf->Line(185.5, 51, 21, 51, $style);
                // (length,start,marginstart,end,)
                $html .= $nopolisHeader;
                $pdf->setListIndentWidth(4.75);
                $html .= '
                <table border="" cellpadding="3">
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
                    <tr>
                        <td colspan="2">Interest Insured</td>
                        <td colspan="1" align="right">:</td>
                    </tr> 
                ';
                //2
                $no = 1;
                foreach ($data2 as $d2) {
                    $html .= '
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="8">' . $no . '. ' . $d2->title . ' - ' . $d2->description . ' Pcs</td>
                        </tr>
                        ';
                    $no++;
                    $pdf->Ln();
                }
                $html .= '</table>';
                $html .= '
            <table border="" cellpadding="3">
                <tr>
                <td colspan="2">Mark/Numbers</td>
                <td colspan="1" align="right">:</td>
                <td colspan="8"align="justify">-</td>
                </tr>
                <tr>
                    <td colspan="2">Amount Insured</td>
                    <td colspan="1" align="right">:</td>
                    <td colspan="8"align="justify">IDR{amountInsured}</td>
                </tr>
                <tr>
                    <td colspan="2">L/C</td>
                    <td colspan="1" align="right">:</td>
                    <td colspan="8"align="justify">' . $d->lampiran_LC . '</td>
                </tr>
                <tr>
                    <td colspan="2">B/L</td>
                    <td colspan="1" align="right">:</td>
                    <td colspan="8"align="justify">' . $d->lampiran_BL . '</td>
                </tr>
                <tr>
                    <td colspan="2">Invoice Number</td>
                    <td colspan="1" align="right">:</td>
                    <td colspan="8"align="justify">' . $d->lampiran_invoice . '</td>
                </tr>
                <tr>
                    <td colspan="2">Scope of Cover</td>
                    <td colspan="1" align="right">:</td>
                    <td colspan="8"align="justify">As per M.O.P No. : {scopeCover}
                    </td>
                </tr>
                <tr>
                    <td colspan="2">Date of Sailing</td>
                    <td colspan="1" align="right">:</td>
                    <td colspan="8"align="justify">' . $sailing_date . '</td>
                </tr>
                <tr>
                    <td colspan="2">Conveyance</td>
                    <td colspan="1" align="right">:</td>
                    <td colspan="8"align="justify">{conveyance}</td>
                </tr>
                <tr>
                    <td colspan="2">Destination</td>
                </tr>
                <tr>
                    <td colspan="2">   - At & From</td>
                    <td colspan="1" align="right">:</td>
                    <td colspan="8"align="justify">' . $d->destination_from . '</td>
                </tr>
                <tr>
                    <td colspan="2">   - Transhipment</td>
                    <td colspan="1" align="right">:</td>
                    <td colspan="8"align="justify">-</td>
                </tr>
                <tr>
                    <td colspan="2">   - To</td>
                    <td colspan="1" align="right">:</td>
                    <td colspan="8"align="justify">' . $d->destination_to . '</td>
                </tr>
            </table>';
                if (defined('FPDF_FONTPATH')) {
                    $this->fontpath = FPDF_FONTPATH;
                    if (substr($this->fontpath, -1) != '/' && substr($this->fontpath, -1) != '\\')
                        $this->fontpath .= '/';
                }
                if ($d->linked_with == true) {
                    $explodeLink = explode(', ', $d->linked_with);
                    $totalLink = count($explodeLink);
                    if ($totalLink < 10) {
                        //disini
                        $no = 1;
                        array_push($explodeLink, $d->site_id);
                        sort($explodeLink);
                        $explodeLinkUnique = array_unique($explodeLink);
                        foreach ($explodeLinkUnique as $d2) {
                            $html .= '  <tr><table border="" cellpadding="1">   
                                                    <td colspan="2"></td>
                                                    <td colspan="1"></td>
                                                    <td colspan="8"> ' . $no . '. SITE ID : ' . $d2 . '</td>
                                                </tr>
                                            ';
                            $no++;
                            $pdf->Ln();
                        }
                    } else {
                        $html .= '<table border="" cellpadding="1">
                                <tr>
                                <td colspan="2"></td>
                                <td colspan="1"></td>
                                <td colspan="8"> SITE ID : As Attached</td>
                                </tr>
                             ';
                    }
                }
                $html .= '</table>';
                $html .=    '   
                    <table border="" cellpadding="3">
                        <tr>
                            <td colspan="2">Consignee</td>
                            <td colspan="1" align="right">:</td>
                            <td colspan="8"align="justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
                            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</td>
                        </tr>
                    </table>';
                    $html .=    '<div style="page-break-inside:avoid;">
                                    <table cellpadding="2">
                                        <tr>
                                            <td align="right">Issued {dateIssued}</td>
                                        </tr>
                                        <tr>
                                            <td align="right">Signed On Behalf</td>
                                        </tr>
                                        <tr style="margin-right:100px">
                                            <td align="right"><img src="pdf/signature.png" style="margin-right:200px" width="auto" height="90px">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right">{namaPerusahaan}<img src="pdf/paraf.png" width="auto" height="25px"></td>
                                        </tr>
                                    </table>    
                                </div>';
                //Certificate Attachment
                if ($d->linked_with == true) {
                    $explodeLink = explode(', ', $d->linked_with);
                    $totalLink = count($explodeLink);
                    if ($totalLink > 9) {
                        // $pdf->AddPage();
                        $html .=   '<div>
                                        <br pagebreak="true"/>
                                        <font size="16">
                                            <table cellpadding="5">
                                                <tr>
                                                    <td colspan="1" align="center">CERTIFICATE ATTACHMENT<br></td>
                                                </tr>
                                            </table>
                                        </font>
                                        <font size="8">
                                            <table border="" cellpadding="3">
                                                <tr>
                                                    <td colspan="2" style="width:15%">The Insured</td>
                                                    <td colspan="1" align="right">:</td>
                                                    <td colspan="8" align="justify">' . $d->the_insured . ' and/or subsidiary and/or affiliated companies including those required or incorporated during the period of insurance for their respective rights and interest.<br></td>   
                                                </tr> 
                                                <tr>
                                                    <td colspan="2" style="width:15%">Certificate No</td>
                                                    <td colspan="1" align="right">:</td>
                                                    <td colspan="8" align="justify">JIS22-{MOP_Header}-{no_sertif}<br><br></td>   
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="width:22%;">Details of SITE ID</td>
                                                    <td colspan="2" style="width:25%;">:</td>
                                                </tr>
                                            </table>
                                        </font>                                        
                                        ';
                        $html .= '
                                        <table cellpadding="1" align="center">
                                            <tr>
                                                <td style="width:33%"></td>
                                                <td border="1" style="width:10%;margin-left:10px">No.</td>
                                                <td border="1" style="width:20%">Site ID</td>
                                            </tr> 
                                     ';
                        array_unshift($explodeLink, $d->site_id);
                        $no = 1;
                        foreach ($explodeLink as $d2) {
                            $html .= '  <tr>
                                                            <td style="width:33%"></td> 
                                                            <td border="1" style="width:10%">' . $no . '</td>
                                                            <td border="1">' . $d2 . '</td>
                                                        </tr>
                                                    ';
                            $no++;
                            $pdf->Ln();
                        }
                        $html .= '</table>
                                    <table cellpadding="2">
                                        <tr>
                                            <td colspan="1" align="center"><br><br>Lampiran ini harus dilekatkan pada Sertifikat</td>
                                        </tr>
                                        <tr>
                                            <td colspan="1" align="center">This attachment must attached to the Certificate</td>
                                        </tr>
                                    </table>
                                </div>';
                    }
                }
                //MOP Logic
                $whereMOP = array('site_id' => $d->site_id);
                $dataMOP = $this->M_admin->get_data('tb_site_in', $whereMOP);
                foreach ($dataMOP as $dMOP) {
                    $firstMOP = $dMOP->cmop;
                }
                if ($d->linked_with == true) {
                    $linkedExploded = explode(', ', $d->linked_with);
                    $bmop = [];
                    foreach ($linkedExploded as $dd2) {
                        $where = array('site_id' => $dd2);
                        $data22 = $this->M_admin->get_data('tb_site_in', $where);
                        foreach ($data22 as $ddd2) {
                            $bmop[] = $ddd2->cmop;
                        }
                    }
                    //push first site id MOP
                    array_push($bmop, $firstMOP);
                    sort($bmop);
                    $amop = implode(", ", array_unique($bmop));
                    $scopeCover = implode("<br>", array_unique($bmop));
                    $html = str_replace('{MOP}', $amop, $html);
                    $countScopeCover = str_word_count($scopeCover);
                    if ($countScopeCover==0){
                        $html = str_replace('{scopeCover}', $scopeCover, $html);
                    }
                    else{
                        $html = str_replace('{scopeCover}','<br>'.$scopeCover, $html);
                    }
                } else {   //linked_with empty
                    $html = str_replace('{MOP}', $firstMOP, $html);
                    $html = str_replace('{scopeCover}', $firstMOP, $html);
                }
                if ($d->conveyance == 'Darat') {
                    $darat = 'By ' . $d->conveyance_type . ' - ' . $d->conveyance_policeno . '<br>Age  : ' . $d->conveyance_age . '<br>Driver  : ' . $d->conveyance_driver;
                    $html = str_replace('{conveyance}', $darat, $html);
                } elseif ($d->conveyance == 'Laut') {
                    // $laut = 'By Vessel - ' . $d->conveyance_ship_name . '<br>Type  : ' . $d->conveyance_ship_type . '<br>GRT  : ' . $d->conveyance_ship_GRT . '<br>Year of Built  : ' . $d->conveyance_ship_age;
                    $laut = 'By Vessel - ' . $d->conveyance_ship_name . '<br>Type  : ' . $d->conveyance_ship_type . '<br>GRT  : ' . $d->conveyance_ship_GRT . '<br>Year of Built  : ' . $d->conveyance_ship_age;
                    $html = str_replace('{conveyance}', $laut, $html);
                } elseif ($d->conveyance == 'Udara') {
                    $udara = 'By ' . $d->conveyance_plane_type . '<>No. AWB : ' . $d->conveyance_plane_AWB;
                    $html = str_replace('{conveyance}', $udara, $html);
                }
                $no_sertif = $d->no_sertif;
                $mop_header = '0608032100001';
                $str_length = 5;
                $no_sertif_5 = substr("00000{$no_sertif}", -$str_length);
                $html = str_replace('{no_sertif}', $no_sertif_5, $html);
                $html = str_replace('{namaPerusahaan}', $namaPerusahaan, $html);
                $html = str_replace('{dateIssued}', $dateIssued, $html);
                //$html = str_replace('{linked_with}',$d->linked_with, $html);
                $html = str_replace('{MOP_Header}', $mop_header, $html);
                $html = str_replace('{invoice_ref_id}', $invoice_ref_id, $html);
                $html = str_replace('{amountInsured}', number_format($d->amount_insured, 2), $html);
                
                // $html = str_replace('{the_insured}',$the_insured, $html);
                // $html = str_replace('{address}',$address_, $html);
                // $html = str_replace('{interest_insured}',$interest_insured, $html);
                // $html = str_replace('{mark_numbers}',$mark_numbers, $html);
                // $html = str_replace('{amount_insured}',$amount_insured, $html);
                // $html = str_replace('{lampiran_LC}',$lampiran_LC, $html);
                // $html = str_replace('{lampiran_BL}',$lampiran_BL, $html);
                // $html = str_replace('{invoice_number}',$invoice_number, $html);
                // $html = str_replace('{sailing_date}',$sailing_date, $html);
                // $html = str_replace('{invoice_number}',$invoice_number, $html);
                // $html = str_replace('{conveyance}',$conveyance, $html);
                // $html = str_replace('{destination_to}',$destination_to, $html);
                // output the HTML content
                $pdf->writeHTML($html, true, false, true, false, '');
                
                // reset pointer to the last page
                $pdf->lastPage();
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