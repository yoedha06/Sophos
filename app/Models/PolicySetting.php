<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PolicySetting extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function cast()
    {
        return[
            'default_value' => AsArrayObject::class,
            'default_unit' => AsArrayObject::class,
            'allowed_units' => AsArrayObject::class,
            'examples' => AsArrayObject::class,
        ];
    }

    public function policy()
    {
        return $this->hasMany(Policy::class, 'type_policy', 'type');
    }
}
