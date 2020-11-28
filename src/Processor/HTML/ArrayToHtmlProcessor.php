<?php
/**
 * Class ArrayToHtmlProcessor
 * @package Kematjaya\Export\Processor
 * @author ardith666 <ardith666@gmail.com> <@16/11/20 09.18>
 */

namespace Kematjaya\Export\Processor\HTML;

use Kematjaya\Export\Processor\AbstractProcessor;


abstract class ArrayToHtmlProcessor extends AbstractProcessor
{
    public function getFileType(): string 
    {
        return 'text/html';
    }
}
