<?php

namespace Kematjaya\Export\Processor;

use Kematjaya\Export\Processor\PDFProcessor;
use Dompdf\Dompdf;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class DOMPDFProcessor extends PDFProcessor
{
    
    public function isSupported($data): bool 
    {
        return is_string($data);
    }

    public function render($content, string $viewMode) 
    {
        $pdf = new Dompdf();
        $pdf->loadHtml($content);
        $pdf->render();
        // TODO: header already sent
        
        return $pdf->stream($this->getFileName(), [
            "Attachment" => $viewMode === self::ATTACHMENT_VIEW ? false : true
        ]);
    }

}
