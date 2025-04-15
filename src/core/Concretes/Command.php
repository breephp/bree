<?php

declare(strict_types=1);

namespace Bree\Concretes;

use Bree\Bases\BaseCommand;

/**
 * The command class
 *
 * @author SIGUI Kessé Emmanuel
 * @license MIT
 */
class Command extends BaseCommand
{
    /**
     * Create a new command
     *
     * @param  string  $name  The command name
     *
     * @throws \InvalidArgumentException if the name is invalid
     */
    public function __construct(string $name, ?callable $handler = null)
    {
        $name = Filter::sanitize_order($name);
        if (! Filter::validate_order($name)) {
            throw new \InvalidArgumentException('Invalid command name given', Exceptions::ORDER_NAME_ERROR_TYPE);
        }

        $this->name = $name;
        $this->handler = $handler;
    }

    /**
     * @var string The command name
     */
    protected string $name;

    /**
     * Get the command name
     *
     * @return string The command name
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @var array The command aliases
     */
    protected array $aliases;

    /**
     * Get the command aliases
     *
     * @return array The command aliases
     */
    public function aliases(): array
    {
        return $this->aliases;
    }

    /**
     * @var callable The command handler
     */
    protected $handler;

    /**
     * Set the command handler
     *
     * @param callable The command handler
     */
    public function setHandler(callable $handler): self
    {
        $this->handler = $handler;

        return $this;
    }

    /**
     * Execute the command
     *
     * @param  array  $args  The command arguments
     *
     * @throws \RuntimeException if the arguments are invalid
     */
    public function execute(...$args): bool
    {
        if ($this->hasActions()) {
            $action = null;
            foreach ($args as $key => $arg) {
                if ($this->hasActions()) {
                    $action = $this->getAction($arg);
                    unset($args[$key]);
                    break;
                }
            }

            if (! isset($action)) {
                throw new \RuntimeException('Invalid arguments given', Exceptions::EXEC_ARGS_ERROR_TYPE);

                return false;
            }

            return $action->execute(...$args);
        }

        return is_callable($this->handler) ? call_user_func($this->handler, ...$args) : true;
    }

    /**
     * Add a new action
     *
     * @param  string  $name  The action name
     * @param  string  $alias  The action alias
     * @return namespace\CommandActionInterface
     *
     * @throws \InvalidArgumentException if the name is invalid
     * @throws \RuntimeException if the name is already used
     */
    public function addAction(string $name, callable $handler, string $alias = ''): CommandActionInterface
    {
        $name = Filter::sanitize_order($name);

        if (! Filter::validate_order($name)) {
            throw new \InvalidArgumentException('Invalid action name given', Exceptions::ORDER_NAME_ERROR_TYPE);
        }

        if (isset($this->actions[$name])) {
            throw new \RuntimeException("$name is already used as action name", Exceptions::ORDER_NAME_ERROR_TYPE);
        }

        return $this->actions[$name] = new CommandAction($this, $name, $handler, $alias);
    }

    /**
     * @var array The command actions list
     */
    protected array $actions = [];

    /**
     * Set a new action
     *
     * @param  string  $name  The action name
     * @param  string  $alias  The action alias
     * @return namespace\CommandActionInterface
     */
    public function setAction(string $name, ?callable $handler = null, string $alias = ''): CommandActionInterface
    {
        if (! $this->hasAction($name)) {
            return $this->addAction($this, $name, $handler);
        }

        $action = $this->getAction($name);
        $action->setHandler($handler);
        $action->setAlias($alias);

        return $action;
    }

    /**
     * Verify if the command has action name
     *
     * @param  string  $name  The action name
     */
    public function hasAction(string $name): bool
    {
        $name = Filter::sanitize_order($name);

        return isset($this->actions[$name]);
    }

    /**
     * Get the command action
     *
     * @param  string  $name  The action name
     * @return null|namespace\CommandActionInterface
     */
    public function getAction(string $name): ?CommandActionInterface
    {
        $name = Filter::sanitize_order($name);

        return $this->actions[$name] ?? null;
    }

    /**
     * Get the command actions list
     *
     * @param  string  $name  The names of actions
     * @return array The command actions list
     */
    public function getActions(array $names = []): array
    {
        if (empty($names)) {
            return $this->actions;
        }

        $actions = [];
        foreach ($names as $name) {
            $actions[$name] = $this->getAction($name);
        }

        return $actions;
    }

    /**
     * Check if the command has actions
     */
    public function hasActions(): bool
    {
        return ! empty($this->actions);
    }

    /**
     * Check if the command has any actions
     *
     * @param  string  $name  The names of actions
     */
    public function hasAnyActions(array $names): bool
    {
        if (empty($names)) {
            return $this->hasActions();
        }

        foreach ($names as $name) {
            if ($this->hasAction($name)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if the command has all actions
     *
     * @param  string  $name  The names of actions
     */
    public function hasAllActions(array $names): bool
    {
        if (empty($names)) {
            return $this->hasActions();
        }

        foreach ($names as $name) {
            if (! $this->hasAction($name)) {
                return false;
            }
        }

        return true;
    }
}
