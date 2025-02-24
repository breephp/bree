<?php

declare(strict_types=1);

namespace Bridget\Concretes;

class Env implements \ArrayAccess, \Countable, \IteratorAggregate, \Stringable
{
    public function __construct(array $vars = [])
    {
        $this->setAll($vars);
    }

    protected array $vars;

    public function setAll(array $vars): self
    {
        $this->vars = [];

        return $this->setAny($vars);
    }

    public function setAny(array $vars): self
    {
        foreach ($vars as $key => $value) {
            $this->set($key, $value);
        }

        return $this;
    }

    public function getAll(): array
    {
        return $this->vars;
    }

    public function getAny(array $vars): array
    {
        $values = [];
        foreach ($vars as $key => $value) {
            if ($this->isset($key)) {
                $values[$key] = $this->get($key);
            }
        }

        return $values;
    }

    public function set(string $key, mixed $value): self
    {
        if (is_array($value)) {
            foreach ($value as $k => $v) {
                $this->set($key.'_'.$k, $v);
            }
        } else {
            $key = strtoupper($key);
            $value = self::convert($value);
            putenv("$key=$value");
            $this->vars[$key] = $_ENV[$key] = $_SERVER[$key] = $value;
        }

        return $this;
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->vars[$key] ?? $default;
    }

    public function isset(string $key): bool
    {
        return isset($this->vars[$key]);
    }

    public function unset(string $key): void
    {
        unset($this->vars[$key]);
    }

    public function offsetExists(mixed $offset): bool
    {
        return $this->isset($offset);
    }

    public static function parse(string|array $data): self
    {
        if (is_string($data)) {
            return is_file($data) ? self::parseFile($data) : self::parseData($data);
        }

        return new self($data);
    }

    public static function parseFile(string $file, bool $process_sections = false, int $flags = 0): self
    {
        $data = \parse_ini_file($file, $process_sections, $flags);
        if ($data === false) {
            throw new \InvalidArgumentException("$file is not a valid INI file");
        }

        return self::parse($data);
    }

    public static function parseData(string $data, bool $process_sections = false, int $flags = 0): self
    {
        $data = \parse_ini_string($data, $process_sections, $flags);
        if ($data === false) {
            throw new \InvalidArgumentException('Invalid INI data provided');
        }

        return self::parse($data);
    }

    public static function format(array $data, bool $process_sections = true): string
    {
        $format = '';
        foreach ($data as $key => $value) {
            if (\is_array($value)) {
                if (! $process_sections) {
                    throw new \InvalidArgumentException("Process sections is false, but $key is an array");
                }
                $format .= "[$key]".PHP_EOL.self::format($value, false);
            } else {
                $format .= $key.'='.self::stringify($value).PHP_EOL;
            }
        }

        return $format;
    }

    public static function convert(mixed $value): mixed
    {
        return match (true) {
            in_array($value, ['null', 'Null', 'NULL', 'nil', 'Nil', 'NIL', 'none', 'NONE'], true) => null,
            in_array($value, ['true', 'True', 'TRUE', 'on', 'On', 'ON', 'yes', 'Yes', 'YES', 't', 'T', 'y', 'Y', '1'], true) => true,
            in_array($value, ['false', 'False', 'FALSE', 'off', 'Off', 'OFF', 'no', 'No', 'NO', 'f', 'F', 'n', 'N', '0'], true) => false,
            is_numeric($value) => is_int(strpos($value, '.')) ? (float) $value : (int) $value,
            default => $value,
        };
    }

    public static function stringify(string|int|float|bool $value): string
    {
        if (\is_bool($value)) {
            $value = $value ? 'true' : 'false';
        } elseif (\is_string($value)) {
            if (\preg_match('/^([\'"]).*\1$/', $value)) {
                return $value;
            }
            $value = ! str_contains($value, '\'') ? '\''.$value.'\'' : '"'.$value.'"';
            $value = \str_replace('\\', '\\\\', $value);
        } else {
            $value = (string) $value;
        }

        return $value;
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->get($offset);
    }

    public function offsetSet(mixed $offset, $value): void
    {
        $this->set($offset, $value);
    }

    public function offsetUnset(mixed $offset): void
    {
        $this->unset($offset);
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->vars);
    }

    public function count(): int
    {
        return count($this->vars);
    }

    public function __set(string $key, mixed $value): void
    {
        $this->set($key, $value);
    }

    public function __get(string $key): mixed
    {
        return $this->get($key);
    }

    public function __isset(string $key): bool
    {
        return $this->isset($key);
    }

    public function __unset(string $key): void
    {
        $this->unset($key);
    }

    public function __debugInfo(): array
    {
        return $this->vars;
    }

    public function __toString(): string
    {
        return self::format($this->vars);
    }

    public function __invoke(string $key, mixed $default = null): mixed
    {
        return $this->get($key, $default);
    }
}
