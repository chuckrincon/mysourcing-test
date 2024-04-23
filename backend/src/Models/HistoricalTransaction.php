<?php

namespace App\Models;

use App\Controllers\Concerns\InteractsWithIds;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HistoricalTransaction extends Model
{
    use InteractsWithIds;

    protected $fillable = [
        'id',
    ];

    protected $casts = [
        'created_at' => 'date:d/m/Y H:i',
        'updated_at' => 'date:d/m/Y H:i',
    ];

    /**
     * Get all of the entries for the HistoricalTransaction
     */
    public function entries(): HasMany
    {
        return $this->hasMany(HistoricalTransactionUser::class);
    }
}
