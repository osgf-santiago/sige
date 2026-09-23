<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Eventos extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'area_id',
        'descripcion',
        'agenda',
    ];
    public function area(): BelongsTo { return $this->belongsTo(Area::class); }
}
