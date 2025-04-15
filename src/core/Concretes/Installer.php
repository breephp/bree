<?php

declare(strict_types=1);

namespace Bree\Concretes;

use Bree\Console\Color;

class Installer
{
    const string NAME = 'Bree';

    public static function postInstall(): void
    {
        self::printMessage('📥 '.static::NAME.' has been installed successfully!', 'blue');
        // TODO: Setup Bree
    }

    public static function postUpdate(): void
    {
        self::printMessage('🔄 '.static::NAME.' has been updated successfully!', 'yellow');
        // TODO: Update Bree
    }

    private static function printMessage(string $message, string $color = 'green'): void
    {
        echo Color::format($color, $message).PHP_EOL;
    }
}
