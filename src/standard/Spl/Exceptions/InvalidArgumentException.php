<?php

declare(strict_types=1);

namespace Spl\Exceptions;

use InvalidArgumentException as BaseException;

class InvalidArgumentException extends BaseException implements ExceptionInterface
{
    use ExceptionTrait;
}
