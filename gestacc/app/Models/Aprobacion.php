<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aprobacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'ref_miembro',
        'ref_acta',
        'aprueba',
    ];
}
