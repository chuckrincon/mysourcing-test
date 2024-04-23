<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionUser extends Model
{
    protected $fillable = [
        'transaction_id',
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
        return $this->belongsTo(Transaction::class);
    }

    /**
     * Get the user that owns the TransactionUser
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
