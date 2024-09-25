<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function getByKey($key)  {
        return static::where('key', $key)->first()['value']  ??  null;
    }

    public function __get($key)
    {
        if(in_array($key, $this->attributes)) {
            return $this->getAttribute($key);
        }

        return static::getByKey($key);
    }
}
