<?php

declare(strict_types=1);

namespace Bridget\Concretes;

use InvalidArgumentException;

class Autoloader
{
    public readonly string $root;

    public const DIRECTORY_SEPARATOR = DIRECTORY_SEPARATOR;

    public const PATH_SEPARATOR = PATH_SEPARATOR;

    public const EXTENSION_SEPARATOR = ',';

    public const NAMESPACE_SEPARATOR = '\\';

    protected string $directories = '';

    /** @var array<string> */
    protected array $extensions = [];

    /** @var array<string, array<string>> */
    protected array $namespaces = [];

    /** @var array<string> */
    protected array $files = [];

    public function __construct(string $root)
    {
        if (empty($root)) {
            throw new InvalidArgumentException('Empty root given');
        }

        if (! is_dir($root) || ! is_readable($root)) {
            throw new InvalidArgumentException("$root must me a readable directory");
        }

        $this->root = realpath($root).DIRECTORY_SEPARATOR;
    }

    public function setDirectories(string $directories): static
    {
        $this->directories = $directories;

        return $this;
    }

    public function getDirectories(): string
    {
        return $this->directories;
    }

    /** @param array<string> $list */
    public function setDirectoryList(array $list): static
    {
        return $this->setDirectories(implode(static::PATH_SEPARATOR, $list));
    }

    /** @return array<string> */
    public function getDirectoryList(): array
    {
        return explode(static::PATH_SEPARATOR, $this->getDirectories());
    }

    public function hasNotDirectories(): bool
    {
        return empty($this->getDirectories());
    }

    public function hasDirectories(): bool
    {
        return ! $this->hasNotDirectories();
    }

    public function hasDirectory(string $directory): bool
    {
        return in_array($directory, $this->getDirectoryList(), true);
    }

    public function addDirectories(string|array $directories, bool $prepend = false): static
    {
        if (is_array($directories)) {
            foreach ($directories as $directory) {
                $this->addDirectories($directory, $prepend);
            }

            return $this;
        }

        if (! \is_dir($directories)) {
            throw new InvalidArgumentException("No such directory $directories");
        }

        if (! \is_readable($directories)) {
            throw new InvalidArgumentException("Cannot read directory $directories");
        }

        $directories = \realpath($directories).\DIRECTORY_SEPARATOR;

        if ($this->hasNotDirectories()) {
            return $this->setDirectories($directories);
        }

        if ($this->hasDirectory($directories)) {
            return $this;
        }

        $directories = $prepend ? $directories.static::PATH_SEPARATOR.$this->getDirectories() : $this->getDirectories().static::PATH_SEPARATOR.$directories;

        return $this->setDirectories($directories);
    }

    /** @param array<string, string|array<string>> $namespaces */
    public function setNamespaces(array $namespaces): static
    {
        $this->namespaces = [];

        foreach ($namespaces as $namespace => $directories) {
            $this->setNamespace($namespace, $directories);
        }

        return $this;
    }

    /** @param string|array<string> $directories */
    public function setNamespace(string $namespace, string|array $directories): static
    {
        $this->namespaces[$namespace] = [];
        $directories = (array) $directories;

        foreach ($directories as $directory) {
            $this->addNamespace($namespace, $directory);
        }

        return $this;
    }

    public function addNamespace(string $namespace, string $directory): static
    {
        if (! isset($this->namespaces[$namespace])) {
            return $this->setNamespace($namespace, $directory);
        }

        if (! in_array($directory, $this->namespaces[$namespace])) {
            $this->namespaces[$namespace][] = $directory;
        }

        return $this;
    }

    /** @param array<string> $files */
    public function setFiles(array $files): static
    {
        $this->files = [];

        return $this->addFiles($files);
    }

    /** @param array<string> $files */
    public function addFiles(array $files): static
    {
        foreach ($files as $file) {
            $this->addFile($file);
        }

        return $this;
    }

    public function addFile(string $file): static
    {
        $this->files[] = $file;

        return $this;
    }

    /** @param array<string> $files */
    public function useFiles(array $files): static
    {
        return $this->setFiles($files)->autoloadFiles();
    }

    public function useFile(string $file): static
    {
        return $this->useFiles([$file]);
    }

    /** @param array<string> $extensions */
    public function setExtensions(array $extensions): static
    {
        $this->extensions = explode(static::EXTENSION_SEPARATOR, spl_autoload_extensions());

        return $this->addExtensions($extensions);
    }

    /** @param array<string> $extensions */
    public function addExtensions(array $extensions): static
    {
        foreach ($this->extensions as $extension) {
            $this->addExtension($extension);
        }

        return $this;
    }

    public function addExtension(string $extension): static
    {
        if (! in_array($extension, $this->extensions)) {
            $this->extensions[] = $extension;
        }

        return $this;
    }

    /** @param array<string> $extensions */
    public function useExtensions(array $extensions): static
    {
        return $this->setExtensions($extensions)->autoloadExtensions();
    }

    public function useExtension(string $extension): static
    {
        return $this->useExtensions([$extension]);
    }

    public function autoloadFiles(): static
    {
        foreach ($this->files as $file) {
            $this->autoloadFile($file);
        }

        return $this;
    }

    public function autoloadFile(string $file): bool
    {
        if ($file = $this->findFile($file)) {
            include_once $file;

            return true;
        }

        return false;
    }

    public function findFile(string $file): string|false
    {
        foreach ([''] + $this->extensions as $extension) {
            $file .= $extension;

            if (is_file($file) || is_file($file = $this->root.$file)) {
                return $file;
            }
        }

        return false;
    }

    public function autoloadExtensions(): static
    {
        $extensions = array_unique($this->extensions);

        spl_autoload_extensions(implode(static::EXTENSION_SEPARATOR, $extensions));

        return $this;
    }

    public function register(): static
    {
        spl_autoload_register($this->autoload(...));

        return $this;
    }

    public function unregister(): static
    {
        spl_autoload_register($this->autoload(...));

        return $this;
    }

    public function autoload(string $class): ?bool
    {
        foreach ($this->namespaces as $namespace => $directories) {
            foreach ($directories as $directory) {
                $this->autoloadClass($class, $namespace, $directory);
            }
        }

        return null;
    }

    protected function autoloadClass(string $class, string $namespace, string $directory): ?bool
    {
        if (! str_ends_with($namespace, static::NAMESPACE_SEPARATOR)) {
            $namespace .= static::NAMESPACE_SEPARATOR;
        }

        if (str_starts_with($class, $namespace)) {
            $directory = strtr($directory, '/\\', static::DIRECTORY_SEPARATOR.static::DIRECTORY_SEPARATOR);

            if (! str_ends_with($directory, static::DIRECTORY_SEPARATOR)) {
                $directory .= static::DIRECTORY_SEPARATOR;
            }

            $name = substr($class, strlen($namespace));
            $file = $directory.strtr($name, static::NAMESPACE_SEPARATOR, static::DIRECTORY_SEPARATOR);

            if ($this->autoloadFile($file)) {
                return $this->loaded($class);
            }
        }

        return null;
    }

    protected function loaded(string $class): bool
    {
        return ! (class_exists($class) || interface_exists($class) || trait_exists($class) || enum_exists($class));
    }
}
