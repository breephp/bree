<?php

declare(strict_types=1);

use Spl\Exceptions\BadFunctionCallException as SplBadFunctionCallException;
use Spl\Exceptions\BadMethodCallException as SplBadMethodCallException;
use Spl\Exceptions\DomainException as SplDomainException;
use Spl\Exceptions\InvalidArgumentException as SplInvalidArgumentException;
use Spl\Exceptions\LengthException as SplLengthException;
use Spl\Exceptions\LogicException as SplLogicException;
use Spl\Exceptions\OutOfBoundsException as SplOutOfBoundsException;
use Spl\Exceptions\OutOfRangeException as SplOutOfRangeException;
use Spl\Exceptions\OverflowException as SplOverflowException;
use Spl\Exceptions\RangeException as SplRangeException;
use Spl\Exceptions\RuntimeException as SplRuntimeException;
use Spl\Exceptions\UnderflowException as SplUnderflowException;
use Spl\Exceptions\UnexpectedValueException as SplUnexpectedValueException;

test('All Spl exceptions inherit PHP exceptions', function (string $phpException, string $sikessemException) {
    $exception = $sikessemException::new('Test %s Error.', [$phpException]);
    expect($exception)->toBeInstanceOf($phpException);
    expect(fn () => throw $exception)->toThrow($phpException);
})->with([
    [BadFunctionCallException::class, SplBadFunctionCallException::class],
    [BadMethodCallException::class, SplBadMethodCallException::class],
    [DomainException::class, SplDomainException::class],
    [InvalidArgumentException::class, SplInvalidArgumentException::class],
    [LengthException::class, SplLengthException::class],
    [LogicException::class, SplLogicException::class],
    [OutOfBoundsException::class, SplOutOfBoundsException::class],
    [OutOfRangeException::class, SplOutOfRangeException::class],
    [OverflowException::class, SplOverflowException::class],
    [RangeException::class, SplRangeException::class],
    [RuntimeException::class, SplRuntimeException::class],
    [UnderflowException::class, SplUnderflowException::class],
    [UnexpectedValueException::class, SplUnexpectedValueException::class],
]);
