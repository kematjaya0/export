<?php

namespace Kematjaya\Export\Processor\Excel;

use Kematjaya\Export\Processor\Excel\ExcelProcessor;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
abstract class PHPSpreadsheetProcessor extends ExcelProcessor
{
    protected function buildWriter(Spreadsheet $spreadsheet, string $fileName = null)
    {
        $writer = new Xlsx($spreadsheet);
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($tempFile);
        
        return $tempFile;
    }
}
