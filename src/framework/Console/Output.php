<?php

declare(strict_types=1);

namespace Bridget\Console;

class Output
{
    public static function print(string $message)
    {
        echo $message."\n";
    }

    public static function success(string $message)
    {
        echo Icon::success().' '.Color::green($message)."\n";
    }

    public static function error(string $message)
    {
        echo Icon::error().' '.Color::red($message)."\n";
    }

    public static function warning(string $message)
    {
        echo Icon::warning().' '.Color::yellow($message)."\n";
    }

    public static function info(string $message)
    {
        echo Icon::info().' '.Color::cyan($message)."\n";
    }

    public static function debug(string $message)
    {
        echo Icon::debug().' '.Color::magenta($message)."\n";
    }

    public static function title(string $message)
    {
        echo "\n".Style::bold(Color::brightBlue($message))."\n";
        echo str_repeat('=', mb_strlen($message))."\n";
    }
}
