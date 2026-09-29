<?php

namespace Kematjaya\Export\Tests;

use Kematjaya\Export\Manager\ExportManager;
use Kematjaya\Export\Processor\Excel\SpreadsheetFromArrayProcessor;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PHPUnit\Framework\TestCase;

class SpreadsheetFromArrayProcessorTest extends TestCase
{
    public function testRenderWithoutFileName()
    {
        $processor = (new SpreadsheetFromArrayProcessor())->setStartCell('B2');
        $response = (new ExportManager())->render([['a', 'b'], ['c', 'd']], $processor);

        $this->assertStringContainsString('filename=export.xlsx', $response->headers->get('content-disposition'));

        $file = $response->getFile()->getPathname();
        $sheet = IOFactory::load($file)->getActiveSheet();
        $this->assertEquals('a', $sheet->getCell('B2')->getValue());
        $this->assertEquals('d', $sheet->getCell('C3')->getValue());

        // file temporary dihapus setelah response dikirim
        ob_start();
        $response->sendContent();
        ob_end_clean();
        $this->assertFileDoesNotExist($file);
    }

    public function testCallable()
    {
        $processor = new SpreadsheetFromArrayProcessor('data.xlsx');
        $response = $processor->render([['a']], SpreadsheetFromArrayProcessor::ATTACHMENT_DOWNLOAD, function ($processor, $data, $viewMode, $spreadsheet) {
            $spreadsheet->getActiveSheet()->setCellValue('A2', 'footer');
        });

        $this->assertEquals('footer', IOFactory::load($response->getFile()->getPathname())->getActiveSheet()->getCell('A2')->getValue());
    }
}
