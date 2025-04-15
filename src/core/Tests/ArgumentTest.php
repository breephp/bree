<?php

declare(strict_types=1);

use Bree\Bases\BaseArgument;
use Bree\Concretes\Argument;
use Bree\Contracts\IsArgument;

test('argument', function () {
    $argument = new Argument(0, 'phi');
    expect($argument)->toBeInstanceOf(Argument::class);
    expect($argument)->toBeInstanceOf(BaseArgument::class);
    expect($argument)->toBeInstanceOf(IsArgument::class);

    expect($argument->getIndex())->toEqual(0);
    expect($argument->indexIs(0))->toBeTrue();
    expect($argument->valueIs('phi'))->toBeTrue();
    expect($argument->indexIs(1))->toBeFalse();
    expect($argument->valueIs('php'))->toBeFalse();

    $argument->setIndex(1)->setValue('php');

    expect($argument->getIndex())->toEqual(1);
    expect($argument->indexIs(0))->toBeFalse();
    expect($argument->valueIs('phi'))->toBeFalse();
    expect($argument->indexIs(1))->toBeTrue();
    expect($argument->valueIs('php'))->toBeTrue();
});
