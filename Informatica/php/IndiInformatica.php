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
    <title>Apoyo a la Infraestructura Informática</title> 
    <meta charset="UTF-8">
    <script src="../js/cargas.js"></script>
    <script src="../js/Indicadores.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/IndiInformatica.css">
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">
</head>

<body>

<main class="container">

    <h1>Indicadores</h1>
    <h4>Apoyo a la Infraestructura Informática</h4>
    
    <section class="registro">
        <form method="post" action="GuardarIndi.php">
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
                
                <h4>Solicitud de Servicio</h4>
                <h5>Atender las solicitudes Generadas Por el Usuario</h5>
                
                <div>
                    <label for="SolicitudesAtendidas">Solicitudes Atendidas:</label>
                    <input type="number" id="SolicitudesAtendidas" name="SolicitudesAtendidas" placeholder="Ingrese la cantidad" required step="any">
                </div>
                
                <div>
                    <label for="NumSolicitudes">Solicitudes Generadas por el Usuario:</label>
                    <input type="number" id="NumSolicitudes" name="NumSolicitudes" placeholder="Ingrese la cantidad" required step="any">
                </div>
                
                <div>
                    <label for="PorSolicitudesAtendidas">Porcentaje de solicitudes Atendidas:</label>
                    <input type="number" id="PorSolicitudesAtendidas" name="PorSolicitudesAtendidas" placeholder="%:" required step="any">
                </div>
            </div>
            
            <!-- Columna 2 -->
            <div class="registro-column">
                <div>
                    <label for="PorSolicitudesAtendidas">Porcentaje de solicitudes Atendidas:</label>
                    <input type="number" id="PorSolicitudesAtendidas" name="PorSolicitudesAtendidas" placeholder="%:" required step="any">
                </div>
                <div>
                    <label for="EventualidadesMes">Eventualidades Presentadas en el Mes:</label>
                    <input type="number" id="EventualidadesMes" name="EventualidadesMes" placeholder="Ej. 0" required step="any">
                </div>
                
                <div>
                    <label for="MetaEsperadaMB">Meta Esperada:</label>
                    <input type="text" id="MetaEsperadaMB" name="MetaEsperadaMB" placeholder="La meta esperada es:" required>
                </div>
                
                <div>
                    <label for="RangoAceptMB">Rango de Aceptación:</label>
                    <input type="text" id="RangoAceptMB" name="RangoAceptMB" placeholder="Ej. 95% al 100%" required>
                </div>
                
                <div>
                    <label for="TendenciaDeseadaMB">Tendencia Deseada:</label>
                    <input type="text" id="TendenciaDeseadaMB" name="TendenciaDeseadaMB" placeholder="Ej. Mantener el 100% de las Solicitudes Atendidas" required>
                </div>
                
                <hr>
                
                <h4>Responsable y Fuente</h4>
                
                <div>
                    <label for="Responsable">Responsable:</label>
                    <input type="text" id="Responsable" name="Responsable" placeholder="Nombre del responsable" required value="<?php echo htmlspecialchars($responsable_value); ?>">
                </div>
                
                <div>
                    <label for="Fuente">Fuente:</label>
                    <textarea id="Fuente" name="Fuente" rows="3" placeholder="Ingrese la fuente de información" required></textarea>
                </div>
            </div>
            
        </div>
        
        <div class="form-buttons">
            <input type="submit" name="g" value="Guardar" class="btn">
            <input type="reset" name="b" value="Limpiar" class="btn">
        </div>

        </form>
    </section>

    <a href="./InformaticaP.php" class="home-link">
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

    enableUppercase('Claveregis');
    enableUppercase('Responsable');
})();
</script>

</body>
</html>