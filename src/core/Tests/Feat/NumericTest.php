<?php

declare(strict_types=1);

use Bridget\Concretes\Cast;
use Bridget\Contracts\IsNumeric;
use Bridget\Contracts\IsScalar;
use Bridget\Objects\NumericObject;

beforeEach(function () {
    $this->numeric = Cast::toNumeric('84.21');
});

it('should be instantiable', function () {
    expect($this->numeric)->toBeInstanceOf(NumericObject::class);
});

it('should be an instance of NumericType', function () {
    expect($this->numeric)->toBeInstanceOf(IsNumeric::class);
});

it('should be an instance of ScalarType', function () {
    expect($this->numeric)->toBeInstanceOf(IsScalar::class);
});

it('should return the value', function () {
    expect($this->numeric->get())->toBe('84.21');
});
