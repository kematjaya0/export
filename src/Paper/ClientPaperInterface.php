<?php

namespace Kematjaya\Export\Paper;

use Kematjaya\Export\Paper\PaperInterface;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface ClientPaperInterface
{
    public function setPaper(PaperInterface $paper):self;
    
    public function getPaper():?PaperInterface;
}
