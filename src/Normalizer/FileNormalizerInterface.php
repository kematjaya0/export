<?php

namespace Kematjaya\Export\Normalizer;

use SplFileInfo;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface FileNormalizerInterface {
    
    public function normalize(SplFileInfo $object):string;
    
}
