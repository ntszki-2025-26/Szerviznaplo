<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'vehicle';

    protected $fillable = [
        'user_id',
        'brand',
        'model',
        'year',
        'license_plate',
    ];
}