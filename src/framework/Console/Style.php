<?php

declare(strict_types=1);

namespace Bree\Console;

class Style extends Util
{
    private static $styles = [
        'reset' => '0', // Reset all styles
        'bold' => '1', 'dim' => '2', 'italic' => '3',
        'underline' => '4', 'slowBlink' => '5', 'rapidBlink' => '6',
        'inverse' => '7', 'hidden' => '8', 'strikethrough' => '9',

        // Framed & Encircled (Not widely supported)
        'framed' => '51', 'encircled' => '52',

        // Overlines (Rarely supported)
        'overlined' => '53',

        // Double Underline
        'doubleUnderline' => '21',
    ];

    public static function format(string $style, string $message): string
    {
        $code = self::$styles[$style] ?? '0';

        return "\033[{$code}m{$message}\033[0m";
    }

    public static function __callStatic(string $method, array $args): string
    {
        $normalizedMethod = self::normalizeMethod($method);

        return self::format($normalizedMethod, $args[0] ?? '');
    }
}
