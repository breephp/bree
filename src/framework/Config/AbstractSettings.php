<?php

declare(strict_types=1);

namespace Bree\Config;

abstract class AbstractSettings implements SettingsInterface
{
    public function __construct(array $options = [])
    {

        $this->setOptions($options);
    }
}
