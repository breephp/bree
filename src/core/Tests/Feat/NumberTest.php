<?php

declare(strict_types=1);

use Bree\Concretes\Cast;
use Bree\Contracts\IsNumber;
use Bree\Contracts\IsNumeric;
use Bree\Objects\NumberObject;

beforeEach(function () {
    $this->number = Cast::toNumber(84.21);
});

it('should be instantiable', function () {
    expect($this->number)->toBeInstanceOf(NumberObject::class);
});

it('should be an instance of NumberType', function () {
    expect($this->number)->toBeInstanceOf(IsNumber::class);
});

it('should be an instance of NumericType', function () {
    expect($this->number)->toBeInstanceOf(IsNumeric::class);
});

it('should return the value', function () {
    expect($this->number->get())->toBe(84.21);
});
