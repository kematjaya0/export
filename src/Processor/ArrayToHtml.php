<?php
/**
 * Class ArrayToHtml
 * @package Kematjaya\Export\Processor
 * @author ardith666 <ardith666@gmail.com> <@16/11/20 09.20>
 */

namespace Kematjaya\Export\Processor;

use Kematjaya\Export\Processor\ArrayToHtml;

class ArrayToHtml extends ArrayToHtmlProcessor
{
    
    function isSupported($data): bool
    {
        return is_array($data);
    }
    
    public function render($data, string $viewMode)
    {
        $out = '<tr>';
        foreach ($array as $key => $value) {
            if (!isset($tableHeader)) {
                $tableHeader =
                    '<th>' .
                    implode('</th><th>', array_keys($array)) .
                    '</th>';
            }
            array_keys($array);
        
            $out .= "<td>$value</td>";
        
        }
        $out .= '</tr>';
    
        return '<table class="table table-bordered">' . $tableHeader . $out . '</table>';
    }
}