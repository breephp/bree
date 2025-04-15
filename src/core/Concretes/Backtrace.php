<?php

declare(strict_types=1);

namespace Bree\Concretes;

final class Backtrace
{
    public const int IGNORE_ARGS = DEBUG_BACKTRACE_IGNORE_ARGS;

    public const int PROVIDE_OBJECT = DEBUG_BACKTRACE_PROVIDE_OBJECT;

    public const string FILE_FIELD = 'file';

    public const string LINE_FIELD = 'line';

    public const string CLASS_FIELD = 'class';

    public const string OBJECT_FIELD = 'object';

    public const string FUNCTION_FIELD = 'function';

    public const string TYPE_FIELD = 'type';

    public const string ARGS_FIELD = 'args';

    public const int DEFAULT_FLAGS = self::IGNORE_ARGS;

    public const int DEFAULT_LIMIT = 0;

    public const int DEFAULT_RESET = 0;

    public const string DEFAULT_FIELD = self::FILE_FIELD;

    public const int DEFAULT_OFFSET = 0;

    /**
     * @var list<array{function:string,line?:int,file?:string,class?:class-string,type?:string,args?:list<mixed>,object?:object}>
     */
    private array $stack = [];

    public function __construct(int $flags = self::DEFAULT_FLAGS, int $reset = self::DEFAULT_RESET, int $limit = self::DEFAULT_LIMIT)
    {
        if ($limit !== 0) {
            $limit++;
        }

        $stack = debug_backtrace($flags, $limit);
        array_splice($stack, 0, $reset);
        $this->stack = $stack;
    }

    /**
     * @return list<array{function:string,line?:int,file?:string,class?:class-string,type?:string,args?:list<mixed>,object?:object}>|array{function:string,line?:int,file?:string,class?:class-string,type?:string,args?:list<mixed>,object?:object}
     */
    public function getStack(?int $offset = null): array
    {
        return is_null($offset) ? $this->stack : $this->stack[$offset];
    }

    public function getDirectory(int $offset = self::DEFAULT_OFFSET): ?string
    {
        if ($file = $this->getFile($offset)) {
            return dirname($file);
        }

        return null;
    }

    public function getFile(int $offset = self::DEFAULT_OFFSET): ?string
    {
        return $this->stack[$offset][self::FILE_FIELD] ?? null;
    }

    public function getLine(int $offset = self::DEFAULT_OFFSET): ?int
    {
        return $this->stack[$offset][self::LINE_FIELD] ?? null;
    }

    /**
     * @return ?class-string
     */
    public function getClass(int $offset = self::DEFAULT_OFFSET): ?string
    {
        return $this->stack[$offset][self::CLASS_FIELD] ?? null;
    }

    public function getObject(int $offset = self::DEFAULT_OFFSET): ?object
    {
        return $this->stack[$offset][self::OBJECT_FIELD] ?? null;
    }

    public function getFunction(int $offset = self::DEFAULT_OFFSET): ?string
    {
        return $this->stack[$offset][self::FUNCTION_FIELD] ?? null;
    }

    public function getType(int $offset = self::DEFAULT_OFFSET): ?string
    {
        return $this->stack[$offset][self::FUNCTION_FIELD] ?? null;
    }

    /**
     * @return array<array-key,mixed>|null
     */
    public function getArgs(int $offset = self::DEFAULT_OFFSET): ?array
    {
        return $this->stack[$offset][self::ARGS_FIELD] ?? null;
    }

    /**
     * @return list<array{function:string,line?:int,file?:string,class?:class-string,type?:string,args?:list<mixed>,object?:object}>
     */
    public function __debugInfo(): array
    {
        return $this->stack;
    }
}
