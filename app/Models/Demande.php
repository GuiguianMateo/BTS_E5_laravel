<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    function user()
    {
        return $this->belongsTo(user::class);
    }

    function type()
    {
        return $this->belongsTo(type::class);
    }
}
