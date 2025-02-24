<?php

declare(strict_types=1);

use Bridget\Exceptions\BadFunctionCallException as BridgetBadFunctionCallException;
use Bridget\Exceptions\BadMethodCallException as BridgetBadMethodCallException;
use Bridget\Exceptions\DomainException as BridgetDomainException;
use Bridget\Exceptions\InvalidArgumentException as BridgetInvalidArgumentException;
use Bridget\Exceptions\LengthException as BridgetLengthException;
use Bridget\Exceptions\LogicException as BridgetLogicException;
use Bridget\Exceptions\OutOfBoundsException as BridgetOutOfBoundsException;
use Bridget\Exceptions\OutOfRangeException as BridgetOutOfRangeException;
use Bridget\Exceptions\OverflowException as BridgetOverflowException;
use Bridget\Exceptions\RangeException as BridgetRangeException;
use Bridget\Exceptions\RuntimeException as BridgetRuntimeException;
use Bridget\Exceptions\UnderflowException as BridgetUnderflowException;
use Bridget\Exceptions\UnexpectedValueException as BridgetUnexpectedValueException;

test('All Bridget exceptions inherit PHP exceptions', function (string $phpException, string $sikessemException) {
    $exception = $sikessemException::with('Test %s Error.', [$phpException]);
    expect($exception)->toBeInstanceOf($phpException);
    expect(fn () => throw $exception)->toThrow($phpException);
})->with([
    [BadFunctionCallException::class, BridgetBadFunctionCallException::class],
    [BadMethodCallException::class, BridgetBadMethodCallException::class],
    [DomainException::class, BridgetDomainException::class],
    [InvalidArgumentException::class, BridgetInvalidArgumentException::class],
    [LengthException::class, BridgetLengthException::class],
    [LogicException::class, BridgetLogicException::class],
    [OutOfBoundsException::class, BridgetOutOfBoundsException::class],
    [OutOfRangeException::class, BridgetOutOfRangeException::class],
    [OverflowException::class, BridgetOverflowException::class],
    [RangeException::class, BridgetRangeException::class],
    [RuntimeException::class, BridgetRuntimeException::class],
    [UnderflowException::class, BridgetUnderflowException::class],
    [UnexpectedValueException::class, BridgetUnexpectedValueException::class],
]);
