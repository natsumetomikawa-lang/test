<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Greeting extends Model
{
    protected $fillable = [
        'from_name',
        'to_name',
        'message',
    ];
}
