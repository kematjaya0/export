<?php

namespace Kematjaya\Export\Manager;

use Kematjaya\Export\Exception\FormatNotSupported;
use Kematjaya\Export\Paper\ClientPaperInterface;
use Kematjaya\Export\Paper\PaperInterface;
use Kematjaya\Export\Processor\AbstractProcessor;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class for exporting data to document
 *
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class ExportManager implements ManagerInterface
{
    private ?AbstractProcessor $processor = null;

    private ?PaperInterface $paper = null;

    /**
     * Creating response object
     */
    public function createResponse(AbstractProcessor $processor, string $mode): Response
    {
        $response = new Response();
        $response->headers->set('Content-Type', $processor->getFileType());
        $fileName = $processor->getFileName();
        $response->headers->set('Content-Disposition', $fileName ? sprintf('%s;filename="%s"', $mode, str_replace('"', '\\"', $fileName)) : $mode);
        $response->headers->set('Cache-Control', 'max-age=1');

        return $response;
    }

    /**
     * Get processor object
     */
    public function getProcessor(): ?AbstractProcessor
    {
        return $this->processor;
    }

    /**
     * Set processor object
     */
    public function setProcessor(AbstractProcessor $processor): ManagerInterface
    {
        $this->processor = $processor;

        return $this;
    }

    /**
     * Get PaperInterface object
     */
    public function getPaper(): ?PaperInterface
    {
        return $this->paper;
    }

    /**
     * Set PaperInterface object
     */
    public function setPaper(?PaperInterface $paper): ManagerInterface
    {
        $this->paper = $paper;

        return $this;
    }

    /**
     * Render data to document format
     *
     * @param  PaperInterface    $paper
     * @throws FormatNotSupported if formt not supported
     */
    public function render(mixed $data, AbstractProcessor $processor, string $mode = AbstractProcessor::ATTACHMENT_DOWNLOAD, ?PaperInterface $paper = null, ?callable $callable = null): Response
    {
        $this->setProcessor($processor);
        $this->setPaper($paper);
        if (!$processor->isSupported($data)) {
            throw new FormatNotSupported();
        }

        if (null !== $paper && $processor instanceof ClientPaperInterface) {
            $processor->setPaper($paper);
        }

        $content = $processor->render($data, $mode, $callable);
        if ($content instanceof Response) {
            return $content;
        }

        $response = $this->createResponse($processor, $mode);
        $response->setContent(null === $content ? null : (string) $content);

        return $response;
    }

}
