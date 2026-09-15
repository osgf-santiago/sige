<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'nombre',
        'edificio',
        'piso',
        'tipo',
        'esta_activo',
    ];
    
    protected $casts = [
        'esta_activo' => 'boolean',
    ];
}
