<?php

namespace App\Models;

use App\Controllers\Concerns\InteractsWithIds;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use InteractsWithIds;

    protected $fillable = [
        'id',
    ];

    protected $casts = [
        'created_at' => 'date:d/m/Y H:i',
        'updated_at' => 'date:d/m/Y H:i',
    ];
}
