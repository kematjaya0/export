<?php

namespace Kematjaya\Export\Processor\PDF;

use Kematjaya\Export\Processor\PDF\PDFProcessor;
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
        
        $paper = $this->getPaper();
        if($paper) {
            $pdf->setPaper($paper->getPaperType(), $paper->getOrientation());
        }
        
        $pdf->loadHtml($content);
        $pdf->render();
        
        return $pdf->output();
    }

}
