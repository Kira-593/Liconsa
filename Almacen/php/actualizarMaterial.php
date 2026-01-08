<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Existencia de Materiales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/actualizarMaterial.css">
    <script src="../js/limpiar.js"></script>
    <script src="../js/ValidacionFirma.js"></script>
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC"> 
</head>
<body>
<div class="container">
    
    <h2>Modificar Existencia de Materia Prima y Material de Envase</h2>
    
    <?php
    include "Conexion.php";
    
    // Verificar si el usuario es administrador
    $es_admin = isset($_SESSION['departamento']) && $_SESSION['departamento'] === 'ADMIN';
    
    $ID = $_GET["id"] ?? $_GET["sc"] ?? die("<div class='alert alert-danger'>Error: ID de registro no proporcionado.</div>");
    $query = "SELECT * FROM a_existenciasmaterial WHERE id='$ID'"; 
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
        <!-- El formulario envía los datos al script HacerMaterial.php (acción 'hacer' como en Subg) -->
        <form action="HacerMaterial.php?action=hacer" method="POST" class="needs-validation" id="formulario">
            <!-- Campo oculto para pasar el ID del registro a actualizar -->
            <input type="hidden" value="<?= $row['id'] ?? '' ?>" name="id"> 
        
            <div class="registro-container">
                <div class="registro-column">
                    
                    <div>
                        <label for="Indicador">Material</label>
                        <select id="Indicador" name="Indicador" <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'disabled' : '' ?> required>
                             <!-- Preselecciona la opción actual -->
                            <option value="Existencias de Materia Prima" <?= ($row['Indicador'] == 'Existencias de Materia Prima') ? 'selected' : '' ?>>Existencias de Materia Prima</option>
                            <option value="Existencias de Material de Envase" <?= ($row['Indicador'] == 'Existencias de Material de Envase') ? 'selected' : '' ?>>Existencias de Material de Envase</option>
                        </select>
                    </div>

                    <div>
                        <label for="Mes">Mes:</label>
                        <input type="date" id="Mes" name="Mes" value="<?= $row['Mes'] ?? '' ?>" <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    
                    <h3 class="mt-4 mb-3">Detalles del Material</h3>
                    
                    <div>
                        <label for="CodigoTC">Código:</label>
                        <input type="number" id="CodigoTC" name="CodigoTC" value="<?= $row['CodigoTC'] ?? '' ?>" <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> placeholder="Ej. 576" required step="any">
                    </div>
                    <div>
                        <label for="DescripcionTD">Descripción:</label>
                        <input type="text" id="DescripcionTD" name="DescripcionTD" value="<?= $row['DescripcionTD'] ?? '' ?>" <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> placeholder="Ej. Polietileno para Frisia de 1LT" required>
                    </div>
                    
                    <h3 class="mt-4 mb-3">Cantidades (en Kg o Unidad equivalente)</h3>
                    
                    <div>
                        <label for="CantidadITC">Cantidad Inicial:</label>
                        <input type="number" id="CantidadITC" name="CantidadITC" value="<?= $row['CantidadITC'] ?? '' ?>" <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> placeholder="Kg" required step="any">
                    </div>
                    <div>
                        <label for="CantidadETC">Cantidad de Entradas:</label>
                        <input type="number" id="CantidadETC" name="CantidadETC" value="<?= $row['CantidadETC'] ?? '' ?>" <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> placeholder="Kg" required step="any">
                    </div>
                    <div>
                        <label for="CantidadCTC">Cantidad de Consumo:</label>
                        <input type="number" id="CantidadCTC" name="CantidadCTC" value="<?= $row['CantidadCTC'] ?? '' ?>" <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> placeholder="Kg" required step="any">
                    </div>
                    <div>
                        <label for="CantidadFTC">Cantidad Final:</label>
                        <input type="number" id="CantidadFTC" name="CantidadFTC" value="<?= $row['CantidadFTC'] ?? '' ?>" <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> placeholder="Kg" required step="any">
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
                           <?= ($solo_firma || !$es_admin) ? 'disabled' : '' ?>>
                    
                    <?php if ($es_admin && $formulario_firmado): ?>
                        <form method="POST" action="HacerMaterial.php" style="display:inline;">
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
            
        </form>
    </section>
    
    <?php include "Cerrar.php"; ?>
    <a href="MenuModifi.php" class="home-link"><img src="../imagenes/home.png" height="100" width="90"></a>
</div>
</body>
</html>