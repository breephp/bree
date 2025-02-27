<?php

declare(strict_types=1);

namespace Spl\Exceptions;

use UnderflowException as BaseException;

class UnderflowException extends BaseException implements ExceptionInterface
{
    use ExceptionTrait;
}
