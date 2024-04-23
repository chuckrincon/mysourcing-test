<?php

namespace App\Models;

use App\Controllers\Concerns\InteractsWithIds;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoricalTransactionUser extends Model
{
    use InteractsWithIds;

    protected $fillable = [
        'historical_transaction_id',
        'user_id',
        'total',
    ];

    protected $casts = [
        'created_at' => 'date:d/m/Y H:i',
        'updated_at' => 'date:d/m/Y H:i',
    ];

    /**
     * Get the transaction that owns the TransactionUser
     */
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(HistoricalTransaction::class);
    }

    /**
     * Get the user that owns the TransactionUser
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
