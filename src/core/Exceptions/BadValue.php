<?php

declare(strict_types=1);

namespace Bridget\Exceptions;

final class BadValue extends \UnexpectedValueException implements IsException
{
    use HasExceptionConstructor;
}
