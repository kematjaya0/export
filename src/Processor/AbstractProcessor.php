<?php

namespace Kematjaya\Export\Processor;


/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
abstract class AbstractProcessor implements ProcessorInterface
{
    protected $fileName;
    
    public function __construct(string $fileName = null) 
    {
        $this->fileName = $fileName;
    }
    
    public function setFileName(string $fileName):self
    {
        $this->fileName = $fileName;
        
        return $this;
    }
    
    public function getFileName():?string
    {
        return $this->fileName;
    }
    
    abstract public function getFileType():string;
    
    abstract function isSupported($data):bool;
}
