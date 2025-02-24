<?php

declare(strict_types=1);

namespace Bridget\Exceptions;

use Bridget\Concerns\CanCreateException;
use Bridget\Contracts\IsException;
use DomainException as BaseException;

class DomainException extends BaseException implements IsException
{
    use CanCreateException;
}
