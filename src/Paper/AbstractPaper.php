<?php

namespace Kematjaya\Export\Paper;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
abstract class AbstractPaper implements PaperInterface 
{
    /**
     *
     * @var array
     */
    protected $margins;
    
    public function __construct() 
    {
        $this->margins = array();
    }
    
    public static function getMarginNames():array
    {
        return [
            self::MARGIN_TOP, self::MARGIN_RIGHT, self::MARGIN_BOTTOM, self::MARGIN_LEFT
        ];
    }
    
    protected function marginValidate():bool
    {
        $marginsNames = self::getMarginNames();
        if(!in_array($name, $marginsNames))
        {
            throw new Exception(sprintf("key %s not exist for margin", $name));
        }
        
        return true;
    }
    
    public function setMargin(string $name, float $value):PaperInterface 
    {
        $this->marginValidate();
        
        $this->margins[$name] = $value;
        
        return $this;
    }
    
    public function getMargin(string $name):?float
    {
        $this->marginValidate();
        
        return $this->margins[$name];
    }
    
    public function getMargins():array
    {
        return $this->margins;
    }
}
