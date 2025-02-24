<?php

declare(strict_types=1);

namespace Bridget\Exceptions;

use Bridget\Concerns\CanCreateException;
use Bridget\Contracts\IsException;
use RangeException as BaseException;

class RangeException extends BaseException implements IsException
{
    use CanCreateException;
}
