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
use Ticketpark\HtmlPhpExcel\HtmlPhpExcel;

/**
 * Class for process from string to spreadsheet document, base on Ticketpark\HtmlPhpExcel\HtmlPhpExcel
 */
class HtmlToExcel extends ExcelProcessor
{
    public const ATTACHMENT_SAVE_TO_DIR = 'save_to_dir';

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
    public function isSupported($data): bool
    {
        $class = HtmlPhpExcel::class;
        if (!class_exists($class)) {
            return false;
        }

        return is_string($data);
    }

    /**
     * Rendering data to spreadsheet document
     *
     * @param  string  $data
     * @throws ViewModeNotSupported when view mode not supported
     */
    public function render(mixed $data, string $viewMode, ?callable $callable = null): string|null|BinaryFileResponse
    {
        $excel = new HtmlPhpExcel($data);
        if ($callable) {
            call_user_func($callable, $this, $data, $viewMode);
        }

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
