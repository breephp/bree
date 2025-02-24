<?php

declare(strict_types=1);

namespace Bridget\Concretes;

use Bridget\Console\Color;

class Installer
{
    const string NAME = 'Bridget';

    public static function postInstall(): void
    {
        self::printMessage('📥 '.static::NAME.' has been installed successfully!', 'blue');
        // TODO: Setup Bridget
    }

    public static function postUpdate(): void
    {
        self::printMessage('🔄 '.static::NAME.' has been updated successfully!', 'yellow');
        // TODO: Update Bridget
    }

    private static function printMessage(string $message, string $color = 'green'): void
    {
        echo Color::format($color, $message).PHP_EOL;
    }
}
