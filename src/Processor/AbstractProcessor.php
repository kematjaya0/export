<?php

namespace Kematjaya\Export\Processor;

use Kematjaya\Export\Paper\ClientPaperInterface;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
abstract class AbstractProcessor implements ProcessorInterface
{
    protected $fileName;
    
    public function __construct(string $fileName) 
    {
        $this->fileName = $fileName;
    }
    
    public function getFileName():?string
    {
        return $this->fileName;
    }
    
    abstract function isSupported($data):bool;
    
    abstract function getFileType():string;
}
