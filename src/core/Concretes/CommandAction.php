<?php

declare(strict_types=1);

namespace Bree\Concretes;

/**
 * The command action class
 *
 * @author SIGUI Kessé Emmanuel
 * @license MIT
 */
class CommandAction extends Command implements CommandActionInterface
{
    /**
     * @uses namespace\ArgumentAlias
     */
    use ArgumentAlias;

    /**
     * Create a new command action
     *
     * @param  namespace\CommandInterface  $command  The command object
     * @param  string  $name  The action name
     * @param  string  $alias  The action alias
     */
    public function __construct(protected CommandInterface $command, string $name, ?callable $handler = null, string $alias = '', array $aliases = [])
    {
        parent::__construct($name, $handler);

        $this->setAlias($alias);
    }

    /**
     * Get the command object
     *
     * @return namespace\CommandInterface The command object
     */
    public function command(): CommandInterface
    {
        return $this->command;
    }
}
