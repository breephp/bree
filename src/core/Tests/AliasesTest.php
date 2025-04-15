<?php

declare(strict_types=1);

use Bree\Concretes\Alias;
use Bree\Concretes\Aliases;

test('aliases', function () {
    $aliases = new Aliases('b', 'hi', new Alias('p'));

    foreach ($aliases->getList() as $alias) {
        expect($alias)->toBeInstanceOf(Alias::class);
    }
});

test('alias', function () {
    $alias = new Alias('phi');

    expect($alias->getName())->toEqual('phi');
    expect($alias->nameIs('phi'))->toBeTrue();
    expect($alias->nameIs('php'))->toBeFalse();

    $alias->setName('php');
    expect($alias->getName())->toEqual('php');
    expect($alias->nameIs('phi'))->toBeFalse();
    expect($alias->nameIs('php'))->toBeTrue();
});
