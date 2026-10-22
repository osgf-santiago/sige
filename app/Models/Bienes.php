<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bienes extends Model
{
    use HasFactory;
    protected $table = 'bienes';

    protected $fillable = [
        'id_udg',
        'cog_descripcion',
        'clasificador',
        'clasificador_descripcion',
        'id_resguardante',
        'nombre_resguardante',
        'fecha_adquisicion',
        'descripcion',
        'origen',
        'tram_alta',
        'marca',
        'modelo',
        'num_serie',
        'id_tipo_siiau',
    ];
}
