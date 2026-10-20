<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OilCheck extends Model
{
    /** @use HasFactory<\Database\Factories\OilCheckFactory> */
    use HasFactory;

    protected $fillable = [
        'current_odometer',
        'odometer_at_last_change',
        'date_at_last_change',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'date_at_last_change' => 'date',
    ];
}
