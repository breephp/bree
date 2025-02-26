<?php

declare(strict_types=1);

namespace Bridget\Exceptions;

enum ExceptionCode
{
    case ORDER_NAME_ERROR_TYPE;

    case EXEC_ARGS_ERROR_TYPE;

    case INVALID_STREAM;

    case INVALID_NAME;

    case NO_SUCH_FILE;

    case NOT_READABLE;

    case UNKNOWN_PATH;
}
