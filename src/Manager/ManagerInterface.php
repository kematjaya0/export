<?php

namespace Kematjaya\Export\Manager;

use Kematjaya\Export\Paper\PaperInterface;
use Kematjaya\Export\Processor\AbstractProcessor;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface ManagerInterface 
{
    public function render($data, AbstractProcessor $processor, string $mode = AbstractProcessor::ATTACHMENT_DOWNLOAD, PaperInterface $paper);
}
