<?php

$router->get('/', fn () => phpinfo());

$router->get('users', ['name' => 'users.index', 'uses' => 'App\Controllers\UserController@index']);

$router->get('transactions', ['name' => 'transactions.index', 'uses' => 'App\Controllers\TransactionController@index']);
$router->post('transactions/create', ['name' => 'transactions.store', 'uses' => 'App\Controllers\TransactionController@store']);

$router->get('transactions/historical', ['name' => 'transactions.historical', 'uses' => 'App\Controllers\HistoricalController@index']);
