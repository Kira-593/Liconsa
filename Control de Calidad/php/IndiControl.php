<!DOCTYPE html>
<html lang="es">
<head>
    <title>Control de Calidad</title>
    <meta charset="UTF-8">

    <script src="../js/cargas.js"></script>
    <script src="../js/Indicadores.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
          rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
          crossorigin="anonymous">

    <link rel="stylesheet" href="../css/IndiControl.css">
</head>

<body>

    <!-- IMÁGENES (corregido: ya no están en el head) -->
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">

    <main class="container">
        <h1>Indicadores</h1>
        <h4>Control de Calidad</h4>
        
        <section class="registro">
            <form method="post" action="GuardarPDC.php">

                <div class="registro-container">

                    <div class="registro-column">

                        <div>
                            <label for="Claveregis">Clave de Registro:</label>
                            <input type="text" id="Claveregis" name="Claveregis" placeholder="Ingrese la clave" required>

                            <label for="Mes">Fecha de Elaboración:</label>
                            <input type="date" id="Mes" name="Mes" required>

                            <label for="Periodo">Periodo:</label>
                            <input type="date" id="Periodo" name="Periodo" required>
                        </div>

                        <div>
                            <hr>
                            <label>Calibración Externa de los Equipos del Laboratorio</label><br>
                            <hr>

                            <label for="NumEquiposAtendidos">Número de Equipos Atendidos:</label>
                            <input type="number" id="NumEquiposAtendidos" name="NumEquiposAtendidos" placeholder="Ingrese la cantidad" required step="any">
                        </div>

                        <div>
                            <label for="NumEquiposProgramados">Número de Equipos Programados:</label>
                            <input type="number" id="NumEquiposProgramados" name="NumEquiposProgramados" placeholder="Ingrese la meta" required step="any">
                        </div>

                        <div>
                            <label for="CalibracionEquipos">Calibración de Equipos:</label>
                            <input type="number" id="CalibracionEquipos" name="CalibracionEquipos" placeholder="Calibración de Equipos:" required step="any">
                        </div>

                        <div>
                            <label for="MetaEsperadaCEE">Meta Esperada:</label>
                            <input type="text" id="MetaEsperadaCEE" name="MetaEsperadaCEE" placeholder="La meta esperada es:" required step="any">
                        </div>

                        <div>
                            <label for="RangoAceptCEE">Rango de Aceptación:</label>
                            <input type="text" id="RangoAceptCEE" name="RangoAceptCEE" placeholder="Ej. 100%" required step="any">
                        </div>

                        <div>
                            <label for="TendenciaDeseadaCEE">Tendencia Deseada:</label>
                            <input type="text" id="TendenciaDeseadaCEE" name="TendenciaDeseadaCEE" placeholder="Ej. Cumplir al 100% con el Cronograma para el mantenimiento y calibración externa de equipos" required>
                        </div>

                        <div>
                            <hr>
                            <label>Inspección de Áreas de Producción, Almacén y Control de Calidad en la Gerencia Estatal de Tlaxcala</label><br>
                            <hr>

                            <label for="NumObservaciones">Número de Observaciones:</label>
                            <input type="number" id="NumObservaciones" name="NumObservaciones" placeholder="Ingrese la cantidad" required step="any">
                        </div>

                        <div>
                            <label for="NumPuntosEvaluados">Número de Puntos Evaluados:</label>
                            <input type="number" id="NumPuntosEvaluados" name="NumPuntosEvaluados" placeholder="Ingrese la meta" required step="any">
                        </div>

                        <div>
                            <label for="CumplimientoPuntosEvaluados">Cumplimiento de los Puntos Evaluados:</label>
                            <input type="number" id="CumplimientoPuntosEvaluados" name="CumplimientoPuntosEvaluados" placeholder="Los Puntos son:" required step="any">
                        </div>

                        <div>
                            <label for="MetaEsperadaIAP">Meta Esperada:</label>
                            <input type="text" id="MetaEsperadaIAP" name="MetaEsperadaIAP" placeholder="La meta esperada es:" required step="any">
                        </div>

                        <div>
                            <label for="RangoAceptIAP">Rango de Aceptación:</label>
                            <input type="text" id="RangoAceptIAP" name="RangoAceptIAP" placeholder="Ej. 98 al 100%" required step="any">
                        </div>

                        <div>
                            <label for="TendenciaDeseadaIAP">Tendencia Deseada:</label>
                            <input type="text" id="TendenciaDeseadaIAP" name="TendenciaDeseadaIAP" placeholder="Llegar al 100% del Cumplimiento de los puntos evaluados" required>
                        </div>

                        <div>
                            <hr>
                            <label for="Responsable">Responsable:</label>
                            <input type="text" id="Responsable" name="Responsable" placeholder="Nombre del responsable" required>
                        </div>

                        <div>
                            <label for="ObservacionesRes">Fuente:</label><br><br>
                            <textarea id="ObservacionesRes" name="ObservacionesRes" rows="4" placeholder="Fuente" required></textarea>
                        </div>

                        <hr>

                    </div> <!-- cierre de registro-column -->

                </div> <!-- cierre de registro-container -->

                <div class="form-buttons">
                    <input type="submit" name="g" value="Guardar">
                    <input type="reset" name="b" value="Limpiar">
                </div>

            </form>
        </section>

        <a href="./ControlP.php" class="home-link">
            <img src="../imagenes/home.png" height="100" width="90">
        </a>

    </main>

    <script>
        // Convertir automáticamente a mayúsculas
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
