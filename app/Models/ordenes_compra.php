<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ordenes_compra extends Model
{
    use HasFactory;
    protected $table = 'ordenes_compras';
    protected $fillable = [
        'area_id',
        'estatus',
        'solicitante',
    ];
    
    public function area(): BelongsTo { return $this->belongsTo(Area::class); }

    public function detalles(): HasMany
    {
        return $this->hasMany(detalles_oc::class, 'oc_id');
    }
}
