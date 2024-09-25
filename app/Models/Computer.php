<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Computer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function casts()
    {
        return[
            'health_service_details' => AsArrayObject::class,
            'operating_system' => AsArrayObject::class,
            'ipv4_addresses' => AsArrayObject::class,
            'mac_addresses' => AsArrayObject::class,
            'group' => AsArrayObject::class,
            'assosiated_person' => AsArrayObject::class,
            'assigned_products' => AsArrayObject::class,
            'encryption' => AsArrayObject::class,
            'isolation' => AsArrayObject::class,
            'last_seen_at' => 'datetime',
        ];
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function policies()
    {
        return $this->hasMany(Policy::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
