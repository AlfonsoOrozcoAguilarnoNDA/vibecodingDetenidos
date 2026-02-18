<?php
/**
 * MONITOR DE DETENCIONES v1.0 - MP Base Lunar Alfa REIMAGINED
 * Modelo: Gemini 3 Flash (Vibecoding Edition)
 * Estilo: Dashboard Institucional de Alta Visibilidad
 */

// 1. DATASET DE PRUEBA (Universo de 24 registros con datos "sucios")
$detenciones_raw = [
    ["id" => 1, "nombre" => "JUAN PEREZ MENDOZA", "delito" => "ROBO CALIFICADO", "horas" => 12, "estatus" => "EN PROCESO"],
    ["id" => 2, "nombre" => "MARIA ELENA RUIZ", "delito" => "FRAUDE", "horas" => "48", "estatus" => "CONSIGNADO"],
    ["id" => 3, "nombre" => "PEDRO 'N'", "delito" => "DAÑO EN PROPIEDAD", "horas" => 72, "estatus" => "PENDIENTE"],
    ["id" => 4, "nombre" => "DESCONOCIDO 01", "delito" => "PORTACION DE ARMA", "horas" => "5000 (ERROR)", "estatus" => "RECLUIDO"],
    ["id" => 5, "nombre" => "LUCIA GALAN", "delito" => "NARCOMENUDEO", "horas" => 5, "estatus" => "ENTREVISTA"],
    ["id" => 6, "nombre" => "ROBERTO SOSA", "delito" => "LESIONES", "horas" => 37, "estatus" => "EN ESPERA"],
    ["id" => 7, "nombre" => "CARLOS VILLA", "delito" => "ROBO A TRANSEUNTE", "horas" => 10, "estatus" => "EN PROCESO"],
    ["id" => 8, "nombre" => "ANTONIA LOPEZ", "delito" => "ABUSO DE CONFIANZA", "horas" => 40, "estatus" => "CONSIGNADO"],
    ["id" => 9, "nombre" => "MIGUEL ANGEL X.", "delito" => "HOMICIDIO", "horas" => 42, "estatus" => "RECLUIDO"],
    ["id" => 10, "nombre" => "SOFIA NIETO", "delito" => "ROBO DE VEHICULO", "horas" => 2, "estatus" => "EN PROCESO"],
    ["id" => 11, "nombre" => "ESTEBAN QUITO", "delito" => "AMENAZAS", "horas" => 80, "estatus" => "PENDIENTE"],
    ["id" => 12, "nombre" => "LAURA POZA", "delito" => "FALSIFICACION", "horas" => "9999", "estatus" => "EN ESPERA"],
    ["id" => 13, "nombre" => "RICARDO DORMIDO", "delito" => "ALLANAMIENTO", "horas" => 15, "estatus" => "EN PROCESO"],
    ["id" => 14, "nombre" => "ELENA TORRES", "delito" => "EXTORSION", "horas" => 45, "estatus" => "CONSIGNADO"],
    ["id" => 15, "nombre" => "FELIPE NERI", "delito" => "ROBO DE INFANTE", "horas" => 36, "estatus" => "RECLUIDO"],
    ["id" => 16, "nombre" => "DANIELA MARIN", "delito" => "DESPOJO", "horas" => 1, "estatus" => "EN PROCESO"],
    ["id" => 17, "nombre" => "GABRIEL LUNA", "delito" => "COHECHO", "horas" => 39, "estatus" => "PENDIENTE"],
    ["id" => 18, "nombre" => "XIMENA RIVAS", "delito" => "EVASION", "horas" => 50, "estatus" => "CONSIGNADO"],
    ["id" => 19, "nombre" => "PABLO MONTERO", "delito" => "VIOLENCIA FAMILIAR", "horas" => 20, "estatus" => "EN PROCESO"],
    ["id" => 20, "nombre" => "MONICA RUIZ", "delito" => "RESISTENCIA", "horas" => 38, "estatus" => "PENDIENTE"],
    ["id" => 21, "nombre" => "JULIO CESAR", "delito" => "MOTIN", "horas" => 4, "estatus" => "EN PROCESO"],
    ["id" => 22, "nombre" => "PATRICIA ARMENDARIZ", "delito" => "PECULADO", "horas" => 60, "estatus" => "CONSIGNADO"],
    ["id" => 23, "nombre" => "OSCAR VALDEZ", "delito" => "NARCOMENUDEO", "horas" => 12, "estatus" => "EN PROCESO"],
    ["id" => 24, "nombre" => "QUETA MERCA", "delito" => "FRAUDE", "horas" => 72, "estatus" => "RECLUIDO"]
];

// 2. LÓGICA DE PAGINACIÓN (Bloques de 6)
$items_per_page = 6;
$total_items = count($detenciones_raw);
$total_pages = ceil($total_items / $items_per_page);
$current_page = isset($_GET['p']) ? (int)$_GET['p'] : 1;
if ($current_page > $total_pages) { $current_page = 1; }

$offset = ($current_page - 1) * $items_per_page;
$display_data = array_slice($detenciones_raw, $offset, $items_per_page);

// 3. SIGUIENTE PÁGINA PARA EL AUTO-REFRESH
$next_page = ($current_page >= $total_pages) ? 1 : $current_page + 1;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitor de Detenciones - MP Base Linar Alfa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <meta http-equiv="refresh" content="7;url=?p=<?php echo $next_page; ?>">
    <style>
        :root {
            --cdmx-dark: #000000;
            --cdmx-gold: #BC955C;
            --cdmx-maroon: #98224E;
        }
        body {
            background-color: #f4f4f4;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            overflow: hidden; /* Evitar scroll en pantallas de monitoreo */
        }
        .navbar {
            background-color: var(--cdmx-dark);
            border-bottom: 4px solid var(--cdmx-gold);
        }
        .navbar-brand { font-weight: bold; letter-spacing: 1px; }
        .dashboard-container {
            padding: 20px;
            height: calc(100vh - 120px);
        }
        .table-monitor {
            background: white;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
            table-layout: fixed;
        }
        .table-monitor thead th {
            background-color: #333;
            color: white;
            text-transform: uppercase;
            font-size: 0.9rem;
            border: none;
            padding: 15px;
        }
        .table-monitor td {
            vertical-align: middle;
            font-size: 1.2rem;
            font-weight: 500;
            padding: 20px;
            border-bottom: 1px solid #eee;
        }
        /* Dinámica de Colores */
        .status-danger {
            background-color: #dc3545 !important;
            color: white !important;
            font-weight: bold;
        }
        .status-warning {
            background-color: #ffc107 !important;
            color: #212529 !important;
            font-weight: bold;
        }
        .status-normal {
            background-color: #ffffff;
            color: #212529;
        }
        .footer-mp {
            background-color: #e9ecef;
            border-top: 1px solid #ddd;
            position: fixed;
            bottom: 0;
            width: 100%;
            padding: 10px 0;
            font-size: 0.85rem;
        }
        .page-indicator {
            background: var(--cdmx-maroon);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
        }
        .blink { animation: blinker 1.5s linear infinite; }
        @keyframes blinker { 50% { opacity: 0.5; } }
    </style>
</head>
<body>

<nav class="navbar navbar-dark shadow">
    <div class="container-fluid">
        <span class="navbar-brand">
            <i class="fas fa-balance-scale mr-2"></i> 
            FISCALÍA GENERAL BASE LUNAR ALFA | <small>Monitor de Control de Detenciones</small>
        </span>
        <div class="text-white small">
            <span class="badge badge-outline-light">MODELO: Gemini-3-Flash</span>
            <span class="ml-2">PHP: <?php echo phpversion(); ?></span>
        </div>
    </div>
</nav>

<div class="container-fluid dashboard-container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="text-secondary m-0">Estado Actual de Detenidos</h4>
        <div class="page-indicator">
            Bloque <?php echo $current_page; ?> de <?php echo $total_pages; ?>
        </div>
    </div>

    <table class="table table-monitor">
        <thead>
            <tr>
                <th style="width: 25%"><i class="fas fa-user mr-2"></i>Nombre Completo</th>
                <th style="width: 30%"><i class="fas fa-gavel mr-2"></i>Delito Imputado</th>
                <th style="width: 20%"><i class="fas fa-clock mr-2"></i>Tiempo (Hrs)</th>
                <th style="width: 25%"><i class="fas fa-info-circle mr-2"></i>Estatus Jurídico</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($display_data as $row): 
                // Lógica de Limpieza y Colores
                $estatus_raw = strtolower($row['estatus']);
                $horas_limpias = (int)$row['horas']; // Sanitización de datos corruptos
                
                $clase_celda = 'status-normal';
                $icono = '<i class="fas fa-check-circle text-success mr-2"></i>';

                if (str_contains($estatus_raw, 'consignado') || str_contains($estatus_raw, 'recluido')) {
                    $clase_celda = 'status-danger';
                    $icono = '<i class="fas fa-exclamation-triangle mr-2 blink"></i>';
                } elseif ($horas_limpias > 36) {
                    $clase_celda = 'status-warning';
                    $icono = '<i class="fas fa-history mr-2"></i>';
                }
            ?>
                <tr>
                    <td><?php echo $row['nombre']; ?></td>
                    <td class="text-uppercase text-muted"><?php echo $row['delito']; ?></td>
                    <td class="<?php echo $clase_celda; ?> text-center">
                        <?php echo $row['horas']; ?> h
                    </td>
                    <td class="<?php echo $clase_celda; ?>">
                        <?php echo $icono; ?>
                        <?php echo strtoupper($row['estatus']); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <div class="text-center mt-4">
        <div class="progress" style="height: 5px; width: 200px; margin: 0 auto;">
            <div id="progress-bar" class="progress-bar bg-warning" style="width: 0%"></div>
        </div>
        <small class="text-muted mt-2 d-block">Siguiente actualización en 7 segundos...</small>
    </div>
</div>

<footer class="footer-mp text-center text-muted">
    <div class="container">
        <strong>SISTEMA DE MONITOREO INSTITUCIONAL</strong> - Agencia del Ministerio Público Base Lunar Alfa - 
        <?php echo date('Y'); ?> | <i class="fas fa-lock small"></i> Acceso Restringido
    </div>
</footer>

<script>
    let bar = document.getElementById('progress-bar');
    let width = 0;
    setInterval(() => {
        if (width >= 100) {
            width = 0;
        } else {
            width += (100 / 70); // Incremento suave para 7 segundos
            bar.style.width = width + '%';
        }
    }, 100);
</script>

</body>
</html>
