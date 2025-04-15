<?php

declare(strict_types=1);

use Bree\Bases\BaseOption;
use Bree\Concretes\Option;
use Bree\Contracts\IsOption;

test('option', function () {
    $option = new Option('engine', 'phi');

    expect($option)->toBeInstanceOf(Option::class);
    expect($option)->toBeInstanceOf(BaseOption::class);
    expect($option)->toBeInstanceOf(IsOption::class);

    expect($option->getKey())->toEqual('engine');
    expect($option->keyIs('engine'))->toBeTrue();
    expect($option->valueIs('phi'))->toBeTrue();
    expect($option->keyIs('language'))->toBeFalse();
    expect($option->valueIs('php'))->toBeFalse();

    $option->setKey('language')->setValue('php');

    expect($option->getKey())->toEqual('language');
    expect($option->keyIs('engine'))->toBeFalse();
    expect($option->valueIs('phi'))->toBeFalse();
    expect($option->keyIs('language'))->toBeTrue();
    expect($option->valueIs('php'))->toBeTrue();
});
