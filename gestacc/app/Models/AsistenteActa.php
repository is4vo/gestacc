<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsistenteActa extends Model
{
    use HasFactory;

    protected $fillable = [
        'ref_acta',
        'ref_asistente',
    ];
}
