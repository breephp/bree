<?php

declare(strict_types=1);

use Bree\Concretes\Cast;
use Bree\Contracts\IsInt;
use Bree\Contracts\IsNumber;
use Bree\Objects\IntObject;

beforeEach(function () {
    $this->int = Cast::toInt(42);
});

it('should be instantiable', function () {
    expect($this->int)->toBeInstanceOf(IntObject::class);
});

it('should be an instance of IntType', function () {
    expect($this->int)->toBeInstanceOf(IsInt::class);
});

it('should be an instance of NumberType', function () {
    expect($this->int)->toBeInstanceOf(IsNumber::class);
});

it('should return the value', function () {
    expect($this->int->get())->toBe(42);
});
