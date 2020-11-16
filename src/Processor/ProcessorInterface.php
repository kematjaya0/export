<?php

namespace Kematjaya\Export\Processor;

use Symfony\Component\HttpFoundation\ResponseHeaderBag;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface ProcessorInterface 
{
    const ATTACHMENT_VIEW = ResponseHeaderBag::DISPOSITION_INLINE;
    const ATTACHMENT_DOWNLOAD = ResponseHeaderBag::DISPOSITION_ATTACHMENT;
    
    public function render($data, string $viewMode);
}
