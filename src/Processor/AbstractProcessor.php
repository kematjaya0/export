<?php

namespace Kematjaya\Export\Processor;

/**
 * Abstract Class for processing data
 *
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
abstract class AbstractProcessor implements ProcessorInterface
{
    /**
     * Constructor
     */
    public function __construct(protected ?string $fileName = null) {}

    /**
     * Set output filename
     */
    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * Get output filename
     */
    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    /**
     * Get output file type
     */
    abstract public function getFileType(): string;

    /**
     * Check supported data
     */
    abstract public function isSupported(mixed $data): bool;
}
