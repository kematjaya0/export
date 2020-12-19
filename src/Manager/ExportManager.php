<?php

namespace Kematjaya\Export\Manager;

use Kematjaya\Export\Exception\FormatNotSupported;
use Kematjaya\Export\Processor\AbstractProcessor;
use Kematjaya\Export\Paper\PaperInterface;
use Kematjaya\Export\Paper\ClientPaperInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class ExportManager implements ManagerInterface
{
    /**
     * 
     * @var AbstractProcessor
     */
    private $processor;
    
    /**
     * 
     * @var PaperInterface
     */
    private $paper;
    
    public function createResponse(AbstractProcessor $processor, string $mode):Response
    {
        $response = new Response();
        $response->headers->set('Content-Type', $processor->getFileType());
        $response->headers->set('Content-Disposition', sprintf('%s;filename="%s"', $mode, $processor->getFileName()));
        $response->headers->set('Cache-Control', 'max-age=1');
        
        return $response;
    }
    
    public function getProcessor(): ?AbstractProcessor
    {
        return $this->processor;
    }
    
    public function setProcessor(AbstractProcessor $processor):ManagerInterface
    {
        $this->processor = $processor;
        
        return $this;
    }
    
    function getPaper() :?PaperInterface
    {
        return $this->paper;
    }

    function setPaper(?PaperInterface $paper): ManagerInterface 
    {
        $this->paper = $paper;
        
        return $this;
    }

    public function render($data, AbstractProcessor $processor, string $mode = AbstractProcessor::ATTACHMENT_DOWNLOAD, PaperInterface $paper = null)
    {
        $this->setProcessor($processor);
        
        $this->setPaper($paper);
        
        if(!$processor->isSupported($data)) {
            throw new FormatNotSupported();
        }
        
        if(null !== $paper and $processor instanceof ClientPaperInterface) {
            $processor->setPaper($paper);
        }
        
        $content = $processor->render($data, $mode);
        if($content instanceof Response) {
            return $content;
        }
        
        if(!headers_sent() or empty(headers_list())) {
            $response = $this->createResponse($processor, $mode);
            $response->setContent($content);
            
            return $response;
        }
        
        return $processor->render($content);
    }

}
