<?php

declare(strict_types=1);

namespace Bree\Console;

class Color extends Util
{
    private static $foregrounds = [
        'black' => '30', 'red' => '31', 'green' => '32',
        'yellow' => '33', 'blue' => '34', 'magenta' => '35',
        'cyan' => '36', 'white' => '37', 'gray' => '90',
        'brightRed' => '91', 'brightGreen' => '92',
        'brightYellow' => '93', 'brightBlue' => '94',
        'brightMagenta' => '95', 'brightCyan' => '96',
        'brightWhite' => '97',
    ];

    private static $backgrounds = [
        'bgBlack' => '40', 'bgRed' => '41', 'bgGreen' => '42',
        'bgYellow' => '43', 'bgBlue' => '44', 'bgMagenta' => '45',
        'bgCyan' => '46', 'bgWhite' => '47', 'bgGray' => '100',
        'bgBrightRed' => '101', 'bgBrightGreen' => '102',
        'bgBrightYellow' => '103', 'bgBrightBlue' => '104',
        'bgBrightMagenta' => '105', 'bgBrightCyan' => '106',
        'bgBrightWhite' => '107',
    ];

    private static function getCode(string $name): string
    {
        return self::$foregrounds[$name] ?? self::$backgrounds[$name] ?? null;
    }

    public static function format(string $color, string $message): string
    {
        $code = self::getCode($color);

        return $code ? "\033[{$code}m{$message}\033[0m" : $message;
    }

    public static function __callStatic(string $method, array $args): string
    {
        $normalizedMethod = self::normalizeMethod($method);

        return self::format($normalizedMethod, $args[0] ?? '');
    }
}
