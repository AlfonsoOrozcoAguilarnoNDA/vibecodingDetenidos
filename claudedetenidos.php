<?php
// ============================================================
// MONITOR DE DETENCIONES — Ministerio Público Base Lunar Alfa
// Modelo: Claude Sonnet 4.6 | Vibecoding Edition
// ============================================================

$registros = [
    // [nombre, delito, horas_detencion, estatus]
    ['GARCÍA MENDOZA, ROBERTO', 'Robo con violencia', 12, 'En proceso'],
    ['LÓPEZ HERNÁNDEZ, ANA PATRICIA', 'Fraude fiscal', 48, 'Pendiente declaración'],
    ['MARTÍNEZ RUIZ, JORGE ALBERTO', 'Homicidio doloso', 72, 'Consignado ante juez'],
    ['FLORES SÁNCHEZ, MARÍA DEL CARMEN', 'Portación de arma', 6, 'En proceso'],
    ['JIMÉNEZ TORRES, LUIS ERNESTO', 'Robo a transeúnte', 3200, 'Pendiente perito'],
    ['RAMÍREZ CASTRO, SOFÍA GUADALUPE', 'Violencia familiar', 18, 'En proceso'],
    ['MORALES DÍAZ, PEDRO IGNACIO', 'Tráfico de drogas', 96, 'Recluido preventivo'],
    ['HERNÁNDEZ VEGA, CLAUDIA ELENA', 'Abuso de confianza', 40, 'Pendiente audiencia'],
    ['VARGAS LUNA, MIGUEL ÁNGEL', 'Lesiones graves', 55, 'Pendiente dictamen médico'],
    ['REYES MONTOYA, DIANA ALEJANDRA', 'Extorsión', 120, 'Consignado ante juez'],
    ['GUTIÉRREZ PEÑA, CARLOS MANUEL', 'Robo de vehículo', 8, 'En proceso'],
    ['SOTO MEDINA, VERÓNICA SUSANA', 'Falsificación de documentos', 9999, 'ERROR: timestamp corrupto'],
    ['TORRES ÁVILA, ARTURO FRANCISCO', 'Homicidio culposo', 33, 'En proceso'],
    ['NÚÑEZ SALINAS, GABRIELA ISABEL', 'Defraudación', 60, 'Recluido preventivo'],
    ['MENDOZA ORTIZ, SAMUEL ANTONIO', 'Secuestro', 144, 'Consignado ante juez'],
    ['AGUILAR FUENTES, PATRICIA EUGENIA', 'Robo en casa habitación', 22, 'En proceso'],
    ['CASTILLO ROMERO, HÉCTOR DAMIÁN', 'Privación ilegal de la libertad', 4500, 'ERROR: datos corruptos'],
    ['RÍOS CABRERA, LETICIA MARIBEL', 'Lavado de dinero', 78, 'Pendiente arraigo'],
    ['PEÑA GUERRERO, FRANCISCO JAVIER', 'Violación', 90, 'Consignado ante juez'],
    ['DELGADO MORENO, ROSA ELENA', 'Robo con violencia', 15, 'En proceso'],
    ['VÁZQUEZ IBARRA, ALEJANDRO OMAR', 'Tráfico de personas', 200, 'Recluido preventivo'],
    ['CRUZ ESPINOZA, YOLANDA MERCEDES', 'Abuso sexual', 11, 'En proceso'],
    ['FUENTES BARRERA, RAÚL GENARO', 'Homicidio doloso', 3, 'En proceso'],
    ['IBARRA VILLAREAL, NORMA ANGÉLICA', 'Fraude bancario', 67, 'Pendiente audiencia inicial'],
];

// --- Lógica de estatus ---
function getRowClass(int $horas, string $estatus): string {
    $est_lower = mb_strtolower($estatus);
    if (str_contains($est_lower, 'consignado') || str_contains($est_lower, 'recluido')) {
        return 'table-danger';
    }
    if ($horas > 36 && $horas < 500) { // Filtrar datos corruptos > 500h
        return 'table-warning';
    }
    return '';
}

function getBadgeClass(int $horas, string $estatus): string {
    $est_lower = mb_strtolower($estatus);
    if (str_contains($est_lower, 'consignado') || str_contains($est_lower, 'recluido')) {
        return 'badge-danger';
    }
    if ($horas > 36 && $horas < 500) {
        return 'badge-warning';
    }
    return 'badge-success';
}

function formatHoras(int $horas): string {
    if ($horas > 500) {
        return '<span class="text-danger font-weight-bold"><i class="fas fa-exclamation-triangle"></i> DATO CORRUPTO (' . number_format($horas) . 'h)</span>';
    }
    $dias = floor($horas / 24);
    $hrs  = $horas % 24;
    if ($dias > 0) {
        return $dias . 'd ' . $hrs . 'h';
    }
    return $horas . 'h';
}

$total = count($registros);
$porPagina = 6;
$totalPaginas = ceil($total / $porPagina);
$phpVersion = PHP_VERSION;

?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitor de Detenciones — MP Base Lunar Alfa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/all.min.css">
    <style>
        :root {
            --cdmx-dark: #0d1b2a;
            --cdmx-blue: #1a3a5c;
            --cdmx-accent: #e8a020;
            --cdmx-light: #f0f4f8;
        }
        body {
            background-color: #0a1628;
            color: #d0dce8;
            font-family: 'Segoe UI', Arial, sans-serif;
            padding-top: 60px;
        }
        .navbar {
            background: linear-gradient(90deg, var(--cdmx-dark) 0%, var(--cdmx-blue) 100%);
            border-bottom: 3px solid var(--cdmx-accent);
        }
        .navbar-brand { color: var(--cdmx-accent) !important; font-weight: 700; letter-spacing: 1px; }
        .navbar .badge-php { background: var(--cdmx-accent); color: #000; font-size: .7rem; }
        .main-card {
            background: #111e30;
            border: 1px solid #1e3552;
            border-radius: 8px;
            box-shadow: 0 4px 24px rgba(0,0,0,.6);
        }
        .card-header-custom {
            background: linear-gradient(90deg, #1a3a5c, #0d2640);
            border-bottom: 2px solid var(--cdmx-accent);
            padding: 1rem 1.5rem;
        }
        .monitor-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .monitor-subtitle { font-size: .8rem; color: #7a9ec0; }
        .table { color: #c8d8e8; margin-bottom: 0; }
        .table thead th {
            background: #0d2640;
            color: var(--cdmx-accent);
            border-color: #1e3552;
            font-size: .78rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: .75rem 1rem;
        }
        .table td {
            border-color: #1a2e45;
            vertical-align: middle;
            padding: .85rem 1rem;
            font-size: .92rem;
        }
        /* Overrides para filas de estado */
        .table-danger { background-color: rgba(180,30,30,.35) !important; }
        .table-danger td { color: #ffcdd2 !important; border-color: #7f2020 !important; }
        .table-warning { background-color: rgba(200,140,0,.25) !important; }
        .table-warning td { color: #ffe082 !important; border-color: #7a5500 !important; }
        .num-col { width: 50px; text-align: center; font-weight: 700; color: #5b8ab0; }
        .nombre-col { font-weight: 600; }
        .badge-danger { background-color: #c0392b; }
        .badge-warning { background-color: #d4860a; color: #000; }
        .badge-success { background-color: #1a6b3c; }
        .badge-estado { font-size: .75rem; padding: .35em .6em; border-radius: 4px; display: inline-block; }
        /* Barra de paginación */
        .pager-bar {
            background: #0d1e33;
            border-top: 1px solid #1e3552;
            padding: .75rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .pager-dots { display: flex; gap: 8px; }
        .pager-dot {
            width: 12px; height: 12px;
            border-radius: 50%;
            background: #1e3552;
            transition: background .3s;
            cursor: pointer;
        }
        .pager-dot.active { background: var(--cdmx-accent); }
        .countdown-bar {
            height: 4px;
            background: var(--cdmx-accent);
            transition: width linear;
        }
        .countdown-wrap {
            background: #060f1a;
            border-radius: 0 0 8px 8px;
            overflow: hidden;
            height: 4px;
        }
        .stats-row { padding: .6rem 1.5rem; background: #0d1e33; border-top: 1px solid #1e3552; }
        .stat-pill {
            font-size: .75rem;
            padding: .3em .7em;
            border-radius: 20px;
            margin-right: .4rem;
            display: inline-block;
        }
        footer {
            background: var(--cdmx-dark);
            border-top: 2px solid var(--cdmx-accent);
            color: #4a6a8a;
            font-size: .8rem;
            padding: 1rem 0;
            margin-top: 2rem;
        }
        .clock { font-size: 1.1rem; font-weight: 700; color: var(--cdmx-accent); letter-spacing: 2px; }
        @keyframes blink { 0%,100%{opacity:1} 50%{opacity:.4} }
        .live-dot { color: #e74c3c; animation: blink 1.2s infinite; font-size: .7rem; }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-dark fixed-top">
    <span class="navbar-brand">
        <i class="fas fa-shield-alt mr-2"></i>
        MP Base Lunar Alfa — Monitor de Detenciones
    </span>
    <div class="d-flex align-items-center">
        <span class="live-dot mr-2"><i class="fas fa-circle"></i></span>
        <span class="mr-3" style="font-size:.8rem; color:#7a9ec0;">EN VIVO</span>
        <span class="badge badge-php mr-3">PHP <?php echo htmlspecialchars($phpVersion); ?></span>
        <span class="badge badge-secondary">Claude Sonnet 4.6</span>
    </div>
</nav>

<!-- CONTENIDO PRINCIPAL -->
<div class="container-fluid px-4 mt-3">

    <!-- Stats rápidas -->
    <div class="row mb-3">
        <?php
        $totalConsignados = 0; $totalAlerta = 0; $totalCorruptos = 0; $totalNormales = 0;
        foreach ($registros as $r) {
            $e = mb_strtolower($r[3]);
            if (str_contains($e, 'consignado') || str_contains($e, 'recluido')) { $totalConsignados++; }
            elseif ($r[2] > 36 && $r[2] < 500) { $totalAlerta++; }
            elseif ($r[2] > 500) { $totalCorruptos++; }
            else { $totalNormales++; }
        }
        ?>
        <div class="col-md-3 col-6 mb-2">
            <div class="main-card p-3 text-center">
                <div style="font-size:1.8rem;font-weight:700;color:#e74c3c;"><?php echo $totalConsignados; ?></div>
                <div style="font-size:.75rem;color:#7a9ec0;text-transform:uppercase;">Consignados / Recluidos</div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-2">
            <div class="main-card p-3 text-center">
                <div style="font-size:1.8rem;font-weight:700;color:#d4860a;"><?php echo $totalAlerta; ?></div>
                <div style="font-size:.75rem;color:#7a9ec0;text-transform:uppercase;">Alerta (&gt;36h)</div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-2">
            <div class="main-card p-3 text-center">
                <div style="font-size:1.8rem;font-weight:700;color:#2ecc71;"><?php echo $totalNormales; ?></div>
                <div style="font-size:.75rem;color:#7a9ec0;text-transform:uppercase;">En proceso normal</div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-2">
            <div class="main-card p-3 text-center">
                <div style="font-size:1.8rem;font-weight:700;color:#e67e22;"><?php echo $totalCorruptos; ?></div>
                <div style="font-size:.75rem;color:#7a9ec0;text-transform:uppercase;">Datos corruptos</div>
            </div>
        </div>
    </div>

    <!-- Monitor principal -->
    <div class="main-card mb-3">
        <div class="card-header-custom d-flex justify-content-between align-items-center">
            <div>
                <div class="monitor-title"><i class="fas fa-table mr-2"></i>Registro de Detenidos</div>
                <div class="monitor-subtitle">
                    <?php echo $total; ?> registros totales &bull;
                    <?php echo $totalPaginas; ?> bloques &bull; Rotación automática cada 7 segundos
                </div>
            </div>
            <div class="text-right">
                <div class="clock" id="clock">--:--:--</div>
                <div style="font-size:.7rem;color:#5b8ab0;" id="fecha-display">...</div>
            </div>
        </div>

        <!-- Tabla dinámica -->
        <div id="tabla-container">
            <table class="table table-sm mb-0" id="tabla-monitor">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th><i class="fas fa-user mr-1"></i>Persona detenida</th>
                        <th><i class="fas fa-gavel mr-1"></i>Delito imputado</th>
                        <th><i class="fas fa-clock mr-1"></i>Tiempo detenido</th>
                        <th><i class="fas fa-info-circle mr-1"></i>Estatus</th>
                    </tr>
                </thead>
                <tbody id="tabla-body">
                </tbody>
            </table>
        </div>

        <!-- Stats y paginación -->
        <div class="stats-row d-flex align-items-center justify-content-between">
            <div>
                <span class="stat-pill" style="background:rgba(180,30,30,.4);color:#ffcdd2;">
                    <i class="fas fa-circle mr-1"></i>Consignado/Recluido
                </span>
                <span class="stat-pill" style="background:rgba(200,140,0,.3);color:#ffe082;">
                    <i class="fas fa-circle mr-1"></i>Alerta &gt;36h
                </span>
                <span class="stat-pill" style="background:rgba(26,107,60,.4);color:#a5d6a7;">
                    <i class="fas fa-circle mr-1"></i>Normal
                </span>
            </div>
            <div class="d-flex align-items-center">
                <span style="font-size:.78rem;color:#5b8ab0;margin-right:12px;">
                    Bloque <span id="pag-actual">1</span> / <?php echo $totalPaginas; ?>
                </span>
                <div class="pager-dots" id="pager-dots">
                    <?php for ($i = 0; $i < $totalPaginas; $i++): ?>
                        <div class="pager-dot <?php echo $i === 0 ? 'active' : ''; ?>" data-page="<?php echo $i; ?>"></div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
        <div class="countdown-wrap">
            <div class="countdown-bar" id="countdown-bar" style="width:100%"></div>
        </div>
    </div>

</div>

<!-- FOOTER -->
<footer>
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-md-6">
                <strong style="color:#7a9ec0;">
                    <i class="fas fa-shield-alt mr-1"></i>
                    Fiscalía General de Justicia — Base Lunar Alfa
                </strong>
                <div>Sistema de Monitoreo de Detenciones &bull; Uso interno exclusivo</div>
            </div>
            <div class="col-md-6 text-md-right">
                <div>Motor: PHP <?php echo htmlspecialchars($phpVersion); ?> &bull; Bootstrap 4.6 &bull; Claude Sonnet 4.6</div>
                <div style="color:#2e4a62;">Exercicio de Vibecoding &mdash; Fines educativos</div>
            </div>
        </div>
    </div>
</footer>

<!-- DATOS PHP → JS -->
<?php
$registrosJS = [];
foreach ($registros as $idx => $r) {
    $registrosJS[] = [
        'num'    => $idx + 1,
        'nombre' => htmlspecialchars($r[0]),
        'delito' => htmlspecialchars($r[1]),
        'horas'  => (int)$r[2],
        'estatus'=> htmlspecialchars($r[3]),
    ];
}
?>
<script>
const REGISTROS = <?php echo json_encode($registrosJS, JSON_UNESCAPED_UNICODE); ?>;
const POR_PAGINA = 6;
const INTERVALO  = 7000;
const TOTAL_PAGS = Math.ceil(REGISTROS.length / POR_PAGINA);

let paginaActual = 0;
let timer = null;
let countdownTimer = null;

function getRowClass(horas, estatus) {
    const e = estatus.toLowerCase();
    if (e.includes('consignado') || e.includes('recluido')) return 'table-danger';
    if (horas > 36 && horas < 500) return 'table-warning';
    return '';
}

function getBadgeClass(horas, estatus) {
    const e = estatus.toLowerCase();
    if (e.includes('consignado') || e.includes('recluido')) return 'badge-danger';
    if (horas > 36 && horas < 500) return 'badge-warning';
    return 'badge-success';
}

function formatHoras(horas) {
    if (horas > 500) {
        return `<span class="text-danger font-weight-bold"><i class="fas fa-exclamation-triangle"></i> DATO CORRUPTO (${horas.toLocaleString()}h)</span>`;
    }
    const dias = Math.floor(horas / 24);
    const hrs  = horas % 24;
    return dias > 0 ? `${dias}d ${hrs}h` : `${horas}h`;
}

function renderPagina(pag) {
    const inicio = pag * POR_PAGINA;
    const slice  = REGISTROS.slice(inicio, inicio + POR_PAGINA);
    const tbody  = document.getElementById('tabla-body');
    let html = '';

    slice.forEach(r => {
        const rowClass   = getRowClass(r.horas, r.estatus);
        const badgeClass = getBadgeClass(r.horas, r.estatus);
        const horasStr   = formatHoras(r.horas);
        html += `
        <tr class="${rowClass}">
            <td class="num-col text-center">${r.num}</td>
            <td class="nombre-col">${r.nombre}</td>
            <td>${r.delito}</td>
            <td>${horasStr}</td>
            <td>
                <span class="badge badge-estado ${badgeClass}">${r.estatus}</span>
            </td>
        </tr>`;
    });

    tbody.innerHTML = html;

    // Update dots
    document.querySelectorAll('.pager-dot').forEach((d, i) => {
        d.classList.toggle('active', i === pag);
    });
    document.getElementById('pag-actual').textContent = pag + 1;
}

function startCountdown() {
    const bar = document.getElementById('countdown-bar');
    const start = Date.now();
    if (countdownTimer) clearInterval(countdownTimer);
    countdownTimer = setInterval(() => {
        const elapsed = Date.now() - start;
        const pct = Math.max(0, 100 - (elapsed / INTERVALO) * 100);
        bar.style.width = pct + '%';
    }, 50);
}

function siguientePagina() {
    paginaActual = (paginaActual + 1) % TOTAL_PAGS;
    renderPagina(paginaActual);
    startCountdown();
}

// Dots click
document.querySelectorAll('.pager-dot').forEach((d, i) => {
    d.addEventListener('click', () => {
        paginaActual = i;
        clearInterval(timer);
        renderPagina(paginaActual);
        startCountdown();
        timer = setInterval(siguientePagina, INTERVALO);
    });
});

// Reloj
function updateClock() {
    const now = new Date();
    const h = String(now.getHours()).padStart(2,'0');
    const m = String(now.getMinutes()).padStart(2,'0');
    const s = String(now.getSeconds()).padStart(2,'0');
    document.getElementById('clock').textContent = `${h}:${m}:${s}`;
    const dias = ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'];
    const meses = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
    document.getElementById('fecha-display').textContent =
        `${dias[now.getDay()]} ${now.getDate()} ${meses[now.getMonth()]} ${now.getFullYear()}`;
}

// Init
renderPagina(0);
startCountdown();
timer = setInterval(siguientePagina, INTERVALO);
setInterval(updateClock, 1000);
updateClock();
</script>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
