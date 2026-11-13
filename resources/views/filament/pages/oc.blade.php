<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>OC #{{ $record->id }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .header-table, .content-table, .signatures-table {
            width: 100%;
            border-collapse: collapse;
        }
        .header-table td {
            vertical-align: top;
            border: none;
        }
        .logo {
            max-height: 100px;
            width: auto;
            margin-top: -30px;
        }
        .title-section {
            text-align: right;
        }
        .title {
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            color: #111;
            margin: 0;
        }
        .subtitle {
            font-size: 11px;
            color: #555;
            margin-top: 3px;
        }
        .info-box {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 10px;
            margin: 20px 0;
            font-size: 11px;
        }
        /* Tabla de artículos */
        .content-table th, .content-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        .content-table th {
            background-color: #f1f5f9;
            font-weight: bold;
            color: #1e293b;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        
        /* Firmas */
        .signatures-table {
            margin-top: 100px;
        }
        .signature-line {
            border-top: 1px solid #333;
            width: 80%;
            margin: 0 auto;
            padding-top: 5px;
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- ENCABEZADO CON LOGO -->
    <table class="header-table">
        <tr>
            <td>
                <img src="{{ public_path('images/BPEJ_dark.png') }}" class="logo" alt="Logo Institucional">
            </td>
            <td class="title-section">
                <table style="width: 100%; border-collapse: collapse; font-size: 11px; text-align: center;">
                    <tbody>
                        <tr>
                            <td style="border: 1px solid #ccc; padding: 5px;">{{ $record->created_at?->format('d') }}</td>
                            <td style="border: 1px solid #ccc; padding: 5px;">{{ $record->created_at?->format('m') }}</td>
                            <td style="border: 1px solid #ccc; padding: 5px;">{{ $record->created_at?->format('Y') }}</td>
                            <td style="border: 0px solid #ccc; padding: 5px; font-weight: bold;"></td>
                            <td style="border: 1px solid #ccc; padding: 5px; font-weight: bold;">No {{ $record->id }}</td>
                        </tr>
                    </tbody>
                    <thead>
                        <tr>
                            <th style="border: 1px solid #ccc; background-color: #f1f5f9; padding: 4px;">Día</th>
                            <th style="border: 1px solid #ccc; background-color: #f1f5f9; padding: 4px;">Mes</th>
                            <th style="border: 1px solid #ccc; background-color: #f1f5f9; padding: 4px;">Año</th>
                            <th style="border: 0px solid #ccc; padding: 4px;"></th>
                            <th style="border: 1px solid #ccc; background-color: #f1f5f9; padding: 4px;">Solicitud</th>
                        </tr>
                    </thead>
                </table>
            </td>
        </tr>
    </table>
<!-- Formato ubicación -->
    <div class="info-box">
        <table style="width: 100%; border: none;">
            <tr>
                <td style="border: none; width: 50%;">
                    Periférico Norte 1695 | Col. Belenes | C.P. 45100
                    Zapopan, Jalisco, México | (0133)3836 4530 y 3613 1220
                    www.bpej.udg.mx
                </td>
                <td style="border: none; width: 50%;">
                    <p class="title">ORDEN DE COMPRA</p>
                </td>
            </tr>
        </table>
    </div>

    <!-- DATOS GENERALES -->
    <div class="info-box">
        <table style="width: 100%; border: none;">
            <tr>
                <td style="border: none; width: 100%;">
                    <strong>Área:</strong> {{ $record->area->nombre ?? 'N/A' }}
                </td>
            </tr>
        </table>
    </div>

    <!-- TABLA DE ARTÍCULOS -->
    <table class="content-table">
        <thead>
            <tr>
                <th class="text-center" style="width: 40px;">Cantidad</th>
                <th>Descripción del Artículo</th>
                <th class="text-center" style="width: 80px;">Precio Unitaro</th>
                <th class="text-center" style="width: 80px;">Sub Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($record->detalles as $index => $detalle)
                <tr>
                    <td class="text-center">{{ $detalle->cantidad }}</td>
                    <td>{{ $detalle->descripcion }}</td>
                    <td class="text-center">${{ $detalle->precio_unitario }}</td>
                    <td class="text-center">${{ $detalle->sub_total }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center" style="color: #666; font-style: italic;">
                        No hay artículos registrados en esta requisición.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- SECCIÓN DE FIRMAS -->
    <table class="signatures-table">
        <tr>
            <td style="border: none; width: 50%; text-align: center;">
                <span style="font-size: 10px; color: #555;">LIC. MARIA DOLORES ARIAS LARA </span>
                <div class="signature-line">
                    <strong>Vo. Bo.  ADMINISTRADORA GENERAL</strong><br>
                </div>
            </td>
            <td style="border: none; width: 50%; text-align: center;">
                <span style="font-size: 10px; color: #555;"> {{ $record->solicitante }}</span>
                <div class="signature-line">
                    <strong>NOMBRE  Y FIRMA DEL COORDINADOR DE ÁREA</strong><br>
                </div>
            </td>
        </tr>
    </table>
</br>
    <strong>* NOTA: Anexar 3 cotizaciones e imagen del producto.</strong>

</body>
</html>