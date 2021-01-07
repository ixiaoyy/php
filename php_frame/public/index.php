<?php

require __DIR__ . '/../vendor/autoload.php';

// ������Ҳ���������ô˺���
/*spl_autoload_register(function ($class) {
    // $class ��App\User
    $psr4 = [
        "App" => "app"
    ];
    $suffix = '.php';
    foreach ($psr4 as $name => $value) { // ����� psr4 �滻
        $class = str_replace($name, $value, $class);
    }
    // $class ��app\User
    include("../".$class . $suffix);
});*/

require_once __DIR__ . '/../app.php';
//App::getContainer()->bind('str', function () {
//    return 'hello str';
//});
//
//echo App::getContainer()->get('str');

//require __DIR__.'/../app/helpers.php'; /*��д��composer.json*/

//hello();

// �� request
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