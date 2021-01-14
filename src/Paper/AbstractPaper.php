<?php

namespace Kematjaya\Export\Paper;

use Kematjaya\Export\Exception\MarginKeyNotValid;

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
    
    /**
     * Get margin name as array
     * 
     * @return array
     */
    public static function getMarginNames():array
    {
        return [
            self::MARGIN_TOP, self::MARGIN_RIGHT, self::MARGIN_BOTTOM, self::MARGIN_LEFT
        ];
    }
    
    /**
     * Validate margin name
     * 
     * @param  string $name
     * @return bool
     * @throws MarginKeyNotValid
     */
    protected function marginValidate(string $name):bool
    {
        $marginsNames = self::getMarginNames();
        if(!in_array($name, $marginsNames)) {
            throw new MarginKeyNotValid($name);
        }
        
        return true;
    }
    
    /**
     * Set margin value by name
     * 
     * @param  string $name
     * @param  float  $value
     * @return PaperInterface
     */
    public function setMargin(string $name, float $value):PaperInterface 
    {
        $this->marginValidate($name);
        
        $this->margins[$name] = $value;
        
        return $this;
    }
    
    /**
     * Get margin values by name
     * 
     * @param  string $name
     * @return float|null
     */
    public function getMargin(string $name):?float
    {
        $this->marginValidate($name);
        
        return $this->margins[$name];
    }
    
    /**
     * Get all margin values
     * 
     * @return array
     */
    public function getMargins():array
    {
        return $this->margins;
    }
    
    /**
     * Get paper orientation value
     * 
     * @return string|null
     */
    public function getOrientation(): ?string 
    {
        return $this->orientation;
    }

    /**
     * @param null|string|array $paperSize
     */
    public function getPaperType() 
    {
        return $this->paperType;
    }

    /**
     * Set paper orientation
     * 
     * @param  string $orientation
     * @return PaperInterface
     */
    public function setOrientation(string $orientation): PaperInterface 
    {
        $this->orientation = $orientation;
        
        return $this;
    }

    /**
     * Sets the paper size & orientation
     *
     * @param string|array $paperType 'letter', 'legal', 'A4', etc.
     * @return $this
     */
    public function setPaperType($paperType): PaperInterface 
    {
        $this->paperType = $paperType;
        
        return $this;
    }
}
