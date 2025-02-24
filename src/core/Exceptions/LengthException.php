<?php

declare(strict_types=1);

namespace Bridget\Exceptions;

use Bridget\Concerns\CanCreateException;
use Bridget\Contracts\IsException;
use LengthException as BaseException;

class LengthException extends BaseException implements IsException
{
    use CanCreateException;
}
