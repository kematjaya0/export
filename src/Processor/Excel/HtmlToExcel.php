<?php
/**
 * Class HtmlToExcel
 *
 * @package Kematjaya\Export\Processor
 * @author  ardith666 <ardith666@gmail.com> <@13/11/20 16.04>
 */

namespace Kematjaya\Export\Processor\Excel;

use Kematjaya\Export\Exception\ViewModeNotSupported;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Class for process from string to spreadsheet document, base on Ticketpark\HtmlPhpExcel\HtmlPhpExcel
 */
class HtmlToExcel extends ExcelProcessor
{
    const ATTACHMENT_SAVE_TO_DIR = 'save_to_dir';
    
    public function __construct(?string $fileName = null)
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
     * @return \Symfony\Component\HttpFoundation\Response|string response, atau path file untuk ATTACHMENT_SAVE_TO_DIR
     * @throws ViewModeNotSupported when view mode not supported
     */
    public function render($data, string $viewMode, ?callable $callable = null)
    {
        $excel = new \Ticketpark\HtmlPhpExcel\HtmlPhpExcel($data);
        if ($callable) {
            
            call_user_func($callable, $this, $data, $viewMode);
        }
        
        // save(string) tersedia di htmlphpexcel 1.x (PhpSpreadsheet) dan 2.x (FastExcelWriter)
        switch ($viewMode) {
        case self::ATTACHMENT_SAVE_TO_DIR:
            $excel->process()->save($this->getFileName());
            
            return $this->getFileName();
        case self::ATTACHMENT_DOWNLOAD:
        case self::ATTACHMENT_VIEW:
            $baseFile = tempnam(sys_get_temp_dir(), 'kmj-export');
            $tempFile = $baseFile . '.xlsx';
            $excel->process()->save($tempFile);
            unlink($baseFile);
            
            $response = new BinaryFileResponse($tempFile);
            $response->deleteFileAfterSend(true);
            $response->setContentDisposition($viewMode, $this->getFileName());
            $response->headers->set('Content-Type', $this->getFileType());
            
            return $response;
        }
        
        throw new ViewModeNotSupported($viewMode);
    }
}
