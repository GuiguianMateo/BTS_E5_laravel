<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class practicien extends Model
{
    use HasFactory;

    function type()
    {
        return $this->belongsTo(type::class);
    }
}
