    <!DOCTYPE html>
    <html lang="es">
    <head>
        <title>Envasado</title> 
        <meta charset="UTF-8">
        <script src="../js/cargas.js"></script>
        <script src="../js/Indicadores.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/IndiEnvas.css">
    </head>

    <body>

    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">

    <main class="container">

        <h1>Indicadores</h1>
        <h4>Envasado</h4>
        
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
                        <label>Calidad de leche Reconstruida (VOLUMEN) Abasto y Frisia</label><br>
                        <hr>

                        <label for="RepAbasto">Reporte Mensual de Control de Calidad de Leche Pasteurizada ABASTO:</label>
                        <input type="number" id="RepAbasto" name="RepAbasto" placeholder="Ingrese la cantidad" required step="any">
                    </div>

                    <div>
                        <label for="RepFrisia">Reporte Mensual de Control de Calidad de Leche Pasteurizada FRISIA:</label>
                        <input type="number" id="RepFrisia" name="RepFrisia" placeholder="Ingrese la cantidad" required step="any">
                    </div>

                    <div>
                        <label for="MetaEsperadaMB">Meta Esperada:</label>
                        <textarea id="MetaEsperadaMB" name="MetaEsperadaMB" placeholder="La meta esperada es:" required></textarea>
                    </div>

                    <div>
                        <label for="RangoAcept">Rango de Aceptación:</label>
                        <textarea id="RangoAcept" name="RangoAcept" placeholder="Ej. Volumen de Abasto: 2000 ml minimo, 2005 ml maximo" required></textarea>
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
                        <label for="ObservacionesRes">Fuente:</label><br><br>
                        <textarea id="ObservacionesRes" name="ObservacionesRes" rows="4" placeholder="Reporte mensual de produccion, reporte de leche pasteurizada de control de calidad." required></textarea>
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

        <a href="./EnvasadoP.php" class="home-link">
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
