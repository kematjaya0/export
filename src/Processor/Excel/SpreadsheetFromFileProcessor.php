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
    
    /**
     *
     * @var string
     */
    private $startCell = 'A1';
    
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
     * Set start cell reading data
     * 
     * @param  string $startCell
     * @return self
     */
    public function setStartCell(string $startCell):self
    {
        $this->startCell = $startCell;
        
        return $this;
    }

    /**
     * Rendering array data to template spreadsheet document
     * 
     * @param  array   $data
     * @param  string $viewMode
     * @return Response spreadsheet file response
     */
    public function render($data, string $viewMode) : Response
    {
        $reader = IOFactory::createReader('Xlsx');
        $spreadsheet = $reader->load($this->getFileName());
        $spreadsheet
            ->getActiveSheet()
            ->fromArray($data, null, $this->startCell);
        
        $filePaths = explode(DIRECTORY_SEPARATOR, $this->getFileName());
        $fileName = end($filePaths);
        
        return $this->buildWriter($spreadsheet, $fileName);
    }

}
