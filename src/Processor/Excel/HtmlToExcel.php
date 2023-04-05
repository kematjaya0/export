<?php
/**
 * Class HtmlToExcel
 *
 * @package Kematjaya\Export\Processor
 * @author  ardith666 <ardith666@gmail.com> <@13/11/20 16.04>
 */

namespace Kematjaya\Export\Processor\Excel;

use Kematjaya\Export\Exception\ViewModeNotSupported;
use Kematjaya\Export\Processor\Excel\ExcelProcessor;

/**
 * Class for process from string to spreadsheet document, base on Ticketpark\HtmlPhpExcel\HtmlPhpExcel
 */
class HtmlToExcel extends ExcelProcessor
{
    const ATTACHMENT_SAVE_TO_DIR = 'save_to_dir';
    
    public function __construct(string $fileName = null)
    {
        parent::__construct($fileName);
    }
    
    /**
     * Check supported data
     * 
     * @param  mixed $data Data
     * @return bool supported status
     */
    function isSupported($data): bool
    {
        $class = "Ticketpark\HtmlPhpExcel\HtmlPhpExcel";
        if (!class_exists($class)) {
            return false;
        }
        
        return is_string($data);
    }
    
    /**
     * Rendering data to spreadsheet document
     * 
     * @param  string  $data
     * @param  string $viewMode
     * @throws ViewModeNotSupported when view mode not supported
     */
    public function render($data, string $viewMode, callable $callable = null)
    {
        $excel = new \Ticketpark\HtmlPhpExcel\HtmlPhpExcel($data);
        if ($callable) {
            
            call_user_func($callable, $this, $data, $viewMode);
        }
        
        switch ($viewMode) {
        case self::ATTACHMENT_SAVE_TO_DIR:
            return $excel->process()->save();
        case self::ATTACHMENT_DOWNLOAD:
            return $excel->process()->output($this->getFileName());
        }
        
        throw new ViewModeNotSupported($viewMode);
    }
}
