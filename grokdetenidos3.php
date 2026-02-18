<?php
// Grok xAI - Vibecoding v3 Compact (Ergonomía Real para MP / Base Lunar Alfa)
// Un solo archivo • PHP puro • Optimizado para 1080p y pantallas estándar

function getHours($tiempo_str) {
    $str = strtolower(trim($tiempo_str));
    if (strpos($str, 'mil') !== false || strpos($str, 'miles') !== false || strpos($str, '999') !== false) {
        return 10000;
    }
    if (preg_match('/(\d+(?:\.\d+)?)/', $str, $matches)) {
        $num = (float)$matches[1];
        if (strpos($str, 'día') !== false || strpos($str, 'dia') !== false) $num *= 24;
        elseif (strpos($str, 'semana') !== false) $num *= 168;
        elseif (strpos($str, 'mes') !== false) $num *= 720;
        return $num;
    }
    return 0;
}

$detenciones = [
    ['persona' => 'Juan Antonio Pérez López', 'delito' => 'Robo agravado', 'tiempo' => '12 horas', 'estatus' => 'En investigación'],
    ['persona' => 'María Elena González Ruiz', 'delito' => 'Lesiones intencionales', 'tiempo' => '20 horas', 'estatus' => 'En investigación'],
    ['persona' => 'Carlos Alberto Ruiz Mendoza', 'delito' => 'Fraude genérico', 'tiempo' => '45 horas', 'estatus' => 'Pendiente de consignación'],
    ['persona' => 'Ana Patricia López Sánchez', 'delito' => 'Homicidio doloso', 'tiempo' => '8 horas', 'estatus' => 'Consignado'],
    ['persona' => 'Luis Fernando Martínez Gómez', 'delito' => 'Narcomenudeo', 'tiempo' => '99999 horas', 'estatus' => 'Recluido'],
    ['persona' => 'Sofía Isabel Hernández Vargas', 'delito' => 'Violencia familiar', 'tiempo' => '15 horas', 'estatus' => 'En detención'],
    ['persona' => 'Miguel Ángel Torres Castillo', 'delito' => 'Robo a casa habitación', 'tiempo' => '50 horas', 'estatus' => 'En investigación'],
    ['persona' => 'Elena María Vargas Ortiz', 'delito' => 'Extorsión', 'tiempo' => '30 horas', 'estatus' => 'Pendiente'],
    ['persona' => 'Roberto Carlos Sánchez Flores', 'delito' => 'Lesiones culposas', 'tiempo' => '72 horas', 'estatus' => 'Consignado'],
    ['persona' => 'Laura Gabriela Mendoza Jiménez', 'delito' => 'Tráfico de personas', 'tiempo' => 'miles de horas', 'estatus' => 'Recluido'],
    ['persona' => 'Andrés Eduardo Castillo Navarro', 'delito' => 'Corrupción de funcionarios', 'tiempo' => '10 horas', 'estatus' => 'En investigación'],
    ['persona' => 'Patricia Alejandra Flores Romero', 'delito' => 'Secuestro exprés', 'tiempo' => '25 horas', 'estatus' => 'En investigación'],
    ['persona' => 'Jorge Alberto Ramírez Soto', 'delito' => 'Delitos contra la salud', 'tiempo' => '60 horas', 'estatus' => 'Pendiente'],
    ['persona' => 'Daniela Cristina Ortiz Herrera', 'delito' => 'Robo de vehículo motor', 'tiempo' => '4 horas', 'estatus' => 'Consignado'],
    ['persona' => 'Ricardo Manuel Morales Silva', 'delito' => 'Amenazas', 'tiempo' => '18 horas', 'estatus' => 'En detención'],
    ['persona' => 'Gabriela Fernanda Jiménez Delgado', 'delito' => 'Falsificación de documentos', 'tiempo' => '120 horas', 'estatus' => 'Recluido'],
    ['persona' => 'Fernando José Navarro Castro', 'delito' => 'Abuso de confianza', 'tiempo' => '22 horas', 'estatus' => 'Pendiente'],
    ['persona' => 'Isabel Cristina Romero Vargas', 'delito' => 'Violación equiparada', 'tiempo' => '36 horas', 'estatus' => 'En investigación'],
    ['persona' => 'Héctor Manuel Silva Ortiz', 'delito' => 'Homicidio calificado', 'tiempo' => '55 horas', 'estatus' => 'Consignado'],
    ['persona' => 'Carmen Rosa Delgado Mendoza', 'delito' => 'Lavado de dinero', 'tiempo' => '999 horas', 'estatus' => 'En investigación'],
    ['persona' => 'Oscar Eduardo Herrera Flores', 'delito' => 'Portación ilegal de arma', 'tiempo' => '7 horas', 'estatus' => 'Pendiente'],
    ['persona' => 'Natalia Sofía Castro Jiménez', 'delito' => 'Despojo', 'tiempo' => '40 horas', 'estatus' => 'Pendiente'],
    ['persona' => 'Eduardo Antonio Vargas López', 'delito' => 'Allanamiento de morada', 'tiempo' => '2000 horas', 'estatus' => 'Recluido'],
    ['persona' => 'Valeria Beatriz Soto Ramírez', 'delito' => 'Estafa', 'tiempo' => '16 horas', 'estatus' => 'En investigación']
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Monitor de Detenciones - CDMX</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: system-ui, sans-serif;
            padding-top: 82px;           /* navbar + margen */
            padding-bottom: 70px;
        }
        .navbar { min-height: 72px; }
        .monitor-table th, .monitor-table td {
            font-size: 1.22rem;          /* más compacto pero legible */
            padding: 1.1rem 0.9rem;
            vertical-align: middle;
        }
        .situacion { min-width: 290px; font-weight: 600; }
        .det-row {
            min-height: 105px;           /* CLAVE: 6 filas caben en cualquier 1080p */
            transition: background-color .3s;
        }
        thead th {
            background-color: #212529;
            color: #fff;
            font-size: 1.28rem;
            padding: 1.2rem 0.9rem;
        }
        .badge { font-size: 1.1rem; padding: 0.55em 1.1em; }
        #page-info { font-size: 1.45rem; font-weight: 700; }
        .alert-corrupto { font-size: 1rem; margin-top: 4px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#"><i class="fas fa-gavel mr-2"></i>MONITOR DE DETENCIONES</a>
        <span class="navbar-text ml-auto text-white">
            <i class="fas fa-brain mr-1"></i>Grok xAI – v3 Compact | PHP <?php echo phpversion(); ?>
        </span>
    </div>
</nav>

<div class="container">
    <div class="text-center mb-4">
        <h2 class="font-weight-bold">FISCALÍA GENERAL DE JUSTICIA CDMX</h2>
        <p class="text-muted">Visualización en tiempo real – Datos procesados</p>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div id="page-info" class="badge badge-dark px-4 py-2">Página 1 de 4</div>
        <button onclick="manualNext()" class="btn btn-outline-dark">Siguiente bloque</button>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover monitor-table" id="monitor-table">
            <thead>
                <tr>
                    <th>Persona</th>
                    <th>Delito</th>
                    <th class="situacion">Tiempo / Estatus</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($detenciones as $index => $det) {
                    $hours = getHours($det['tiempo']);
                    $estatus_lower = strtolower($det['estatus']);
                    $is_red    = strpos($estatus_lower, 'consignado') !== false || strpos($estatus_lower, 'recluido') !== false;
                    $is_yellow = !$is_red && $hours > 36;

                    $row_class = $is_red ? 'bg-danger text-white' : ($is_yellow ? 'bg-warning text-dark' : 'bg-white');

                    echo '<tr class="det-row" data-index="'.$index.'" style="display:none;">';
                    echo '<td>'.htmlspecialchars($det['persona']).'</td>';
                    echo '<td>'.htmlspecialchars($det['delito']).'</td>';
                    echo '<td class="'.$row_class.' situacion">';
                    echo htmlspecialchars($det['tiempo']).'<br>';
                    echo '<span class="badge badge-pill '.($is_red?'badge-light':($is_yellow?'badge-danger':'badge-secondary')).' mt-1">';
                    echo htmlspecialchars($det['estatus']);
                    echo '</span>';
                    if ($hours >= 1000) echo '<div class="alert-corrupto text-danger">⚠️ Dato procesado (corrupto)</div>';
                    echo '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<footer class="bg-dark text-white text-center py-3 fixed-bottom">
    <small>Cambio automático cada 7 segundos • Grok xAI v3 Compact 2026</small>
</footer>

<script>
    let currentPage = 0;
    const rowsPerPage = 6;
    const totalPages = Math.ceil(24 / rowsPerPage);

    function showPage(page) {
        page = page % totalPages;
        document.querySelectorAll('.det-row').forEach((row, i) => {
            row.style.display = (Math.floor(i / rowsPerPage) === page) ? '' : 'none';
        });
        document.getElementById('page-info').textContent = `Página ${page + 1} de ${totalPages}`;
    }

    function nextPage() { currentPage = (currentPage + 1) % totalPages; showPage(currentPage); }
    function manualNext() { nextPage(); }

    window.onload = () => { showPage(0); setInterval(nextPage, 7000); };
</script>
</body>
</html>
