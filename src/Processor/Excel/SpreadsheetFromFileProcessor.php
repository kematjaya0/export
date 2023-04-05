<?php

namespace Kematjaya\Export\Processor\Excel;

use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\Response;

/**
 * Processing data from spredsheet template file
 * 
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class SpreadsheetFromFileProcessor extends PHPSpreadsheetProcessor
{
    /**
     *
     * @var Filesystem
     */
    private $fileSystem;
    
    
    public function __construct(string $fileName)
    {
        $this->fileSystem = new Filesystem();
        if(!$this->fileSystem->exists($fileName)) {
            throw new FileNotFoundException();
        }
        
        parent::__construct($fileName);
    }
    
    /**
     * Check supported data
     * 
     * @param  mixed $data Data
     * @return bool supported status
     */
    public function isSupported($data): bool 
    {
        return is_array($data);
    }

    /**
     * Rendering array data to template spreadsheet document
     * 
     * @param  array   $data
     * @param  string $viewMode
     * @return Response spreadsheet file response
     */
    public function render($data, string $viewMode, callable $callable = null) : Response
    {
        $reader = IOFactory::createReader('Xlsx');
        $spreadsheet = $reader->load($this->getFileName());
        $spreadsheet
            ->getActiveSheet()
            ->fromArray($data, null, $this->getStartCell());
        
        if ($callable) {
            
            call_user_func($callable, $this, $data, $viewMode, $spreadsheet);
        }
        
        $filePaths = explode(DIRECTORY_SEPARATOR, $this->getFileName());
        $fileName = end($filePaths);
        
        return $this->buildWriter($spreadsheet, $fileName);
    }

}
