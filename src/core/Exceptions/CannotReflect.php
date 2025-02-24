<?php

declare(strict_types=1);

namespace Bridget\Exceptions;

final class CannotReflect extends \ReflectionException implements IsException
{
    use HasExceptionConstructor;
}
