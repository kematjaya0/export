<?php

namespace Kematjaya\Export\Tests;

use Kematjaya\Export\Exception\FormatNotSupported;
use Kematjaya\Export\Manager\ExportManager;
use Kematjaya\Export\Processor\AbstractProcessor;
use PHPUnit\Framework\TestCase;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class ExportManagerTest extends TestCase
{
    public function testFormatNotSupported(): void
    {
        $pdfProcessor = $this->createConfiguredMock(AbstractProcessor::class, [
            'getFileName' => 'test.pdf', 'isSupported' => false,
        ]);
        $manager = new ExportManager();

        $this->expectException(FormatNotSupported::class);
        $manager->render([], $pdfProcessor);
    }
}
