<?php

declare(strict_types=1);

use Bree\Bases\BaseParameter;
use Bree\Concretes\Parameter;
use Bree\Contracts\IsParameter;
use Bree\Enums\BuiltinType;

test('parameter', function () {
    $parameter = new Parameter('string', 'engine', 'phi');

    expect($parameter)->toBeInstanceOf(Parameter::class);
    expect($parameter)->toBeInstanceOf(BaseParameter::class);
    expect($parameter)->toBeInstanceOf(IsParameter::class);

    expect($parameter->getName())->toEqual('engine');
    expect($parameter->typeIs('string'))->toBeTrue();
    expect($parameter->typeIs(BuiltinType::String))->toBeTrue();
    expect($parameter->nameIs('engine'))->toBeTrue();
    expect($parameter->valueIs('phi'))->toBeTrue();
    expect($parameter->typeIs('bool'))->toBeFalse();
    expect($parameter->nameIs('lang'))->toBeFalse();
    expect($parameter->valueIs('php'))->toBeFalse();

    $parameter->setType(BuiltinType::Bool)->setName('language')->setValue('php');

    expect($parameter->typeIs('string'))->toBeFalse();
    expect($parameter->typeIs(BuiltinType::String))->toBeFalse();
    expect($parameter->typeIs('bool'))->toBeTrue();
    expect($parameter->typeIs(BuiltinType::Bool))->toBeTrue();
    expect($parameter->nameIs('engine'))->toBeFalse();
    expect($parameter->valueIs('phi'))->toBeFalse();
    expect($parameter->nameIs('language'))->toBeTrue();
    expect($parameter->valueIs('php'))->toBeTrue();
});
