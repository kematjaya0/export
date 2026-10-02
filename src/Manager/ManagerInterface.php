<?php

namespace Kematjaya\Export\Manager;

use Kematjaya\Export\Paper\PaperInterface;
use Kematjaya\Export\Processor\AbstractProcessor;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface ManagerInterface
{
    /**
     * Creating response object
     */
    public function createResponse(AbstractProcessor $processor, string $mode): Response;

    /**
     * Get processor object
     */
    public function getProcessor(): ?AbstractProcessor;

    /**
     * Set processor object
     */
    public function setProcessor(AbstractProcessor $processor): self;

    /**
     * Render data to document format
     */
    public function render(mixed $data, AbstractProcessor $processor, string $mode = AbstractProcessor::ATTACHMENT_DOWNLOAD, ?PaperInterface $paper = null, ?callable $callable = null): Response;
}
