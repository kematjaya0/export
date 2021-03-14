<?php

/**
 * This file is part of the export.
 */

namespace Kematjaya\Export\Processor\Excel;

/**
 * @package Kematjaya\Export\Processor\Excel
 * @license https://opensource.org/licenses/MIT MIT
 * @author  Nur Hidayatullah <kematjaya0@gmail.com>
 */
class KoolReportToExcel extends NativeHtmlToExcel
{
    public function __construct(string $fileName = null) 
    {
        if (!class_exists('koolreport\KoolReport')) {
            throw new \Exception(sprintf('class "%s" not found, try running "%s"', 'koolreport\KoolReport', 'koolreport/core'));
        }
        
        parent::__construct($fileName);
    }
    
    public function isSupported($data): bool 
    {
        return ($data instanceof \koolreport\KoolReport);
    }

    public function render($data, string $viewMode, callable $callable = null) 
    {
        $data = $this->renderHTML($data);
        
        return parent::render($data, $viewMode, $callable);
    }

    protected function renderHTML(\koolreport\KoolReport $report):string
    {
        return $report->run()->render(true);
    }
}
