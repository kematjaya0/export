<?php

namespace Kematjaya\Export\Processor\PDF;

use Kematjaya\Export\Processor\AbstractProcessor;
use Kematjaya\Export\Paper\ClientPaperInterface;
use Kematjaya\Export\Paper\PaperInterface;

/**
 * Base Class for render PDF Document
 *
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
abstract class PDFProcessor extends AbstractProcessor implements ClientPaperInterface
{

    /**
     * 
     * @var PaperInterface
     */
    private $paper;

    /**
     * Get paper object
     * 
     * @return PaperInterface|null
     */
    function getPaper(): ?PaperInterface 
    {
        return $this->paper;
    }

    /**
     * Set Paper object
     * 
     * @param  PaperInterface $paper
     * @return ClientPaperInterface
     */
    function setPaper(PaperInterface $paper): ClientPaperInterface 
    {
        $this->paper = $paper;
        
        return $this;
    }

    /**
     * Get mime type
     * 
     * @return string
     */
    public function getFileType(): string
    {
        return 'application/pdf';
    }

}
