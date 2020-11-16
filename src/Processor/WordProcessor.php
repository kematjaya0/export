<?php

namespace Kematjaya\Export\Processor;

use Kematjaya\Export\Processor\AbstractProcessor;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */ 
abstract class WordProcessor extends AbstractProcessor
{
    public function getFileType():string
    {
        return 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
    }
}
