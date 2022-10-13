<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endpoint extends Model
{
    protected $fillable = [
        'name',
        'endpoint_url',
        'headers',
        'data',
        'is_active'
    ];

    use HasFactory;
}
