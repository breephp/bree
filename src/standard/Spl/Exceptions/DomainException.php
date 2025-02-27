<?php

declare(strict_types=1);

namespace Spl\Exceptions;

use DomainException as BaseException;

class DomainException extends BaseException implements ExceptionInterface
{
    use ExceptionTrait;
}
