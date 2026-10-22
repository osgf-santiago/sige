<?php

namespace App\Imports;

use App\Models\Bienes;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BienesImport implements ToModel, WithHeadingRow
{
    public function model(array $row): Model|null
    {
        return new Bienes([
            'id_udg'                   => $row['id_udg'], 
            'cog_descripcion'          => $row['cog_descripcion'] ?? null,
            'clasificador'             => $row['clasificador'] ?? null,
            'clasificador_descripcion' => $row['clasificador_descripcion'] ?? null,
            'id_resguardante'          => $row['id_resguardante'] ?? null,
            'nombre_resguardante'      => $row['nombre_resguardante'] ?? null,
            'fecha_adquisicion'        => $row['fecha_adquisicion'] ?? null,
            'descripcion'              => $row['descripcion'] ?? null,
            'origen'                   => $row['origen'] ?? null,
            'tram_alta'                => $row['tram_alta'] ?? null,
            'marca'                    => $row['marca'] ?? null,
            'modelo'                   => $row['modelo'] ?? null,
            'num_serie'                => $row['num_serie'] ?? null,
            'id_tipo_siiau'            => $row['id_tipo_siiau'] ?? null,
        ]);
    }
}
