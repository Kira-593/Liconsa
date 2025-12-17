<!DOCTYPE html>
<html lang="es">
<head>
    <title>Recursos Financieros</title> 
    <meta charset="UTF-8">
    <script src="../js/cargas.js"></script>
    <script src="../js/Indicadores.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/IndiRecursos.css">
</head>

<body>

    <!-- MOVIDO FUERA DEL HEAD -->
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">

<main class="container">

    <h1>Indicadores</h1>
    <h4>Recursos Financieros</h4>
    
    <section class="registro">
        <form method="post" action="GuardarIndi.php">
            <div class="registro-container">
                <div class="registro-column">

                    <div>
                        <label for="Claveregis">Clave de Registro:</label>
                        <input type="text" id="Claveregis" name="Claveregis" placeholder="Ingrese la cantidad" required>

                        <label for="Mes">Fecha de Elaboración:</label>
                        <input type="date" id="Mes" name="Mes" required>

                        <label for="Periodo">Periodo:</label>
                        <input type="date" id="Periodo" name="Periodo" required>
                    </div>

                    <div>
                        <hr>
                        <label>Suficiencia Presupuestal</label><br>
                        <hr>

                        <label for="ExpedinAut">Numero de Expendientes de Sufuciencia Presupuestal Autorizados:</label>
                        <input type="number" id="ExpedinAut" name="ExpedinAut" placeholder="Ingrese la cantidad" required step="any">
                    </div>

                    <div>
                        <label for="ExpendiReci">Numero de Expendientes de Sificiencia Presupuestal Recibidos:</label>
                        <input type="number" id="ExpendiReci" name="ExpendiReci" placeholder="Ingrese la cantidad" required step="any">
                    </div>

                    <div>
                        <label for="PorcentajeExpAut">Porcentaje de Expendientes Autorizados:</label>
                        <input type="number" id="PorcentajeExpAut" name="PorcentajeExpAut" placeholder="Ingrese el porcentaje" required step="any">
                    </div>

                    <div>
                        <label for="MetaEsperadaMB">Meta Esperada:</label>
                        <textarea id="MetaEsperadaMB" name="MetaEsperadaMB" placeholder="La meta esperada es:" required></textarea>
                    </div>

                    <div>
                        <label for="RangoAceptMB">Rango de Aceptación:</label>
                        <input type="text" id="RangoAceptMB" name="RangoAceptMB" placeholder="Ej. 70% de expedientes autorizados" required>
                    </div>

                    <div>
                        <label for="TendenciaDeseadaMB">Tendencia Deseada:</label>
                        <input type="text" id="TendenciaDeseadaMB" name="TendenciaDeseadaMB" placeholder="Ej. 100 puntos , Meta Alcanzada" required>
                    </div>

                    <div>
                        <hr>
                        <label for="Responsable">Responsable:</label>
                        <input type="text" id="Responsable" name="Responsable" placeholder="Nombre del responsable" required>
                    </div>

                    <div>
                        <label for="Fuente">Fuente:</label><br><br>
                        <textarea id="Fuente" name="Fuente" rows="4" placeholder="" required></textarea>
                    </div>

                    <hr>

                    <div class="form-buttons">
                        <input type="submit" name="g" value="Guardar" class="btn">
                        <input type="reset" name="b" value="Limpiar" class="btn">
                    </div>

                </div>
            </div>
        </form>
    </section>

    <a href="./RecursosP.php" class="home-link">
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
