<!DOCTYPE html>
<html lang="es">
<head>
	<title>Hoja de Proceso de Almacén</title> 
	<meta charset="UTF-8">
    <script src="../js/cargas.js"></script>
    <script src="../js/Indicadores.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/IndiMantenimiento.css">
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
	<img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">	
    
</head>
<body>
<main class="container">

    <h1>Indicadores</h1>
    <h4>Mantenimiento, Instalaciones y equipo de Planta</h4>
    
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
                    <label>Gatos de Operación</label><br>
                    <hr>
                    <label for="PresEje">Presupuesto Ejercido:</label>
                    <input type="number" id="PresEje" name="PresEje" placeholder="Ingrese la cantidad" required step="any">
                </div>
                
                <label>Menor ó Igual Al</label>
            
                <div>
                    <label for="GastoAutorizado">Gasto Autorizado:</label>
                    <input type="number" id="GastoAutorizado" name="GastoAutorizado" placeholder="Ingrese la meta" required step="any">
                </div>
                <div>
                    <label for="Diferiencia">Diferencia:</label>
                    <input type="number" id="Diferiencia" name="Diferiencia" placeholder="Los Puntos son:" required step="any">
                </div>
                 <div>
                    <label for="MetaEsperadaGO">Meta Esperada:</label>
                    <input type="text" id="MetaEsperadaGO" name="MetaEsperadaGO" placeholder="La meta esperada es:" required step="any">
                </div>
                 <div>
                    <label for="RangoAceptGO">Rango de Aceptación:</label>
                    <input type="text" id="RangoAceptGO" name="RangoAceptGO" placeholder="Ej. Max el gasto autorizado" required step="any">
                </div>

                <div>
                    <label for="TendenciaDeseadaGO">Tendencia Deseada:</label>
                    <input type="text" id="TendenciaDeseadaGO" name="TendenciaDeseadaGO" placeholder="Ej. No Rebasar el Gasto Autorizado" required step="any">
                </div>

                 <div>
                    <hr>
                    <label>Disponibilidad de Equipo Para la Producción, Envasado y ReHidratado</label><br>
                    <hr>
                    <label for="HorasHombre"> Total de Horas Hombre Disponible:</label>
                    <input type="number" id="HorasHombre" name="HorasHombre" placeholder="Ingrese la cantidad" required step="any">
                </div>
                <div>
                    <label for="HorasParo">Horas de paro:</label>
                    <input type="number" id="HorasParo" name="HorasParo" placeholder="Ingrese la meta" required step="any">
                </div>
                    <div>
                    <label for="HorasDisponibles">Total de Horas Disponibles:</label>
                    <input type="number" id="HorasDisponibles" name="HorasDisponibles" placeholder="Ingrese la meta" required step="any">
                </div>
                <div>
                    <label for="prc">Porcentaje de Disponibilidad del Equipo:</label>
                    <input type="number" id="prc" name="prc" placeholder="%" required step="any">
                </div>
                 <div>
                    <label for="MetaEsperadaDEP">Meta Esperada:</label>
                    <input type="text" id="MetaEsperadaDEP" name="MetaEsperadaDEP" placeholder="La meta esperada es:" required step="any">
                </div>
                 <div>
                    <label for="RangoAceptDEP">Rango de Aceptación:</label>
                    <input type="text" id="RangoAceptDEP" name="RangoAceptDEP" placeholder="Ej. 99.50-100%" required step="any">
                </div>

                <div>
                    <label for="TendenciaDeseadaDEP">Tendencia Deseada:</label>
                    <input type="text" id="TendenciaDeseadaDEP" name="TendenciaDeseadaDEP" placeholder="Ej. 100%" required step="any">
                </div>
                 <div>
                    <hr>
                    <label>Trabajos Preventivos</label><br>
                    <hr>
                    <label for="TPE">Trabajos Programados Ejecutados:</label>
                    <input type="number" id="TPE" name="TPE" placeholder="Ingrese la cantidad" required step="any">
                </div>
                <div>
                    <label for="TP">Trabajos Programados:</label>
                    <input type="number" id="TP" name="TP" placeholder="Ingrese la meta" required step="any">
                </div>
                    <div>
                    <label for="PorcentTP">Porcentaje de Trabajos  Preventivos:</label>
                    <input type="number" id="PorcentTP" name="PorcentTP" placeholder="%" required step="any">
                </div>

                 <div>
                    <label for="MetaEsperadaTP">Meta Esperada:</label>
                    <input type="text" id="MetaEsperadaTP" name="MetaEsperadaTP" placeholder="La meta esperada es:" required step="any">
                </div>
                 <div>
                    <label for="RangoAceptTP">Rango de Aceptación:</label>
                    <input type="text" id="RangoAceptTP" name="RangoAceptTP" placeholder="Ej. 99.50-100%" required step="any">
                </div>

                <div>
                    <label for="TendenciaDeseadaTP">Tendencia Deseada:</label>
                    <input type="text" id="TendenciaDeseadaTP" name="TendenciaDeseadaTP" placeholder="Ej. 100%" required step="any">
                </div>
                <div>
                    <hr>
                    <label>Trabajos Correctivos</label><br>
                    <hr>
                    <label for="TC">Trabajos correctivos realizados:</label>
                    <input type="number" id="TC" name="TC" placeholder="Ingrese la cantidad" required step="any">
                </div>
                    <div>
                    <label for="PorcentTC">Porcentaje de Trabajos  Correctivos:</label>
                    <input type="number" id="PorcentTC" name="PorcentTC" placeholder="%" required step="any">
                </div>

                 <div>
                    <label for="MetaEsperadaTC">Meta Esperada:</label>
                    <input type="text" id="MetaEsperadaTC" name="MetaEsperadaTC" placeholder="La meta esperada es:" required step="any">
                </div>
                 <div>
                    <label for="RangoAceptTC">Rango de Aceptación:</label>
                    <input type="text" id="RangoAceptTC" name="RangoAceptTC" placeholder="Ej. 0 - 0.15%" required step="any">
                </div>

                <div>
                    <label for="TendenciaDeseadaTC">Tendencia Deseada:</label>
                    <input type="text" id="TendenciaDeseadaTC" name="TendenciaDeseadaTC" placeholder="Ej. 0%" required step="any">
                </div>
                <div>
                    <hr>
                    <label>Consumo Térmico</label><br>
                    <hr>
                    <label for="ConsumoTermico">Consumo Térmico (litros):</label>
                    <input type="number" id="ConsumoTermico" name="ConsumoTermico" placeholder="Ingrese la cantidad en Litros" required step="any">
                </div>
                <div>
                    <label for="LitrosLecheProducidatermica">Litros de Leche Producida:</label>
                    <input type="number" id="LitrosLecheProducidatermica" name="LitrosLecheProducidatermica" placeholder="Ingrese la cantidad en Litros" required step="any">
                </div>
                <div>
                    <label for="ConsTT">Consumo Total Térmico:</label>
                    <input type="number" id="ConsTT" name="ConsTT" placeholder="Ingrese la cantidad en Litros" required step="any">
                </div>

                 <div>
                    <label for="MetaEsperadaCT">Meta Esperada:</label>
                    <input type="text" id="MetaEsperadaCT" name="MetaEsperadaCT" placeholder="1.8500 litros de agua / Litro de leche" required step="any">
                </div>
                 <div>
                    <label for="RangoAceptCT">Rango de Aceptación:</label>
                    <input type="text" id="RangoAceptCT" name="RangoAceptCT" placeholder="Ej. Maximo 1.85" required step="any">
                </div>

                <div>
                    <label for="TendenciaDeseadaCT">Tendencia Deseada:</label>
                    <input type="text" id="TendenciaDeseadaCT" name="TendenciaDeseadaCT" placeholder="Ej. Max 1.85" required step="any">
                </div>
                <div>
                    <hr>
                    <label>Consumo de Agua</label><br>
                    <hr>
                    <label for="ConsumoAgua">Consumo de Agua (litros):</label>
                    <input type="number" id="ConsumoAgua" name="ConsumoAgua" placeholder="Ingrese la cantidad en Litros" required step="any">
                </div>
                <div>
                    <label for="LitrosLecheProducida">Litros de Leche Producida:</label>
                    <input type="number" id="LitrosLecheProducida" name="LitrosLecheProducida" placeholder="Ingrese la cantidad en Litros" required step="any">
                </div>
                <div>
                    <label for="ConsTA">Consumo Total de Agua:</label>
                    <input type="number" id="ConsTA" name="ConsTA" placeholder="Ingrese la cantidad en Litros" required step="any">
                </div>

                 <div>
                    <label for="MetaEsperadaCA">Meta Esperada:</label>
                    <input type="text" id="MetaEsperadaCA" name="MetaEsperadaCA" placeholder="1.8500 litros de agua / Litro de leche" required step="any">
                </div>
                 <div>
                    <label for="RangoAceptCA">Rango de Aceptación:</label>
                    <input type="text" id="RangoAceptCA" name="RangoAceptCA" placeholder="Ej. Maximo 1.85" required step="any">
                </div>
                <div>
                    <label for="TendenciaDeseadaCA">Tendencia Deseada:</label>
                    <input type="text" id="TendenciaDeseadaCA" name="TendenciaDeseadaCA" placeholder="Ej. Max 1.85" required step="any">
                </div>

                <div>
                    <hr>
                    <label>Consumo Eléctrico</label><br>
                    <hr>
                    <label for="ConsumoElectrico">Consumo Eléctrico (kWh):</label>
                    <input type="number" id="ConsumoElectrico" name="ConsumoElectrico" placeholder="Ingrese la cantidad en kWh" required step="any">
                </div>
                <div>
                    <label for="LitrosLecheProducidaElectrico">Litros de Leche Producida:</label>
                    <input type="number" id="LitrosLecheProducidaElectrico" name="LitrosLecheProducidaElectrico" placeholder="Ingrese la cantidad en Litros" required step="any">
                </div>
                <div>
                    <label for="ConsTE">Consumo Total Eléctrico:</label>
                    <input type="number" id="ConsTE" name="ConsTE" placeholder="Ingrese la cantidad en kWh" required step="any">
                </div>

                 <div>
                    <label for="MetaEsperadaCE">Meta Esperada:</label>
                    <input type="text" id="MetaEsperadaCE" name="MetaEsperadaCE" placeholder="1.8500 kWh / Litro de leche" required step="any">
                </div>
                 <div>
                    <label for="RangoAceptCE">Rango de Aceptación:</label>
                    <input type="text" id="RangoAceptCE" name="RangoAceptCE" placeholder="Ej. Maximo 1.85" required step="any">
                </div>

                <div>
                    <label for="TendenciaDeseadaCE">Tendencia Deseada:</label>
                    <input type="text" id="TendenciaDeseadaCE" name="TendenciaDeseadaCE" placeholder="Ej. Max 1.85" required step="any">
                </div>

                <div>
                <hr>
                    <label for="Responsable">Responsable:</label>
                    <input type="text" id="Responsable" name="Responsable" placeholder="Nombre del responsable" required>
                </div>
            
                <div>
                    <label for="Fuente">Fuente:</label><br><br>
                    <textarea id="Fuente" name="Fuente" rows="4" placeholder="Fuente" required ></textarea>
                </div>
                <hr>



                    
            <div class="form-buttons">
                <input type="submit" name="g" value="Guardar">
                <input type="reset" name="b" value="Limpiar">
            </div>
        </form>
    </section>
    <a href="./MantenimientoP.php" class="home-link">
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