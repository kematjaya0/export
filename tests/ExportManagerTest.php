<?php

namespace Kematjaya\Export\Tests;

use Kematjaya\Export\Exception\FormatNotSupported;
use Kematjaya\Export\Manager\ExportManager;
use Kematjaya\Export\Processor\AbstractProcessor;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class ExportManagerTest extends TestCase
{
    public function testFormatNotSupported(): void
    {
        $pdfProcessor = $this->createConfiguredMock(AbstractProcessor::class, [
            'getFileName' => 'test.pdf',
            'isSupported' => false,
        ]);
        $manager = new ExportManager();

        $this->expectException(FormatNotSupported::class);
        $manager->render([], $pdfProcessor);
    }

    public function testRenderWithoutPaperAndCallableUsesDefaults(): void
    {
        $processor = $this->createConfiguredMock(AbstractProcessor::class, [
            'getFileName' => 'test.pdf',
            'getFileType' => 'application/pdf',
            'isSupported' => true,
            'render' => 'mock-content',
        ]);
        $manager = new ExportManager();
        $response1 = $manager->render('test-data', $processor);
        $this->assertInstanceOf(Response::class, $response1);
        $this->assertSame('mock-content', $response1->getContent());
        $this->assertNull($manager->getPaper());
        $this->assertSame($processor, $manager->getProcessor());

        $manager2 = new ExportManager();
        $response2 = $manager2->render('test-data', $processor, AbstractProcessor::ATTACHMENT_DOWNLOAD, null, null);
        $this->assertSame($response1->getContent(), $response2->getContent());
        $this->assertSame($response1->headers->all(), $response2->headers->all());
    }
}
