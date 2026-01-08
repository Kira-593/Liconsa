<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$responsable_value = '';
if (!empty($_SESSION['correo'])) {
    $correo_sess = $_SESSION['correo'];
    $db = new mysqli('localhost', 'root', '', 'usuario');
    if (!$db->connect_error) {
        $stmt = $db->prepare("SELECT Nombre, Ap_P, Ap_M FROM users WHERE correo = ? LIMIT 1");
        if ($stmt) {
            $stmt->bind_param('s', $correo_sess);
            $stmt->execute();
            $stmt->bind_result($n, $ap, $am);
            if ($stmt->fetch()) {
                $responsable_value = trim($n . ' ' . $ap . ' ' . $am);
            }
            $stmt->close();
        }
        $db->close();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Gestion del Ambiente de trabajo y de las Competencias de Personal</title>
    <meta charset="UTF-8">
    <script src="../js/cargas.js"></script>
    <script src="../js/IndicadoresMa.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/IndiGestionMa.css">
</head>

<body>
    <!-- LOGOS -->
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">

<main class="container">

    <h1>Indicadores</h1>
    <h4>Gestion del Ambiente de trabajo y de las Competencias de Personal</h4>
    
    <section class="registro">
        <form method="post" action="GuardarIndiMa.php">
        <div class="registro-container">
            
            <!-- Columna 1 -->
            <div class="registro-column">
                <div>
                    <label for="Claveregis">Clave de Registro:</label>
                    <input type="text" id="Claveregis" name="Claveregis" value="TX-MSGC-500-01-R01" placeholder="Ingrese la Clave" required>
                </div>

                <div>
                    <label for="FechaAct">Fecha de Actualización:</label>
                    <input type="date" id="FechaAct" name="FechaAct" value="2025-10-01" required>
                </div>

                <div>
                    <label for="Mes">Fecha de Elaboración:</label>
                    <input type="date" id="Mes" name="Mes" min="<?php echo date('Y-m-d'); ?>" required>
                </div>

                <div>
                    <label for="Periodo">Periodo:</label>
                    <input type="date" id="Periodo" name="Periodo" required>
                </div>

                <hr>
                
                <h4>Cumplimientos de la Capacitación</h4>
                
                <div>
                    <label for="CapaImpar">Capacitaciones Impartidas:</label>
                    <input type="number" id="CapaImpar" name="CapaImpar" placeholder="Ingrese la cantidad" required step="any">
                </div>

                <div>
                    <label for="CapaProg">Capacitaciones Programadas:</label>
                    <input type="number" id="CapaProg" name="CapaProg" placeholder="Ingrese la meta" required step="any">
                </div>

                <div>
                    <label for="PorCumplimientoCAP">Porcentaje de Cumplimiento:</label>
                    <input type="number" id="PorCumplimientoCAP" name="PorCumplimientoCAP" placeholder="Los Puntos son:" required step="any">
                </div>

                <div>
                    <label for="MetaEsperadaCC">Meta Esperada:</label>
                    <input type="text" id="MetaEsperadaCC" name="MetaEsperadaCC" placeholder="La meta esperada es:" required>
                </div>

                <div>
                    <label for="RangoAceptCC">Rango de Aceptación:</label>
                    <input type="text" id="RangoAceptCC" name="RangoAceptCC" placeholder="Ej. MIN=80% MAX=100%" required>
                </div>

                <div>
                    <label for="TendenciaDeseadaCC">Tendencia Deseada:</label>
                    <input type="text" id="TendenciaDeseadaCC" name="TendenciaDeseadaCC" placeholder="Ej. cumplir con la capacitación programada" required>
                </div>
                
                <hr>
                
                
            </div>
            
            <!-- Columna 2 -->
            <div class="registro-column">
                <h4>Evaluación Técnica</h4>
                
                <div>
                    <label for="NuevosIP">Nuevos Ingresos al Puesto:</label>
                    <input type="number" id="NuevosIP" name="NuevosIP" placeholder="Ingrese la cantidad" required step="any">
                </div>
                <div>
                    <label for="NumEvaluaciones">Número de Evaluaciones:</label>
                    <input type="number" id="NumEvaluaciones" name="NumEvaluaciones" placeholder="Ingrese la meta" required step="any">
                </div>

                <div>
                    <label for="PorCumplimientoET">Porcentaje de Cumplimiento:</label>
                    <input type="number" id="PorCumplimientoET" name="PorCumplimientoET" placeholder="Los Puntos son:" required step="any">
                </div>

                <div>
                    <label for="MetaEsperadaET">Meta Esperada:</label>
                    <input type="text" id="MetaEsperadaET" name="MetaEsperadaET" placeholder="La meta esperada es:" required>
                </div>

                <div>
                    <label for="RangoAceptET">Rango de Aceptación:</label>
                    <input type="text" id="RangoAceptET" name="RangoAceptET" placeholder="Ej. MIN= No aplica MAX= Cambio de puestos y nuevos ingresos" required>
                </div>

                <div>
                    <label for="TendenciaDeseadaET">Tendencia Deseada:</label>
                    <input type="text" id="TendenciaDeseadaET" name="TendenciaDeseadaET" placeholder="Ej. cumplir con la Evaluación Técnica" required>
                </div>

                <hr>
                
                <h4>Responsable y Fuente</h4>
                
                <div>
                    <label for="Responsable">Responsable:</label>
                    <input type="text" id="Responsable" name="Responsable" placeholder="Nombre del responsable" required value="<?php echo htmlspecialchars($responsable_value); ?>">
                </div>

                <div>
                    <label for="Fuente">Fuente:</label>
                    <textarea id="Fuente" name="Fuente" rows="4" placeholder="Fuente" required></textarea>
                </div>

                <div class="form-buttons">
                    <input type="submit" name="g" value="Guardar">
                    <input type="reset" name="b" value="Limpiar">
                </div>
            </div>
            
        </div> <!-- cierre registro-container -->
        </form>
    </section>

    <a href="./Indigestiones.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90">
    </a>
</main>

<script>
    (function() {
        function enableUppercase(id) {
            var el = document.getElementById(id);
            if (!el) return;
            el.addEventListener('input', function() {
                var start = this.selectionStart;
                var end = this.selectionEnd;
                this.value = this.value.toUpperCase();
                if (typeof this.setSelectionRange === 'function') {
                    this.setSelectionRange(start, end);
                }
            });
        }

        // Aplicar mayúsculas automáticas
        enableUppercase('Claveregis');
        enableUppercase('Responsable');
    })();
</script>

</body>
</html>