<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    public function visitas(): HasMany
    {
        return $this->hasMany(Visitas::class, 'area_id');
    }
}
