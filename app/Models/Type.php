<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    function consultation()
    {
        return $this->hasMany(Consultation::class);
    }

    function demande()
    {
        return $this->hasMany(Demande::class);
    }
}
