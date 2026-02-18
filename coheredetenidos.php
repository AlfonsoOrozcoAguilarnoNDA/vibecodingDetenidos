<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitor de Detenciones - Base Lunar Alfa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css">
    <style>
        .table-responsive {
            max-height: 600px;
            overflow-y: auto;
        }
        .status-cell {
            padding: 10px;
            text-align: center;
            font-weight: bold;
        }
        .bg-danger {
            background-color: #ff6b6b !important;
        }
        .bg-warning {
            background-color: #ffd166 !important;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">Monitor de Detenciones - Modelo: Vibecoding PHP <?php echo phpversion(); ?></span>
    </nav>

    <div class="container mt-4">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Persona</th>
                        <th scope="col">Delito</th>
                        <th scope="col">Tiempo (horas)</th>
                        <th scope="col">Estatus</th>
                    </tr>
                </thead>
                <tbody id="detencionesTableBody">
                    <?php
                    $detenciones = [
                        ['Juan Pérez', 'Robo', '24', 'En proceso'],
                        ['María Gómez', 'Fraude', '48', 'Consignado'],
                        ['Carlos Ruiz', 'Homicidio', '72', 'Recluido'],
                        ['Ana López', 'Lesiones', '12', 'En proceso'],
                        ['Luis Martínez', 'Extorsión', '36', 'En proceso'],
                        ['Sofía Hernández', 'Secuestro', '96', 'Consignado'],
                        ['Pedro Ramírez', 'Narcomenudeo', '18', 'En proceso'],
                        ['Laura Torres', 'Daño a propiedad', '6', 'En proceso'],
                        ['Jorge Morales', 'Violencia familiar', '48', 'Recluido'],
                        ['Marta Díaz', 'Estafa', '24', 'En proceso'],
                        ['Ricardo Castro', 'Asalto', '72', 'Consignado'],
                        ['Elena Vargas', 'Corrupción', '36', 'En proceso'],
                        ['Fernando Peña', 'Tráfico de influencias', '96', 'Recluido'],
                        ['Carmen Reyes', 'Fraude fiscal', '12', 'En proceso'],
                        ['Héctor Ortiz', 'Lavado de dinero', '48', 'Consignado'],
                        ['Patricia Mendoza', 'Delitos cibernéticos', '72', 'Recluido'],
                        ['Gabriel Jiménez', 'Contrabando', '24', 'En proceso'],
                        ['Teresa Romero', 'Delitos ambientales', '36', 'En proceso'],
                        ['Miguel Ángel Herrera', 'Delitos electorales', '96', 'Consignado'],
                        ['Beatriz Gutiérrez', 'Delitos de género', '18', 'En proceso'],
                        ['Alejandro Fernández', 'Delitos de odio', '48', 'Recluido'],
                        ['Isabel Castillo', 'Delitos de prensa', '24', 'En proceso'],
                        ['Rafael Medina', 'Delitos de tránsito', '36', 'En proceso'],
                    ];

                    $registrosPorPagina = 6;
                    $totalPaginas = ceil(count($detenciones) / $registrosPorPagina);
                    $paginaActual = isset($_GET['page']) ? intval($_GET['page']) : 1;
                    $inicio = ($paginaActual - 1) * $registrosPorPagina;
                    $fin = $inicio + $registrosPorPagina;

                    for ($i = $inicio; $i < $fin && $i < count($detenciones); $i++) {
                        $detencion = $detenciones[$i];
                        $tiempo = intval($detencion[2]);
                        $estatus = strtolower($detencion[3]);
                        $clase = '';

                        if (strpos($estatus, 'consignado') !== false || strpos($estatus, 'recluido') !== false) {
                            $clase = 'bg-danger';
                        } elseif ($tiempo > 36 && strpos($estatus, 'consignado') === false) {
                            $clase = 'bg-warning';
                        }

                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($detencion[0]) . '</td>';
                        echo '<td>' . htmlspecialchars($detencion[1]) . '</td>';
                        echo '<td class="status-cell ' . $clase . '">' . htmlspecialchars($detencion[2]) . '</td>';
                        echo '<td class="status-cell ' . $clase . '">' . htmlspecialchars($detencion[3]) . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <nav aria-label="Page navigation" class="mt-4">
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                <li class="page-item <?php echo $i === $paginaActual ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>

    <footer class="footer mt-auto py-3 bg-light">
        <div class="container text-center">
            <span class="text-muted">© 2023 Ministerio Público Base Lunar Alfa. Todos los derechos reservados.</span>
        </div>
    </footer>

    <script>
        function cambiarPagina() {
            const totalPaginas = <?php echo $totalPaginas; ?>;
            let paginaActual = <?php echo $paginaActual; ?>;
            paginaActual++;
            if (paginaActual > totalPaginas) {
                paginaActual = 1;
            }
            window.location.href = '?page=' + paginaActual;
        }

        setInterval(cambiarPagina, 7000);
    </script>
</body>
</html>
