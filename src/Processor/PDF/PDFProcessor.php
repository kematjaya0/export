<?php

namespace Kematjaya\Export\Processor\PDF;

use Kematjaya\Export\Paper\ClientPaperInterface;
use Kematjaya\Export\Paper\PaperInterface;
use Kematjaya\Export\Processor\AbstractProcessor;

/**
 * Base Class for render PDF Document
 *
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
abstract class PDFProcessor extends AbstractProcessor implements ClientPaperInterface
{
    private ?PaperInterface $paper = null;

    /**
     * Get paper object
     */
    public function getPaper(): ?PaperInterface
    {
        return $this->paper;
    }

    /**
     * Set Paper object
     */
    public function setPaper(PaperInterface $paper): ClientPaperInterface
    {
        $this->paper = $paper;

        return $this;
    }

    /**
     * Get mime type
     */
    public function getFileType(): string
    {
        return 'application/pdf';
    }

}
