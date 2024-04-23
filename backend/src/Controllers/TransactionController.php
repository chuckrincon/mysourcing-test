<?php

namespace App\Controllers;

use App\Models\HistoricalTransaction;
use App\Models\HistoricalTransactionUser;
use App\Models\Transaction;
use App\Models\TransactionUser;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController
{
    public function index()
    {
        return Transaction::first();
    }

    public function store(Request $request)
    {
        $users = User::all();

        $transaction = Transaction::first();

        if ($transaction) {
            $transaction->update(['id' => Transaction::nextId()]);
        } else {
            $transaction = Transaction::create();
        }

        $values = $request->collect('transactions');

        $transactions = $users->map(function ($user) use ($values, $transaction) {
            $data = $values->firstWhere('id', $user['id']);

            if (! $data) {
                $data['total'] = 0;
            }

            $record = TransactionUser::updateOrCreate([
                'user_id' => $user['id'],
            ], [...$data, 'transaction_id' => $transaction->getKey()]);

            return $record->toArray();
        });

        $historicalTransaction = HistoricalTransaction::create(['id' => $transaction->getKey()]);

        $transactions = $transactions->map(function ($item) use ($historicalTransaction) {
            $item['historical_transaction_id'] = $historicalTransaction->getKey();

            HistoricalTransactionUser::create($item);
        });

        return $transaction;
    }
}
