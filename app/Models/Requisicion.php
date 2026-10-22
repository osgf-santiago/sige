<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Requisicion extends Model
{
    use HasFactory;
    protected $table = 'requisiciones';
    protected $fillable = [
        'area_id',
        'estatus',
        'solicitante',
    ];
    
    public function area(): BelongsTo { return $this->belongsTo(Area::class); }

    public function detalles(): HasMany
    {
        return $this->hasMany(DetalleRequisicion::class, 'requisicion_id');
    }
}
