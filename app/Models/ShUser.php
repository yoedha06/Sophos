<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShUser extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function casts()
    {
        return[
            'groups' => AsArrayObject::class,
        ];
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function policies()
    {
        return $this->belongsToMany(Policy::class, 'policy_users', 'computer_id', 'policy_id');
    }
}
