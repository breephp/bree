<?php

declare(strict_types=1);

namespace Bridget\Exceptions;

use Psr\Container\NotFoundExceptionInterface;

interface IsNotFound extends IsException, NotFoundExceptionInterface {}
