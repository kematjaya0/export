<?php

namespace Kematjaya\Export\Processor\Excel;

use koolreport\KoolReport;
use Symfony\Component\HttpFoundation\Response;

/**
 * @package Kematjaya\Export\Processor\Excel
 * @license https://opensource.org/licenses/MIT MIT
 * @author  Nur Hidayatullah <kematjaya0@gmail.com>
 */
class KoolReportToExcel extends NativeHtmlToExcel
{
    public function __construct(?string $fileName = null)
    {
        if (!class_exists('koolreport\KoolReport')) {
            throw new \Exception(sprintf('class "%s" not found, try running "%s"', 'koolreport\KoolReport', 'koolreport/core'));
        }

        parent::__construct($fileName);
    }

    public function isSupported($data): bool
    {
        return ($data instanceof KoolReport);
    }

    public function render(mixed $data, string $viewMode, ?callable $callable = null): Response
    {
        $data = $this->renderHTML($data);

        return parent::render($data, $viewMode, $callable);
    }

    protected function renderHTML(KoolReport $report): string
    {
        return $report->run()->render(true);
    }
}
