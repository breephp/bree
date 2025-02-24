<?php

declare(strict_types=1);

namespace Bridget\Tests;

use Bridget\Concretes\Let;
use Bridget\Concretes\Statement;

class LetTest implements Statement
{
    public function __construct(protected mixed $value) {}

    public static function parse(mixed $value): self
    {
        return new self($value);
    }

    public function getValue(): mixed
    {
        return $this->value;
    }
}

test('The let() function (alias of the '.Let::class.'::var() method) must return an instance of '.Statement::class, function () {
    $phiVar = new class(5) extends LetTest {};
    expect($phiVar->getValue())->toBeInt()->toEqual(5);
    expect($var = let($phiVar, 2))->toEqual(Let::var(LetTest::class, 2));
    expect($var->getValue())->toBeInt()->toEqual(2);
});
