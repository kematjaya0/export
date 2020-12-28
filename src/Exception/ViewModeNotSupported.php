<?php

/**
 * This file is part of the export.
 */

namespace Kematjaya\Export\Exception;

use Exception;

/**
 * @package Kematjaya\Export\Exception
 * @license https://opensource.org/licenses/MIT MIT
 * @author  Nur Hidayatullah <kematjaya0@gmail.com>
 */
class ViewModeNotSupported extends Exception
{
    public function __construct(string $viewMode, int $code = 0, \Throwable $previous = null) 
    {
        $message = sprintf("view mode %s not supported", $viewMode);
        parent::__construct($message, $code, $previous);
    }
}
