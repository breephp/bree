<?php

declare(strict_types=1);

namespace Bree\Concretes;

/**
 * The filter class
 *
 * @author SIGUI Kessé Emmanuel
 * @license MIT
 */
class CommandFilter
{
    /**
     * Sanitize the name of order
     *
     * @param  string  $order  The order name
     * @return string The name sanitized
     */
    public static function sanitize_order(string $order): string
    {
        return strtolower(trim($order));
    }

    /**
     * Validate the name of order
     *
     * @param  string  $order  The order name
     */
    public static function validate_order(string $order): bool
    {
        return ! preg_match('/\s+/s', $order);
    }

    /**
     * Sanitize a alias
     *
     * @param  string  $alias  The alias
     * @return string The alias sanitized
     */
    public static function sanitize_alias(string $alias): string
    {
        $alias = self::sanitize_order($alias);

        return $alias;
    }

    /**
     * Validate a alias
     *
     * @param  string  $alias  The alias
     */
    public static function validate_alias(string $alias): bool
    {
        $alias = self::validate_order($alias);

        return $alias;
    }
}
