<?php

declare(strict_types=1);

use Bridget\Concretes\Cast;
use Bridget\Contracts\IsBool;
use Bridget\Contracts\IsScalar;
use Bridget\Objects\BoolObject;

beforeEach(function () {
    $this->bool = Cast::toBool(true);
});

it('should be instantiable', function () {
    expect($this->bool)->toBeInstanceOf(BoolObject::class);
});

it('should be an instance of BoolType', function () {
    expect($this->bool)->toBeInstanceOf(IsBool::class);
});

it('should be an instance of ScalarType', function () {
    expect($this->bool)->toBeInstanceOf(IsScalar::class);
});

it('should return the value', function () {
    expect($this->bool->get())->toBe(true);
});
