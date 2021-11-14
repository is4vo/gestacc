<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsistenteReunion extends Model
{
    use HasFactory;

    protected $fillable = [
        'ref_reunion',
        'ref_usuario',
    ];
}
