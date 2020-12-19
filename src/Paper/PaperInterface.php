<?php

namespace Kematjaya\Export\Paper;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface PaperInterface 
{
    const ORIENTATION_PORTRAIT ='portrait';
    const ORIENTATION_LANDSCAPE = 'landscape';
    
    const MARGIN_LEFT   = 'left';
    const MARGIN_RIGHT  = 'right';
    const MARGIN_TOP    = 'top';
    const MARGIN_BOTTOM = 'bottom';
    
    public function setOrientation(string $orientation):self;
    
    public function getOrientation():?string;
    
    public function setPaperType(string $paperType):self;
    
    public function getPaperType():?string;
    
    public function setMargin(string $name, float $value):self;
    
    public function getMargin(string $name):?float;
    
}
