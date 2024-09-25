<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function casts()
    {
        return[
            'api_host' => AsArrayObject::class
        ];
    }

    public function computers()
    {
        return $this->hasmany(Computer::class);
    }

    public function policies()
    {
        return $this->hasMany(Policy::class);
    }
}
