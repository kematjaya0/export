<?php
/**
 * Class ArrayToHtml
 * @package Kematjaya\Export\Processor
 * @author ardith666 <ardith666@gmail.com> <@16/11/20 09.20>
 */

namespace Kematjaya\Export\Processor\HTML;

use Kematjaya\Export\Processor\HTML\ArrayToHtmlProcessor;

class ArrayToHtml extends ArrayToHtmlProcessor
{
    
    function isSupported($data): bool
    {
        return is_array($data);
    }
    
    public function render($array, string $viewMode)
    {
        if ($array) {
            $first_key = array_keys($array);
            $keys = array_keys($array[$first_key[0]]);
            // start table
            $html = '<div class="table table-responsive"><table class="tabe table-bordered datatables" width="100%">';
            // header row
            $html .= '<thead><tr>';
            foreach ($keys as $key => $value) {
                $html .= '<th style="text-align:center">' . htmlspecialchars($value) . '</th>';
            }
            $html .= '</tr></thead>';
        
            // data rows
            $html .= '<tbody>';
            foreach ($array as $key => $value) {
                $html .= '<tr>';
                foreach ($value as $key2 => $value2) {
                    $html .= '<td>' . htmlspecialchars($value2) . '</td>';
                }
                $html .= '</tr>';
            }
            $html .= '</tbody>';
        
            // finish table and return it
        
            $html .= '</table></div>';
        } else {
            $html = '<div class="table table-responsive"><table class="tabe table-bordered datatables" width="100%"><thead><tr><td></td></tr></thead><tbody></tbody></table></div>';
        }
    
        return $html;
    }

}
