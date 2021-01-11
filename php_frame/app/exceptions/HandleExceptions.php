<?php

namespace App\exceptions;

use core\HandleExceptions as BaseHandleExceptions;

class HandleExceptions extends BaseHandleExceptions
{
    // 要忽略记录的异常 不记录到日志
    protected $ignore = [
        ErrorMessageException::class
    ];
}