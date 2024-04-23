<?php

namespace App\Controllers;

use App\Models\HistoricalTransaction;

class HistoricalController
{
    public function index()
    {
        return HistoricalTransaction::with('entries.user')->get();
    }
}
