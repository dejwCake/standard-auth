<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::prefix('admin', function ($routes) {
    $routes->plugin(
        'DejwCake/StandardAuth',
        ['path' => '/', '_namePrefix' => 'Admin'],
        function (RouteBuilder $routes) {
            $routes->connect('/login', ['controller' => 'Users', 'action' => 'login', 'plugin' => 'DejwCake/StandardAuth', '_ext' => null]);
//        $routes->fallbacks(DashedRoute::class);
        });
});

//Router::plugin(
//    'DejwCake/StandardAuth',
//    ['path' => '/', '_namePrefix' => 'Admin'],
//    function (RouteBuilder $routes) {
//        $routes->connect('/', ['controller' => 'Users', 'action' => 'login', 'plugin' => 'DejwCake/StandardAuth', '_ext' => null]);
////        $routes->fallbacks(DashedRoute::class);
//    }
//);
