<!DOCTYPE html>
<html lang="es">
<head>
	<title>Hoja de Proceso de Almacén</title> 
	<meta charset="UTF-8">
    <script src="../js/cargas.js"></script>
    <script src="../js/Indicadores.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/IndiAlmacen.css">
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
	<img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">	
    
</head>
<body>
<main class="container">

    <h1>Indicadores</h1>
    <h4>Hoja de proceso de Almacén</h4>
    
    <section class="registro">
        <form method="post" action="GuardarIndi.php">
        <div class="registro-container">
            <div class="registro-column">
                <div>
                    <div>
                    <label for="Claveregis">Clave de Registro:</label>
                    <input type="text" id="Claveregis" name="Claveregis" placeholder="Ingrese la Clave" required step="any">
                    </div>
                    <label for="Mes">Fecha de Elaboración:</label>
                    <input type="date" id="Mes" name="Mes" required>
                    <label for="Periodo">Periodo:</label>
                    <input type="date" id="Periodo" name="Periodo" required>
                    </div>
                <div>
                    <hr>
                    <label>Satisfacción de Nuestros Clientes</label><br>
                    <hr>
                    <label for="SumEn">Sumatoria de la calificación de Encuesta de Satisfacción de Nuestros clientes:</label>
                    <input type="number" id="SumEn" name="SumEn" placeholder="Ingrese la cantidad" required step="any">
                </div>
                <div>
                    <label for="NumEncuestas">Numero de Encuestas:</label>
                    <input type="number" id="NumEncuestas" name="NumEncuestas" placeholder="Ingrese la meta" required step="any">
                </div>
                <div>
                    <label for="PuntosSatisfaccion">Puntos de satisfaccion:</label>
                    <input type="number" id="PuntosSatisfaccion" name="PuntosSatisfaccion" placeholder="Los Puntos son:" required step="any">
                </div>
                 <div>
                    <label for="MetaEsperadaMB">Meta Esperada:</label>
                    <input type="text" id="MetaEsperadaMB" name="MetaEsperadaMB" placeholder="La meta esperada es:" required step="any">
                </div>
                 <div>
                    <label for="RangoAceptMB">Rango de Aceptación:</label>
                    <input type="text" id="RangoAceptMB" name="RangoAceptMB" placeholder="Ej. 90 a 100 Puntos" required step="any">
                </div>

                <div>
                    <label for="TendenciaDeseadaMB">Tendencia Deseada:</label>
                    <input type="text" id="TendenciaDeseadaMB" name="TendenciaDeseadaMB" placeholder="Ej. 100 puntos , Meta Alcanzada" required step="any">
                </div>
                
                
                <div>
                <hr>
                    <label for="Responsable">Responsable:</label>
                    <input type="text" id="Responsable" name="Responsable" placeholder="Nombre del responsable" required>
                </div>
            
                <div>
                    <label for="Fuente">Fuente:</label><br><br>
                    <textarea id="Fuente" name="Fuente" rows="4" placeholder="Ej. La Facturación Disminuyó 5.25% al cierre del mes" required ></textarea>
                </div>
                <hr>



                    
            <div class="form-buttons">
                <input type="submit" name="g" value="Guardar">
                <input type="reset" name="b" value="Limpiar">
            </div>
        </form>
    </section>
    <a href="./AlmacenP.php" class="home-link">
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