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
    public function render($array, string $viewMode, ?callable $callable = null)
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
        
        $keys = array_keys((array) reset($array));
        
        $rows = [];
        foreach ($keys as $key => $value) {
            $rows[] = '<th style="text-align:center">' . $this->escape($value) . '</th>';
        }
        
        $head = sprintf('<tr>%s</tr>', implode("", $rows));
        
        $bodyRows = [];
        foreach ($array as $key => $value) {
            $column = [];
            foreach ((array) $value as $value2) {
                $column[] = '<td>' . $this->escape($value2) . '</td>';
            }
            
            $bodyRows[] = sprintf('<tr>%s</tr>', implode("", $column));
        }
        
        if ($callable) {
            
            call_user_func($callable, $this, $array, $html, $viewMode);
        }
        
        return sprintf($html, $head, implode("", $bodyRows));
    }
    
    /**
     * Convert cell value to escaped string
     * 
     * @param  mixed $value
     * @return string
     */
    protected function escape($value):string
    {
        if ($value instanceof \DateTimeInterface) {
            $value = $value->format('Y-m-d H:i:s');
        } elseif (is_bool($value)) {
            $value = $value ? '1' : '0';
        } elseif (is_array($value)) {
            $value = implode(', ', array_map([$this, 'escape'], $value));
            
            return $value;
        } elseif (is_object($value) && !method_exists($value, '__toString')) {
            $value = get_class($value);
        }
        
        return htmlspecialchars((string) $value);
    }

}
