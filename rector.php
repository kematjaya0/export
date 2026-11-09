<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Set\SymfonySetList;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])
    ->withPhpSets(php84: true)
    ->withSets([
        SymfonySetList::SYMFONY_CODE_QUALITY,
        SymfonySetList::SYMFONY_CONSTRUCTOR_INJECTION,
    ])
    ->withComposerBased(symfony: true)
    ->withPreparedSets(deadCode: true, typeDeclarations: true)
    ->withSkip([
        \Rector\DeadCode\Rector\MethodCall\RemoveNullArgOnNullDefaultParamRector::class,
    ])
    ->withImportNames(importShortClasses: false, removeUnusedImports: true);
