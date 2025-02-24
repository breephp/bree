<?php

declare(strict_types=1);

namespace Bridget\Exceptions;

use Bridget\Concerns\CanCreateException;
use Bridget\Contracts\IsException;
use LogicException as BaseException;

class LogicException extends BaseException implements IsException
{
    use CanCreateException;
}
