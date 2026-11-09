<?php

namespace Kematjaya\Export\Tests;

use Kematjaya\Export\Exception\ViewModeNotSupported;
use Kematjaya\Export\Manager\ExportManager;
use Kematjaya\Export\Processor\Excel\HtmlToExcel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * @package Kematjaya\Export\Test
 * @license https://opensource.org/licenses/MIT MIT
 * @author  Nur Hidayatullah <kematjaya0@gmail.com>
 */
class HtmlToExcelTest extends TestCase
{
    public const HTML = '<table><tr><th>No</th><th>Nama</th></tr><tr><td>1</td><td>Budi</td></tr></table>';

    public function testException(): void
    {
        $excel = new HtmlToExcel();
        $this->assertFalse($excel->isSupported([]));
        $this->assertTrue($excel->isSupported(self::HTML));
    }

    public function testDownload(): void
    {
        $processor = new HtmlToExcel('laporan.xlsx');
        $response = new ExportManager()->render(self::HTML, $processor);

        $this->assertInstanceOf(BinaryFileResponse::class, $response);
        $this->assertStringContainsString('laporan.xlsx', (string) $response->headers->get('content-disposition'));
        $this->assertEquals($processor->getFileType(), $response->headers->get('content-type'));

        $sheet = IOFactory::load($response->getFile()->getPathname())->getActiveSheet();
        $this->assertEquals('Nama', $sheet->getCell('B1')->getValue());
        $this->assertEquals('Budi', $sheet->getCell('B2')->getValue());
    }

    public function testViewModeInline(): void
    {
        $processor = new HtmlToExcel('laporan.xlsx');
        $response = new ExportManager()->render(self::HTML, $processor, HtmlToExcel::ATTACHMENT_VIEW);

        $this->assertInstanceOf(BinaryFileResponse::class, $response);
        $this->assertStringContainsString('inline', (string) $response->headers->get('content-disposition'));
    }

    public function testSaveToDir(): void
    {
        $target = sys_get_temp_dir() . '/kmj-export-' . uniqid() . '.xlsx';
        $result = new HtmlToExcel($target)->render(self::HTML, HtmlToExcel::ATTACHMENT_SAVE_TO_DIR);

        $this->assertSame($target, $result);
        $this->assertEquals('Budi', IOFactory::load($target)->getActiveSheet()->getCell('B2')->getValue());
        unlink($target);
    }

    public function testViewModeNotSupported(): void
    {
        $this->expectException(ViewModeNotSupported::class);
        new HtmlToExcel()->render(self::HTML, 'unknown');
    }

    public function testCallable(): void
    {
        $called = false;
        $target = sys_get_temp_dir() . '/kmj-callable-' . uniqid() . '.xlsx';
        $processor = new HtmlToExcel($target);
        $processor->render(self::HTML, HtmlToExcel::ATTACHMENT_SAVE_TO_DIR, function () use (&$called): void {
            $called = true;
        });

        $this->assertTrue($called);
        if (file_exists($target)) {
            unlink($target);
        }
    }
}
