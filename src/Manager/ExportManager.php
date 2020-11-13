<?php

namespace Kematjaya\Export\Manager;

use Kematjaya\Export\Exception\FormatNotSupported;
use Kematjaya\Export\Processor\AbstractProcessor;
use Kematjaya\Export\Paper\PaperInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class ExportManager implements ManagerInterface
{
    
    public function render($data, AbstractProcessor $processor, string $mode = AbstractProcessor::ATTACHMENT_DOWNLOAD, PaperInterface $paper) 
    {
        if(!$processor->isSupported($data))
        {
            throw new FormatNotSupported();
        }
        
        //lanjut kode belum selesai
    }

}
