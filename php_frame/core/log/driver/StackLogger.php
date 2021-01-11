<?php

namespace core\log\driver;

use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use Psr\Log\AbstractLogger;
use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;

class StackLogger extends AbstractLogger
{
    protected $config;
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    // 来自: https://learnku.com/docs/psr/psr-3-logger-interface/1607
    /**
     * @example 代码:app('log')->info('{language} is the best language in the world’,['language' => 'php']) 返回: php is the best language in the world
     * @param $message string 原本消息
     * @param $context string 上下文 要替换的
     * @return string
     */
    public function interpolate($message, array $context = array())
    {
        // 构建一个花括号包含的键名的替换数组
        $replace = array();
        foreach ($context as $key => $val) {
            // 检查该值是否可以转换为字符串
            if (!is_array($val) && (!is_object($val) || method_exists($val, '__toString'))) {
                $replace['{' . $key . '}'] = $val;
            }
        }

        // 替换记录信息中的占位符，最后返回修改后的记录信息。
        return strtr($message, $replace);
    }

    /*
     * @inheritDoc
     */
    public function log($level, $message, array $context = array())
    {
        if (is_array($message))
            $message = var_export($message, true) . var_export($context, true);
        else if (is_string($message))
            $message = $this->interpolate($message,$context);

        $message = sprintf($this->config['format'],date('y-m-d h:m:s'), $level, $message);

        error_log($message.PHP_EOL,3,$this->config['path'].'/php_frame.log');
    }
}