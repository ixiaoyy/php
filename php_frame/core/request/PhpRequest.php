<?php

namespace core\request;

class PhpRequest implements RequestInterface
{


    protected $url;
    protected $method;
    protected $headers;
    public function __construct($uri,$method,$headers)
    {
        $this->uri = $uri;
        $this->method = $method;
        $this->headers = $headers;
    }

    // 创建一个请求
    public static function create($uri, $method, $headers = [])
    {
        return new static($uri, $method, $headers); // new 自己
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getHeader()
    {

    }
}
