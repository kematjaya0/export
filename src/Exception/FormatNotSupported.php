<?php

namespace Kematjaya\Export\Exception;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class FormatNotSupported extends \Exception
{
    public function __construct(string $message = "", int $code = 0, \Throwable $previous = NULL): \Exception 
    {
        $message = "format not supported";
        
        parent::__construct($message, $code, $previous);
    }
}
