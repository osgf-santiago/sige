<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Extension  extends Model
{
    use HasFactory;
    protected $table = 'extensiones';
    protected $fillable = [
        'extension',
        'area_id',
        'personas',
    ];
    public function area(): BelongsTo { return $this->belongsTo(Area::class); }
}
