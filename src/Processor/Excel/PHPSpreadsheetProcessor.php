<?php

namespace Kematjaya\Export\Processor\Excel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
abstract class PHPSpreadsheetProcessor extends ExcelProcessor
{
    private string $startCell = 'A1';

    /**
     * Set start cell reading data
     */
    public function setStartCell(string $startCell): self
    {
        $this->startCell = $startCell;

        return $this;
    }

    public function getStartCell(): ?string
    {
        return $this->startCell;
    }

    /**
     * Writing spreadsheet object to temporary file and return respose object
     *
     * @param  string      $fileName
     */
    protected function buildWriter(Spreadsheet $spreadsheet, ?string $fileName = null): Response
    {
        $targetFile = $fileName ?: ($this->getFileName() ?: 'export.xlsx');
        $writer = new Xlsx($spreadsheet);
        $tempFile = tempnam(sys_get_temp_dir(), $targetFile);
        $writer->save($tempFile);

        $response = new BinaryFileResponse($tempFile);
        $response->deleteFileAfterSend(true);
        $response->setContentDisposition(self::ATTACHMENT_DOWNLOAD, $targetFile);
        $response->headers->set('Content-Type', $this->getFileType());

        return $response;
    }
}
