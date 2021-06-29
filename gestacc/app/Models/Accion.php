<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accion extends Model
{
    use HasFactory;
    protected $table = 'acciones';

    protected $fillable = [
        'comentario',
        'tipo',
        'vencimiento',
        'estado',
        'ref_tema',
        'ref_asistente',
    ];
}
