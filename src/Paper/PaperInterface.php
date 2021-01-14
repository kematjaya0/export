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
    
    /**
     * Sets the paper size & orientation
     *
     * @param string|array $paperType 'letter', 'legal', 'A4', etc.
     * @return $this
     */
    public function setPaperType($paperType):self;
    
    /**
     * @param null|string|array $paperSize
     */
    public function getPaperType();
    
    public function setMargin(string $name, float $value):self;
    
    public function getMargin(string $name):?float;
    
}
