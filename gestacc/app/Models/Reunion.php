<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reunion extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_reunion',
        'tipo_reunion',
        'fecha_reunion',
        'hora_inicio',
        'hora_termino',
        'ref_usuario',
    ];
}
