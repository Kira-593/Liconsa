<?php
session_start();
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

     <?php
    include "Conexion.php";
    
    // Verificar si el usuario es administrador
    $es_admin = isset($_SESSION['departamento']) && $_SESSION['departamento'] === 'ADMIN';
    
    $ID = $_GET["id"] ?? $_GET["sc"] ?? die("<div class='alert alert-danger'>Error: ID de registro no proporcionado.</div>");
    $query = "SELECT * FROM c_contenidonetopesoenvase WHERE id='$ID'"; 
    $res = mysqli_query($link, $query);
    
    if (!$res || mysqli_num_rows($res) == 0) {
        die("<div class='alert alert-danger'>Error: Registro no encontrado.</div>");
    }
    
    $row = mysqli_fetch_array($res);

    // Verificar permisos
    $solo_firma = $row['permitir_firmar'] && !$row['permitir_modificar'];
    $formulario_firmado = !empty($row['firma_usuario']);
    
    // Si solo está permitido firmar y el formulario ya está firmado, y NO es admin: bloquear
    if ($solo_firma && $formulario_firmado && !$es_admin) {
        echo "<script>
            alert('Este formulario ya ha sido firmado y no puede ser modificado.');
            window.location.href = 'MenuModifi.php';
        </script>";
        exit();
    }

    // Si no tiene permisos de modificación ni firma, y NO es admin
    if (!$row['permitir_modificar'] && !$row['permitir_firmar'] && !$es_admin) {
        echo "<script>
            alert('No tienes permisos para modificar o firmar este formulario. Contacta al administrador.');
            window.location.href = 'MenuModifi.php';
        </script>";
        exit();
    }

    // Mostrar alerta si es admin accediendo a un registro firmado
    if ($es_admin && $formulario_firmado) {
        echo "<div class='alert alert-warning alert-section'>
            <strong>🔓 Acceso de Administrador</strong><br>
            Como administrador, puedes modificar este formulario firmado y deshacer la firma si es necesario.
        </div>";
    }

    // Mostrar estado de firma si ya está firmado
    if ($formulario_firmado): ?>
        <div class="alert alert-info alert-section">
            <strong>✅ Formulario Firmado</strong><br>
            Firmado por: <?= $row['firma_usuario'] ?><br>
            Fecha: <?= $row['fecha_firma'] ?>
        </div>
    <?php endif; ?>
    
    <section class="registro">
        <!-- La acción del formulario se dirige a un script de Actualización (ActualizarNyP.php) -->
        <form action="HacerNyP.php" method="POST" class="needs-validation" id="formulario">
            <!-- Campo oculto para pasar el ID del registro a actualizar -->
            <input type="hidden" value="<?= $row['id'] ?? '' ?>" name="id"> 
        
            <div class="registro-container">
                <div class="registro-column">
                    
                    <!-- Indicador (Dropdown) -->
                    <div>
                        <label for="Indicador">Indicador</label>
                        <select id="Indicador" name="Indicador" required <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'disabled' : '' ?>>
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
                                <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
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
                                <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                                placeholder="(ml)" required>
                    </div>

                    <div>
                        <!-- MaximoTMN -->
                        <label for="MaximoTMN">Maximo:</label>
                        <input type="Text" id="MaximoTMN" name="MaximoTMN" 
                                value="<?= $row['MaximoTMN'] ?? '' ?>" 
                                <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                                placeholder="(ml)" required>
                    </div>

                    <div>
                        <!-- PromedioTPN -->
                        <label for="PromedioTPN">Promedio:</label>
                        <input type="text" id="PromedioTPN" name="PromedioTPN" 
                                value="<?= $row['PromedioTPN'] ?? '' ?>" 
                                <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
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
                                <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                                placeholder="(gr)" required>
                    </div>

                    <div>
                        <!-- MaximoTE -->
                        <label for="MaximoTE">Maximo:</label>
                        <input type="Text" id="MaximoTE" name="MaximoTE" 
                                value="<?= $row['MaximoTE'] ?? '' ?>" 
                                <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                                placeholder="(gr)" required>
                    </div>

                    <div>
                        <!-- PromedioTP -->
                        <label for="PromedioTP">Promedio:</label>
                        <input type="text" id="PromedioTP" name="PromedioTP" 
                                value="<?= $row['PromedioTP'] ?? '' ?>" 
                                <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
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

           <div class="form-buttons">
                <?php if (!$formulario_firmado): ?>
                    <input type="submit" name="g" value="Guardar Cambios" class="btn btn-primary">
                    <input type="button" value="Limpiar Campos" class="btn btn-secondary" onclick="limpiarCampos()"
                           <?= ($solo_firma) ? 'disabled' : '' ?>>
                <?php else: ?>
                    <input type="submit" name="g" value="Guardar Cambios" class="btn btn-primary" 
                           <?= $es_admin ? '' : 'disabled' ?>>
                    <input type="button" value="Limpiar Campos" class="btn btn-secondary" onclick="limpiarCampos()"
                           <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'disabled' : '' ?>>
                    
                    <?php if ($es_admin && $formulario_firmado): ?>
                        <form method="POST" action="HacerNyP.php" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <input type="hidden" name="action" value="undo_signature">
                            <input type="submit" value="Deshacer Firma" class="btn btn-warning"
                                   onclick="return confirm('¿Estás seguro de que deseas deshacer la firma de este formulario?')">
                        </form>
                    <?php endif; ?>
                    
                        <?php if (!$es_admin): ?>
                            <div class="alert alert-warning mt-3">
                                Este formulario ya ha sido firmado y no puede ser modificado.
                            </div>
                        <?php endif; ?>
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
