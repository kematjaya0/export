<?php

namespace Kematjaya\Export\Tests;

use Kematjaya\Export\Normalizer\FileNormalizer;
use PHPUnit\Framework\TestCase;

class FileNormalizerTest extends TestCase
{
    public function testNormalizeImageToDataUri()
    {
        $file = sys_get_temp_dir() . '/kmj-pixel-' . uniqid() . '.png';
        file_put_contents($file, base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNkYPhfDwAChwGA60e6kgAAAABJRU5ErkJggg=='));

        $result = (new FileNormalizer())->normalize(new \SplFileInfo($file));
        unlink($file);

        $this->assertStringStartsWith('data:image/png;base64,iVBORw0KGgo', $result);
    }
}
