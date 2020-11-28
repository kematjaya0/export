<?php

namespace Kematjaya\Export\Processor\Excel;

use Kematjaya\Export\Processor\Excel\ExcelProcessor;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

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
        
        $response = new BinaryFileResponse($tempFile);
        $response->setContentDisposition(self::ATTACHMENT_DOWNLOAD, null === $fileName ? $response->getFile()->getFilename() : $fileName);
        $response->headers->set('Content-Type', $this->getFileType());
        
        return $response;
    }
}
