<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertificateBuilder extends Model
{
    protected $fillable = [
        'id',
        'title',
        'subtitle',
        'description',
        'background',
        'signature',
        'bg_width',
        'bg_height',
        'aspectRatioHeight',
    ];
}
