<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endpoint extends Model
{
    protected $fillable = [
        'name',
        'api_source',
        'endpoint_url',
        'auth',
        'is_active'
    ];

    protected $casts = [
        'auth' => 'json',
    ];

    use HasFactory;
}
