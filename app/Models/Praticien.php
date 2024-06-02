<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class praticien extends Model
{
    use HasFactory;

    function type()
    {
        return $this->belongsTo(Type::class);
    }

    function consultation()
    {
        return $this->hasMany(Consultation::class);
    }

    function demande()
    {
        return $this->hasMany(Demande::class);
    }
}
