<?php

namespace Kematjaya\Export\Tests;

use Kematjaya\Export\Processor\Excel\NativeHtmlToExcel;
use PHPUnit\Framework\TestCase;

class NativeHtmlToExcelTest extends TestCase
{
    public function testIsSupported(): void
    {
        $processor = new NativeHtmlToExcel();
        $this->assertTrue($processor->isSupported('<table></table>'));
        $this->assertFalse($processor->isSupported(['not-string']));
    }

    public function testRenderTablesOnly(): void
    {
        $html = '<h1>judul</h1><table><tr><td>1</td></tr></table><p>x</p><table><tr><td>2</td></tr></table>';
        $response = new NativeHtmlToExcel()->render($html, NativeHtmlToExcel::ATTACHMENT_DOWNLOAD);

        $this->assertStringNotContainsString('judul', (string) $response->getContent());
        $this->assertStringContainsString('<td>1</td>', (string) $response->getContent());
        $this->assertStringContainsString('<td>2</td>', (string) $response->getContent());
        $this->assertStringContainsString('filename=export.xlsx', (string) $response->headers->get('content-disposition'));
    }

    public function testCallable(): void
    {
        $called = false;
        $processor = new NativeHtmlToExcel();
        $processor->render('<table><tr><td>x</td></tr></table>', NativeHtmlToExcel::ATTACHMENT_VIEW, function () use (&$called): void {
            $called = true;
        });

        $this->assertTrue($called);
    }
}
