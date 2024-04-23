<?php

use App\Models\HistoricalTransaction;
use App\Models\HistoricalTransactionUser;
use App\Models\Transaction;
use App\Models\TransactionUser;
use App\Models\User;

$router->get('migrations', function () use ($db) {
    $blueprint = $db->connection('default')->getSchemaBuilder();

    $blueprint->dropIfExists('users');
    $blueprint->create('users', function ($table) {
        $table->id();
        $table->string('name');
    });

    $blueprint->dropIfExists('transactions');
    $blueprint->create('transactions', function ($table) {
        $table->id();
        $table->timestamps();
    });

    $blueprint->dropIfExists('transaction_users');
    $blueprint->create('transaction_users', function ($table) {
        $table->id();
        $table->foreignIdFor(Transaction::class);
        $table->foreignIdFor(User::class);
        $table->unsignedBigInteger('total');
        $table->timestamps();
    });

    $blueprint->dropIfExists('historical_transactions');
    $blueprint->create('historical_transactions', function ($table) {
        $table->id();
        $table->timestamps();
    });

    $blueprint->dropIfExists('historical_transaction_users');
    $blueprint->create('historical_transaction_users', function ($table) {
        $table->id();
        $table->foreignIdFor(HistoricalTransaction::class);
        $table->foreignIdFor(User::class);
        $table->unsignedBigInteger('total');
        $table->timestamps();
    });

    return $blueprint->getAllTables();
});

$router->get('seeders', function () {
    $faker = Faker\Factory::create();

    HistoricalTransaction::truncate();
    HistoricalTransactionUser::truncate();
    Transaction::truncate();
    TransactionUser::truncate();
    User::truncate();

    $records = [];
    foreach (range(1, 5) as $userIndex) {
        $records['users'][] = User::create(['name' => $faker->firstName()]);
    }

    return $records;
});
