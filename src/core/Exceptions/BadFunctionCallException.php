<?php

declare(strict_types=1);

namespace Bridget\Exceptions;

use BadFunctionCallException as BaseException;

class BadFunctionCallException extends BaseException implements ExceptionInterface
{
    use ExceptionTrait;
}
