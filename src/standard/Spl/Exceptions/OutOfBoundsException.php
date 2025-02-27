<?php

declare(strict_types=1);

namespace Spl\Exceptions;

use OutOfBoundsException as BaseException;

class OutOfBoundsException extends BaseException implements ExceptionInterface
{
    use ExceptionTrait;
}
