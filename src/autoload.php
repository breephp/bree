<?php

declare(strict_types=1);

use Bridget\Concretes\Autoloader;
use Bridget\Concretes\AutoloaderInit;

require_once __DIR__.'/core/Concretes/AutoloaderInit.php';

return AutoloaderInit::getAutoloader(then: static function (Autoloader $autoloader) {
    $autoloader
        ->setNamespace('Bridget', ['core', 'framework'])
        ->useExtension('.bg')
        ->useFile('bridget')
        ->register();
});
