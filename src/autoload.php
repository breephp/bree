<?php

declare(strict_types=1);

use Bree\Concretes\Autoloader;
use Bree\Concretes\AutoloaderInit;

require_once __DIR__.'/core/Concretes/AutoloaderInit.php';

return AutoloaderInit::getAutoloader(then: static function (Autoloader $autoloader) {
    $autoloader
        ->setNamespace('Bree', ['core', 'framework'])
        ->useExtension('.bg')
        ->useFile('bree')
        ->register();
});
