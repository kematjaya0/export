<?php

namespace Kematjaya\Export\Tests;

use Kematjaya\Export\Manager\ExportManager;
use Kematjaya\Export\Paper\Paper;
use Kematjaya\Export\Processor\PDF\DOMPDFProcessor;
use PHPUnit\Framework\TestCase;

class DOMPDFProcessorTest extends TestCase
{
    public function testRenderResponse()
    {
        $paper = (new Paper())->setPaperType('A5')->setOrientation(Paper::ORIENTATION_LANDSCAPE);
        $processor = new DOMPDFProcessor('laporan.pdf');
        $usedPaper = null;
        $response = (new ExportManager())->render('<h1>test</h1>', $processor, DOMPDFProcessor::ATTACHMENT_VIEW, $paper, function ($processor, $content, $pdf, $paper) use (&$usedPaper) {
            $usedPaper = $paper;
        });

        $this->assertSame($paper, $usedPaper);
        $this->assertStringStartsWith('%PDF', $response->getContent());
        $this->assertEquals('application/pdf', $response->headers->get('content-type'));
        $this->assertEquals('inline;filename="laporan.pdf"', $response->headers->get('content-disposition'));
    }

    public function testResponseWithoutFileName()
    {
        $response = (new ExportManager())->render('<h1>test</h1>', new DOMPDFProcessor(), DOMPDFProcessor::ATTACHMENT_DOWNLOAD);

        $this->assertEquals('attachment', $response->headers->get('content-disposition'));
    }
}
