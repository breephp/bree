<?php

declare(strict_types=1);

namespace Bree\Concretes;

use Spl\Exception\RuntimeException;

class FtpException extends RuntimeException
{
    const CONNECTION_FAILURE = 0x01;

    const NOT_CONNECTED = 0x02;

    const LOGIN_FAILURE = 0x04;

    const NOT_LOGGED_IN = 0x08;

    const BAD_METHOD = 0x010;

    const INVALID_ARGUMENT = 0x020;

    const INVALID_STATEMENT = 0x040;

    const STATEMENT_FAILURE = 0x080;
}
