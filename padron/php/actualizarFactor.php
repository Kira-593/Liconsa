<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Factor de Retiro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/actualizarfactor.css">
    <script src="../js/limpiar.js"></script>
    <script src="../js/ValidacionFirma.js"></script>
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC"> 
</head>
<body>
<div class="container">
    <h2>Modificar Factor de Retiro</h2>
    
    <?php
    include "Conexion.php";
    
    $ID = $_GET["sc"] ?? die("<div class='alert alert-danger'>Error: ID de registro no proporcionado.</div>");
    $query = "SELECT * FROM p_factorretiro WHERE id='$ID'"; 
    $res = mysqli_query($link, $query);
    
    if (!$res || mysqli_num_rows($res) == 0) {
        die("<div class='alert alert-danger'>Error: Registro no encontrado.</div>");
    }
    
    $row = mysqli_fetch_array($res);

    // Verificar permisos
    $solo_firma = $row['permitir_firmar'] && !$row['permitir_modificar'];
    $formulario_firmado = !empty($row['firma_usuario']);
    
    // Si solo está permitido firmar y el formulario ya está firmado, bloquear todo
    if ($solo_firma && $formulario_firmado) {
        echo "<script>
            alert('Este formulario ya ha sido firmado y no puede ser modificado.');
            window.location.href = 'MenuModifi.php';
        </script>";
        exit();
    }

    // Si no tiene permisos de modificación ni firma
    if (!$row['permitir_modificar'] && !$row['permitir_firmar']) {
        echo "<script>
            alert('No tienes permisos para modificar o firmar este formulario. Contacta al administrador.');
            window.location.href = 'MenuModifi.php';
        </script>";
        exit();
    }

    // Mostrar estado de firma si ya está firmado
    if ($formulario_firmado): ?>
        <div class="alert alert-info">
            <strong>✅ Formulario Firmado</strong><br>
            Firmado por: <?= $row['firma_usuario'] ?><br>
            Fecha: <?= $row['fecha_firma'] ?>
        </div>
    <?php endif; ?>

    <form action="HacerFactor.php" method="POST" class="needs-validation" id="formulario">
        <input type="hidden" value="<?= $row['id'] ?? '' ?>" name="id">
        
        <div class="registro-container">
            <div class="registro-column">
                <div class="mb-3">
                    <label for="Indicador">Tipo de Leche</label>
                    <select id="Indicador" name="Indicador" <?= ($solo_firma || $formulario_firmado) ? 'disabled' : '' ?> required>
                        <option value="Liquida de Abasto" <?= ($row['Indicador'] == 'Liquida de Abasto') ? 'selected' : '' ?>>Liquida de Abasto</option>
                        <option value="Polvo de Abasto" <?= ($row['Indicador'] == 'Polvo de Abasto') ? 'selected' : '' ?>>Polvo de Abasto</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="Mes">Mes:</label>
                    <input type="date" id="Mes" name="Mes" value="<?= $row['Mes'] ?? '' ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                </div>
                
                <h3 class="mt-4 mb-3">Cantidades</h3>
                
                <div class="mb-3">
                    <label for="FactorRTF">Factor de Retiro Mínimo:</label>
                    <input type="number" id="FactorRTF" name="FactorRTF" value="<?= $row['FactorRTF'] ?? '' ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                </div>
                
                <div class="mb-3">
                    <label for="AlcanceTA">Alcance del Mes:</label>
                    <input type="number" id="AlcanceTA" name="AlcanceTA" value="<?= $row['AlcanceTA'] ?? '' ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
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
                               placeholder="Ingrese su clave única de firma"
                                <?= !$row['permitir_firmar'] ? 'readonly' : '' ?>>
                        <small>
                            Ingrese su clave única de firma para validar este formulario.
                        </small>
                    </div>
                    <div class="col-md-6">
                        <label for="confirmar_clave">Confirmar Clave:</label>
                        <input type="password" id="confirmar_clave" name="confirmar_clave" class="form-control" 
                               placeholder="Confirme su clave de firma"
                               <?= !$row['permitir_firmar'] ? 'readonly' : '' ?>>
                    </div>
                </div>
                
                <div class="form-check mb-3">
                    <label class="form-check-label" for="firmar_documento" style="display:inline-flex;align-items:center;gap:6px;cursor:pointer;">
                        <input type="checkbox" id="firmar_documento" name="firmar_documento" class="form-check-input"  required>
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
        
        <div class="row mt-4">
            <div class="col-12 text-center">
                <?php if (!$formulario_firmado): ?>
                    <input type="submit" value="Guardar Cambios" class="btn btn-primary me-2" id="btnGuardar">
                    <input type="button" value="Limpiar Campos" class="btn btn-secondary" onclick="limpiarCampos()"
                    <?= ($solo_firma) ? 'disabled' : '' ?>>
                <?php else: ?>
                    <div class="alert alert-warning">
                        Este formulario ya ha sido firmado y no puede ser modificado.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </form>
    
    <br><a href="MenuModifi.php" class="back-link"><img src="../imagenes/home.png" height="100" width="90"></a>
</div>
</body>
</html>