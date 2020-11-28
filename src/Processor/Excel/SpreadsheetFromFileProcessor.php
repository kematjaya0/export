<?php

namespace Kematjaya\Export\Processor\Excel;

use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;

/**
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
    private $startCell;
    
    public function __construct(string $fileName) 
    {
        $this->fileSystem = new Filesystem();
        if(!$this->fileSystem->exists($fileName))
        {
            throw new FileNotFoundException();
        }
        
        parent::__construct($fileName);
    }
    
    public function isSupported($data): bool 
    {
        return is_array($data);
    }
    
    public function setStartCell(string $startCell):self
    {
        $this->startCell = $startCell;
        
        return $this;
    }

    public function render($data, string $viewMode) 
    {
        $reader = IOFactory::createReader('Xlsx');
        
        $spreadsheet = $reader->load($this->getFileName());
        
        $sheet = $spreadsheet->getActiveSheet();
        
        $sheet->fromArray($data, null, $this->startCell);
        
        $filePaths = explode(DIRECTORY_SEPARATOR, $this->getFileName());
        $fileName = end($filePaths);
        
        return $this->buildWriter($spreadsheet, $fileName);
    }

}
