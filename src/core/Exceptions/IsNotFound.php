<?php

declare(strict_types=1);

namespace Bree\Exceptions;

use Psr\Container\NotFoundExceptionInterface;
use Spl\Exceptions\ExceptionInterface;

interface IsNotFound extends ExceptionInterface, NotFoundExceptionInterface {}
