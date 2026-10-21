<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OilCheck extends Model
{
    /** @use HasFactory<\Database\Factories\OilCheckFactory> */
    use HasFactory;

    protected $fillable = [
        'odometer_at_last_change',
        'current_odometer',
        'date_at_last_change',
    ];

    protected $casts = [
        'date_at_last_change' => 'date',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
