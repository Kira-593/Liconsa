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
	<title>Distribución</title> 
	<meta charset="UTF-8">
    <script src="../js/cargas.js"></script>
    <script src="../js/Indicadores.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../css/IndiDistribucion.css">
</head>

<body>

<!-- IMÁGENES MOVIDAS DEL HEAD -->
<img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
<img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">

<main class="container">

    <h1>Indicadores</h1>
    <h4>Distribución</h4>
    
    <section class="registro">
        <form method="post" action="GuardarIndi.php">
        <div class="registro-container">

            <div class="registro-column">

                <div>
                    <div>
                        <label for="Claveregis">Clave de Registro:</label>
                        <input type="text" id="Claveregis" name="Claveregis" value="TX-MSGC-500-01-R01" placeholder="Ingrese la Clave" required>
                    </div>

                    <label for="Mes">Fecha de Elaboración:</label>
                    <input type="date" id="Mes" name="Mes" value="2025-10-01" required>
                    <label for="Periodo">Periodo:</label>
                    <input type="date" id="Periodo" name="Periodo" required>
                </div>

                <div>
                    <hr>
                    <label>Cumplimiento con el Despacho Programado de Leche Liquida P.A.S Tlaxcala</label><br>
                    <hr>

                    <label for="CumplRealProgDia">Cumplimiento Real al Programa Diaria de Despacho:</label>
                    <input type="number" id="CumplRealProgDia" name="CumplRealProgDia" placeholder="Ingrese la cantidad" required step="any">
                </div>

                <div>
                    <label for="ProgDiarioDespacho">Programa Diario de Despacho:</label>
                    <input type="number" id="ProgDiarioDespacho" name="ProgDiarioDespacho" placeholder="Ingrese la cantidad" required step="any">
                </div>

                <div>
                    <label for="PCDP">Porcentaje del cumplimiento Con el Despacho Programado:</label>
                    <input type="number" id="PCDP" name="PCDP" placeholder="Los Puntos son:" required step="any">
                </div>

                <div>
                    <label for="MetaEsperada">Meta Esperada:</label>
                    <input type="text" id="MetaEsperadaMB" name="MetaEsperadaMB" placeholder="La meta esperada es:" required>
                </div>

                <div>
                    <label for="RangoAcept">Rango de Aceptación:</label>
                    <input type="text" id="RangoAceptMB" name="RangoAceptMB" placeholder="Ej. 90 a 100 Puntos" required>
                </div>

                <div>
                    <label for="TendenciaDeseada">Tendencia Deseada:</label>
                    <input type="text" id="TendenciaDeseadaMB" name="TendenciaDeseadaMB" placeholder="Ej. Alcanzar la meta propuesta" required>
                </div>

                <div>
                    <hr>
                    <label>Cumplimiento de Ventas Programadas</label><br>
                    <hr>

                    <label for="Ventatot">Venta Total:</label>
                    <input type="number" id="Ventatot" name="Ventatot" placeholder="Ingrese la cantidad" required step="any">
                </div>

                <div>
                    <label for="DotEntre">Dotación Entregada:</label>
                    <input type="number" id="DotEntre" name="DotEntre" placeholder="Ingrese la Dotacion Entregada" required step="any">
                </div>

                <div>
                    <label for="CumplimientoVentas">Cumplimiento de Ventas Programadas:</label>
                    <input type="number" id="CumplimientoVentas" name="CumplimientoVentas" placeholder="cumplimiento del:" required step="any">
                </div>

                <div>
                    <label for="MetaEsperadaCVP">Meta Esperada:</label>
                    <input type="text" id="MetaEsperadaCVP" name="MetaEsperadaCVP" placeholder="La meta esperada es:" required>
                </div>

                <div>
                    <label for="RangoAceptCVP">Rango de Aceptación:</label>
                    <input type="text" id="RangoAceptCVP" name="RangoAceptCVP" placeholder="Ej. 90 a 100 Puntos" required>
                </div>

                <div>
                    <label for="TendenciaDeseadaCVP">Tendencia Deseada:</label>
                    <input type="text" id="TendenciaDeseadaCVP" name="TendenciaDeseadaCVP" placeholder="Ej. Alcanzar la meta propuesta" required>
                </div>

                <div>
                    <hr>
                    <label>Control de Envases Rotos...</label><br>
                    <hr>

                    <label for="MermasEnva">Mermas:</label>
                    <input type="number" id="MermasEnva" name="MermasEnva" placeholder="Ingrese la cantidad de mermas" required step="any">
                </div>

                <div>
                    <label for="DotEnva">Dotación:</label>
                    <input type="number" id="DotEnva" name="DotEnva" placeholder="Ingrese la Dotación" required step="any">
                </div>

                <div>
                    <label for="CantidadEnvRotos">Cantidad de Envases Rotos:</label>
                    <input type="number" id="CantidadEnvRotos" name="CantidadEnvRotos" placeholder="Ingrese la cantidad" required step="any">
                </div>

                <div>
                    <label for="MetaEsperadaCER">Meta Esperada:</label>
                    <input type="text" id="MetaEsperadaCER" name="MetaEsperadaCER" placeholder="La meta esperada es:" required>
                </div>

                <div>
                    <label for="RangoAceptCER">Rango de Aceptación:</label>
                    <input type="text" id="RangoAceptCER" name="RangoAceptCER" placeholder="Ej. 90 a 100 Puntos" required>
                </div>

                <div>
                    <label for="TendenciaDeseadaCER">Tendencia Deseada:</label>
                    <input type="text" id="TendenciaDeseadaCER" name="TendenciaDeseadaCER" placeholder="Ej. Alcanzar la meta propuesta" required>
                </div>

                <div>
                    <hr>
                    <label>Devoluciones del P.A.S. Tlaxcala</label><br>
                    <hr>

                    <label for="Devoluciones">Devoluciones:</label>
                    <input type="number" id="Devoluciones" name="Devoluciones" placeholder="Ingrese la cantidad de devoluciones" required step="any">
                </div>

                <div>
                    <label for="DotDev">Dotación:</label>
                    <input type="number" id="DotDev" name="DotDev" placeholder="Ingrese la Dotación" required step="any">
                </div>

                <div>
                    <label for="DevolucionesDPAS">Devoluciones Del P.A.S. Tlaxcala:</label>
                    <input type="number" id="DevolucionesDPAS" name="DevolucionesDPAS" placeholder="Ingrese la cantidad" required step="any">
                </div>

                <div>
                    <label for="MetaEsperadaDPAS">Meta Esperada:</label>
                    <input type="text" id="MetaEsperadaDPAS" name="MetaEsperadaDPAS" placeholder="La meta esperada es:" required>
                </div>

                <div>
                    <label for="RangoAceptDPAS">Rango de Aceptación:</label>
                    <input type="text" id="RangoAceptDPAS" name="RangoAceptDPAS" placeholder="Ej. 90 a 100 Puntos" required>
                </div>

                <div>
                    <label for="TendenciaDeseadaDPAS">Tendencia Deseada:</label>
                    <input type="text" id="TendenciaDeseadaDPAS" name="TendenciaDeseadaDPAS" placeholder="Ej. Alcanzar la meta propuesta" required>
                </div>

                <div>
                    <hr>
                    <label>Gastos de Distribución</label><br>
                    <hr>

                    <label for="GastosTD">Gastos Totales de Distribución:</label>
                    <input type="number" id="GastosTD" name="GastosTD" placeholder="Ingrese la cantidad de gastos" required step="any">
                </div>

                <div>
                    <label for="LitrosDistribucion">Litros Distribución:</label>
                    <input type="number" id="LitrosDistribucion" name="LitrosDistribucion" placeholder="Ingrese la cantidad de litros" required step="any">
                </div>

                <div>
                    <label for="GastosDistribucion">Gastos de distribución:</label>
                    <input type="number" id="GastosDistribucion" name="GastosDistribucion" placeholder="Ingrese la cantidad" required step="any">
                </div>

                <div>
                    <label for="MetaEsperadaGD">Meta Esperada:</label>
                    <input type="text" id="MetaEsperadaGD" name="MetaEsperadaGD" placeholder="La meta esperada es:" required>
                </div>

                <div>
                    <label for="RangoAceptGD">Rango de Aceptación:</label>
                    <input type="text" id="RangoAceptGD" name="RangoAceptGD" placeholder="Ej. 90 a 100 Puntos" required>
                </div>

                <div>
                    <label for="TendenciaDeseadaGD">Tendencia Deseada:</label>
                    <input type="text" id="TendenciaDeseadaGD" name="TendenciaDeseadaGD" placeholder="Ej. Alcanzar la meta propuesta" required>
                </div>

                <div>
                    <hr>
                    <label for="Responsable">Responsable:</label>
                    <input type="text" id="Responsable" name="Responsable" placeholder="Nombre del responsable" required value="<?php echo htmlspecialchars($responsable_value); ?>">
                </div>

                <div>
                    <label for="Observ">Observaciones:</label><br><br>
                    <textarea id="Observ" name="Observ" rows="4" placeholder="Ej.  En el punto uno, tuvimos un incremento del despacho por 14000 litros" required ></textarea>
                </div>

                <hr>

                <div class="form-buttons">
                    <input type="submit" name="g" value="Guardar">
                    <input type="reset" name="b" value="Limpiar">
                </div>

            </div>
        </div>
        </form>
    </section>

    <a href="./distribucionP.php" class="home-link">
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
