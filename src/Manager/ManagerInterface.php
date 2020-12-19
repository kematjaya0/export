<?php

namespace Kematjaya\Export\Manager;

use Kematjaya\Export\Paper\PaperInterface;
use Kematjaya\Export\Processor\AbstractProcessor;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface ManagerInterface 
{
    public function createResponse(AbstractProcessor $processor, string $mode):Response;
    
    public function getProcessor(): ?AbstractProcessor;
    
    public function setProcessor(AbstractProcessor $processor):self;
    
    public function render($data, AbstractProcessor $processor, string $mode = AbstractProcessor::ATTACHMENT_DOWNLOAD, PaperInterface $paper = null);
}
