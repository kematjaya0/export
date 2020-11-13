<?php

namespace Kematjaya\Export\Processor;

use Kematjaya\Export\Processor\PDFProcessor;
use Dompdf\Dompdf;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\Response;

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
        
        $disposition = $viewMode === self::ATTACHMENT_VIEW ? ResponseHeaderBag::DISPOSITION_INLINE : ResponseHeaderBag::DISPOSITION_ATTACHMENT;
        
        $response = new Response($pdf->output());
        $response->headers->set('Content-Type', 'application/pdf');
        $response->headers->set('Content-Disposition', $disposition);
        
        return $response;
    }

}
