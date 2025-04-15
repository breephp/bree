<?php

declare(strict_types=1);

use Bree\Concretes\Cast;
use Bree\Contracts\IsScalar;
use Bree\Contracts\IsString;
use Bree\Objects\StringObject;

beforeEach(function () {
    $this->string = Cast::toString('Hello World');
});

it('should be instantiable', function () {
    expect($this->string)->toBeInstanceOf(StringObject::class);
});

it('should be an instance of StringType', function () {
    expect($this->string)->toBeInstanceOf(IsString::class);
});

it('should be an instance of ScalarType', function () {
    expect($this->string)->toBeInstanceOf(IsScalar::class);
});

it('should return the value', function () {
    expect($this->string->get())->toBe('Hello World');
});
