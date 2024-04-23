<?php

require_once __DIR__.'/vendor/autoload.php';

use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\Router;
use Illuminate\Routing\UrlGenerator;

$container = new Container;

$request = Request::capture();

$container->instance('Illuminate\Http\Request', $request);

$db = new DB;
$db->addConnection([
    'driver' => 'mysql',
    'host' => '127.0.0.1',
    'database' => 'transactions',
    'username' => 'root',
    'password' => '',
    'port' => 3306,
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
], 'default');
$db->setAsGlobal();
$db->bootEloquent();

$events = new Dispatcher($container);

$router = new Router($events, $container);

require_once __DIR__.'/src/routes/web.php';
require_once __DIR__.'/src/routes/database.php';

$redirect = new Redirector(new UrlGenerator($router->getRoutes(), $request));

$response = $router->dispatch($request);

header('Access-Control-Allow-Origin: http://localhost:4200');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Accept, Authorization, X-Requested-With, X-Auth-Token, Application, XMLHttpRequest');

$response->send();
