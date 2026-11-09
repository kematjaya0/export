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
        $this->margins = [];
    }

    /**
     * Get margin name as array
     */
    public static function getMarginNames(): array
    {
        return [
            self::MARGIN_TOP, self::MARGIN_RIGHT, self::MARGIN_BOTTOM, self::MARGIN_LEFT,
        ];
    }

    /**
     * Validate margin name
     *
     * @throws MarginKeyNotValid
     */
    protected function marginValidate(string $name): bool
    {
        $marginsNames = self::getMarginNames();
        if (!in_array($name, $marginsNames)) {
            throw new MarginKeyNotValid($name);
        }

        return true;
    }

    /**
     * Set margin value by name
     */
    public function setMargin(string $name, float $value): PaperInterface
    {
        $this->marginValidate($name);

        $this->margins[$name] = $value;

        return $this;
    }

    /**
     * Get margin values by name
     */
    public function getMargin(string $name): ?float
    {
        $this->marginValidate($name);

        return $this->margins[$name] ?? null;
    }

    /**
     * Get all margin values
     */
    public function getMargins(): array
    {
        return $this->margins;
    }

    /**
     * Get paper orientation value
     */
    public function getOrientation(): ?string
    {
        return $this->orientation;
    }

    /**
     * @return null|string|array
     */
    public function getPaperType()
    {
        return $this->paperType;
    }

    /**
     * Set paper orientation
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
