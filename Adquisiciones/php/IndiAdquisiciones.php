<!DOCTYPE html>
<html lang="es">
<head>
    <title>Adquisiciones de Bienes Muebles y Servicios (10)</title> 
    <meta charset="UTF-8">
    <script src="../js/cargas.js"></script>
    <script src="../js/Indicadores.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/IndiAdquisiciones.css">
</head>

<body>

    <!-- IMÁGENES MOVIDAS FUERA DEL HEAD -->
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">

<main class="container">

    <h1>Indicadores</h1>
    <h4>Adquisiciones de Bienes Muebles y Servicios (10)</h4>
    
    <section class="registro">
        <form method="post" action="GuardarIndi.php">
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
                    <label>Cumplimiento de las Compras Realizadas</label><br>
                    <hr>

                    <label for="ExpAtend">Expedientes Completos Atendidos:</label>
                    <input type="number" id="ExpAtend" name="ExpAtend" placeholder="Ingrese la cantidad" required step="any">
                </div>

                <div>
                    <label for="ExpRecib">Expedientes Completos Recibidos:</label>
                    <input type="number" id="ExpRecib" name="ExpRecib" placeholder="Ingrese la meta" required step="any">
                </div>

                <div>
                    <label for="Cumplimiento">Cumplimiento:</label>
                    <input type="number" id="Cumplimiento" name="Cumplimiento" placeholder="Cumplimiento:" required step="any">
                </div>

                <div>
                    <label for="MetaEsperadaCCR">Meta Esperada:</label>
                    <input type="text" id="MetaEsperadaCCR" name="MetaEsperadaCCR" placeholder="La meta esperada es:" required>
                </div>

                <div>
                    <label for="RangoAceptCCR">Rango de Aceptación:</label>
                    <input type="text" id="RangoAceptCCR" name="RangoAceptCCR" placeholder="Ej. 90% a 100%" required>
                </div>

                <div>
                    <label for="TendenciaDeseadaCCR">Tendencia Deseada:</label>
                    <input type="text" id="TendenciaDeseadaCCR" name="TendenciaDeseadaCCR" placeholder="Ej. 100% , Meta Alcanzada" required>
                </div>

                <div>
                    <hr>
                    <label>Satisfacción del Cliente</label><br>
                    <hr>

                    <label for="EncuSatisfa">Encuestas Satisfactorias:</label>
                    <input type="number" id="EncuSatisfa" name="EncuSatisfa" placeholder="Ingrese la cantidad" required step="any">
                </div>

                <div>
                    <label for="EncEnvia">Número de Encuestas Enviadas en el Semestre:</label>
                    <input type="number" id="EncEnvia" name="EncEnvia" placeholder="Ingrese la meta" required step="any">
                </div>

                <div>
                    <label for="Satisfaccion">Satisfacción:</label>
                    <input type="number" id="Satisfaccion" name="Satisfaccion" placeholder="Satisfacción:" required step="any">
                </div>

                <div>
                    <label for="MetaEsperadaSC">Meta Esperada:</label>
                    <input type="text" id="MetaEsperadaSC" name="MetaEsperadaSC" placeholder="La meta esperada es:" required>
                </div>

                <div>
                    <label for="RangoAceptSC">Rango de Aceptación:</label>
                    <input type="text" id="RangoAceptSC" name="RangoAceptSC" placeholder="Ej. 90% a 100%" required>
                </div>

                <div>
                    <label for="TendenciaDeseadaSC">Tendencia Deseada:</label>
                    <input type="text" id="TendenciaDeseadaSC" name="TendenciaDeseadaSC" placeholder="Ej. 100% , Meta Alcanzada" required>
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

                <div class="form-buttons">
                    <input type="submit" name="g" value="Guardar" class="btn">
                    <input type="reset" name="b" value="Limpiar" class="btn">
                </div>

            </div> <!-- cierre faltante -->
            </div>
        </form>
    </section>

    <a href="MenuIndi.php" class="home-link">
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
