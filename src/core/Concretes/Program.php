<?php

declare(strict_types=1);

namespace Bridget\Concretes;

use Bridget\Console\Input;
use Bridget\Console\Output;
use InvalidArgumentException;
use RuntimeException;

abstract class Program
{
    protected Container $container;

    protected string $projectRoot;

    protected array $composerJson;

    protected string $name;

    protected string $description;

    public function __construct(protected string $binFile, protected string $userRoot, array $components = [])
    {
        if (! is_file($binFile)) {
            throw new InvalidArgumentException("$binFile is not a file");
        }

        if (! is_dir($userRoot)) {
            throw new InvalidArgumentException("$userRoot is not a directory");
        }

        $this->binFile = realpath($binFile);
        $this->userRoot = realpath($userRoot);
        $this->projectRoot = dirname(__DIR__);
        $this->container = new Container([
            ...[
                'input' => Input::class,
                'output' => Output::class,
            ],
            ...$components,
        ]);

        $this->configure();
    }

    public function configure(): void
    {
        $this->composerJson = $this->loadComposerJson($this->userRoot);
        /** @var array{name: string, version: string, description: string} */
        $project = $this->projectRoot === $this->userRoot
        ? $this->composerJson
           : $this->loadComposerJson($this->projectRoot);

        $this->setProject($project);
    }

    public function setProject(array $project): static
    {
        return $this
            ->setName($project['name'])
            ->setDescription($project['description']);
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    protected function loadComposerJson(string $dir): mixed
    {
        return $this->loadJson($dir.DIRECTORY_SEPARATOR.'composer.json', true);
    }

    protected function loadJson(string $file, bool $assoc = false): mixed
    {
        if (! is_file($file)) {
            throw new InvalidArgumentException("$file is not a file");
        }

        $file = realpath($file);
        $data = file_get_contents($file);

        if (! json_validate($data)) {
            throw new RuntimeException("Invalid `composer.json` file ($file)");
        }

        return json_decode($data, $assoc);
    }

    /**
     * @param  null|array<string>  $argv
     **/
    public function run(?array $argv = null, ?int $argc = null): never
    {
        /** @var array<string> */
        $args = $argv ?? $_SERVER['argv'] ?? [];
        $count ??= $argc ?? count($args);

        if ($count !== count($args)) {
            exit_error('Wrong arguments count');
        }

        if ($count < 1) {
            exit_error('No argument given');
        }

        $argv0 = $argv[0];
        $binFile = realpath($argv0);
        $args = array_slice($args, 1);

        if ($binFile !== $this->binFile && basename($this->binFile) !== basename($binFile) && dirname($binFile) !== dirname(__DIR__)) {
            exit_error('Cannot run %s from %s', $this->binFile, $argv0);
        }

        /** @var Input */
        $input = $this->container->get('input');

        /** @var Output */
        $output = $this->container->get('output');

        $code = $this->execute($args, $input, $output);

        exit($code);
    }

    /**
     * @param  null|array<string>  $args
     **/
    abstract public function execute(array $args, Input $input, Output $output): int;
}
