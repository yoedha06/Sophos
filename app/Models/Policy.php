<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function cast()
    {
        return[
            'settings' => AsArrayObject::class,
        ];
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function policySetting()
    {
        return $this->belongsTo(PolicySetting::class, 'type_policy', 'type');
    }

    // public function computer()
    // {
    //     return $this->belongsTo(Computer::class);
    // }

    public function computers()
    {
        return $this->belongsToMany(Computer::class, 'policy_computers', 'policy_id', 'computer_id');
    }
}
