<?php

namespace Kematjaya\Export\Tests;

use Kematjaya\Export\Exception\FormatNotSupported;
use Kematjaya\Export\Manager\ExportManager;
use Kematjaya\Export\Processor\HTML\ArrayToHtml;
use PHPUnit\Framework\TestCase;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class ArrayToHtmlTest extends TestCase
{
    public function testInsertData()
    {
        $processor = new ArrayToHtml();
        $this->assertFalse($processor->isSupported('test'));
        
        $data = [
            [
                'No' => 1,
                'Nama' => 'test',
                'Alamat' => 'sby',
            ],
            [
                'No' => 2,
                'Nama' => 'test',
                'Alamat' => 'sby',
            ],
            [
                'No' => 3,
                'Nama' => 'test',
                'Alamat' => 'sby',
            ],
            [
                'No' => 4,
                'Nama' => 'test',
                'Alamat' => 'sby',
            ],
        ];
        
        $this->assertTrue($processor->isSupported($data));
        $content = $processor->render($data, ArrayToHtml::ATTACHMENT_DOWNLOAD);
        $this->assertIsString($content);
    }
    
    public function testFormatNotSupported()
    {
        $processor = new ArrayToHtml();
        $manager = new ExportManager();
        
        $this->expectException(FormatNotSupported::class);
        $manager->render('test', $processor);
    }
    
    public function testExportExcel()
    {
        $processor = new ArrayToHtml();
        $manager = new ExportManager();
        $data = [
            ['1233', 'test 1'],
            ['1234', 'test 2']
        ];
        
        $result = $manager->render($data, $processor);
        $this->assertEquals($processor->getFileType(), $result->headers->get('content-type'));
        $this->assertIsString($result->getContent());
    }
}
