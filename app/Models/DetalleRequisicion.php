<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class DetalleRequisicion extends Model
{
    use HasFactory;
    protected $table = 'detalle_requisiciones';
    protected $fillable = [
        'requisicion_id',
        'articulo_id',
        'cantidad',
    ];
      public function requisicion(): BelongsTo
    {
        return $this->belongsTo(Requisicion::class);
    }

    public function articulo(): BelongsTo
    {
        return $this->belongsTo(Articulos::class);
    }
}
