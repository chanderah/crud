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
        if (defined('FPDF_FONTPATH')) {
            $this->fontpath = FPDF_FONTPATH;
            if (substr($this->fontpath, -1) != '/' && substr($this->fontpath, -1) != '\\')
                $this->fontpath .= '/';
        }

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
                $html .= '
                        <font face="narrowi">
                            <table cellpadding="5">
                                <tr>
                                    <td align="center"><font size="13" font face="monotype">No. </font><font size="11" font face="narrowi">JIS'.$yearIssued.'-{MOP_Header}-'.$monthIssued.'-{no_sertif}</font></td>
                                </tr>
                            </table>   
                        </font>';
                $style = array('width' => 0.2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
                $pdf->Line(181.5, 51, 25, 51, $style);
                // (length,start,marginstart,end,)
                
                $html .= ' <table cellpadding="0" border="0" class="line18">
                                <tr>
                                    <td colspan="1" align="left">THIS TO CERTIFY that insurance has been effected as per Open Policy No. <span class="italic">{MOP}</span></td>
                                </tr>
                            </table>';

                $pdf->setListIndentWidth(4.75);

                $html .= '<style>'.file_get_contents(base_url()."pdf/".'stylesheet.css').'</style>';

                //start table
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
                    ';
                        
                    $explodedItemInsured = explode("\n", $replacedItemInsured);
                    $x = 0;
                    foreach ($explodedItemInsured as $a){
                        if ($x===0){
                            $html .= '
                            <tr>
                                <td colspan="2">Interest Insured</td>
                                <td colspan="1" align="right" style="width:51px">:</td>
                                <td colspan="8">'.$a.'</td>
                            </tr>';
                        }
                        else{
                            $html .= '
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="1"></td>
                                <td colspan="8">'.$a.'</td>
                            </tr>';
                        }
                        $x++;
                    }

                $html .= '
                    <tr>
                        <td colspan="2">Mark/Numbers</td>
                        <td colspan="1" align="right">:</td>
                        <td colspan="8"align="justify">-</td>
                    </tr>
                    <tr>
                        <td colspan="2">Amount Insured</td>
                        <td colspan="1" align="right">:</td>
                        <td colspan="8"align="justify">IDR '.number_format($d->amount_insured, 2).'</td>
                    </tr>
                    <tr>
                        <td colspan="2">L/C</td>
                        <td colspan="1" align="right">:</td>
                        <td colspan="8"align="justify">-' . $d->lampiran_LC . '</td>
                    </tr>
                    <tr>
                        <td colspan="2">B/L</td>
                        <td colspan="1" align="right">:</td>
                        <td colspan="8"align="justify">TBA' . $d->lampiran_BL . '</td>
                    </tr>
                    <tr>
                        <td colspan="2">Invoice Number</td>
                        <td colspan="1" align="right">:</td>
                        <td colspan="8"align="justify">-' . $d->lampiran_invoice . '</td>
                    </tr>';

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
                        $bmop = array_unique($bmop);

                        $lasttMOP = array_pop($bmop);
                        $amop = implode(", ", $bmop);

                        if (count($bmop) > 1) {
                            $html = str_replace('{MOP}', $amop." & ".$lasttMOP, $html);
                        }

                        else{
                            $html = str_replace('{MOP}', $lasttMOP, $html);
                        }
                        
                        $scopeCover = implode("<br>", array_unique($bmop));
                        $countScopeCover = str_word_count($scopeCover);

                        if ($countScopeCover==0){
                            $html .= ' 
                                                <tr>   
                                                    <td colspan="2">Scope of Cover</td>
                                                    <td colspan="1" align="right">:</td>
                                                    <td colspan="8" align="justify">As per M.O.P No. : ' . $lasttMOP . '</td>
                                                </tr>';
                        
                        }else{
                            array_push($bmop,$lasttMOP);
                            $explodeLinkUnique = array_unique($bmop);
                            $x = 1;

                            foreach ($explodeLinkUnique as $d2) {  

                                if($x === 1){
                                    $html .= '  
                                                <tr>  
                                                    <td colspan="2">Scope of Cover</td>       
                                                    <td colspan="1" align="right">:</td>
                                                    <td colspan="8" align="justify">As per M.O.P No. :</td>
                                                </tr>
                                                <tr>  
                                                    <td colspan="2"></td>       
                                                    <td colspan="1" align="right"></td>
                                                    <td colspan="8" align="justify">
                                                        <ul>
                                                            <li>' . $d2 . '</li>
                                                        </ul>
                                                    </td>
                                                </tr>';
                                    $pdf->Ln();
                                }else{
                                    $html .= '  
                                                <tr>  
                                                    <td colspan="2"></td>       
                                                    <td colspan="1" align="right"></td>
                                                    <td colspan="8" align="justify">
                                                        <ul>
                                                            <li>' . $d2 . '</li>
                                                        </ul>
                                                    </td>
                                                </tr>';
                                    $pdf->Ln();
                                }
                                $x++;
                            }
                        }
                    } else {
                        $html = str_replace('{MOP}', $firstMOP, $html);
                        $html = str_replace('{scopeCover}', $firstMOP, $html);
                    }


                $html .= '
                    <tr>
                        <td colspan="2">Date of Sailing</td>
                        <td colspan="1" align="right">:</td>
                        <td colspan="8"align="justify">' . $sailing_date . '</td>
                    </tr>
                    <tr>
                        <td colspan="2">Conveyance</td>
                        <td colspan="1" align="right">:</td>
                        <td colspan="8"align="justify">{conveyance}';


                if ($d->conveyance == 'Darat') {
                    $darat = 
                    'By ' . $d->conveyance_by . '
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="1" align="right"></td>
                        <td colspan="8"align="justify">Type : ' . $d->conveyance_type . '</td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="1" align="right"></td>
                        <td colspan="8"align="justify">Police No. : ' . $d->conveyance_policeno . '</td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="1" align="right"></td>
                        <td colspan="8"align="justify">Driver :'  . $d->conveyance_driver . '</td>
                    </tr>
                    ';

                    $html = str_replace('{conveyance}', $darat, $html);

                } elseif ($d->conveyance == 'Laut') {

                    $laut = 
                    'By Vessel - ' . $d->conveyance_ship_name .'
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="1" align="right"></td>
                        <td colspan="8"align="justify">Type : ' . $d->conveyance_ship_type . '</td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="1" align="right"></td>
                        <td colspan="8"align="justify">GRT : ' . $d->conveyance_ship_GRT . '</td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="1" align="right"></td>
                        <td colspan="8"align="justify">Year of Build : '  . $d->conveyance_ship_birth . '</td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="1" align="right"></td>
                        <td colspan="8"align="justify">Container No. : '  . $d->conveyance_ship_containerno . '</td>
                    </tr>
                    ';

                    $html = str_replace('{conveyance}', $laut, $html);

                } elseif ($d->conveyance == 'Udara') {
                    $udara =
                    'By Plane    
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="1" align="right"></td>
                        <td colspan="8"align="justify">Type : ' . $d->conveyance_plane_type . '</td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="1" align="right"></td>
                        <td colspan="8"align="justify">AWB No. : ' . $d->conveyance_plane_AWB . '</td>
                    </tr>
                    '; 

                    $html = str_replace('{conveyance}', $udara, $html);
                }

                $html .= '
                    <tr>
                        <td colspan="2">Destination</td>
                    </tr>';

                $explodedDestinationFrom = explode("\n", $d->destination_from);
                $x = 0;
                foreach ($explodedDestinationFrom as $a){
                    if ($x===0){
                        $html .= '
                        <tr>
                            <td colspan="2">   - At & From</td>
                            <td colspan="1" align="right">:</td>
                            <td colspan="8"align="justify">'.$a.'</td>
                        </tr>';
                    }
                    else{
                        $html .= '
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="1" align="right"></td>
                            <td colspan="8"align="justify">'.$a.'</td>
                        </tr>';
                    }
                    $x++;
                }

                $html .= '<br>
                    <tr>
                        <td colspan="2">   - Transhipment</td>
                        <td colspan="1" align="right">:</td>
                        <td colspan="8"align="justify">-</td>
                    </tr>
                    <tr>
                        <td colspan="2">   - To</td>
                        <td colspan="1" align="right">:</td>
                        <td colspan="8"align="justify">'.strtok($d->destination_to, "\n").'</td>
                    </tr>';

                if ($d->linked_with == true) {
                    $explodeLink = explode(', ', $d->linked_with);
                    
                    sort($explodeLink);
                    array_unshift($explodeLink, $d->site_id);
                    $explodeLinkUnique = array_unique($explodeLink);
                    $totalLink = count($explodeLink);
                    if ($totalLink < 10) {
                        //disini
                        $x = 1;

                        foreach ($explodeLinkUnique as $d2) {
                            $html .= '
                            <tr class="line10">   
                                <td colspan="2"></td>
                                <td colspan="1"></td>
                                <td colspan="8"> ' . $x . '. SITE ID : ' . $d2 . '</td>
                            </tr>';

                            $x++;
                            // $pdf->Ln();
                        }
                    } else {
                        $html .= '
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="1"></td>
                                <td colspan="8"> SITE ID : As Attached</td>
                            </tr>';
                    }
                }

                $html .= '<br class="line10">';
                $arr = explode("\n", $d->destination_to);
                // $output = implode("<br>", $arr);

                $x = 0;
                foreach ($arr as $a){
                    if ($x===0){
                        $html .= '   
                            <tr>
                                <td colspan="2">Consignee</td>
                                <td colspan="1" align="right">:</td>
                                <td colspan="8"align="justify" class="underlined">In '.$a.' :</td>
                            </tr>';
                    }

                    else {

                        $html .= '
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="1" align="right"></td>
                                <td colspan="8"align="justify">'.$a.'</td>
                            </tr>';
                    }
                $x++;
                }
                $html .= '</table><br><br>';

                //signature
                $html .=    '
                            <div style="page-break-inside:avoid">
                                <table cellpadding="0" border="0" align="right">
                                    <tr>
                                        <td>Issued at Bogor, {dateIssued}</td>
                                    </tr>
                                    <tr>
                                        <td>Signed On Behalf</td>
                                    </tr>
                                    <tr>
                                        <td cellpadding="0" cellspacing="0" class="signature">
                                        <img src="pdf/signature.png" height="115px"></td>
                                    </tr>
                                    <tr>
                                        <td cellpadding="0" cellspacing="0">
                                        {namaPerusahaan}<img src="pdf/paraf.png" width="auto" height="20px" style="margin-top:20px"></td>
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
                                                    <td colspan="8" align="justify">JIS'.$yearIssued.'-{MOP_Header}-'.$monthIssued.'-{no_sertif}<br><br></td> 
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
                        $explodeLinks = array_unique($explodeLink);

                        $no = 1;
                        foreach ($explodeLinks as $d2) {
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
                //end table

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