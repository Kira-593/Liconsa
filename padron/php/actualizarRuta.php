<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Rutas de Distribución</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/actualizarRutas.css">
    <script src="../js/cargas.js"></script>
    <script src="../js/SumaT.js"></script>
    <script src="../js/limpiar.js"></script>
    <script src="../js/ValidacionFirma.js"></script>
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">
</head>
<body>
<div class="container">
    <h2>Modificar Rutas de Distribución</h2>
     
    <?php
    include "Conexion.php";
    
    // Verificar si el usuario es administrador
    $es_admin = isset($_SESSION['departamento']) && $_SESSION['departamento'] === 'ADMIN';
    
    $ID = $_GET["id"] ?? $_GET["sc"] ?? die("<div class='alert alert-danger'>Error: ID de registro no proporcionado.</div>");
    $query = "SELECT * FROM p_rutasdistribucion WHERE id='$ID'"; 
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
            window.location.href = 'MenuIndi.php';
        </script>";
        exit();
    }

    // Mostrar alerta si es admin accediendo a un registro firmado
    if ($es_admin && $formulario_firmado) {
        echo "<div class='alert alert-warning'>
            <strong>🔓 Acceso de Administrador</strong><br>
            Como administrador, puedes modificar este formulario firmado y deshacer la firma si es necesario.
        </div>";
    }

    // Mostrar estado de firma si ya está firmado
    if ($formulario_firmado): ?>
        <div class="alert alert-info">
            <strong>✅ Formulario Firmado</strong><br>
            Firmado por: <?= $row['firma_usuario'] ?><br>
            Fecha: <?= $row['fecha_firma'] ?>
        </div>
    <?php endif; ?>

    <form action="HacerRutas.php" method="POST" class="needs-validation" id="formulario">
        <input type="hidden" value="<?= $row['id'] ?? '' ?>" name="id">

        <div class="registro-container">
            <!-- Columna 1 - Mantener la misma estructura que en registro -->
            <div class="registro-column">
                <div>
                    <label for="Mes">Mes:</label>
                    <input type="date" id="Mes" name="Mes" value="<?= $row['Mes'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                </div>
                
                <div class="seccion-transporte">
                    <hr>
                    <label class="titulo-seccion">Transporte Propio</label>
                    <hr>
                </div>

                <div>
                    <label for="LitrosTRuno">Litros Desplazados de R1:</label>
                    <input type="number" id="LitrosTRuno" name="LitrosTRuno" value="<?= $row['LitrosTRuno'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                </div>
                
                <div>
                    <label for="PorcentajeTRuno">Porcentaje que Representa R1:</label>
                    <input type="number" id="PorcentajeTRuno" name="PorcentajeTRuno" placeholder="Ej. 27%" value="<?= $row['PorcentajeTRuno'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                </div>
                
                <div>
                    <label for="LitrosTRdos">Litros Desplazados de R2:</label>
                    <input type="number" id="LitrosTRdos" name="LitrosTRdos" value="<?= $row['LitrosTRdos'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                </div>
            </div>
            
            <!-- Columna 2 - Mantener la misma estructura que en registro -->
            <div class="registro-column">
                <div>
                    <label for="PorcentajeTRdos">Porcentaje que Representa R2:</label>
                    <input type="number" id="PorcentajeTRdos" name="PorcentajeTRdos" placeholder="Ej. 26%" value="<?= $row['PorcentajeTRdos'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                </div>
                
                <div>
                    <label for="LitrosTRtres">Litros Desplazados de R3:</label>
                    <input type="number" id="LitrosTRtres" name="LitrosTRtres" value="<?= $row['LitrosTRtres'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                </div>
                
                <div>
                    <label for="PorcentajeTRtres">Porcentaje que Representa R3:</label>
                    <input type="number" id="PorcentajeTRtres" name="PorcentajeTRtres" placeholder="Ej. 29%" value="<?= $row['PorcentajeTRtres'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                </div>
                
                <div>
                    <label for="LitrosTRcuatro">Litros Desplazados de R4:</label>
                    <input type="number" id="LitrosTRcuatro" name="LitrosTRcuatro" value="<?= $row['LitrosTRcuatro'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                </div>
                
                <div>
                    <label for="PorcentajeTRcuatro">Porcentaje que Representa R4:</label>
                    <input type="number" id="PorcentajeTRcuatro" name="PorcentajeTRcuatro" placeholder="Ej. 18%" value="<?= $row['PorcentajeTRcuatro'] ?? '' ?>" 
                           <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                </div>
                
                <!-- Sección de firma digital - SOLO PARA ACTUALIZACIÓN -->
                <?php if ($row['permitir_firmar'] && !$formulario_firmado): ?>
                <div class="firma-section">
                    <div class="seccion-transporte">
                        <hr>
                        <label class="titulo-seccion">Firma Digital</label>
                        <hr>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="clave_firma">Clave de Firma:</label>
                            <input type="password" id="clave_firma" name="clave_firma" class="form-control" 
                                   placeholder="Ingrese su clave única de firma">
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
                       <?= ($solo_firma || !$es_admin) ? 'disabled' : '' ?>>
                
                <?php if ($es_admin && $formulario_firmado): ?>
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <input type="hidden" name="action" value="undo_signature">
                    <input type="submit" name="deshacer_firma" value="Deshacer Firma" class="btn btn-warning"
                           onclick="return confirm('¿Estás seguro de que deseas deshacer la firma de este formulario?')">
                <?php endif; ?>
                
                <?php if (!$es_admin): ?>
                    <div class="alert alert-warning mt-3">
                        Este formulario ya ha sido firmado y no puede ser modificado.
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </form>

    <br><br><a href="MenuModifi.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90" alt="Volver">
    </a>
</div>
</body>
</html>