<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InstructorPayoutInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'instructor_id',
        'gateway',
        'information'
    ];
}
