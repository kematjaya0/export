<?php
/**
 * Class ArrayToHtmlProcessor
 *
 * @package Kematjaya\Export\Processor
 * @author  ardith666 <ardith666@gmail.com> <@16/11/20 09.18>
 */

namespace Kematjaya\Export\Processor\HTML;

use Kematjaya\Export\Processor\AbstractProcessor;

/**
 * Base class for render array to HTML
 */
abstract class ArrayToHtmlProcessor extends AbstractProcessor
{
    /**
     * Get output file type
     *
     * @return string String of output type
     */
    public function getFileType(): string 
    {
        return 'text/html';
    }
}
