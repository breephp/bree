<?php

declare(strict_types=1);

namespace Bridget\Exceptions;

use OverflowException as BaseException;

class OverflowException extends BaseException implements ExceptionInterface
{
    use ExceptionTrait;
}
