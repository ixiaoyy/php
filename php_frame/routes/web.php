<?php

$router->get('/hello', function (){
   return '访问hello';
});

$router->get('/config', function (){
   echo App::getContainer()->get('config')->get('database.connections.mysql_one.driver').'<hr>';
   App::getContainer()->get('config')->set('database.connections.mysql_one.driver', 'mysql set');
   echo App::getContainer()->get('config')->get('database.connections.mysql_one.driver');
});

$router->get('/db', function () {
   $id = 1;
   var_dump(
       App::getContainer()->get('db')->select('select * from users where id = ?', [$id])
   );
});

$router->get('/query',function (){
    $id = 2;
    var_dump(
        App::getContainer()->get('db')->table('users')->where('id', $id)->get()
    );
});

$router->get('/model', function (){
   $users = \App\User::Where('id',1)->orWhere('id',2)->get();
   foreach ($users as $user) {
       echo $user->sayPhp() .'<br>';
   }
});

$router->get('/controller','UserController@index');

$router->get('view/blade', function (){
   $str = '这是blade模板引擎';

   return view('blade.index',compact('str'));
});

$router->get('view/thinkphp', function (){
    $str = '这是thinkphp模板引擎';

    return view('thinkphp.index', compact('str'));
});

$router->get('log/stack', function (){
   App::getContainer()->get('log')->debug('{language} is the best language in the world', ['language' => 'php']);
   App::getContainer()->get('log')->info("hello world");
});

$router->get('exception', function (){
    throw new \App\exceptions\ErrorMessageException('The server did not want to bird you and threw an exception');
});

$router->get('error', function (){
   故意写错;
});