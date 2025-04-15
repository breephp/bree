<?php

declare(strict_types=1);

namespace Bree\Concretes;

final class AutoloaderInit
{
    private static Autoloader $autoloader;

    private static bool $registered = false;

    public static function autoload(string $class): ?bool
    {
        $namespace = preg_quote(__NAMESPACE__, '/');
        $directory = __DIR__.DIRECTORY_SEPARATOR;
        $extension = '.'.pathinfo(__FILE__, PATHINFO_EXTENSION);
        if (preg_match("/^$namespace\\\(?P<name>.*)$/", $class, $matches) === 1) {
            if (is_file($file = $directory.str_replace('\\', DIRECTORY_SEPARATOR, $matches['name']).$extension)) {
                if (is_readable($file)) {
                    include_once $file;

                    return class_exists($class) || interface_exists($class) || trait_exists($class) || enum_exists($class);
                }
            }
        }

        return null;
    }

    /**
     * @param  null|array<callable-string|callable-object>|array{object|class-string,string}|callable-string|callable-object|callable(Autoloader $autoloader): mixed  $then
     */
    public static function getAutoloader(null|array|string|object|callable $then = null): Autoloader
    {
        if (! isset(self::$autoloader)) {
            self::register();
            self::$autoloader = $autoloader = new Autoloader(\dirname(__DIR__));
            if ($then) {
                $then($autoloader);
            }
            self::unregister();
        }

        return self::$autoloader;
    }

    public static function register(): void
    {
        if (! self::$registered) {
            spl_autoload_register(self::autoload(...), true, true);
            self::$registered = true;
        }
    }

    public static function unregister(): void
    {
        if (self::$registered) {
            spl_autoload_unregister(self::autoload(...));
            self::$registered = false;
        }
    }
}
