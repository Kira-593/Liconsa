<?php
    // Incluye la conexión a la base de datos
    include "Conexion.php";
    
    // Asumimos que la clave (id) se pasa por la URL
$ID = $_GET["sc"] ?? die("
    <!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><title>Error</title></head><body>
    <div class='container mt-5'><div class='alert alert-danger'>Error: ID de registro (sc) no proporcionado.</div></div>
    </body></html>");    
    // Consulta para obtener los datos existentes
    $query = "SELECT * FROM m_indicador WHERE id='$ID'"; 
    $res = mysqli_query($link, $query);
    
    if (!$res || mysqli_num_rows($res) == 0) {
        die("
        <!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><title>Error</title></head><body>
        <div class='container mt-5'><div class='alert alert-danger'>Error: Registro con ID $ID no encontrado o error en la consulta.</div></div>
        </body></html>");
    }
    
    $row = mysqli_fetch_array($res);

    // Verificar permisos (coincidente con actualizarSubG.php)
    $solo_firma = !empty($row['permitir_firmar']) && empty($row['permitir_modificar']);
    $formulario_firmado = !empty($row['firma_usuario']);

    // Si solo está permitido firmar y el formulario ya está firmado, bloquear todo
    if ($solo_firma && $formulario_firmado) {
        echo "<script>
            alert('Este formulario ya ha sido firmado y no puede ser modificado.');
            window.location.href = 'MantenimientoP.php';
        </script>";
        exit();
    }

    // Si no tiene permisos de modificación ni firma
    if (empty($row['permitir_modificar']) && empty($row['permitir_firmar'])) {
        echo "<script>
            alert('No tienes permisos para modificar o firmar este formulario. Contacta al administrador.');
            window.location.href = 'MantenimientoP.php';
        </script>";
        exit();
    }

    include "Cerrar.php";
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Indicadores de Mantenimiento</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Carga de scripts requeridos -->
    <script src="../js/cargas.js"></script>
    <script src="../js/Indicadores.js"></script>
    <script src="../js/limpiar.js"></script>
    <script src="../js/ValidacionFirma.js"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Se usa el CSS de mantenimiento para el estilo -->
    <link rel="stylesheet" href="../css/actualizarindi.css"> 
    
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC"> 
</head>
<body>
<main class="container">

    <!-- Título adaptado al formulario de mantenimiento -->
    <h1>Indicadores</h1>
    <h4>Actualizar Mantenimiento</h4>

    <section class="registro">

    <!-- El formulario envía los datos a HacerMantenimiento.php -->
    <form method="post" action="HacerIndi.php" class="needs-validation" id="formulario">
        <!-- Campo oculto para pasar el ID del registro a actualizar -->
        <input type="hidden" value="<?= $row['id'] ?? '' ?>" name="id"> 

        <?php if ($formulario_firmado): ?>
        <div class="alert alert-info alert-section">
            <strong>✅ Formulario Firmado</strong><br>
            Firmado por: <?= $row['firma_usuario'] ?><br>
            Fecha: <?= $row['fecha_firma'] ?>
        </div>
        <?php endif; ?>

        <div class="registro-container">
            <div class="registro-column">
                
                <!-- Datos Generales -->
                <div>
                    <div>
                    <label for="Claveregis">Clave de Registro:</label>
                    <input type="text" id="Claveregis" name="Claveregis" 
                           value="<?= $row['Claveregis'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="Ingrese la Clave" required>
                    </div>
                    
                    <label for="Mes">Fecha de Elaboración:</label>
                    <input type="date" id="Mes" name="Mes" 
                           value="<?= $row['Mes'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           required>
                    
                    <label for="Periodo">Periodo:</label>
                    <input type="date" id="Periodo" name="Periodo" 
                           value="<?= $row['Periodo'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           required>
                </div>
                
                <!-- Gastos de Operación -->
                <div>
                    <hr>
                    <label>Gatos de Operación</label><br>
                    <hr>
                    
                    <label for="PresEje">Presupuesto Ejercido:</label>
                    <input type="number" id="PresEje" name="PresEje" 
                           value="<?= $row['PresEje'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="Ingrese la cantidad" required step="any">
                    
                    <label>Menor ó Igual Al</label>
                
                    <label for="GastoAutorizado">Gasto Autorizado:</label>
                    <input type="number" id="GastoAutorizado" name="GastoAutorizado" 
                           value="<?= $row['GastoAutorizado'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="Ingrese la meta" required step="any">
                    
                    <label for="Diferiencia">Diferencia:</label>
                    <input type="number" id="Diferiencia" name="Diferiencia" 
                           value="<?= $row['Diferiencia'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="Los Puntos son:" required step="any">
                    
                    <label for="MetaEsperadaGO">Meta Esperada:</label>
                    <input type="text" id="MetaEsperadaGO" name="MetaEsperadaGO" 
                           value="<?= $row['MetaEsperadaGO'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="La meta esperada es:" required>
                    
                    <label for="RangoAceptGO">Rango de Aceptación:</label>
                    <input type="text" id="RangoAceptGO" name="RangoAceptGO" 
                           value="<?= $row['RangoAceptGO'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="Ej. Max el gasto autorizado" required>
                    
                    <label for="TendenciaDeseadaGO">Tendencia Deseada:</label>
                    <input type="text" id="TendenciaDeseadaGO" name="TendenciaDeseadaGO" 
                           value="<?= $row['TendenciaDeseadaGO'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="Ej. No Rebasar el Gasto Autorizado" required>
                </div>

                <!-- Disponibilidad de Equipo Para la Producción, Envasado y ReHidratado -->
                <div>
                    <hr>
                    <label>Disponibilidad de Equipo Para la Producción, Envasado y ReHidratado</label><br>
                    <hr>
                    
                    <label for="HorasHombre"> Total de Horas Hombre Disponible:</label>
                    <input type="number" id="HorasHombre" name="HorasHombre" 
                           value="<?= $row['HorasHombre'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="Ingrese la cantidad" required step="any">
                    
                    <label for="HorasParo">Horas de paro:</label>
                    <input type="number" id="HorasParo" name="HorasParo" 
                           value="<?= $row['HorasParo'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="Ingrese la meta" required step="any">
                    
                    <label for="HorasDisponibles">Total de Horas Disponibles:</label>
                    <input type="number" id="HorasDisponibles" name="HorasDisponibles" 
                           value="<?= $row['HorasDisponibles'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="Ingrese la meta" required step="any">
                    
                    <label for="prc">Porcentaje de Disponibilidad del Equipo:</label>
                    <input type="number" id="prc" name="prc" 
                           value="<?= $row['prc'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="%" required step="any">
                    
                    <label for="MetaEsperadaDEP">Meta Esperada:</label>
                    <input type="text" id="MetaEsperadaDEP" name="MetaEsperadaDEP" 
                           value="<?= $row['MetaEsperadaDEP'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="La meta esperada es:" required>
                    
                    <label for="RangoAceptDEP">Rango de Aceptación:</label>
                    <input type="text" id="RangoAceptDEP" name="RangoAceptDEP" 
                           value="<?= $row['RangoAceptDEP'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="Ej. 99.50-100%" required>
                    
                    <label for="TendenciaDeseadaDEP">Tendencia Deseada:</label>
                    <input type="text" id="TendenciaDeseadaDEP" name="TendenciaDeseadaDEP" 
                           value="<?= $row['TendenciaDeseadaDEP'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="Ej. 100%" required>
                </div>

                <!-- Trabajos Preventivos -->
                <div>
                    <hr>
                    <label>Trabajos Preventivos</label><br>
                    <hr>
                    
                    <label for="TPE">Trabajos Programados Ejecutados:</label>
                    <input type="number" id="TPE" name="TPE" 
                           value="<?= $row['TPE'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="Ingrese la cantidad" required step="any">
                    
                    <label for="TP">Trabajos Programados:</label>
                    <input type="number" id="TP" name="TP" 
                           value="<?= $row['TP'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="Ingrese la meta" required step="any">
                    
                    <label for="PorcentTP">Porcentaje de Trabajos  Preventivos:</label>
                    <input type="number" id="PorcentTP" name="PorcentTP" 
                           value="<?= $row['PorcentTP'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="%" required step="any">
                    
                    <label for="MetaEsperadaTP">Meta Esperada:</label>
                    <input type="text" id="MetaEsperadaTP" name="MetaEsperadaTP" 
                           value="<?= $row['MetaEsperadaTP'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="La meta esperada es:" required>
                    
                    <label for="RangoAceptTP">Rango de Aceptación:</label>
                    <input type="text" id="RangoAceptTP" name="RangoAceptTP" 
                           value="<?= $row['RangoAceptTP'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="Ej. 99.50-100%" required>
                    
                    <label for="TendenciaDeseadaTP">Tendencia Deseada:</label>
                    <input type="text" id="TendenciaDeseadaTP" name="TendenciaDeseadaTP" 
                           value="<?= $row['TendenciaDeseadaTP'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="Ej. 100%" required>
                </div>

                <!-- Trabajos Correctivos -->
                <div>
                    <hr>
                    <label>Trabajos Correctivos</label><br>
                    <hr>
                    
                    <label for="TC">Trabajos correctivos realizados:</label>
                    <input type="number" id="TC" name="TC" 
                           value="<?= $row['TC'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="Ingrese la cantidad" required step="any">
                    
                    <label for="PorcentTC">Porcentaje de Trabajos  Correctivos:</label>
                    <input type="number" id="PorcentTC" name="PorcentTC" 
                           value="<?= $row['PorcentTC'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="%" required step="any">
                    
                    <label for="MetaEsperadaTC">Meta Esperada:</label>
                    <input type="text" id="MetaEsperadaTC" name="MetaEsperadaTC" 
                           value="<?= $row['MetaEsperadaTC'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="La meta esperada es:" required>
                    
                    <label for="RangoAceptTC">Rango de Aceptación:</label>
                    <input type="text" id="RangoAceptTC" name="RangoAceptTC" 
                           value="<?= $row['RangoAceptTC'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="Ej. 0 - 0.15%" required>
                    
                    <label for="TendenciaDeseadaTC">Tendencia Deseada:</label>
                    <input type="text" id="TendenciaDeseadaTC" name="TendenciaDeseadaTC" 
                           value="<?= $row['TendenciaDeseadaTC'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="Ej. 0%" required>
                </div>

                <!-- Consumo Térmico -->
                <div>
                    <hr>
                    <label>Consumo Térmico</label><br>
                    <hr>
                    
                    <label for="ConsumoTermico">Consumo Térmico (litros):</label>
                    <input type="number" id="ConsumoTermico" name="ConsumoTermico" 
                           value="<?= $row['ConsumoTermico'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="Ingrese la cantidad en Litros" required step="any">
                    
                    <label for="LitrosLecheProducidatermica">Litros de Leche Producida:</label>
                    <input type="number" id="LitrosLecheProducidatermica" name="LitrosLecheProducidatermica" 
                           value="<?= $row['LitrosLecheProducidatermica'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="Ingrese la cantidad en Litros" required step="any">
                    
                    <label for="ConsTT">Consumo Total Térmico:</label>
                    <input type="number" id="ConsTT" name="ConsTT" 
                           value="<?= $row['ConsTT'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="Ingrese la cantidad en Litros" required step="any">
                    
                    <label for="MetaEsperadaCT">Meta Esperada:</label>
                    <input type="text" id="MetaEsperadaCT" name="MetaEsperadaCT" 
                           value="<?= $row['MetaEsperadaCT'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="1.8500 litros de agua / Litro de leche" required>
                    
                    <label for="RangoAceptCT">Rango de Aceptación:</label>
                    <input type="text" id="RangoAceptCT" name="RangoAceptCT" 
                           value="<?= $row['RangoAceptCT'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="Ej. Maximo 1.85" required>
                    
                    <label for="TendenciaDeseadaCT">Tendencia Deseada:</label>
                    <input type="text" id="TendenciaDeseadaCT" name="TendenciaDeseadaCT" 
                           value="<?= $row['TendenciaDeseadaCT'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="Ej. Max 1.85" required>
                </div>

                <!-- Consumo de Agua -->
                <div>
                    <hr>
                    <label>Consumo de Agua</label><br>
                    <hr>
                    
                    <label for="ConsumoAgua">Consumo de Agua (litros):</label>
                    <input type="number" id="ConsumoAgua" name="ConsumoAgua" 
                           value="<?= $row['ConsumoAgua'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="Ingrese la cantidad en Litros" required step="any">
                    
                    <label for="LitrosLecheProducida">Litros de Leche Producida:</label>
                    <input type="number" id="LitrosLecheProducida" name="LitrosLecheProducida" 
                           value="<?= $row['LitrosLecheProducida'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="Ingrese la cantidad en Litros" required step="any">
                    
                    <label for="ConsTA">Consumo Total de Agua:</label>
                    <input type="number" id="ConsTA" name="ConsTA" 
                           value="<?= $row['ConsTA'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="Ingrese la cantidad en Litros" required step="any">
                    
                    <label for="MetaEsperadaCA">Meta Esperada:</label>
                    <input type="text" id="MetaEsperadaCA" name="MetaEsperadaCA" 
                           value="<?= $row['MetaEsperadaCA'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="1.8500 litros de agua / Litro de leche" required>
                    
                    <label for="RangoAceptCA">Rango de Aceptación:</label>
                    <input type="text" id="RangoAceptCA" name="RangoAceptCA" 
                           value="<?= $row['RangoAceptCA'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="Ej. Maximo 1.85" required>
                    
                    <label for="TendenciaDeseadaCA">Tendencia Deseada:</label>
                    <input type="text" id="TendenciaDeseadaCA" name="TendenciaDeseadaCA" 
                           value="<?= $row['TendenciaDeseadaCA'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="Ej. Max 1.85" required>
                </div>

                <!-- Consumo Eléctrico -->
                <div>
                    <hr>
                    <label>Consumo Eléctrico</label><br>
                    <hr>
                    
                    <label for="ConsumoElectrico">Consumo Eléctrico (kWh):</label>
                    <input type="number" id="ConsumoElectrico" name="ConsumoElectrico" 
                           value="<?= $row['ConsumoElectrico'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="Ingrese la cantidad en kWh" required step="any">
                    
                    <label for="LitrosLecheProducidaElectrico">Litros de Leche Producida:</label>
                    <input type="number" id="LitrosLecheProducidaElectrico" name="LitrosLecheProducidaElectrico" 
                           value="<?= $row['LitrosLecheProducidaElectrico'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="Ingrese la cantidad en Litros" required step="any">
                    
                    <label for="ConsTE">Consumo Total Eléctrico:</label>
                    <input type="number" id="ConsTE" name="ConsTE" 
                           value="<?= $row['ConsTE'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="Ingrese la cantidad en kWh" required step="any">
                    
                    <label for="MetaEsperadaCE">Meta Esperada:</label>
                    <input type="text" id="MetaEsperadaCE" name="MetaEsperadaCE" 
                           value="<?= $row['MetaEsperadaCE'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="1.8500 kWh / Litro de leche" required>
                    
                    <label for="RangoAceptCE">Rango de Aceptación:</label>
                    <input type="text" id="RangoAceptCE" name="RangoAceptCE" 
                           value="<?= $row['RangoAceptCE'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="Ej. Maximo 1.85" required>
                    
                    <label for="TendenciaDeseadaCE">Tendencia Deseada:</label>
                    <input type="text" id="TendenciaDeseadaCE" name="TendenciaDeseadaCE" 
                           value="<?= $row['TendenciaDeseadaCE'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="Ej. Max 1.85" required>
                </div>

                <!-- Responsable y Fuente -->
                <div>
                    <hr>
                    <label for="Responsable">Responsable:</label>
                    <input type="text" id="Responsable" name="Responsable" 
                           value="<?= $row['Responsable'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                           placeholder="Nombre del responsable" required>
                
                    <label for="Fuente">Fuente:</label><br><br>
                    <textarea id="Fuente" name="Fuente" rows="4" 
                              <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                              placeholder="Fuente" required><?= $row['Fuente'] ?? '' ?></textarea>
                </div>
                <hr>
            </div> 
        </div> <!-- Fin de registro-container -->
            
            <!-- SECCIÓN DE FIRMA -->
            <div class="firma-section mt-4 p-3 border rounded">
                <h4>Firma Digital</h4>
                
                <?php if ($row['permitir_firmar'] && !$formulario_firmado): ?>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="clave_firma">Clave de Firma:</label>
                            <input type="password" id="clave_firma" name="clave_firma" class="form-control" 
                                placeholder="Ingrese su clave única de firma">
                            <small>Ingrese su clave única de firma para validar este formulario.</small>
                        </div>
                        <div class="col-md-6">
                            <label for="confirmar_clave">Confirmar Clave:</label>
                            <input type="password" id="confirmar_clave" name="confirmar_clave" class="form-control" 
                                placeholder="Confirme su clave de firma">
                        </div>
                    </div>
                    
                    <div class="form-check mb-3">
                        <label class="form-check-label" for="firmar_documento" style="display:inline-flex;align-items:center;gap:6px;cursor:pointer;">
                            <input type="checkbox" id="firmar_documento" name="firmar_documento" class="form-check-input" required>
                            Deseo firmar este documento digitalmente
                        </label>
                    </div>
                <?php elseif ($formulario_firmado): ?>
                    <div class="alert alert-success">
                        <strong>✅ Documento Firmado</strong><br>
                        Este formulario fue firmado por: <strong><?= $row['firma_usuario'] ?></strong><br>
                        Fecha de firma: <strong><?= $row['fecha_firma'] ?></strong>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning">
                        <strong>⚠️ Firma no disponible</strong><br>
                        No tienes permisos para firmar este documento o la firma no está habilitada.
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-buttons">
                <?php if (!$formulario_firmado): ?>
                    <input type="submit" name="g" value="Guardar Cambios" class="btn btn-primary">
                    <input type="button" value="Limpiar Campos" class="btn btn-secondary" onclick="limpiarCampos()"
                           <?= ($solo_firma) ? 'disabled' : '' ?>>
                <?php else: ?>
                    <div class="alert alert-warning">
                        Este formulario ya ha sido firmado y no puede ser modificado.
                    </div>
                <?php endif; ?>
            </div>
    </form>
    </section>
    
    <?php include "Cerrar.php"; // Cierra la conexión ?>
    
    <!-- Enlace de regreso a MantenimientoP.php -->
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