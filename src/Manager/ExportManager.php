<?php

namespace Kematjaya\Export\Manager;

use Kematjaya\Export\Exception\FormatNotSupported;
use Kematjaya\Export\Processor\AbstractProcessor;
use Kematjaya\Export\Paper\PaperInterface;
use Kematjaya\Export\Paper\ClientPaperInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class for exporting data to document
 * 
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class ExportManager implements ManagerInterface
{
    private AbstractProcessor $processor;
    
    private PaperInterface $paper;
    
    /**
     * Creating response object
     * 
     * @param  AbstractProcessor $processor
     * @param  string            $mode
     * @return Response
     */
    public function createResponse(AbstractProcessor $processor, string $mode):Response
    {
        $response = new Response();
        $response->headers->set('Content-Type', $processor->getFileType());
        $response->headers->set('Content-Disposition', sprintf('%s;filename="%s"', $mode, $processor->getFileName()));
        $response->headers->set('Cache-Control', 'max-age=1');
        
        return $response;
    }
    
    /**
     * Get processor object
     * 
     * @return AbstractProcessor|null
     */
    public function getProcessor(): ?AbstractProcessor
    {
        return $this->processor;
    }
    
    /**
     * Set processor object
     * 
     * @param  AbstractProcessor $processor
     * @return ManagerInterface
     */
    public function setProcessor(AbstractProcessor $processor):ManagerInterface
    {
        $this->processor = $processor;
        
        return $this;
    }
    
    /**
     * Get PaperInterface object
     *
     * @return PaperInterface|null
     */
    function getPaper() :?PaperInterface
    {
        return $this->paper;
    }

    /**
     * Set PaperInterface object
     * 
     * @param  PaperInterface|null $paper
     * @return ManagerInterface
     */
    function setPaper(?PaperInterface $paper): ManagerInterface
    {
        $this->paper = $paper;
        
        return $this;
    }

    /**
     * Render data to document format
     * 
     * @param  mixed             $data
     * @param  AbstractProcessor $processor
     * @param  string            $mode
     * @param  PaperInterface    $paper
     * @throws FormatNotSupported if formt not supported
     */
    public function render(mixed $data, AbstractProcessor $processor, string $mode = AbstractProcessor::ATTACHMENT_DOWNLOAD, ?PaperInterface $paper = null, ?callable $callable = null)
    {
        $this->setProcessor($processor);
        if (!$processor->isSupported($data)) {
            
            throw new FormatNotSupported();
        }
        
        if (null !== $paper and $processor instanceof ClientPaperInterface) {
            $processor->setPaper($paper);
        }
        
        $content = $processor->render($data, $mode, $callable);
        if ($content instanceof Response) {
            
            return $content;
        }
        
        if (!headers_sent() or empty(headers_list())) {
            $response = $this->createResponse($processor, $mode);
            $response->setContent($content);
            
            return $response;
        }
        
        return $processor->render($content, $mode, $callable);
    }

}
