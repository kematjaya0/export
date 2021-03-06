<?php

namespace Kematjaya\Export\Processor\Excel;

use Kematjaya\Export\Processor\Excel\ExcelProcessor;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
abstract class PHPSpreadsheetProcessor extends ExcelProcessor
{
    /**
     * Writing spreadsheet object to temporary file and return respose object
     * 
     * @param  Spreadsheet $spreadsheet
     * @param  string      $fileName
     * @return Response
     */
    protected function buildWriter(Spreadsheet $spreadsheet, string $fileName = null): Response
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
