<?php

namespace Kematjaya\Export\Processor;

use Symfony\Component\HttpFoundation\ResponseHeaderBag;

/**
 * Interface for processor
 * 
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface ProcessorInterface
{
    const ATTACHMENT_VIEW = ResponseHeaderBag::DISPOSITION_INLINE;
    const ATTACHMENT_DOWNLOAD = ResponseHeaderBag::DISPOSITION_ATTACHMENT;

    public function render(mixed $data, string $viewMode, ?callable $callable = null);
}
