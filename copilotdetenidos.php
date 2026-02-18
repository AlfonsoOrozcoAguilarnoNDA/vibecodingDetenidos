
text/x-generic copilotdetenidos.php ( PHP script, UTF-8 Unicode text, with CRLF line terminators )
<?php
// Monitor de Detenciones - Vibecoding Mode
// Autor: Modelo de Ejemplo
// PHP Version
$phpVersion = phpversion();

// Datos de prueba (24 registros)
$registros = [
    ["Juan Pérez", "Robo", 12, "detenido"],
    ["María López", "Fraude", 40, "en proceso"],
    ["Carlos Sánchez", "Homicidio", 15, "consignado"],
    ["Ana Torres", "Extorsión", 50, "detenido"],
    ["Luis Gómez", "Secuestro", 20, "recluido"],
    ["Sofía Ramírez", "Robo", 8, "detenido"],
    ["Pedro Hernández", "Fraude", 1000, "en proceso"],
    ["Lucía Martínez", "Homicidio", 30, "detenido"],
    ["Miguel Díaz", "Extorsión", 37, "detenido"],
    ["Laura Fernández", "Secuestro", 10, "detenido"],
    ["José Morales", "Robo", 25, "detenido"],
    ["Patricia Cruz", "Fraude", 60, "detenido"],
    ["Andrés Vargas", "Homicidio", 14, "consignado"],
    ["Gabriela Reyes", "Extorsión", 48, "detenido"],
    ["Fernando Castillo", "Secuestro", 22, "detenido"],
    ["Isabel Romero", "Robo", 35, "detenido"],
    ["Ricardo Navarro", "Fraude", 5, "detenido"],
    ["Claudia Ortega", "Homicidio", 42, "detenido"],
    ["Diego Silva", "Extorsión", 18, "detenido"],
    ["Valeria Mendoza", "Secuestro", 50, "detenido"],
    ["Hugo Rivas", "Robo", 33, "detenido"],
    ["Elena Soto", "Fraude", 12, "detenido"],
    ["Manuel Peña", "Homicidio", 39, "detenido"],
    ["Rosa Aguilar", "Extorsión", 20, "detenido"]
];

// Paginación automática
$totalRegistros = count($registros);
$porPagina = 6;
$totalPaginas = ceil($totalRegistros / $porPagina);
$paginaActual = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($paginaActual < 1 || $paginaActual > $totalPaginas) {
    $paginaActual = 1;
}
$inicio = ($paginaActual - 1) * $porPagina;
$bloque = array_slice($registros, $inicio, $porPagina);
$nextPage = $paginaActual + 1;
if ($nextPage > $totalPaginas) {
    $nextPage = 1;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Monitor de Detenciones</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
    <meta http-equiv="refresh" content="7;url=?page=<?php echo $nextPage; ?>">
    <style>
        .estatus-rojo { background-color: #f8d7da; }
        .estatus-amarillo { background-color: #fff3cd; }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#"><i class="fas fa-gavel"></i> Monitor de Detenciones</a>
        <span class="navbar-text">Modelo: Vibecoding | PHP <?php echo $phpVersion; ?></span>
    </nav>

    <div class="container" style="margin-top:80px;">
        <h3 class="mb-4">Bloque <?php echo $paginaActual; ?> de <?php echo $totalPaginas; ?></h3>
        <table class="table table-bordered table-striped text-center">
            <thead class="thead-dark">
                <tr>
                    <th>Persona</th>
                    <th>Delito</th>
                    <th>Tiempo (hrs)</th>
                    <th>Estatus</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bloque as $registro): 
                    $persona = $registro[0];
                    $delito = $registro[1];
                    $tiempo = $registro[2];
                    $estatus = $registro[3];
                    $clase = "";
                    if (stripos($estatus, "consignado") !== false || stripos($estatus, "recluido") !== false) {
                        $clase = "estatus-rojo";
                    } elseif ($tiempo > 36 && stripos($estatus, "consignado") === false) {
                        $clase = "estatus-amarillo";
                    }
                ?>
                <tr class="<?php echo $clase; ?>">
                    <td><?php echo htmlspecialchars($persona); ?></td>
                    <td><?php echo htmlspecialchars($delito); ?></td>
                    <td><?php echo htmlspecialchars($tiempo); ?></td>
                    <td><?php echo htmlspecialchars($estatus); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer class="footer bg-dark text-white text-center py-3">
        <div class="container">
            <span><i class="fas fa-balance-scale"></i> Ministerio Público Base Lunar Alfa - Monitor Institucional</span>
        </div>
    </footer>
</body>
</html>
