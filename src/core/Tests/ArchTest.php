<?php

declare(strict_types=1);

arch('strict')
    ->expect('Bridget\\')
    ->toUseStrictTypes();

arch()
    ->preset()
    ->php()
    ->ignoring('debug_backtrace');

arch()
    ->preset()
    ->security()
    ->ignoring(['extract', 'parse_str']);

arch('bases')
    ->expect('Bridget\Bases')
    ->classes()
    ->toBeAbstract()
    ->toHavePrefix('Base');

arch('concerns')
    ->expect('Bridget\Concerns')
    ->traits()
    ->toOnlyBeUsedIn(['Bridget\Bases', 'Bridget\Concerns', 'Bridget\Exceptions', 'Bridget\Samples']);

arch('contracts')
    ->expect('Bridget\Contracts')
    ->interfaces()
    ->toOnlyBeUsedIn(['Bridget\Bases', 'Bridget\Contracts', 'Bridget\Exceptions', 'Bridget\Samples']);

arch('enums')
    ->expect('Bridget\Enums')
    ->enums()
    ->toOnlyBeUsedIn(['Bridget\Bases', 'Bridget\Types', 'Bridget\Concerns', 'Bridget\Contracts']);

arch('objects')
    ->expect('Bridget\Objects')
    ->classes()
    ->toHaveSuffix('Object')
    ->toHaveConstructor();

arch('types')
    ->expect('Bridget\Types')
    ->classes()
    ->toHaveSuffix('Type')
    ->toExtend('Bridget\Bases\BaseType');
