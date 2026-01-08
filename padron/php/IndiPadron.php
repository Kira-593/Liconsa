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
	<title>Administración del Padron de Beneficiarios</title> 
	<meta charset="UTF-8">
    <script src="../js/cargas.js"></script>
    <script src="../js/Indicadores.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/IndiPadron.css">
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
	<img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">	
    
</head>
<body>
<main class="container">

    <h1>Indicadores</h1>
    <h4>Administrador del Padron de Beneficiarios</h4>
    
    <section class="registro">
        <form method="post" action="GuardarIndi.php">
        <div class="registro-container">
            <div class="registro-column">
                <div>
                    <div>
                    <label for="Claveregis">Clave de Registro:</label>
                    <input type="text" id="Claveregis" name="Claveregis" value="TX-MSGC-500-01-R01" placeholder="Ingrese la Clave" required step="any">
                    </div>
                    <label for="FechaAct">Fecha de Actualización:</label>
                    <input type="date" id="FechaAct" name="FechaAct" value="2025-10-01" required>
                    <label for="Mes">Fecha de Elaboración:</label>
                    <input type="date" id="Mes" name="Mes" required>
                    <label for="Periodo">Periodo:</label>
                    <input type="date" id="Periodo" name="Periodo" required>
                    </div>
                <div>
                    <hr>
                    <label>Meta de Beneficiarios</label><br>
                    <hr>
                    <label for="NumBenefi">Numero de Beneficiarios:</label>
                    <input type="number" id="NumBenefi" name="NumBenefi" placeholder="Ingrese la cantidad" required step="any">
                </div>
                <div>
                    <label for="MetaBeneficiarios">Meta de Beneficiarios:</label>
                    <input type="number" id="MetaBeneficiarios" name="MetaBeneficiarios" placeholder="Ingrese la meta" required step="any">
                </div>
                <div>
                    <label for="MetaReal">Meta Alcanzada:</label>
                    <input type="number" id="MetaReal" name="MetaReal" placeholder="La meta real es:" required step="any">
                </div>
                 <div>
                    <label for="MetaEsperadaMB">Meta Esperada:</label>
                    <input type="text" id="MetaEsperadaMB" name="MetaEsperadaMB" placeholder="La meta esperada es:" required step="any">
                </div>
                 <div>
                    <label for="RangoAceptMB">Rango de Aceptación:</label>
                    <input type="text" id="RangoAceptMB" name="RangoAceptMB" placeholder="Ej. Cumplimiento del 93% al 99%" required step="any">
                </div>

                <div>
                    <label for="TendenciaDeseadaMB">Tendencia Deseada:</label>
                    <input type="text" id="TendenciaDeseadaMB" name="TendenciaDeseadaMB" placeholder="Ej. Cumplimiento al 100%" required step="any">
                </div>
                <div>
                    <hr>
                    <label>Factor de retiro Global Liquida</label><br>
                    <hr>
                    <label for="LitrosVendidos">Litros vendidos:</label>
                    <input type="number" id="LitrosVendidos" name="LitrosVendidos" placeholder="Ingrese la cantidad" required step="any">
                </div>
                <div>
                    <label for="NumBenefiActivos">Número de Beneficiarios Activos:</label>
                    <input type="number" id="NumBenefiActivos" name="NumBenefiActivos" placeholder="Ingrese la cantidad" required step="any">
                </div>
                <div>
                    <label for="DiasVenta">Dias de Venta:</label>
                    <input type="number" id="DiasVenta" name="DiasVenta" placeholder="Ingrese la cantidad" required step="any">
                </div>
                 <div>
                    <label for="FacRetLi">Factor de retiro Global Liquida:</label>
                    <input type="number" id="FacRetLi" name="FacRetLi" placeholder="Ingrese la cantidad" required step="any">
                </div>
                <div>
                    <label for="MetaEsperadaFRL">Meta Esperada:</label>
                    <input type="text" id="MetaEsperadaFRL" name="MetaEsperadaFRL" placeholder="La meta esperada es:" required step="any">
                </div>
                 <div>
                    <label for="RangoAceptFRL">Rango de Aceptación:</label>
                    <input type="text" id="RangoAceptFRL" name="RangoAceptFRL" placeholder="Ej. Cumplimiento del 93% al 99%" required>
                </div>

                <div>
                    <label for="TendenciaDeseadaFRL">Tendencia Deseada:</label>
                    <input type="text" id="TendenciaDeseadaFRL" name="TendenciaDeseadaFRL" placeholder="Ej. Cumplimiento al 100%" required>
                </div>
                <div>
                    <hr>
                    <label>Factor de retiro Global polvo</label><br>
                    <hr>
                    <label for="LitrosVendidosPol">Litros vendidos:</label>
                    <input type="number" id="LitrosVendidosPol" name="LitrosVendidosPol" placeholder="Ingrese la cantidad" required step="any">
                </div>
                <div>
                    <label for="NumBenefiActivosPol">Número de Beneficiarios Activos:</label>
                    <input type="number" id="NumBenefiActivosPol" name="NumBenefiActivosPol" placeholder="Ingrese la cantidad" required step="any">
                </div>
                <div>
                    <label for="DiasVentaPol">Dias de Venta:</label>
                    <input type="number" id="DiasVentaPol" name="DiasVentaPol" placeholder="Ingrese la cantidad" required step="any">
                </div>
                <div>
                    <label for="FacRetPol">Factor de retiro Global Polvo:</label>
                    <input type="number" id="FacRetPol" name="FacRetPol" placeholder="Ingrese la cantidad" required step="any">
                </div>
                <div>
                    <label for="MetaEsperadaFRP">Meta Esperada:</label>
                    <input type="text" id="MetaEsperadaFRP" name="MetaEsperadaFRP" placeholder="La meta esperada es:" required step="any">
                </div>
                 <div>
                    <label for="RangoAceptFRP">Rango de Aceptación:</label>
                    <input type="text" id="RangoAceptFRP" name="RangoAceptFRP" placeholder="Ej. Cumplimiento del 93% al 99%" required>
                </div>

                <div>
                    <label for="TendenciaDeseadaFRP">Tendencia Deseada:</label>
                    <input type="text" id="TendenciaDeseadaFRP" name="TendenciaDeseadaFRP" placeholder="Ej. Cumplimiento al 100%" required>
                </div>
                <div>
                    <hr>
                    <label>Tarjetas no Entregadas</label><br>
                    <hr>
                    <label for="TNE">Número de Tarjetas no Entregadas:</label>
                    <input type="number" id="TNE" name="TNE" placeholder="Ingrese la cantidad" required step="any">
                </div>
                <div>
                    <label for="FamiliasInscritas">Número de Familias Inscritas en el Padron:</label>
                    <input type="number" id="FamiliasInscritas" name="FamiliasInscritas" placeholder="Ingrese la cantidad" required step="any">
                </div>
                <div>
                    <label for="PorcentajeTNE"> Porcentaje de Tarjetas no Entregadas:</label>
                    <input type="number" id="PorcentajeTNE" name="PorcentajeTNE" placeholder="Ingrese la cantidad" required step="any">
                </div>
                <div>
                    <label for="MetaEsperadaTNE">Meta Esperada:</label>
                    <input type="text" id="MetaEsperadaTNE" name="MetaEsperadaTNE" placeholder="La meta esperada es:" required step="any" >
                </div>
                 <div>
                    <label for="RangoAceptTNE">Rango de Aceptación:</label>
                    <input type="text" id="RangoAceptTNE" name="RangoAceptTNE" placeholder="Ej. Cumplimiento del 93% al 99%" required>
                </div>

                <div>
                    <label for="TendenciaDeseadaTNE">Tendencia Deseada:</label>
                    <input type="text" id="TendenciaDeseadaTNE" name="TendenciaDeseadaTNE" placeholder="Ej. Cumplimiento al 100%" required>
                </div>
                <div>
                    <hr>
                    <label>Atencion a Quejas</label><br>
                    <hr>
                    <label for="QuejasRecibidas">Quejas  Recibidas:</label>
                    <input type="number" id="QuejasRecibidas" name="QuejasRecibidas" placeholder="Ingrese la cantidad" required step="any">
                </div>
                <div>
                    <label for="QuejasAtendidas">Quejas Atendidas:</label>
                    <input type="number" id="QuejasAtendidas" name="QuejasAtendidas" placeholder="Ingrese la cantidad" required step="any">
                </div>
                   <div>
                    <label for="PQNA">Porcentaje de Quejas Atendidas:</label>
                    <input type="number" id="PQNA" name="PQNA" placeholder="Ingrese la cantidad" required step="any">
                </div>
                <div>
                    <label for="MetaEsperadaAQ">Meta Esperada:</label>
                    <input type="text" id="MetaEsperadaAQ" name="MetaEsperadaAQ" placeholder="La meta esperada es:" required step="any">
                </div>
                 <div>
                    <label for="RangoAceptAQ">Rango de Aceptación:</label>
                    <input type="text" id="RangoAceptAQ" name="RangoAceptAQ" placeholder="Ej. Cumplimiento del 93% al 99%" required>
                </div>

                <div>
                    <label for="TendenciaDeseadaAQ">Tendencia Deseada:</label>
                    <input type="text" id="TendenciaDeseadaAQ" name="TendenciaDeseadaAQ" placeholder="Ej. Cumplimiento al 100%" required>
                </div>
                 <div>
                    <hr>
                    <label>Encuesta de Satisfacción al Cliente</label><br>
                    <hr>
                    <label for="TotalEncues">Total de Encuestas:</label>
                    <input type="number" id="TotalEncues" name="TotalEncues" placeholder="Ingrese la cantidad" required step="any">
                </div>
                <div>
                    <label for="MaxPuntos">Maximo de puntos:</label>
                    <input type="number" id="MaxPuntos" name="MaxPuntos" placeholder="Ingrese la cantidad" required step="any">
                </div>
                 <div>
                    <label for="TPTE">Total de puntos del Total de Encuestas:</label>
                    <input type="number" id="TPTE" name="TPTE" placeholder="Ingrese la cantidad" required step="any">
                </div>
                <div>
                    <label for="PorcentajeEncuestas"> Porcentaje de Encuestas de Satisfacción:</label>
                    <input type="number" id="PorcentajeEncuestas" name="PorcentajeEncuestas" placeholder="Ingrese la cantidad" required step="any">
                </div>
                <div>
                    <label for="MetaEsperadaES">Meta Esperada:</label>
                    <input type="text" id="MetaEsperadaES" name="MetaEsperadaES" placeholder="La meta esperada es:" required step="any">
                </div>
                 <div>
                    <label for="RangoAceptES">Rango de Aceptación:</label>
                    <input type="text" id="RangoAceptES" name="RangoAceptES" placeholder="Ej. Cumplimiento del 93% al 99%" required>
                </div>

                <div>
                    <label for="TendenciaDeseadaES">Tendencia Deseada:</label>
                    <input type="text" id="TendenciaDeseadaES" name="TendenciaDeseadaES" placeholder="Ej. Cumplimiento al 100%" required>
                </div>
                
                <div>
                <hr>
                    <label for="Responsable">Responsable:</label>
                    <input type="text" id="Responsable" name="Responsable" placeholder="Nombre del responsable" required value="<?php echo htmlspecialchars($responsable_value); ?>">
                </div>
               <div>
                    <label for="Fuente">Fuente:</label><br><br>
                    <textarea id="Fuente" name="Fuente" rows="4" placeholder="Ej. La Facturación Disminuyó 5.25% al cierre del mes" required ></textarea>
                </div>

                <hr>
    
            <div class="form-buttons">


                <input type="submit" name="g" class="btn" value="Guardar">
                <input type="reset" name="b" class="btn" value="Limpiar">
            </div>
        </form>
    </section>

    <a href="MenuIndi.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90">
    </a>
</main>

<script>
    // Convertir automáticamente a mayúsculas en el campo "Clave de Registro"
    (function() {
        function enableUppercase(id) {
            var el = document.getElementById(id);
            if (!el) return;
            el.addEventListener('input', function() {
                var start = this.selectionStart;
                var end = this.selectionEnd;
                this.value = this.value.toUpperCase();
                // intentar restaurar la posición del cursor
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