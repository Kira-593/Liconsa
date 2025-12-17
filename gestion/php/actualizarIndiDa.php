<?php
// Incluye la conexión a la base de datos
include "Conexion.php";

// Se usa 'sc' para obtener el ID del registro a modificar
$ID = $_GET["sc"] ?? die("
    <!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><title>Error</title></head><body>
    <div class='container mt-5'><div class='alert alert-danger'>Error: ID de registro (sc) no proporcionado.</div></div>
    </body></html>"); 
    
$query = "SELECT * FROM g_indicador_da WHERE id='$ID'"; 
$res = mysqli_query($link, $query);

if (!$res || mysqli_num_rows($res) == 0) {
        die("
        <!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><title>Error</title></head><body>
        <div class='container mt-5'><div class='alert alert-danger'>Error: Registro con ID $ID no encontrado o error en la consulta.</div></div>
        </body></html>");
}

$row = mysqli_fetch_array($res);

// Verificar permisos (coincidente con otros formularios)
$solo_firma = !empty($row['permitir_firmar']) && empty($row['permitir_modificar']);
$formulario_firmado = !empty($row['firma_usuario']);

// Si solo está permitido firmar y el formulario ya está firmado, bloquear todo
if ($solo_firma && $formulario_firmado) {
        echo "<script>
            alert('Este formulario ya ha sido firmado y no puede ser modificado.');
            window.location.href = 'ModIndicadoresDa.php';
        </script>";
        exit();
}

// Si no tiene permisos de modificación ni firma
if (empty($row['permitir_modificar']) && empty($row['permitir_firmar'])) {
        echo "<script>
            alert('No tienes permisos para modificar o firmar este formulario. Contacta al administrador.');
            window.location.href = 'ModIndicadoresDa.php';
        </script>";
        exit();
}

include "Cerrar.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Modificar Indicadores de Gestión del Ambiente de trabajo</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/cargas.js"></script>
    <script src="../js/IndicadoresDa.js"></script>
    <script src="../js/ValidacionFirma.js"></script>
    <script src="../js/limpiar.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/actualizarIndiDa.css">
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC"> 
    
</head>
<body>
<main class="container">

    <h1>Indicadores</h1>
    <h4>Gestión del Ambiente de trabajo</h4>
    <h4>y de las Competencias de Personal</h4>
    
    <section class="registro">
        <form method="post" action="HacerIndiDa.php" class="needs-validation" id="formulario">
        
            <!-- Campo oculto para pasar el ID del registro a actualizar -->
            <input type="hidden" value="<?= $row['id'] ?? '' ?>" name="id"> 

            <?php if ($formulario_firmado): ?>
            <div class="alert alert-info">
                <strong>✅ Formulario Firmado</strong><br>
                Firmado por: <?= $row['firma_usuario'] ?><br>
                Fecha: <?= $row['fecha_firma'] ?>
            </div>
            <?php endif; ?>
            
            <div class="registro-container">
                <div class="registro-column">

                    <div>
                        <label for="Claveregis">Clave de Registro:</label>
                        <input type="text" id="Claveregis" name="Claveregis" 
                               value="<?= $row['Claveregis'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> 
                               placeholder="Ingrese la Clave" required>

                        <label for="Mes">Fecha de Elaboración:</label>
                        <input type="date" id="Mes" name="Mes" 
                               value="<?= $row['Mes'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>

                        <label for="Periodo">Periodo:</label>
                        <input type="date" id="Periodo" name="Periodo" 
                               value="<?= $row['Periodo'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>

                    <div>
                        <hr>
                        <label>Ambiente de trabajo  "Reporte de inspección de Órden seguridad y Limpieza en Areas de Servicio"</label><br>
                        <hr>

                        <label for="NoSatis">No. de Satisfacciones:</label>
                        <input type="number" id="NoSatis" name="NoSatis" 
                               value="<?= $row['NoSatis'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               placeholder="Ingrese la cantidad" required step="any">
                    </div>

                    <div>
                        <label for="NoPuntos">No. de Puntos:</label>
                        <input type="number" id="NoPuntos" name="NoPuntos" 
                               value="<?= $row['NoPuntos'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               placeholder="Ingrese la cantidad" required step="any">
                    </div>

                    <div>
                        <label for="DndSat">Donde la Satisfacción es Equivalente a:</label>
                        <input type="number" id="DndSat" name="DndSat" 
                               value="<?= $row['DndSat'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               placeholder="%" required step="any">
                    </div>

                    <div>
                        <label for="MetaEsperadaRIO">Meta Esperada:</label>
                        <input type="text" id="MetaEsperadaRIO" name="MetaEsperadaRIO" 
                               value="<?= $row['MetaEsperadaRIO'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               placeholder="La meta esperada es:" required>
                    </div>

                    <div>
                        <label for="RangoAceptRIO">Rango de Aceptación:</label>
                        <input type="text" id="RangoAceptRIO" name="RangoAceptRIO" 
                               value="<?= $row['RangoAceptRIO'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               placeholder="Ej. MIN=95% MAX=100%" required>
                    </div>

                    <div>
                        <label for="TendenciaDeseadaRIO">Tendencia Deseada:</label>
                        <textarea id="TendenciaDeseadaRIO" name="TendenciaDeseadaRIO" 
                                  <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                                  placeholder="Tendencia deseada:" required><?= $row['TendenciaDeseadaRIO'] ?? '' ?></textarea>
                    </div>

                    <div>
                        <hr>
                        <label>Ambiente de Trabajo "Uniformes de Trabajo y Equipo de Protección de Personal Operativo"</label><br>
                        <hr>

                        <label for="NoSatisUnif">No. de Satisfacciones:</label>
                        <input type="number" id="NoSatisUnif" name="NoSatisUnif" 
                               value="<?= $row['NoSatisUnif'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               placeholder="Ingrese la cantidad" required step="any">
                    </div>

                    <div>
                        <label for="NoPuntosUnif">No. de Puntos:</label>
                        <input type="number" id="NoPuntosUnif" name="NoPuntosUnif" 
                               value="<?= $row['NoPuntosUnif'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               placeholder="Ingrese la cantidad" required step="any">
                    </div>

                    <div>
                        <label for="DndSatUnif">Donde la Satisfacción es Equivalente a:</label>
                        <input type="number" id="DndSatUnif" name="DndSatUnif" 
                               value="<?= $row['DndSatUnif'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               placeholder="%" required step="any">
                    </div>

                    <div>
                        <label for="MetaEsperadaUTE">Meta Esperada:</label>
                        <input type="text" id="MetaEsperadaUTE" name="MetaEsperadaUTE" 
                               value="<?= $row['MetaEsperadaUTE'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               placeholder="La meta esperada es:" required>
                    </div>

                    <div>
                        <label for="RangoAceptUTE">Rango de Aceptación:</label>
                        <input type="text" id="RangoAceptUTE" name="RangoAceptUTE" 
                               value="<?= $row['RangoAceptUTE'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               placeholder="Ej. MIN=95% MAX=100%" required>
                    </div>

                    <div>
                        <label for="TendenciaDeseadaUTE">Tendencia Deseada:</label>
                        <textarea id="TendenciaDeseadaUTE" name="TendenciaDeseadaUTE" 
                                  <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                                  placeholder="Tendencia deseada:" required><?= $row['TendenciaDeseadaUTE'] ?? '' ?></textarea>
                    </div>

                    <div>
                        <hr>
                        <label>Accidentes e Incidentes por Riesgo de Trabajo</label><br>
                        <hr>

                        <label for="CantAcci">Cantidad de Accidentes:</label>
                        <input type="number" id="CantAcci" name="CantAcci" 
                               value="<?= $row['CantAcci'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               placeholder="Ingrese la cantidad" required step="any">
                    </div>

                    <div>
                        <label for="DiasLaborados">Dias Laborados:</label>
                        <input type="number" id="DiasLaborados" name="DiasLaborados" 
                               value="<?= $row['DiasLaborados'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               placeholder="Ingrese la cantidad" required step="any">
                    </div>

                    <div>
                        <label for="Frecuencia">Frecuencia:</label>
                        <input type="number" id="Frecuencia" name="Frecuencia" 
                               value="<?= $row['Frecuencia'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               placeholder="Frecuencia" required step="any">
                    </div>

                    <div>
                        <label for="MetaEsperadaAIR">Meta Esperada:</label>
                        <input type="text" id="MetaEsperadaAIR" name="MetaEsperadaAIR" 
                               value="<?= $row['MetaEsperadaAIR'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               placeholder="La meta esperada es:" required>
                    </div>

                    <div>
                        <label for="RangoAceptAIR">Rango de Aceptación:</label>
                        <input type="text" id="RangoAceptAIR" name="RangoAceptAIR" 
                               value="<?= $row['RangoAceptAIR'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               placeholder="Ej. Minimo NO APLICA" required>
                    </div>

                    <div>
                        <label for="TendenciaDeseadaAIR">Tendencia Deseada:</label>
                        <textarea id="TendenciaDeseadaAIR" name="TendenciaDeseadaAIR" 
                                  <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                                  placeholder="Tendencia deseada:" required><?= $row['TendenciaDeseadaAIR'] ?? '' ?></textarea>
                    </div>

                    <div>
                        <hr>
                        <label>Actos y Condiciones Inseguras</label><br>
                        <hr>

                        <label for="CantActCondInseg">Actos y/o Condiciones Inseguras Reportadas en el Mes:</label>
                        <input type="number" id="CantActCondInseg" name="CantActCondInseg" 
                               value="<?= $row['CantActCondInseg'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               placeholder="Ingrese la cantidad" required step="any">
                    </div>

                    <div>
                        <label for="MetaEsperadaACI">Meta Esperada:</label>
                        <input type="text" id="MetaEsperadaACI" name="MetaEsperadaACI" 
                               value="<?= $row['MetaEsperadaACI'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               placeholder="La meta esperada es:" required>
                    </div>

                    <div>
                        <label for="RangoAceptACI">Rango de Aceptación:</label>
                        <input type="text" id="RangoAceptACI" name="RangoAceptACI" 
                               value="<?= $row['RangoAceptACI'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               placeholder="Ej. Minimo NO APLICA" required>
                    </div>

                    <div>
                        <label for="TendenciaDeseadaACI">Tendencia Deseada:</label>
                        <textarea id="TendenciaDeseadaACI" name="TendenciaDeseadaACI" 
                                  <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                                  placeholder="Tendencia deseada:" required><?= $row['TendenciaDeseadaACI'] ?? '' ?></textarea>
                    </div>

                    <div>
                        <hr>
                        <label for="Responsable">Responsable:</label>
                        <input type="text" id="Responsable" name="Responsable" 
                               value="<?= $row['Responsable'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               placeholder="Nombre del responsable" required>
                    </div>

                    <div>
                        <label for="ObservacionesRes">Fuente:</label><br><br>
                        <textarea id="ObservacionesRes" name="ObservacionesRes" rows="4" 
                                  <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                                  placeholder="Fuente" required><?= $row['ObservacionesRes'] ?? '' ?></textarea>
                    </div>

                    <!-- SECCIÓN DE FIRMA -->
                    <div class="firma-section mt-4 p-3 border rounded">
                        <h4>Firma Digital</h4>

                        <?php if ($row['permitir_firmar'] && !$formulario_firmado): ?>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="clave_firma">Clave de Firma:</label>
                                    <input type="password" id="clave_firma" name="clave_firma" class="form-control"
                                        placeholder="Ingrese su clave única de firma" <?= !$row['permitir_firmar'] ? 'readonly' : '' ?>>
                                    <small>Ingrese su clave única de firma para validar este formulario.</small>
                                </div>
                                <div class="col-md-6">
                                    <label for="confirmar_clave">Confirmar Clave:</label>
                                    <input type="password" id="confirmar_clave" name="confirmar_clave" class="form-control"
                                        placeholder="Confirme su clave de firma" <?= !$row['permitir_firmar'] ? 'readonly' : '' ?>>
                                </div>
                            </div>

                            <div class="form-check mb-3">
                                <label class="form-check-label" for="firmar_documento" style="display:inline-flex;align-items:center;gap:6px;cursor:pointer;">
                                    <input type="checkbox" id="firmar_documento" name="firmar_documento" class="form-check-input" <?= !$row['permitir_firmar'] ? 'disabled' : '' ?> required>
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

                    <hr>

                    <div class="form-buttons">
                        <?php if (!$formulario_firmado): ?>
                            <input type="submit" name="g" value="Guardar Cambios" class="btn" id="btnGuardar">
                            <input type="button" value="Limpiar Campos" class="btn" onclick="limpiarCampos()"
                            <?= ($solo_firma) ? 'disabled' : '' ?>>
                        <?php else: ?>
                            <div class="alert alert-warning">Este formulario ya ha sido firmado y no puede ser modificado.</div>
                        <?php endif; ?>
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