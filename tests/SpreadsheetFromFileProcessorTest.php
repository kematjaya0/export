<?php

namespace Kematjaya\Export\Test;

use Kematjaya\Export\Exception\FormatNotSupported;
use Kematjaya\Export\Manager\ExportManager;
use Kematjaya\Export\Processor\Excel\SpreadsheetFromFileProcessor;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use PHPUnit\Framework\TestCase;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class SpreadsheetFromFileProcessorTest extends TestCase 
{
    public function testCreateException()
    {
        $this->expectException(FileNotFoundException::class);
        $processor = new SpreadsheetFromFileProcessor('test.xlsx');
    }
    
    public function testInsertData()
    {
        $processor = new SpreadsheetFromFileProcessor(__DIR__ .'/test.xlsx');
        $this->assertFalse($processor->isSupported('test'));
        
        $data = [
            ['1233', 'test 1'],
            ['1234', 'test 2']
        ];
        $this->assertTrue($processor->isSupported($data));
        
        $processor->setStartCell('A2');
        
        $this->assertIsString($processor->render($data, SpreadsheetFromFileProcessor::ATTACHMENT_DOWNLOAD));
    }
    
    public function testFormatNotSupported()
    {
        $processor = new SpreadsheetFromFileProcessor(__DIR__ .'/test.xlsx');
        $manager = new ExportManager();
        
        $this->expectException(FormatNotSupported::class);
        $manager->render('test', $processor);
    }
    
    public function testExportExcel()
    {
        $processor = new SpreadsheetFromFileProcessor(__DIR__ .'/test.xlsx');
        $processor->setStartCell('A2');
        $manager = new ExportManager();
        $data = [
            ['1233', 'test 1'],
            ['1234', 'test 2']
        ];
        
        $result = $manager->render($data, $processor);
        $this->assertEquals($processor->getFileType(), $result->headers->get('content-type'));
        $this->assertFileIsReadable($result->getContent());
    }
    
}
