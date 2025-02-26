<?php

declare(strict_types=1);

namespace Bridget\Exceptions;

use OutOfBoundsException as BaseException;

class OutOfBoundsException extends BaseException implements ExceptionInterface
{
    use ExceptionTrait;
}
