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
