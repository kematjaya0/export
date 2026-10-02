<?php

namespace Kematjaya\Export\Paper;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface PaperInterface
{
    public const ORIENTATION_PORTRAIT = 'portrait';
    public const ORIENTATION_LANDSCAPE = 'landscape';

    public const MARGIN_LEFT   = 'left';
    public const MARGIN_RIGHT  = 'right';
    public const MARGIN_TOP    = 'top';
    public const MARGIN_BOTTOM = 'bottom';

    public function setOrientation(string $orientation): self;

    public function getOrientation(): ?string;

    /**
     * Sets the paper size & orientation
     *
     * @param string|array $paperType 'letter', 'legal', 'A4', etc.
     */
    public function setPaperType(string|array $paperType): self;

    public function getPaperType(): string|array;

    public function setMargin(string $name, float $value): self;

    public function getMargin(string $name): ?float;
}
