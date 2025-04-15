<?php

declare(strict_types=1);

arch('strict')
    ->expect('Bree\\')
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
    ->expect('Bree\Bases')
    ->classes()
    ->toBeAbstract()
    ->toHavePrefix('Base');

arch('concerns')
    ->expect('Bree\Concerns')
    ->traits()
    ->toOnlyBeUsedIn(['Bree\Bases', 'Bree\Concerns', 'Bree\Exceptions', 'Bree\Samples']);

arch('contracts')
    ->expect('Bree\Contracts')
    ->interfaces()
    ->toOnlyBeUsedIn(['Bree\Bases', 'Bree\Contracts', 'Bree\Exceptions', 'Bree\Samples']);

arch('enums')
    ->expect('Bree\Enums')
    ->enums()
    ->toOnlyBeUsedIn(['Bree\Bases', 'Bree\Types', 'Bree\Concerns', 'Bree\Contracts']);

arch('objects')
    ->expect('Bree\Objects')
    ->classes()
    ->toHaveSuffix('Object')
    ->toHaveConstructor();

arch('types')
    ->expect('Bree\Types')
    ->classes()
    ->toHaveSuffix('Type')
    ->toExtend('Bree\Bases\BaseType');
