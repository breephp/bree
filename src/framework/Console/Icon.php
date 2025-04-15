<?php

declare(strict_types=1);

namespace Bree\Console;

class Icon extends Util
{
    private static $icons = [
        'success' => '✅', 'error' => '❌', 'warning' => '⚠️',
        'info' => 'ℹ️', 'question' => '❓', 'debug' => '🐞',
        'rocket' => '🚀', 'fire' => '🔥', 'star' => '⭐',
        'heart' => '❤️', 'thumbsUp' => '👍', 'thumbsDown' => '👎',
        'clock' => '⏳', 'lightning' => '⚡', 'skull' => '💀',
        'bulb' => '💡', 'hammer' => '🔨', 'wrench' => '🔧',
        'file' => '📄', 'folder' => '📁', 'lock' => '🔒',
        'unlock' => '🔓', 'bell' => '🔔', 'coffee' => '☕',
    ];

    public static function get(string $name): string
    {
        return self::$icons[$name] ?? '';
    }

    public static function __callStatic(string $method, array $args): string
    {
        $normalizedMethod = self::normalizeMethod($method);

        return self::get($normalizedMethod);
    }
}
