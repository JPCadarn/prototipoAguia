<?php

require_once('assets/vendors/TCPDF/tcpdf_import.php');

class ImpressaoHelper extends TCPDF{
	public function Header() {
        $bMargin = $this->getBreakMargin();
        $auto_page_break = $this->AutoPageBreak;
        $this->SetAutoPageBreak(false, 0);
        $img_file = 'assets/Logo/watermark.png';
        $this->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
        $this->SetAutoPageBreak($auto_page_break, $bMargin);
        $this->setPageMark();
    }

    public function Footer() {
        $this->SetTextColor(255, 255, 255);
        $this->SetY(-10);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages().' - Gerado em '.date('d/m/Y H:i:s'), 0, false, 'L');
    }
}