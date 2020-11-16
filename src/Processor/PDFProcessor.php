<?php

namespace Kematjaya\Export\Processor;

use Kematjaya\Export\Processor\AbstractProcessor;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
abstract class PDFProcessor extends AbstractProcessor
{
    public function getFileType():string
    {
        return 'application/pdf';
    }
}
