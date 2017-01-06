<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::prefix('admin', ['_namePrefix' => 'admin:'], function ($routes) {
    $routes->plugin(
        'DejwCake/StandardAuth',
        ['path' => '/'],
        function (RouteBuilder $routes) {
//            $routes->scope('/:language', function (RouteBuilder $routes) {
                $routes->connect('/login', ['controller' => 'Users', 'action' => 'login', 'plugin' => 'DejwCake/StandardAuth', '_ext' => null]);
                $routes->scope('/users', function (RouteBuilder $routes) {
                    $routes->connect('/', ['controller' => 'Users', 'action' => 'index', 'plugin' => 'DejwCake/StandardAuth', '_ext' => null]);
                    $routes->connect('/add', ['controller' => 'Users', 'action' => 'add', 'plugin' => 'DejwCake/StandardAuth', '_ext' => null]);
                    $routes->connect('/view/:id', ['controller' => 'Users', 'action' => 'view', 'plugin' => 'DejwCake/StandardAuth', '_ext' => null], ['pass' => ['id'],]);
                    $routes->connect('/edit/:id', ['controller' => 'Users', 'action' => 'edit', 'plugin' => 'DejwCake/StandardAuth', '_ext' => null], ['pass' => ['id'],]);
                    $routes->connect('/delete/:id', ['controller' => 'Users', 'action' => 'delete', 'plugin' => 'DejwCake/StandardAuth', '_ext' => null], ['pass' => ['id'],]);
                    $routes->connect('/enable/:id', ['controller' => 'Users', 'action' => 'enable', 'plugin' => 'DejwCake/StandardAuth', '_ext' => null], ['pass' => ['id'],]);
                });
                $routes->scope('/roles', function (RouteBuilder $routes) {
                    $routes->connect('/', ['controller' => 'Roles', 'action' => 'index', 'plugin' => 'DejwCake/StandardAuth', '_ext' => null]);
                    $routes->connect('/add', ['controller' => 'Roles', 'action' => 'add', 'plugin' => 'DejwCake/StandardAuth', '_ext' => null]);
                    $routes->connect('/view/:id', ['controller' => 'Roles', 'action' => 'view', 'plugin' => 'DejwCake/StandardAuth', '_ext' => null], ['pass' => ['id'],]);
                    $routes->connect('/edit/:id', ['controller' => 'Roles', 'action' => 'edit', 'plugin' => 'DejwCake/StandardAuth', '_ext' => null], ['pass' => ['id'],]);
                    $routes->connect('/delete/:id', ['controller' => 'Roles', 'action' => 'delete', 'plugin' => 'DejwCake/StandardAuth', '_ext' => null], ['pass' => ['id'],]);
                    $routes->connect('/enable/:id', ['controller' => 'Roles', 'action' => 'enable', 'plugin' => 'DejwCake/StandardAuth', '_ext' => null], ['pass' => ['id'],]);
                });
//            });
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
