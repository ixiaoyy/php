<?php

namespace App\controller;

use App\middleware\ControllerMiddleWare;
use core\Controller;
use core\request\RequestInterface;

// 继承基础控制器
class UserController extends Controller
{
    protected $middleware = [
        ControllerMiddleWare::class
    ];

    public function index(RequestInterface $request)
    {
        return [
            'method' => $request->getMethod(),
            'url' => $request->getUri()
        ];
    }

    public function index2()
    {

    }
}