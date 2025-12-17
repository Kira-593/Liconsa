<!DOCTYPE html>
<html lang="es">
<head>
    <title>Gestion del Ambiente de trabajo y de las Competencias de Personal</title> 
    <meta charset="UTF-8">
    <script src="../js/cargas.js"></script>
    <script src="../js/IndicadoresDa.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/IndiGestionDa.css">
</head>

<body>

<!-- IMÁGENES MOVIDAS FUERA DEL HEAD -->
<img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
<img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">

<main class="container">

    <h1>Indicadores</h1>
    <h4>Gestion del Ambiente de trabajo y de las Competencias de Personal</h4>
    
    <section class="registro">
        <form method="post" action="GuardarIndiDa.php">

        <div class="registro-container">
        <div class="registro-column">

            <div>
                <label for="Claveregis">Clave de Registro:</label>
                <input type="text" id="Claveregis" name="Claveregis" placeholder="Ingrese la Clave" required>

                <label for="Mes">Fecha de Elaboración:</label>
                <input type="date" id="Mes" name="Mes" required>

                <label for="Periodo">Periodo:</label>
                <input type="date" id="Periodo" name="Periodo" required>
            </div>

            <div>
                <hr>
                <label>Ambiente de trabajo  "Reporte de inspección de Órden seguridad y Limpieza en Areas de Servicio"</label><br>
                <hr>

                <label for="NoSatis">No. de Satisfacciones:</label>
                <input type="number" id="NoSatis" name="NoSatis" placeholder="Ingrese la cantidad" required step="any">
            </div>

            <div>
                <label for="NoPuntos">No. de Puntos:</label>
                <input type="number" id="NoPuntos" name="NoPuntos" placeholder="Ingrese la cantidad" required step="any">
            </div>

            <div>
                <label for="DndSat">Donde la Satisfacción es Equivalente a:</label>
                <input type="number" id="DndSat" name="DndSat" placeholder="%" required step="any">
            </div>

            <div>
                <label for="MetaEsperadaRIO">Meta Esperada:</label>
                <input type="text" id="MetaEsperadaRIO" name="MetaEsperadaRIO" placeholder="La meta esperada es:" required>
            </div>

            <div>
                <label for="RangoAceptRIO">Rango de Aceptación:</label>
                <input type="text" id="RangoAceptRIO" name="RangoAceptRIO" placeholder="Ej. MIN=95% MAX=100%" required>
            </div>

            <div>
                <label for="TendenciaDeseadaRIO">Tendencia Deseada:</label>
                <textarea id="TendenciaDeseadaRIO" name="TendenciaDeseadaRIO" placeholder="Tendencia deseada:" required></textarea>
            </div>

            <div>
                <hr>
                <label>Ambiente de Trabajo "Uniformes de Trabajo y Equipo de Protección de Personal Operativo"</label><br>
                <hr>

                <label for="NoSatisUnif">No. de Satisfacciones:</label>
                <input type="number" id="NoSatisUnif" name="NoSatisUnif" placeholder="Ingrese la cantidad" required step="any">
            </div>

            <div>
                <label for="NoPuntosUnif">No. de Puntos:</label>
                <input type="number" id="NoPuntosUnif" name="NoPuntosUnif" placeholder="Ingrese la cantidad" required step="any">
            </div>

            <div>
                <label for="DndSatUnif">Donde la Satisfacción es Equivalente a:</label>
                <input type="number" id="DndSatUnif" name="DndSatUnif" placeholder="%" required step="any">
            </div>

            <div>
                <label for="MetaEsperadaUTE">Meta Esperada:</label>
                <input type="text" id="MetaEsperadaUTE" name="MetaEsperadaUTE" placeholder="La meta esperada es:" required>
            </div>

            <div>
                <label for="RangoAceptUTE">Rango de Aceptación:</label>
                <input type="text" id="RangoAceptUTE" name="RangoAceptUTE" placeholder="Ej. MIN=95% MAX=100%" required>
            </div>

            <div>
                <label for="TendenciaDeseadaUTE">Tendencia Deseada:</label>
                <textarea id="TendenciaDeseadaUTE" name="TendenciaDeseadaUTE" placeholder="Tendencia deseada:" required></textarea>
            </div>

            <div>
                <hr>
                <label>Accidentes e Incidentes por Riesgo de Trabajo</label><br>
                <hr>

                <label for="CantAcci">Cantidad de Accidentes:</label>
                <input type="number" id="CantAcci" name="CantAcci" placeholder="Ingrese la cantidad" required step="any">
            </div>

            <div>
                <label for="DiasLaborados">Dias Laborados:</label>
                <input type="number" id="DiasLaborados" name="DiasLaborados" placeholder="Ingrese la cantidad" required step="any">
            </div>

            <div>
                <label for="Frecuencia">Frecuencia:</label>
                <input type="number" id="Frecuencia" name="Frecuencia" placeholder="Frecuencia" required step="any">
            </div>

            <div>
                <label for="MetaEsperadaAIR">Meta Esperada:</label>
                <input type="text" id="MetaEsperadaAIR" name="MetaEsperadaAIR" placeholder="La meta esperada es:" required>
            </div>

            <div>
                <label for="RangoAceptAIR">Rango de Aceptación:</label>
                <input type="text" id="RangoAceptAIR" name="RangoAceptAIR" placeholder="Ej. Minimo NO APLICA" required>
            </div>

            <div>
                <label for="TendenciaDeseadaAIR">Tendencia Deseada:</label>
                <textarea id="TendenciaDeseadaAIR" name="TendenciaDeseadaAIR" placeholder="Tendencia deseada:" required></textarea>
            </div>

            <div>
                <hr>
                <label>Actos y Condiciones Inseguras</label><br>
                <hr>

                <label for="CantActCondInseg">Actos y/o Condiciones Inseguras Reportadas en el Mes:</label>
                <input type="number" id="CantActCondInseg" name="CantActCondInseg" placeholder="Ingrese la cantidad" required step="any">
            </div>

            <div>
                <label for="MetaEsperadaACI">Meta Esperada:</label>
                <input type="text" id="MetaEsperadaACI" name="MetaEsperadaACI" placeholder="La meta esperada es:" required>
            </div>

            <div>
                <label for="RangoAceptACI">Rango de Aceptación:</label>
                <input type="text" id="RangoAceptACI" name="RangoAceptACI" placeholder="Ej. Minimo NO APLICA" required>
            </div>

            <div>
                <label for="TendenciaDeseadaACI">Tendencia Deseada:</label>
                <textarea id="TendenciaDeseadaACI" name="TendenciaDeseadaACI" placeholder="Tendencia deseada:" required></textarea>
            </div>

            <div>
                <hr>
                <label for="Responsable">Responsable:</label>
                <input type="text" id="Responsable" name="Responsable" placeholder="Nombre del responsable" required>
            </div>

            <!-- CORRECCIÓN: for e id deben coincidir -->
            <div>
                <label for="ObservacionesRes">Fuente:</label><br><br>
                <textarea id="ObservacionesRes" name="ObservacionesRes" rows="4" placeholder="Fuente" required></textarea>
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

    <a href="MenuIndiDa.php" class="home-link">
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
