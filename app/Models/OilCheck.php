<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OilCheck extends Model
{
    protected $fillable = [
        'current_odometer',
        'odometer_at_previous',
        'previous_oil_change_date'
    ];

    protected $casts = [
        'previous_oil_change_date' => 'date'
    ];
}
