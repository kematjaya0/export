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
    public const ATTACHMENT_VIEW = ResponseHeaderBag::DISPOSITION_INLINE;
    public const ATTACHMENT_DOWNLOAD = ResponseHeaderBag::DISPOSITION_ATTACHMENT;

    /**
     * Rendering data to document
     */
    public function render(mixed $data, string $viewMode, ?callable $callable = null): mixed;
}
