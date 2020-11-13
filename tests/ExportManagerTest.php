<?php

namespace Kematjaya\Export\Test;

use Kematjaya\Export\Exception\FormatNotSupported;
use Kematjaya\Export\Processor\AbstractProcessor;
use Kematjaya\Export\Manager\ExportManager;
use PHPUnit\Framework\TestCase;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class ExportManagerTest extends TestCase
{
    public function testFormatNotSupported()
    {
        $pdfProcessor = $this->createConfiguredMock(AbstractProcessor::class, [
            'getFileName' => 'test.pdf', 'isSupported' => false
        ]);
        $manager = new ExportManager();
        
        $this->expectException(FormatNotSupported::class);
        $manager->render([], $pdfProcessor);
    }
}
