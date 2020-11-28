<?php

namespace Kematjaya\Export\Processor\Excel;

use Kematjaya\Export\Processor\AbstractProcessor;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
abstract class ExcelProcessor extends AbstractProcessor
{
    public function getFileType():string
    {
        return 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
    }
}
