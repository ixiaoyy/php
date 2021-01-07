<?php

require __DIR__ . '/../vendor/autoload.php';

// 如果累找不到，会调用此函数
/*spl_autoload_register(function ($class) {
    // $class 是App\User
    $psr4 = [
        "App" => "app"
    ];
    $suffix = '.php';
    foreach ($psr4 as $name => $value) { // 如果是 psr4 替换
        $class = str_replace($name, $value, $class);
    }
    // $class 是app\User
    include("../".$class . $suffix);
});*/

require_once __DIR__ . '/../app.php';
//App::getContainer()->bind('str', function () {
//    return 'hello str';
//});
//
//echo App::getContainer()->get('str');

//require __DIR__.'/../app/helpers.php'; /*改写到composer.json*/

//hello();

// 绑定 request
App::getContainer()->bind(\core\request\RequestInterface::class, function () {
    return \core\request\PhpRequest::create(
        $_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD'], $_SERVER
    );
});

//echo App::getContainer()->get(\core\request\RequestInterface::class)->getMethod();
App::getContainer()->get('response')->setContent(
    App::getContainer()->get('router')->dispatch(
        App::getContainer()->get(\core\request\RequestInterface::class)
    )
)->send();