<?php

namespace Kematjaya\Export\Processor\PDF;

use Kematjaya\Export\Processor\PDF\PDFProcessor;
use Dompdf\Dompdf;

/**
 * Class for render PDF document base on DOMPDF
 * 
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class DOMPDFProcessor extends PDFProcessor
{
    /**
     * Check supported data
     * 
     * @param  mixed $data Data
     * @return bool supported status
     */
    public function isSupported($data): bool 
    {
        return is_string($data);
    }

    /**
     * Rendering data to PDF document
     * 
     * @param  string  $content
     * @param  string $viewMode
     * @return string PDF document as string
     * @throws ViewModeNotSupported when view mode not supported
     */
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
