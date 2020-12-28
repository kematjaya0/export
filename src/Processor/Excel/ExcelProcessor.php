<?php

namespace Kematjaya\Export\Processor\Excel;

use Kematjaya\Export\Processor\AbstractProcessor;

/**
 * Base class for spreadsheet document type processor
 * 
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
abstract class ExcelProcessor extends AbstractProcessor
{
    
    /**
     * Get output file type
     *
     * @return string String of output type
     */
    public function getFileType():string
    {
        return 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
    }
}
