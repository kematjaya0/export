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
    /**
     * Creating response object
     * 
     * @param  AbstractProcessor $processor
     * @param  string            $mode
     * @return Response
     */
    public function createResponse(AbstractProcessor $processor, string $mode):Response;
    
    /**
     * Get processor object
     * 
     * @return AbstractProcessor|null
     */
    public function getProcessor(): ?AbstractProcessor;
    
    /**
     * Set processor object
     * 
     * @param  AbstractProcessor $processor
     * @return ManagerInterface
     */
    public function setProcessor(AbstractProcessor $processor):self;
    
    /**
     * Render data to document format
     * 
     * @param mixed             $data
     * @param AbstractProcessor $processor
     * @param string            $mode
     * @param PaperInterface    $paper
     */
    public function render($data, AbstractProcessor $processor, string $mode = AbstractProcessor::ATTACHMENT_DOWNLOAD, PaperInterface $paper = null, callable $callable = null);
}
