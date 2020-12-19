<?php

namespace Kematjaya\Export\Test;

use Kematjaya\Export\Processor\PDF\DOMPDFProcessor;
use Kematjaya\Export\Manager\ExportManager;
use Kematjaya\Export\Paper\AbstractPaper;
use Kematjaya\Export\Paper\Paper;
use Kematjaya\Export\Paper\PaperInterface;
use PHPUnit\Framework\TestCase;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class PaperTest extends TestCase
{
    public function testInstance():AbstractPaper
    {
        $paper = new Paper();
        $paper->setOrientation(Paper::ORIENTATION_LANDSCAPE);
        $this->assertEquals(Paper::ORIENTATION_LANDSCAPE, $paper->getOrientation());
        
        $paper->setPaperType('A4');
        $this->assertEquals('A4', $paper->getPaperType());
        
        $paper->setMargin(Paper::MARGIN_BOTTOM, 0);
        $paper->setMargin(Paper::MARGIN_TOP, 5);
        $paper->setMargin(Paper::MARGIN_RIGHT, 10);
        $paper->setMargin(Paper::MARGIN_LEFT, 15);
        
        $margins = $paper->getMargins();
        $this->assertEquals(0, $margins[Paper::MARGIN_BOTTOM]);
        $this->assertEquals(5, $margins[Paper::MARGIN_TOP]);
        $this->assertEquals(10, $margins[Paper::MARGIN_RIGHT]);
        $this->assertEquals(15, $margins[Paper::MARGIN_LEFT]);
        
        return $paper;
    }
    
    /**
     * @depends testInstance
     */
    public function testSetPaper(AbstractPaper $paper)
    {
        $processor = new DOMPDFProcessor();
        $manager = new ExportManager();
        $response = $manager->render('<h1>test</h1>', $processor, DOMPDFProcessor::ATTACHMENT_VIEW, $paper);
        $this->assertInstanceOf(AbstractPaper::class, $manager->getPaper());
        $this->assertInstanceOf(DOMPDFProcessor::class, $manager->getProcessor());
        $this->assertInstanceOf(PaperInterface::class, $processor->getPaper());
    }
}
