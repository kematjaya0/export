<?php

namespace Kematjaya\Export\Processor;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface ProcessorInterface 
{
    const ATTACHMENT_VIEW = 'view';
    const ATTACHMENT_DOWNLOAD = 'download';
    
    public function render($data, string $viewMode);
}
