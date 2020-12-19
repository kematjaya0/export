<?php

namespace Kematjaya\Export\Processor\PDF;

use Kematjaya\Export\Processor\AbstractProcessor;
use Kematjaya\Export\Paper\ClientPaperInterface;
use Kematjaya\Export\Paper\PaperInterface;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
abstract class PDFProcessor extends AbstractProcessor implements ClientPaperInterface {

    /**
     * 
     * @var PaperInterface
     */
    private $paper;

    function getPaper(): ?PaperInterface 
    {
        return $this->paper;
    }

    function setPaper(PaperInterface $paper): ClientPaperInterface 
    {
        $this->paper = $paper;
        
        return $this;
    }

    public function getFileType(): string {
        return 'application/pdf';
    }

}
