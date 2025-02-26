<?php

declare(strict_types=1);

namespace Bridget\Exceptions;

use InvalidArgumentException as BaseException;

class InvalidArgumentException extends BaseException implements ExceptionInterface
{
    use ExceptionTrait;
}
