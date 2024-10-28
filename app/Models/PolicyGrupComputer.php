<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PolicyGrupComputer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function policy()
    {
        return $this->belongsTo(Policy::class, 'policy_id', 'id_policies');
    }
}
