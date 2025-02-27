<?php

declare(strict_types=1);

namespace Spl\Exceptions;

use Exception as BaseException;

class Exception extends BaseException implements ExceptionInterface
{
    use ExceptionTrait;
}
