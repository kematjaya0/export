<?php

namespace Kematjaya\Export\Manager;

use Kematjaya\Export\Exception\FormatNotSupported;
use Kematjaya\Export\Processor\AbstractProcessor;
use Kematjaya\Export\Paper\PaperInterface;
use Kematjaya\Export\Paper\ClientPaperInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class ExportManager implements ManagerInterface
{
    
    public function render($data, AbstractProcessor $processor, string $mode = AbstractProcessor::ATTACHMENT_DOWNLOAD, PaperInterface $paper = null) 
    {
        if(!$processor->isSupported($data))
        {
            throw new FormatNotSupported();
        }
        
        if($processor instanceof ClientPaperInterface)
        {
            $processor->setPaper($paper);
        }
        
        return $processor->render($data, $mode);
    }

}
