<?php

namespace core;

class Response
{

    protected $headers = []; // 要发送的请求头
    protected $content = ''; // 要发送的内容
    protected $code = 200; // 发送状态码

    public function sendContent() // 发送内容
    {
        echo $this->content;
    }

    public function sendHeaders() // 发送请求头
    {
        foreach ($this->headers as $key => $header) {
            header($key.': '.$header);
        }
    }

    public function send() // 发送
    {
        $this->sendHeaders();
        $this->sendContent();
        return $this;
    }

    public function setContent($content)
    {
        if (is_array($content)) {
            $content = json_encode($content);
        }
        $this->content = $content;
        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getStatusCode()
    {
        return $this->code;
    }

    public function setCode(int $code)
    {
        $this->code = $code;
        return $this;
    }
}
