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

    public function testRenderNonStringValues()
    {
        $data = [
            ['nama' => 'a <b>', 'tanggal' => new \DateTime('2024-01-02 03:04:05'), 'aktif' => true, 'catatan' => null, 'tag' => ['x', 'y']],
        ];

        $content = (new ArrayToHtml())->render($data, ArrayToHtml::ATTACHMENT_VIEW);

        $this->assertStringContainsString('<td>a &lt;b&gt;</td>', $content);
        $this->assertStringContainsString('<td>2024-01-02 03:04:05</td>', $content);
        $this->assertStringContainsString('<td>1</td><td></td><td>x, y</td>', $content);
        $this->assertStringContainsString('<th style="text-align:center">tanggal</th>', $content);
    }

    public function testRenderEmpty()
    {
        $content = (new ArrayToHtml())->render([], ArrayToHtml::ATTACHMENT_VIEW);

        $this->assertStringContainsString('<thead>  </thead>', $content);
    }

    public function testRenderAssociativeRows()
    {
        $content = (new ArrayToHtml())->render(['first' => ['a' => 1], 'second' => ['a' => 2]], ArrayToHtml::ATTACHMENT_VIEW);

        $this->assertStringContainsString('<th style="text-align:center">a</th>', $content);
        $this->assertStringContainsString('<tr><td>2</td></tr>', $content);
    }
}
