<?php

namespace core;

use App\exceptions\ErrorMessageException;
use App\exceptions\RunErrorException;
use Throwable;

class HandleExceptions
{
    // 忽略的异常
    protected $ignore = [];

    public function init()
    {
        // 所有异常托管到handleException方法
        set_exception_handler([$this, 'handleException']);

        // 所有错误到托管到handleError方法
        set_error_handler([$this, 'handleError']);
    }

    public function handleError($error_level, $error_message, $error_file, $error_line, $error_context)
    {
        app('response')->setContent(
            '程序崩溃'
        )->setCode(500)->send();

        // 记录到日志
        app('log')->error(
            $error_message . ' at ' . $error_file . ':' . $error_file
        );
    }

    // 异常托管到这个方法
    public function handleException(Throwable $e)
    {
        if (method_exists($e, 'render')) // 如果自定义的异常类存在render()方法
            app('response')->setContent(
                $e->render()
            )->send();

        if (!$this->isIgnore($e)) {
            app('log')->debug(
                $e->getMessage() . ' at ' . $e->getFile() . ':' . $e->getLine()
            );

            // 显示给开发者看 以便查找错误
            echo $e->getMessage() . ' at ' . $e->getFile() . ':' . $e->getLine();
        }
    }

    // 是否忽略异常
    protected function isIgnore(Throwable $e)
    {
        foreach ($this->ignore as $item)
            if ($item == get_class($e))
                return true;
        return false;
    }
}
