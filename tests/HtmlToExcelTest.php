<?php

namespace Kematjaya\Export\Tests;

use Kematjaya\Export\Processor\Excel\HtmlToExcel;
use PHPUnit\Framework\TestCase;

/**
 * @package Kematjaya\Export\Test
 * @license https://opensource.org/licenses/MIT MIT
 * @author  Nur Hidayatullah <kematjaya0@gmail.com>
 */
class HtmlToExcelTest extends TestCase
{
    public function testException()
    {
        $excel = new HtmlToExcel();
        $this->assertFalse($excel->isSupported([]));
    }
}
