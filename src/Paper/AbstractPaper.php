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
    
    /**
     * 
     * @var string
     */
    protected $paperType = 'A4';
    
    /**
     * 
     * @var string
     */
    protected $orientation = self::ORIENTATION_PORTRAIT;
    
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
    
    protected function marginValidate(string $name):bool
    {
        $marginsNames = self::getMarginNames();
        if(!in_array($name, $marginsNames)) {
            throw new Exception(sprintf("key %s not exist for margin", $name));
        }
        
        return true;
    }
    
    public function setMargin(string $name, float $value):PaperInterface 
    {
        $this->marginValidate($name);
        
        $this->margins[$name] = $value;
        
        return $this;
    }
    
    public function getMargin(string $name):?float
    {
        $this->marginValidate($name);
        
        return $this->margins[$name];
    }
    
    public function getMargins():array
    {
        return $this->margins;
    }
    
    public function getOrientation(): ?string 
    {
        return $this->orientation;
    }

    public function getPaperType(): ?string 
    {
        return $this->paperType;
    }

    public function setOrientation(string $orientation): PaperInterface 
    {
        $this->orientation = $orientation;
        
        return $this;
    }

    public function setPaperType(string $paperType): PaperInterface 
    {
        $this->paperType = $paperType;
        
        return $this;
    }
}
