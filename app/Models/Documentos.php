<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Documentos extends Model
{
    use HasFactory;
  protected $fillable = [
        'area_id',
        'categoria',
        'asunto',
        'observaciones',
        'ruta_adjuntos',
    ];
    public function area(): BelongsTo { return $this->belongsTo(Area::class); }
}
