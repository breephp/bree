<?php

declare(strict_types=1);

namespace Spl\Exceptions;

use LengthException as BaseException;

class LengthException extends BaseException implements ExceptionInterface
{
    use ExceptionTrait;
}
