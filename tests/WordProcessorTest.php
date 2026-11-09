<?php

namespace Kematjaya\Export\Tests;

use Kematjaya\Export\Processor\Word\WordProcessor;
use PHPUnit\Framework\TestCase;

class WordProcessorTest extends TestCase
{
    public function testWordProcessorAndAbstractProcessor(): void
    {
        $processor = new class () extends WordProcessor {
            public function isSupported($data): bool
            {
                return true;
            }

            public function render(mixed $data, string $viewMode, ?callable $callable = null): string
            {
                return 'word';
            }
        };

        $this->assertSame('application/vnd.openxmlformats-officedocument.wordprocessingml.document', $processor->getFileType());
        $processor->setFileName('document.docx');
        $this->assertSame('document.docx', $processor->getFileName());
    }
}
