<?php

namespace Kematjaya\Export\Processor;

/**
 * Abstract Class for processing data
 *
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
abstract class AbstractProcessor implements ProcessorInterface
{
    /**
     * 
     * @var string
     */
    protected $fileName;
    
    /**
     * Constructor
     * 
     * @param string $fileName
     */
    public function __construct(?string $fileName = null)
    {
        $this->fileName = $fileName;
    }
    
    /**
     * Set output filename
     * 
     * @param  string $fileName
     * @return AbstractProcessor
     */
    public function setFileName(string $fileName):self
    {
        $this->fileName = $fileName;
        
        return $this;
    }
    
    /**
     * Get output filename
     * 
     * @return string|null
     */
    public function getFileName():?string
    {
        return $this->fileName;
    }
    
    /**
     * Get output file type
     */
    abstract public function getFileType():string;
    
    /**
     * Check supported data
     */
    abstract function isSupported($data):bool;
}
