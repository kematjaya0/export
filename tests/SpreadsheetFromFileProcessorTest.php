<?php

namespace Kematjaya\Export\Tests;

use Kematjaya\Export\Exception\FormatNotSupported;
use Kematjaya\Export\Manager\ExportManager;
use Kematjaya\Export\Processor\Excel\SpreadsheetFromFileProcessor;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class SpreadsheetFromFileProcessorTest extends TestCase
{
    public function testCreateException(): void
    {
        $this->expectException(FileNotFoundException::class);
        $processor = new SpreadsheetFromFileProcessor('test.xlsx');
    }

    public function testInsertData(): void
    {
        $processor = new SpreadsheetFromFileProcessor(__DIR__ . '/test.xlsx');
        $this->assertFalse($processor->isSupported('test'));

        $data = [
            ['1233', 'test 1'],
            ['1234', 'test 2'],
        ];
        $this->assertTrue($processor->isSupported($data));

        $processor->setStartCell('A2');

        $response = $processor->render($data, SpreadsheetFromFileProcessor::ATTACHMENT_DOWNLOAD);
        $this->assertEquals($processor->getFileType(), $response->headers->get('content-type'));
    }

    public function testFormatNotSupported(): void
    {
        $processor = new SpreadsheetFromFileProcessor(__DIR__ . '/test.xlsx');
        $manager = new ExportManager();

        $this->expectException(FormatNotSupported::class);
        $manager->render('test', $processor);
    }

    public function testExportExcel(): void
    {
        $processor = new SpreadsheetFromFileProcessor(__DIR__ . '/test.xlsx');
        $processor->setStartCell('A2');
        $manager = new ExportManager();
        $data = [
            ['1233', 'test 1'],
            ['1234', 'test 2'],
        ];

        $result = $manager->render($data, $processor);
        $this->assertEquals($processor->getFileType(), $result->headers->get('content-type'));
    }

}
