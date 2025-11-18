<?php
// Incluye la conexión a la base de datos
include "Conexion.php";

// 1. Verificar y obtener el ID del registro a modificar
// Se usa 'sc' para obtener el ID.
$ID = $_GET["sc"] ?? die("
    <!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><title>Error</title></head><body>
    <div class='container mt-5'><div class='alert alert-danger'>Error: ID de registro (sc) no proporcionado.</div></div>
    </body></html>");

// La tabla se asume como 'c_contenidopeso' basándose en los nuevos campos.
// Seleccionamos TODOS los campos para prellenar el formulario
$query = "SELECT * FROM  c_contenidonetopesoenvase WHERE id='$ID'"; 
$res = mysqli_query($link, $query);

if (!$res || mysqli_num_rows($res) == 0) {
    die("
    <!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><title>Error</title></head><body>
    <div class='container mt-5'><div class='alert alert-danger'>Error: Registro con ID $ID no encontrado o error en la consulta.</div></div>
    </body></html>");
}

$row = mysqli_fetch_array($res);

// Permisos y estado de firma
$solo_firma = !empty($row['permitir_firmar']) && empty($row['permitir_modificar']);
$formulario_firmado = !empty($row['firma_usuario']);

// Si solo está permitido firmar y ya está firmado, bloquear todo
if ($solo_firma && $formulario_firmado) {
        echo "<script>
            alert('Este formulario ya ha sido firmado y no puede ser modificado.');
            window.location.href = 'MenuModifi.php';
        </script>";
        exit();
}

// Si no tiene permisos de modificación ni firma
if (empty($row['permitir_modificar']) && empty($row['permitir_firmar'])) {
        echo "<script>
            alert('No tienes permisos para modificar o firmar este formulario. Contacta al administrador.');
            window.location.href = 'MenuModifi.php';
        </script>";
        exit();
}

// Cierra la conexión después de obtener los datos
include "Cerrar.php"; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Modificar Contenido Neto y Peso de Envase Vacío</title>
    <meta charset="UTF-8">
    <!-- Scripts JS originales -->
    <script src="../js/cargas.js"></script>
    <script src="../js/SumaT.js"></script>

    <script src="../js/limpiar.js"></script>
    <script src="../js/ValidacionFirma.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Se usa el CSS del formulario de Contenido Neto y Peso (formContenidoNyP.css) -->
    <link rel="stylesheet" href="../css/actualizarNyP.css">
    
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC"> 
    
</head>
<body>
<main class="container">
    
    <h1>Modificar Registro de Contenido Neto y Peso de Envase Vacío</h1>
    <h5>(Leche Fortificada y Frisia)</h5>
    
    <section class="registro">
        <!-- La acción del formulario se dirige a un script de Actualización (ActualizarNyP.php) -->
        <form action="HacerNyP.php" method="POST" class="needs-validation" id="formulario">
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
                    
                    <!-- Indicador (Dropdown) -->
                    <div>
                        <label for="Indicador">Indicador</label>
                        <select id="Indicador" name="Indicador" required <?= ($solo_firma || $formulario_firmado) ? 'disabled' : '' ?>>
                            <!-- Lógica para preseleccionar la opción correcta -->
                            <?php $current_indicador = $row['Indicador'] ?? ''; ?>
                            <option value="Leche Fortificada 2L" <?= $current_indicador == 'Leche Fortificada 2L' ? 'selected' : '' ?>>Leche fortificada 2L</option>
                            <option value="Leche Frisia 1L" <?= $current_indicador == 'Leche Frisia 1L' ? 'selected' : '' ?>>Leche Frisia 1L</option>
                        </select>
                    </div>

                    <!-- Mes (Fecha) -->
                    <div>
                        <label for="Mes">Mes:</label>
                        <input type="date" id="Mes" name="Mes" 
                                value="<?= $row['Mes'] ?? '' ?>" 
                                <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                                required>
                    </div>
                    
                    <hr>
                    
                    <!-- CONTENIDO NETO -->
                    <div>
                        <label for="ContenidoNTC">CONTENIDO NETO</label></br></br>
                        
                        <!-- MinimoTMN -->
                        <label for="MinimoTMN">Minimo:</label>
                        <input type="Text" id="MinimoTMN" name="MinimoTMN" 
                                value="<?= $row['MinimoTMN'] ?? '' ?>" 
                                <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                                placeholder="(ml)" required>
                    </div>

                    <div>
                        <!-- MaximoTMN -->
                        <label for="MaximoTMN">Maximo:</label>
                        <input type="Text" id="MaximoTMN" name="MaximoTMN" 
                                value="<?= $row['MaximoTMN'] ?? '' ?>" 
                                <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                                placeholder="(ml)" required>
                    </div>

                    <div>
                        <!-- PromedioTPN -->
                        <label for="PromedioTPN">Promedio:</label>
                        <input type="text" id="PromedioTPN" name="PromedioTPN" 
                                value="<?= $row['PromedioTPN'] ?? '' ?>" 
                                <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                                placeholder="(ml)" required>
                    </div>
                    
                    <hr>
                    
                    <!-- PESO DEL ENVASE -->
                    <div>
                        <label for="PesoETE">PESO DEL ENVASE</label></br></br>
                        
                        <!-- MinimoTE -->
                        <label for="MinimoTE">Minimo:</label>
                        <input type="Text" id="MinimoTE" name="MinimoTE" 
                                value="<?= $row['MinimoTE'] ?? '' ?>" 
                                <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                                placeholder="(gr)" required>
                    </div>

                    <div>
                        <!-- MaximoTE -->
                        <label for="MaximoTE">Maximo:</label>
                        <input type="Text" id="MaximoTE" name="MaximoTE" 
                                value="<?= $row['MaximoTE'] ?? '' ?>" 
                                <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                                placeholder="(gr)" required>
                    </div>

                    <div>
                        <!-- PromedioTP -->
                        <label for="PromedioTP">Promedio:</label>
                        <input type="text" id="PromedioTP" name="PromedioTP" 
                                value="<?= $row['PromedioTP'] ?? '' ?>" 
                                <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                                placeholder="(gr)" required>
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

            <div class="form-buttons mt-4">
                <?php if (!$formulario_firmado): ?>
                    <input type="submit" name="g" value="Guardar Cambios">
                    <input type="button" name="b" value="Limpiar" onclick="limpiarCampos()"
                    <?= ($solo_firma) ? 'disabled' : '' ?>>
                <?php else: ?>
                    <div class="alert alert-warning">Este formulario ya ha sido firmado y no puede ser modificado.</div>
                <?php endif; ?>
            </div>
        </form>
    </section>
    
    <!-- Se mantiene el enlace de regreso -->
    <a href="./MenuModifi.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90" alt="Volver a la página de inicio">
    </a>
</main>
</body>
</html>
