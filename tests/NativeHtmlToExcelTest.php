<?php

namespace Kematjaya\Export\Tests;

use Kematjaya\Export\Processor\Excel\NativeHtmlToExcel;
use PHPUnit\Framework\TestCase;

class NativeHtmlToExcelTest extends TestCase
{
    public function testRenderTablesOnly(): void
    {
        $html = '<h1>judul</h1><table><tr><td>1</td></tr></table><p>x</p><table><tr><td>2</td></tr></table>';
        $response = (new NativeHtmlToExcel())->render($html, NativeHtmlToExcel::ATTACHMENT_DOWNLOAD);

        $this->assertStringNotContainsString('judul', $response->getContent());
        $this->assertStringContainsString('<table border="1"><tr><td>1</td></tr></table>', $response->getContent());
        $this->assertStringContainsString('<td>2</td>', $response->getContent());
        $this->assertStringContainsString('filename=export.xlsx', $response->headers->get('content-disposition'));
    }
}
