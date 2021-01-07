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