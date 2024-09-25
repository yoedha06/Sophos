<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function cast()
    {
        return[
            'event_create_at' => 'datetime',
            'when' => 'datetime',
            'core_remedy_item' => AsArrayObject::class,
        ];
    }

    public function computer()
    {
        return $this->belongsTo(Computer::class);
    }
}
