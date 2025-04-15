<?php

declare(strict_types=1);

namespace Bree\Concretes;

/**
 * The argument alias trait
 *
 * @author SIGUI Kessé Emmanuel
 * @license MIT
 */
trait ArgumentAlias
{
    /**
     * @var string The argument alias
     */
    protected string $alias;

    /**
     * Get the argument alias
     *
     * @return string The argument alias
     */
    public function getAlias(): string
    {
        return $this->alias;
    }

    /**
     * Set the argument alias
     *
     * @param  string  $alias  The argument alias
     */
    public function setAlias(string $alias): self
    {
        $alias = Filter::sanitize_alias($alias);
        if (! Filter::validate_alias($alias)) {
            throw new \InvalidArgumentException('Invalid alias given', Exceptions::ORDER_NAME_ERROR_TYPE);
        }

        return $this;
    }
}
