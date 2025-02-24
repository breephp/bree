<?php

declare(strict_types=1);

$loaded = false;

foreach (['../..', '.'] as $dir) {
    if (file_exists($file = __DIR__."/$dir/vendor/autoload.php")) {
        include_once $file;
        $loaded = true;
        break;
    }
}

if (! $loaded) {
    require_once __DIR__.DIRECTORY_SEPARATOR.'src/autoload.php';
}
