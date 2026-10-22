<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Visitas extends Model
{
    use HasFactory;
    protected $fillable = [
        'area_id',
        'identificador',
    ];
    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
}
