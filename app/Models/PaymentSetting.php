<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentSetting extends Model
{
    protected $fillable = [
        'key', // Added 'key' to allow mass assignment
        'value',
    ];
}
