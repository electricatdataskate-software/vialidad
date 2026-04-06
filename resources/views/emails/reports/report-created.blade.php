<!DOCTYPE html>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Denuncia recibida</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7f6; margin: 0; padding: 0; color: #333; }
        .container { max-width: 600px; margin: 20px auto; background: #ffffff; padding: 40px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { color: #2c3e50; font-size: 24px; margin: 0; }
        .status-badge { display: inline-block; padding: 8px 16px; border-radius: 20px; font-weight: 600; font-size: 14px; text-transform: uppercase; margin: 20px 0; }
        .status-pending { background-color: #fef3c7; color: #92400e; }
        .info-section { border-top: 1px solid #eee; padding-top: 20px; margin-top: 20px; }
        .info-item { margin-bottom: 15px; }
        .info-label { font-weight: bold; color: #64748b; font-size: 12px; text-transform: uppercase; display: block; margin-bottom: 4px; }
        .info-value { color: #1e293b; font-size: 16px; }
        .footer { text-align: center; font-size: 12px; color: #94a3b8; margin-top: 40px; }
        .btn { display: inline-block; background-color: #2563eb; color: #ffffff; text-decoration: none; padding: 12px 24px; border-radius: 6px; font-weight: 600; margin-top: 25px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>✅ Denuncia recibida</h1>
            <p>Hola {{ $report->reportedBy?->name }}, tu denuncia fue registrada correctamente.</p>
        </div>

```
    <div style="text-align: center;">
        <span class="status-badge status-pending">
            Pendiente de evaluación
        </span>
    </div>

    <p style="text-align: center; font-size: 15px; color: #475569;">
        Nuestro equipo de vialidad revisará la información en breve.<br>
        Te notificaremos cuando haya actualizaciones sobre el estado de tu denuncia.
    </p>

    <div class="info-section">
        <div class="info-item">
            <span class="info-label">Tipo de Infracción</span>
            <span class="info-value">{{ $report->violationType?->name }}</span>
        </div>

        <div class="info-item">
            <span class="info-label">Ubicación</span>
            <span class="info-value">
                {{ $report->location?->address
                    ?? ($report->location
                        ? 'Coordenadas: ' . $report->location->latitude . ', ' . $report->location->longitude
                        : 'No especificada')
                }}
            </span>
        </div>

        <div class="info-item">
            <span class="info-label">Fecha del Suceso</span>
            <span class="info-value">
                {{ $report->occurred_at?->format('d/m/Y H:i') ?? 'No especificada' }}
            </span>
        </div>
    </div>

    <div style="text-align: center;">
        <a href="{{ config('app.url') }}" class="btn">Ver en la plataforma</a>
    </div>

    <div class="footer">
        Este es un correo automático de {{ config('app.name') }}. Por favor, no respondas a este mensaje.
    </div>
</div>


</body>
</html>
