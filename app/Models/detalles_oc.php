<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class detalles_oc extends Model
{
    use HasFactory;
    protected $table = 'detalles_oc';
    protected $fillable = [
        'oc_id',
        'cantidad',
        'descripcion',
        'precio_unitario',
        'sub_total',
    ];
    public function ordenes_compra(): BelongsTo
    {
        return $this->belongsTo(ordenes_compra::class);
    }
}
