<?php
/**
 * Class HtmlToExcel
 * @package Kematjaya\Export\Processor
 * @author ardith666 <ardith666@gmail.com> <@13/11/20 16.04>
 */

namespace Kematjaya\Export\Processor\Excel;

use Kematjaya\Export\Processor\Excel\ExcelProcessor;
use Ticketpark\HtmlPhpExcel\HtmlPhpExcel;


class HtmlToExcel extends ExcelProcessor
{
    const ATTACHMENT_SAVE_TO_DIR = 'save_to_dir';
    
    function isSupported($data): bool
    {
        return is_string($data);
    }
    
    public function render($data, string $viewMode)
    {
        $excel = new HtmlPhpExcel($data);
        
        switch ($viewMode) {
            case self::ATTACHMENT_SAVE_TO_DIR:
                return $excel->process()->save();
                break;
            case self::ATTACHMENT_DOWNLOAD:
                return $excel->process()->output($this->getFileName());
                break;
        }
    }
}
