<?php

declare(strict_types=1);

namespace Bridget\Concretes;

/**
 * The console command interface
 *
 * @author SIGUI Kessé Emmanuel
 * @license MIT
 */
interface CommandInterface
{
    /**
     * Set the command handler
     *
     * @param callable The command handler
     */
    public function setHandler(callable $handler): self;

    /**
     * Execute the command
     *
     * @param  array  $args  The command arguments
     */
    public function execute(...$args): bool;

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
    public function addAction(string $name, callable $handler, string $alias = ''): CommandActionInterface;

    /**
     * Set a new action
     *
     * @param  string  $name  The action name
     * @param  null|string  $alias  The action alias
     * @return namespace\CommandActionInterface
     */
    public function setAction(string $name, ?callable $handler = null, string $alias = ''): CommandActionInterface;

    /**
     * Verify if the command has action name
     *
     * @param  string  $name  The action name
     */
    public function hasAction(string $name): bool;

    /**
     * Get the command action
     *
     * @param  string  $name  The action name
     * @return null|namespace\CommandActionInterface
     */
    public function getAction(string $name): ?CommandActionInterface;

    /**
     * Get the command actions list
     *
     * @param  string  $name  The names of actions
     * @return array The command actions list
     */
    public function getActions(array $names = []): array;

    /**
     * Check if the command has actions
     */
    public function hasActions(): bool;

    /**
     * Check if the command has any actions
     *
     * @param  string  $name  The names of actions
     */
    public function hasAnyActions(array $names): bool;

    /**
     * Check if the command has all actions
     *
     * @param  string  $name  The names of actions
     */
    public function hasAllActions(array $names): bool;
}
