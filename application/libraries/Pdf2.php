<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class Pdf2 extends TCPDF
{
    function __construct()
    {
        parent::__construct();
    }

  //Page header
  public function Header() {

    // Logo
    $image_file = 'pdf/malacca.png'; // *** Very IMP
    $this->Image($image_file,8,10,50);
    // Set font
    $this->SetFont('monotype', 'C', 24);
    // Line break
    $this->Ln();        
    $this->Ln(40);        
    //adjust the x and y positions of this text ... first two parameters
    if ($this->page == 1) {    
        $this->Cell(161, 0, 'Certificate of Insurance', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    } else {
        //$this->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);
    }
}

// Page footer
    public function Footer() {
    // Position at 25 mm from bottom
    $this->SetY(-30);
    $this->SetRightMargin(12);
    $this->SetLeftMargin(12);
    // Set font
    $this->SetFont('helvetica', 'I', 8);
    
    $this->SetTextColor(100,100,100);
    $this->Ln(); 
    $this->Cell(0, 0, 'PT. MALACCA TRUST WUWUNGAN INSURANCE Tbk', 0, 0, 'L');
    $this->Ln(); 
    $this->Cell(0, 0, 'Chase Plaza 8th floor', 0, 0, 'L');
    $this->Ln();
    $this->Cell(0, 0, 'Jl. Jend. Sudirman Kav. 21', 0, 0, 'L');
    $this->Ln();
    $this->Cell(0, 0, 'Jakarta – 12920, Indonesia', 0, 0, 'L');
    $this->Ln();
    $this->Cell(0, 0, 'T : +62 21 2598 9830             F : +62 21 2598 9837', 0, 0, 'L');
    $this->Cell(0, 0, 'MALACCA CARE CENTRE', 0, 0, 'R');
    $this->Ln();
    $this->Cell(0, 0, 'E : mcc@mtwi.co.id', 0, 0, 'L');
    $this->Cell(0, 0, '+62 21 25 9898 35', 0, 0, 'R');
    $this->Ln(); 
    // $this->Cell(0,0,'(d/h PT Asuransi Kresna Mitra Tbk)', 0, false, 'C', 0, '', 0, false, 'T', 'M');

    // Page number
        // $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
}

}

/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */
