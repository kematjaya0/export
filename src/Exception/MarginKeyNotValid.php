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
class MarginKeyNotValid extends Exception
{
    public function __construct(string $name) 
    {
        $message = sprintf("key %s not exist for margin", $name);
        parent::__construct($message);
    }
}
