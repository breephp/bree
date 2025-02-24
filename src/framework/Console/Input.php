<?php

declare(strict_types=1);

namespace Bridget\Console;

class Input
{
    public static function scan(?string $prompt = null): string
    {
        return readline($prompt);
    }

    public static function string(?string $prompt = null): string
    {
        return self::scan($prompt);
    }

    public static function int(?string $prompt = null): int
    {
        return (int) self::scan($prompt);
    }

    public static function float(?string $prompt = null): float
    {
        return (float) self::scan($prompt);
    }

    public static function bool(?string $prompt = null): bool
    {
        $input = strtolower(self::scan($prompt.' (yes/no) '));

        return in_array($input, ['yes', 'y', 'true', '1']);
    }

    public static function choice(string $prompt, array $choices): string
    {
        while (true) {
            echo $prompt.' ['.implode('/', $choices).']: ';
            $input = strtolower(trim(fgets(STDIN)));
            if (in_array($input, $choices)) {
                return $input;
            }
            echo Color::red("Invalid choice. Please try again.\n");
        }
    }
}
