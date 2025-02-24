<?php

declare(strict_types=1);

namespace Bridget\Exceptions;

use Bridget\Concerns\CanCreateException;
use Bridget\Contracts\IsException;
use RuntimeException as BaseException;

class RuntimeException extends BaseException implements IsException
{
    use CanCreateException;
}
