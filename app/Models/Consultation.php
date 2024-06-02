<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    function type()
    {
        return $this->belongsTo(Type::class);
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function praticien()
    {
        return $this->belongsTo(Praticien::class);
    }
}
