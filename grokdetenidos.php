?php
// Vibecoding Mode: Senior Full-Stack Developer (Grok xAI)
// Archivo único - PHP 8.x puro - Bootstrap 4.6 + Font Awesome vía jsDelivr
// NO short tags, NO short echo, NO BD, 24 registros sucios simulados

function getHours($tiempo_str) {
    $str = strtolower($tiempo_str);
    if (strpos($str, 'mil') !== false || strpos($str, 'miles') !== false) {
        return 10000;
    }
    if (preg_match('/(\d+)/', $tiempo_str, $matches)) {
        $num = (int)$matches[1];
        if (strpos($str, 'día') !== false || strpos($str, 'dia') !== false) {
            $num *= 24;
        }
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitor de Detenciones - CDMX</title>
    <!-- Bootstrap 4.6 vía jsDelivr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Font Awesome 5 vía jsDelivr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.4rem;
        }
        .monitor-table th, .monitor-table td {
            font-size: 1.25rem;
            padding: 1.25rem 0.75rem;
            vertical-align: middle;
        }
        .situacion {
            min-width: 280px;
            font-weight: 600;
        }
        .det-row {
            transition: all 0.3s ease;
        }
        .table thead th {
            background-color: #343a40;
            color: white;
            font-size: 1.3rem;
        }
        .badge {
            font-size: 1.1rem;
            padding: 0.5em 1em;
        }
        #page-info {
            font-size: 1.4rem;
            font-weight: 700;
        }
        .footer {
            font-size: 0.95rem;
        }
    </style>
</head>
<body>
    <!-- NAVBAR FIJA -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-shield-alt mr-2"></i>
                MONITOR DE DETENCIONES
            </a>
            <span class="navbar-text ml-auto text-light">
                <i class="fas fa-robot mr-1"></i>
                Modelo: <strong>Grok by xAI</strong> 
                | PHP <?php echo phpversion(); ?>
            </span>
        </div>
    </nav>

    <div class="container pt-5 mt-5">
        <div class="text-center mb-4">
            <h1 class="display-4 font-weight-bold text-dark">MINISTERIO PÚBLICO Base Lunar Alfa</h1>
            <p class="lead text-muted">Sistema de Visualización Automatizada - Datos corruptos procesados en tiempo real</p>
        </div>

        <!-- INFO PÁGINA -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div id="page-info" class="badge badge-dark p-3">Página 1 de 4</div>
            <button onclick="manualNext()" class="btn btn-outline-dark">
                <i class="fas fa-arrow-right"></i> Siguiente Bloque (Manual)
            </button>
        </div>

        <!-- TABLA -->
        <table class="table table-bordered table-hover monitor-table" id="monitor-table">
            <thead>
                <tr>
                    <th>Persona</th>
                    <th>Delito</th>
                    <th class="situacion">Tiempo de Detención / Estatus</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($detenciones as $index => $det) {
                    $hours = getHours($det['tiempo']);
                    $estatus_lower = strtolower($det['estatus']);
                    $is_red = strpos($estatus_lower, 'consignado') !== false || strpos($estatus_lower, 'recluido') !== false;

                    $color_class = '';
                    if ($is_red) {
                        $color_class = 'bg-danger text-white';
                    } elseif ($hours > 36) {
                        $color_class = 'bg-warning text-dark';
                    } else {
                        $color_class = 'bg-white';
                    }

                    echo '<tr class="det-row" data-index="' . $index . '" style="display:none;">';
                    echo '<td>' . htmlspecialchars($det['persona']) . '</td>';
                    echo '<td>' . htmlspecialchars($det['delito']) . '</td>';
                    echo '<td class="' . $color_class . ' situacion">';
                    echo htmlspecialchars($det['tiempo']) . '<br>';
                    echo '<span class="badge badge-pill ' . ($is_red ? 'badge-light' : 'badge-secondary') . ' mt-1">';
                    echo htmlspecialchars($det['estatus']);
                    echo '</span>';
                    echo '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- FOOTER ESTÁTICO -->
    <footer class="bg-dark text-light text-center py-4 footer fixed-bottom">
        <div class="container">
            <small>
                <i class="fas fa-clock mr-1"></i>
                Actualización automática cada 7 segundos • 
                Datos simulados con información corrupta del Ministerio Público Base Lunar Alfa • 
                Vibecoding 2026 • Grok xAI
            </small>
        </div>
    </footer>

    <script>
        // JS Vanilla - Paginación automática 6 registros / 7 segundos
        let currentPage = 0;
        const rowsPerPage = 6;

        function showPage(page) {
            const rows = document.querySelectorAll('.det-row');
            const totalPages = Math.ceil(rows.length / rowsPerPage);
            page = page % totalPages;

            rows.forEach((row, index) => {
                const rowPage = Math.floor(index / rowsPerPage);
                row.style.display = (rowPage === page) ? 'table-row' : 'none';
            });

            document.getElementById('page-info').textContent = 
                `Página ${page + 1} de ${totalPages}`;
        }

        function nextPage() {
            currentPage = (currentPage + 1) % Math.ceil(24 / rowsPerPage);
            showPage(currentPage);
        }

        function manualNext() {
            nextPage();
        }

        // Inicializar
        window.onload = function() {
            showPage(0);                    // Muestra primer bloque
            setInterval(nextPage, 7000);    // Cambio automático cada 7 segundos
        };
    </script>
</body>
</html>
