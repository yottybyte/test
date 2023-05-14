<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoggingErrors extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'client_ip',
        'data'
    ];
}
