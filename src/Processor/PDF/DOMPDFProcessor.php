<?php

namespace Kematjaya\Export\Processor\PDF;

use Dompdf\Dompdf;
use Kematjaya\Export\Exception\ViewModeNotSupported;

/**
 * Class for render PDF document base on DOMPDF
 *
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class DOMPDFProcessor extends PDFProcessor
{
    /**
     * Check supported data
     *
     * @param  mixed $data Data
     * @return bool supported status
     */
    public function isSupported($data): bool
    {
        return is_string($data);
    }

    /**
     * Rendering data to PDF document
     *
     * @param  string  $content
     * @return string PDF document as string
     * @throws ViewModeNotSupported when view mode not supported
     */
    public function render(mixed $content, string $viewMode, ?callable $callable = null)
    {
        $pdf = new Dompdf();

        $paper = $this->getPaper();
        if ($paper) {
            $pdf->setPaper($paper->getPaperType(), $paper->getOrientation());
        }

        if ($callable) {

            call_user_func($callable, $this, $content, $pdf, $paper, $viewMode);
        }

        $pdf->loadHtml($content);
        $pdf->render();

        return $pdf->output();
    }

}
