<?php

declare(strict_types=1);

namespace Bridget\Exceptions;

use DomainException as BaseException;

class DomainException extends BaseException implements ExceptionInterface
{
    use ExceptionTrait;
}
