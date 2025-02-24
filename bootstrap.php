<?php

declare(strict_types=1);

use Composer\Autoload\ClassLoader;

return (static function (string $root = __DIR__): ClassLoader {
    $init_root = $root;
    $autoloader = null;
    do {
        $file = "{$root}/composer.json";
        if (is_file($file) && is_readable($file)) {
            $data = (string) file_get_contents($file);
            $data = (array) json_decode($data, true);
            if ($data) {
                $autoload_file = "{$root}/".($data['config']['vendor-dir'] ?? 'vendor').'/autoload.php';
                if (is_file($autoload_file) && is_readable($autoload_file)) {
                    $autoload_file = realpath($autoload_file);
                    if (in_array($autoload_file, get_included_files())) {
                        throw new RuntimeException("The {$autoload_file} file has already been included.");
                    }
                    $autoloader = include_once $autoload_file;
                }
            }
        }
        $root = dirname($root);
    } while (! isset($autoloader) && dirname($root) !== $root);

    if (! $autoloader instanceof ClassLoader) {
        \fprintf(
            \STDERR,
            'No autoload file found between directory %s and its parents',
            $init_root
        );
        exit(1);
    }

    return $autoloader;
})();
