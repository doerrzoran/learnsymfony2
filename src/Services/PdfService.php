<?php

namespace App\Services;

use Dompdf\Dompdf;
use Dompdf\Options;

class PdfService
{
    private $domPdf;

    public function __construct()
    {
        $this->domPdf = new Dompdf();

        $pdfOptions = new Options();

        $pdfOptions->set('defaultFont', 'Garamond');

        $this->domPdf->setOptions($pdfOptions);
    }

    public function loadAndRender($html)
    {
        $this->domPdf->loadHtml($html);
        $this->domPdf->render();
    }

    public function helloPdf($html)
    {
        // Load HTML content 
        $this->domPdf->loadHtml($html); 
        // (Optional) Setup the paper size and orientation 
        $this->domPdf->setPaper('A4', 'landscape'); 
        // Render the HTML as PDF 
        $this->domPdf->render(); 
        // Output the generated PDF to Browser 
        $this->domPdf->stream();
    }

    public function showPdfFile($html){
        // $this->domPdf->loadHtml($html);
        // $this->domPdf->render();
        $this->loadAndRender($html);
        $this->domPdf->stream("details.pdf", [
            'attachement' => false
        ]);
    }
    
    public function generateBinaryPDF($html)
    {
        // $this->domPdf->loadHtml($html);
        // $this->domPdf->render();
        $this->loadAndRender($html);
        $this->domPdf->output();
    }
}
