<!DOCTYPE html>
<html lang="es">
<head>
	<title>Elaboración</title> 
	<meta charset="UTF-8">
    <script src="../js/cargas.js"></script>
    <script src="../js/Indicadores.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/IndiElaboracion.css">
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
	<img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">	
    
</head>
<body>
<main class="container">

    <h1>Indicadores</h1>
    <h4>Elaboración</h4>
    
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
                    <label>Cumplimiento al Programa de Distribución Mensual de Leche del Programa de Abasto Social</label><br>
                    <hr>
                    <label for="DBPAS">Despacho Brutos del Programa de Abasto Social:</label>
                    <input type="number" id="DBPAS" name="DBPAS" placeholder="Litros de leche" required step="any">
                </div>
                <div>
                    <label for="PDOACP">Programa de Despacho Original Autorizado Por el Comite de Producción, Distribución y Comercialización y Abasto:</label>
                    <input type="number" id="PDOACP" name="PDOACP" placeholder="Litros de Leche" required step="any">
                </div>
                <div>
                    <label for="LRAPMDOL">Litros Resultantes del Ajuste al Programa Mensual de Distribución Original de leche (+-):</label>
                    <input type="number" id="LRAPMDOL" name="LRAPMDOL" placeholder="(+-) Litros de Leche" required step="any">
                </div>
                <div>
                    <label for="PC">Porcentaje de Cumplimiento:</label>
                    <input type="number" id="PC" name="PC" placeholder="Porcentaje de Cumplimiento" required step="any">
                </div>
                 <div>
                    <label for="MetaEsperadaDMLPS">Meta Esperada:</label>
                    <textarea id="MetaEsperadaDMLPS" name="MetaEsperadaDMLPS" placeholder="La meta esperada es:" required></textarea>
                </div>
                 <div>
                    <label for="RangoAceptDMLPS">Rango de Aceptación:</label>
                    <input type="text" id="RangoAceptDMLPS" name="RangoAceptDMLPS" placeholder="Ej. minimo 100%" required step="any">
                </div>

                <div>
                    <label for="TendenciaDeseadaDMLPS">Tendencia Deseada:</label>
                    <input type="text" id="TendenciaDeseadaDMLPS" name="TendenciaDeseadaDMLPS" placeholder="Ej. mensual" required step="any">
                </div>
                <div>
                    <hr>
                    <label>Entrega de Producto no Cubiertas por Factores Imputable a la operación de Plantas</label><br>
                    <hr>
                    <label for="CDLPAS">Cifra Generadora Directa: Leche del Programa de Abasto Social no Entregada a Distribución por Factores Atribuibles o Imputables a la Operación de Planta:</label>
                    <input type="number" id="CDLPAS" name="CDLPAS" placeholder="Ej. 0" required step="any">
                </div>
                 <div>
                    <label for="MetaEsperadaEPNC">Meta Esperada:</label>
                    <textarea id="MetaEsperadaEPNC" name="MetaEsperadaEPNC" placeholder="La meta esperada es:" required step="any"></textarea>
                </div>
                 <div>
                    <label for="RangoAceptEPNC">Rango de Aceptación:</label>
                    <input type="text" id="RangoAceptEPNC" name="RangoAceptEPNC" placeholder="Ej. Maximo 0" required step="any">
                </div>

                <div>
                    <label for="TendenciaDeseadaEPNC">Tendencia Deseada:</label>
                    <input type="text" id="TendenciaDeseadaEPNC" name="TendenciaDeseadaEPNC" placeholder="Ej. mensual" required step="any">
                </div>
                <div>
                    <hr>
                    <label>Cumplimiento Con la Producción Solicitada en el Programa de Distribución</label><br>
                    <hr>
                    <label for="DespaReal">Despacho Real:</label>
                    <input type="number" id="DespaReal" name="DespaReal" placeholder="Litros de leche" required step="any">
                </div>
                <div>
                    <label for="DespaProg">Despacho Programado:</label>
                    <input type="number" id="DespaProg" name="DespaProg" placeholder="Litros de Leche" required step="any">
                </div>
                 <div>
                    <label for="LechePrograma">Litros de Leche del Programa de Producción:</label>
                    <input type="number" id="LechePrograma" name="LechePrograma" placeholder="Litros de Leche" required step="any">
                </div>
                <div>
                    <label for="PorcentajeProduccion">Porcentaje de Producción de leche:</label>
                    <input type="number" id="PorcentajeProduccion" name="PorcentajeProduccion" placeholder="Litros de Leche" required step="any">
                </div>
                 <div>
                    <label for="PPL">Porcentaje de Cumplimiento de Con la Producción Solicitada:</label>
                    <input type="number" id="PPL" name="PPL" placeholder="Litros de Leche" required step="any">
                </div>
                 <div>
                    <label for="MetaEsperadaCPSP">Meta Esperada:</label>
                    <textarea id="MetaEsperadaCPSP" name="MetaEsperadaCPSP" placeholder="La meta esperada es:" required step></textarea>
                </div>
                 <div>
                    <label for="RangoAceptCPSP">Rango de Aceptación:</label>
                    <input type="text" id="RangoAceptCPSP" name="RangoAceptCPSP" placeholder="Ej. Maximo 0" required step="any">
                </div>

                <div>
                    <label for="TendenciaDeseadaCPSP">Tendencia Deseada:</label>
                    <input type="text" id="TendenciaDeseadaCPSP" name="TendenciaDeseadaCPSP" placeholder="Ej. mensual" required step="any">
                </div>
                <div>
                    <hr>
                    <label>Calidad de la leche de Abasto</label><br>
                    <label>(reporte mensual de control de calidad de leche pasteurizada)</label><br>
                    
                </div>
                <div>
                    <hr>
                    <label>Grasa</label><br>
                    <hr>
                    <label for="GLCMGV">LCMGV:</label>
                    <input type="number" id="GLCMGV" name="GLCMGV" placeholder="g/l" required step="any">
                </div>
                <div>
                    <label for="GLPD">LPD:</label>
                    <input type="number" id="GLPD" name="GLPD" placeholder="g/l" required step="any">
                </div>
                 <div>
                    <hr>
                    <label>Proteína</label><br>
                    <hr>
                    <label for="PLCMGV">LCMGV:</label>
                    <input type="number" id="PLCMGV" name="PLCMGV" placeholder="g/l" required step="any">
                </div>
                <div>
                    <label for="PLPD">LPD:</label>
                    <input type="number" id="PLPD" name="PLPD" placeholder="g/l" required step="any">
                </div>
                 <div>
                    <label for="MetaEsperadaCLA">Meta Esperada:</label>
                    <textarea id="MetaEsperadaCLA" name="MetaEsperadaCLA" placeholder="La meta esperada es:" required></textarea>
                </div>
                 <div>
                    <label for="RangoAceptCLA">Rango de Aceptación:</label>
                    <input type="text" id="RangoAceptCLA" name="RangoAceptCLA" placeholder="Ej. Maximo 0" required step="any">
                </div>

                <div>
                    <label for="TendenciaDeseadaCLA">Tendencia Deseada:</label>
                    <input type="text" id="TendenciaDeseadaCLA" name="TendenciaDeseadaCLA" placeholder="Ej. mensual" required step="any">
                </div>
                <div>
                    <hr>
                    <label>Cumplimiento de las Buenas Practicas de Higiene y Manofactura</label><br>
                    <hr>
                    <label for="PCBH">Porcentaje de Cumplimiento de la verificacion Continua del PCC:</label>
                    <input type="number" id="PCBH" name="PCBH" placeholder="Ej.100%" required step="any">
                </div>
                <div>
                    <label for="MetaEsperadaCBC">Meta Esperada:</label>
                    <textarea id="MetaEsperadaCBC" name="MetaEsperadaCBC" placeholder="La meta esperada es:" required></textarea>
                </div>
                 <div>
                    <label for="RangoAceptCBC">Rango de Aceptación:</label>
                    <input type="text" id="RangoAceptCBC" name="RangoAceptCBC" placeholder="Ej. Maximo 0" required step="any">
                </div>
                <div>
                    <label for="TendenciaDeseadaCBC">Tendencia Deseada:</label>
                    <input type="text" id="TendenciaDeseadaCBC" name="TendenciaDeseadaCBC" placeholder="Ej. mensual" required step="any">
                </div>
                <div>
                    <hr>
                    <label>Cumplimiento a los Lineamientos Internos y Criterios de la Nom 251-ssa 1-2009</label><br>
                    <hr>
                    <label for="PCCL">Porcentaje de Cumplimiento de los 129 Puntos (Recorido de Comisión Mixta Seguridad e Higiene):</label>
                    <input type="number" id="PCCL" name="PCCL" placeholder="Ej.85%" required step="any">
                </div>
                <div>
                    <label for="MetaEsperadaCLI">Meta Esperada:</label>
                    <textarea id="MetaEsperadaCLI" name="MetaEsperadaCLI" placeholder="La meta esperada es:" required step="any"></textarea>
                </div>
                  <div>
                    <label for="RangoAceptCLI">Rango de Aceptación:</label>
                    <input type="text" id="RangoAceptCLI" name="RangoAceptCLI" placeholder="Ej. Maximo 0" required step="any">
                </div>
                <div>
                    <label for="TendenciaDeseadaCLI">Tendencia Deseada:</label>
                    <input type="text" id="TendenciaDeseadaCLI" name="TendenciaDeseadaCLI" placeholder="Ej. mensual" required step="any">
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