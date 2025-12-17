<?php
session_start();
// Incluye la conexión a la base de datos   
include "Conexion.php";

// 1. Verificar y obtener el ID del registro a modificar
$ID = $_GET["sc"] ?? die("
    <!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><title>Error</title></head><body>
    <div class='container mt-5'><div class='alert alert-danger'>Error: ID de registro (sc) no proporcionado.</div></div>
    </body></html>");

// La tabla para los indicadores de adquisiciones se llama 'c_indicador_10'
$query = "SELECT * FROM ad_indicador WHERE id='$ID'"; 
$res = mysqli_query($link, $query);

if (!$res || mysqli_num_rows($res) == 0) {
    die("
    <!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><title>Error</title></head><body>
    <div class='container mt-5'><div class='alert alert-danger'>Error: Registro con ID $ID no encontrado o error en la consulta.</div></div>
    </body></html>");   
}

$row = mysqli_fetch_array($res);

// Verificar permisos
$solo_firma = !empty($row['permitir_firmar']) && empty($row['permitir_modificar']);
$formulario_firmado = !empty($row['firma_usuario']);

// Si solo está permitido firmar y el formulario ya está firmado, bloquear todo
if ($solo_firma && $formulario_firmado) {
    echo "<script>
        alert('Este formulario ya ha sido firmado y no puede ser modificado.');
        window.location.href = 'ModIndicadorAdquisiciones.php';
    </script>";
    include 'Cerrar.php';
    exit();
}

// Si no tiene permisos de modificación ni firma
if (empty($row['permitir_modificar']) && empty($row['permitir_firmar'])) {
    echo "<script>
        alert('No tienes permisos para modificar o firmar este formulario. Contacta al administrador.');
        window.location.href = 'ModIndicadorAdquisiciones.php';
    </script>";
    include 'Cerrar.php';
    exit();
}

// Cierra la conexión después de obtener los datos
include "Cerrar.php"; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Indicadores de Adquisiciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/actualizarIndi.css">
    <script src="../js/cargas.js"></script>
    <script src="../js/Indicadores.js"></script>
    <script src="../js/ValidacionFirma.js"></script>
    <script src="../js/limpiar.js"></script>
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">
    
</head>
<body>
<main class="container">
    
    <h1>Indicadores</h1>
    <h4>Adquisiciones de Bienes Muebles y Servicios (10)</h4>
    
    <section class="registro">  
        <!-- El formulario envía los datos al script HacerIndiAdquisiciones.php -->
        <form action="HacerIndi.php" method="POST" id='formulario'>
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
                    
                    <div>
                        <div>
                            <label for="Claveregis">Clave de Registro:</label>
                            <input type="text" id="Claveregis" name="Claveregis" 
                                   value="<?= $row['Claveregis'] ?? '' ?>" 
                                   placeholder="Ingrese la Clave" 
                                   <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                                   required>
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
                    
                    <!-- Cumplimiento de las Compras Realizadas -->
                    <div>
                        <hr>
                        <label>Cumplimiento de las Compras Realizadas</label><br>
                        <hr>
                        <label for="ExpAtend">Expedientes Completos Atendidos:</label>
                        <input type="number" id="ExpAtend" name="ExpAtend" 
                               value="<?= $row['ExpAtend'] ?? '' ?>" 
                               placeholder="Ingrese la cantidad" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required step="any">
                    </div>
                    <div>
                        <label for="ExpRecib">Expedientes Completos Recibidos:</label>
                        <input type="number" id="ExpRecib" name="ExpRecib" 
                               value="<?= $row['ExpRecib'] ?? '' ?>" 
                               placeholder="Ingrese la meta" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required step="any">
                    </div>
                    <div>
                        <label for="Cumplimiento">Cumplimiento:</label>
                        <input type="number" id="Cumplimiento" name="Cumplimiento" 
                               value="<?= $row['Cumplimiento'] ?? '' ?>" 
                               placeholder="Cumplimiento:" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required step="any">
                    </div>
                    <div>
                        <label for="MetaEsperadaCCR">Meta Esperada:</label>
                        <input type="text" id="MetaEsperadaCCR" name="MetaEsperadaCCR" 
                               value="<?= $row['MetaEsperadaCCR'] ?? '' ?>" 
                               placeholder="La meta esperada es:" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="RangoAceptCCR">Rango de Aceptación:</label>
                        <input type="text" id="RangoAceptCCR" name="RangoAceptCCR" 
                               value="<?= $row['RangoAceptCCR'] ?? '' ?>" 
                               placeholder="Ej. 90% a 100%" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="TendenciaDeseadaCCR">Tendencia Deseada:</label>
                        <input type="text" id="TendenciaDeseadaCCR" name="TendenciaDeseadaCCR" 
                               value="<?= $row['TendenciaDeseadaCCR'] ?? '' ?>" 
                               placeholder="Ej. 100% , Meta Alcanzada" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    
                    <!-- Satisfacción del Cliente -->
                    <div>
                        <hr>
                        <label>Satisfacción del Cliente</label><br>
                        <hr>
                        <label for="EncuSatisfa">Encuestas Satisfactorias:</label>
                        <input type="number" id="EncuSatisfa" name="EncuSatisfa" 
                               value="<?= $row['EncuSatisfa'] ?? '' ?>" 
                               placeholder="Ingrese la cantidad" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required step="any">
                    </div>
                    <div>
                        <label for="EncEnvia">Número de Encuestas Enviadas en el Semestre:</label>
                        <input type="number" id="EncEnvia" name="EncEnvia" 
                               value="<?= $row['EncEnvia'] ?? '' ?>" 
                               placeholder="Ingrese la meta" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required step="any">
                    </div>
                    <div>
                        <label for="Satisfaccion">Satisfacción:</label>
                        <input type="number" id="Satisfaccion" name="Satisfaccion" 
                               value="<?= $row['Satisfaccion'] ?? '' ?>" 
                               placeholder="Satisfacción:" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required step="any">
                    </div>
                    <div>
                        <label for="MetaEsperadaSC">Meta Esperada:</label>
                        <input type="text" id="MetaEsperadaSC" name="MetaEsperadaSC" 
                               value="<?= $row['MetaEsperadaSC'] ?? '' ?>" 
                               placeholder="La meta esperada es:" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="RangoAceptSC">Rango de Aceptación:</label>
                        <input type="text" id="RangoAceptSC" name="RangoAceptSC" 
                               value="<?= $row['RangoAceptSC'] ?? '' ?>" 
                               placeholder="Ej. 90% a 100%" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="TendenciaDeseadaSC">Tendencia Deseada:</label>
                        <input type="text" id="TendenciaDeseadaSC" name="TendenciaDeseadaSC" 
                               value="<?= $row['TendenciaDeseadaSC'] ?? '' ?>" 
                               placeholder="Ej. 100% , Meta Alcanzada" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    
                    <!-- Información Adicional -->
                    <div>
                        <hr>
                        <label for="Responsable">Responsable:</label>
                        <input type="text" id="Responsable" name="Responsable" 
                               value="<?= $row['Responsable'] ?? '' ?>" 
                               placeholder="Nombre del responsable" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="ObservacionesRes">Fuente:</label><br><br>
                        <textarea id="ObservacionesRes" name="ObservacionesRes" rows="4" 
                                  placeholder="Fuente" 
                                  <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                                  required><?= $row['ObservacionesRes'] ?? '' ?></textarea>
                    </div>
                </div>
            </div>
            
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
                    <input type="submit" name="g" value="Guardar Cambios" class="btn">
                    <input type="button" value="Limpiar Campos" class="btn" onclick="limpiarCampos()"
                           <?= ($solo_firma) ? 'disabled' : '' ?>>
                <?php else: ?>
                    <div class="alert alert-warning">
                        Este formulario ya ha sido firmado y no puede ser modificado.
                    </div>
                <?php endif; ?>
            </div>
        </form>
    </section>
    
    <a href="AdquisicionesP.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90">
    </a>
</main>

<script>
    // Convertir automáticamente a mayúsculas en los campos relevantes
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