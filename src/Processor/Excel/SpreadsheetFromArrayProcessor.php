<?php

namespace Kematjaya\Export\Processor\Excel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;

/**
 * Class for generate spreadsheet document from array
 * 
 * @package Kematjaya\Export\Processor\Excel
 * @license https://opensource.org/licenses/MIT MIT
 * @author  Nur Hidayatullah <kematjaya0@gmail.com>
 */
class SpreadsheetFromArrayProcessor extends PHPSpreadsheetProcessor
{
    
    public function isSupported($data): bool
    {
        return is_array($data);
    }

    public function render($data, string $viewMode, callable $callable = null)
    {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getActiveSheet()
                ->fromArray($data, null, $this->getStartCell());
        
        if ($callable) {
            
            call_user_func($callable, $this, $data, $viewMode, $spreadsheet);
        }
        
        return $this->buildWriter($spreadsheet);
    }

}
