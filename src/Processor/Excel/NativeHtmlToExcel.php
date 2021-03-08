<?php

/**
 * This file is part of the export.
 */

namespace Kematjaya\Export\Processor\Excel;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\HeaderUtils;

/**
 * @package Kematjaya\Export\Processor\Excel
 * @license https://opensource.org/licenses/MIT MIT
 * @author  Nur Hidayatullah <kematjaya0@gmail.com>
 */
class NativeHtmlToExcel extends ExcelProcessor
{
    
    public function isSupported($data): bool 
    {
        return is_string($data);
    }

    public function render($data, string $viewMode) 
    {
        $excel = $this->createTableHTML($data);
        
        return $this->createResponse($excel, $viewMode);
    }

    protected function createTableHTML(string $data)
    {
        $crawler = new Crawler($data);
        $html = $crawler->filter('table')->each(function (Crawler $dom){
            
            return sprintf('<table border="1">%s</table>', $dom->html());
        });
        $separator = '<table><tr><td></td></tr></table><table><tr><td></td></tr></table><table><tr><td></td></tr></table>';
        
        return implode($separator, $html);
    }
    
    protected function createResponse(string $content, string $viewMode = self::ATTACHMENT_VIEW): Response
    {
        $response = new Response($content);
        $response->headers->set('Content-type', $this->getFileType());
        $response->headers->set('Content-Disposition', HeaderUtils::makeDisposition($viewMode, $this->getFileName()));
        
        return $response;
    }
}
