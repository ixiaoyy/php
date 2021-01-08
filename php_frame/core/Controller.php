<?php

namespace core;

class Controller
{
    protected $middleware = [];

    // 获取中间件
    public function getMiddleware()
    {
        return $this->middleware;
    }

    // 调用控制器方法
    public function callAction($method, $parameters)
    {
        return call_user_func_array([$this, $method], $parameters);
    }
}