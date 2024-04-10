<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    function client()
    {
        return $this->belongsTo(user::class);
    }

    function type()
    {
        return $this->belongsTo(user::class);
    }


}
