<?php

namespace Kematjaya\Export\Normalizer;

use SplFileInfo;
use Symfony\Component\Serializer\Normalizer\DataUriNormalizer;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class FileNormalizer implements FileNormalizerInterface
{
    
    private $normalizer;
    
    public function __construct() 
    {
        $this->normalizer = new DataUriNormalizer();
    }
    
    public function normalize(SplFileInfo $object):string
    {
        return $this->normalizer->normalize($object);
    }
    
}
