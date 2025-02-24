<?php

declare(strict_types=1);

namespace Bridget\Concretes;

class FtpDotenv extends FtpEnv
{
    public function __construct(string $file = '.env', bool $process_sections = false, int $flags = 0)
    {
        $this->setFile($file);
        $this->setProcessSections($process_sections);
        $this->setFlags($flags);
    }

    protected string $file = '.env';

    public function setFile(string $file): self
    {
        return $this;
    }

    public function getFile(): string
    {
        return $this->file;
    }

    protected $process_sections = false;

    public function setProcessSections(bool $process_sections): self
    {
        $this->process_sections = $process_sections;

        return $this;
    }

    public function getProcessSections(): bool
    {
        return $this->process_sections;
    }

    protected int $flags = 0;

    public function setFlags(int $flags): self
    {
        $this->flags = $flags;

        return $this;
    }

    public function getFlags(): int
    {
        return $this->flags;
    }

    public function addFlag(int $flag): self
    {
        $this->flags |= $flag;

        return $this;
    }

    public function removeFlag(int $flag): self
    {
        $this->flags &= ~$flag;

        return $this;
    }

    public function hasFlag(int $flag): bool
    {
        return ($this->flags & $flag) === $flag;
    }

    public function getFlag(int $flag): int
    {
        return $this->flags & $flag;
    }

    public static function loadFile(string $file, bool $process_sections = false, int $flags = 0): Env
    {
        return (new static($file, $process_sections, $flags))->load();
    }

    public static function saveFile(array $data, string $file, bool $process_sections = false, int $flags = 0): bool
    {
        return (new static($file, $process_sections, $flags))->save($data);
    }

    public function load(?string $file = null): self
    {
        if ($file !== null) {
            $this->setFile($file);
        }
        $file = $this->getFile();
        $process_sections = $this->getProcessSections();
        $flags = $this->getFlags();

        if (! \is_file($file)) {
            throw new \InvalidArgumentException("$file does not exist");
        }
        if (! \is_readable($file)) {
            throw new \InvalidArgumentException("$file is not readable");
        }
        $vars = self::parseFile($file, $process_sections, $flags);

        return $this->setAll($vars);
    }

    public function save(string $data, ?string $file = null): self
    {
        if ($file !== null) {
            $this->setFile($file);
        }
        $file = $this->getFile();
        $process_sections = $this->getProcessSections();
        $flags = $this->getFlags();

        $vars = self::parseData($data, $process_sections, $flags);
        if (file_put_contents($file, $data, LOCK_EX) === false) {
            throw new \InvalidArgumentException("$file is not writable");
        }

        return $this->setAll($vars);
    }
}
