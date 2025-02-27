<?php

declare(strict_types=1);

namespace Spl\Exceptions;

use RuntimeException as BaseException;

class RuntimeException extends BaseException implements ExceptionInterface
{
    use ExceptionTrait;
}
