<?php
/**
 * Class ArrayToHtml
 *
 * @package Kematjaya\Export\Processor
 * @author  ardith666 <ardith666@gmail.com> <@16/11/20 09.20>
 */

namespace Kematjaya\Export\Processor\HTML;

use Kematjaya\Export\Processor\HTML\ArrayToHtmlProcessor;

/**
 * Class for render array to html string
 */
class ArrayToHtml extends ArrayToHtmlProcessor
{
    
    /**
     * Check supported data
     * 
     * @param  mixed $data Data
     * @return bool supported status
     */
    function isSupported($data): bool
    {
        return is_array($data);
    }
    
    /**
     * Rendering data to html string
     * 
     * @param array  $array
     * @param string $viewMode
     */
    public function render($array = [], string $viewMode)
    {
        $html = ''
        . '<div class="table table-responsive">'
            . '<table class="table table-bordered datatables">'
                . '<thead> %s </thead>'
                . '<tbody> %s </tbody>'
            . '</table>'
        . '</div>';
        
        if (empty($array)) {
            
            return sprintf($html, '', '');
        }
        
        $first_key = array_keys($array);
        $keys = array_keys($array[$first_key[0]]);
        
        $rows = [];
        foreach ($keys as $key => $value) {
            $rows[] = '<th style="text-align:center">' . htmlspecialchars($value) . '</th>';
        }
        
        $head = sprintf('<tr>%s</tr>', implode("", $rows));
        
        $bodyRows = [];
        foreach ($array as $key => $value) {
            $column = [];
            foreach ($value as $value2) {
                $column[] = '<td>' . htmlspecialchars($value2) . '</td>';
            }
            
            $bodyRows[] = sprintf('<tr>%s</tr>', implode("", $column));
        }
        
        return sprintf($html, $head, implode("", $bodyRows));
    }

}
