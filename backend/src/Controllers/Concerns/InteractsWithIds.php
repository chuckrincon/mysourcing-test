<?php

namespace App\Controllers\Concerns;

trait InteractsWithIds
{
    public static function lastId()
    {
        return static::max('id');
    }

    public static function nextId()
    {
        return static::lastId() + 1;
    }
}
