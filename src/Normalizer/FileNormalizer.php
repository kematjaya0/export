<?php

namespace Kematjaya\Export\Normalizer;

use SplFileInfo;
use Symfony\Component\Serializer\Normalizer\DataUriNormalizer;

/**
 * Class for normalizer file to base64 format
 * 
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class FileNormalizer implements FileNormalizerInterface
{
    /**
     * 
     * @var NormalizerInterface
     */
    private $normalizer;
    
    
    /**
     * __construct()
     */
    public function __construct() 
    {
        $this->normalizer = new DataUriNormalizer();
    }
    
    /**
     * normalizer file and return string base64 
     * 
     * @param  SplFileInfo $object
     * @return string
     */
    public function normalize(SplFileInfo $object):string
    {
        return $this->normalizer->normalize($object);
    }
    
}
