<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Modificar Captación de Leche</title>
    <meta charset="UTF-8">
    <script src="../js/cargas.js"></script>
    <script src="../js/SumaT.js"></script>
    <script src="../js/limpiar.js"></script>
    <script src="../js/ValidacionFirma.js"></script> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/actualizarRCT.css">
    
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC"> 
</head>
<body>
<main class="container">
    
    <h1>Modificar Registro de Captación de Leche</h1>

    <?php
    include "Conexion.php";
    
    $es_admin = isset($_SESSION['departamento']) && $_SESSION['departamento'] === 'ADMIN';
    
    $ID = $_GET["id"] ?? $_GET["sc"] ?? die("<div class='alert alert-danger'>Error: ID de registro no proporcionado.</div>");
    $query = "SELECT * FROM c_captacionleche WHERE id='$ID'"; 
    $res = mysqli_query($link, $query);
    
    if (!$res || mysqli_num_rows($res) == 0) {
        die("<div class='alert alert-danger'>Error: Registro no encontrado.</div>");
    }
    
    $row = mysqli_fetch_array($res);

    $solo_firma = $row['permitir_firmar'] && !$row['permitir_modificar'];
    $formulario_firmado = !empty($row['firma_usuario']);
    
    if ($solo_firma && $formulario_firmado && !$es_admin) {
        echo "<script>
            alert('Este formulario ya ha sido firmado y no puede ser modificado.');
            window.location.href = 'MenuModifi.php';
        </script>";
        exit();
    }

    if (!$row['permitir_modificar'] && !$row['permitir_firmar'] && !$es_admin) {
        echo "<script>
            alert('No tienes permisos para modificar o firmar este formulario. Contacta al administrador.');
            window.location.href = 'MenuModifi.php';
        </script>";
        exit();
    }

    if ($es_admin && $formulario_firmado) {
        echo "<div class='alert alert-warning'>
            <strong>🔓 Acceso de Administrador</strong><br>
            Como administrador, puedes modificar este formulario firmado y deshacer la firma si es necesario.
        </div>";
    }

    if ($formulario_firmado): ?>
        <div class="alert alert-info">
            <strong>✅ Formulario Firmado</strong><br>
            Firmado por: <?= $row['firma_usuario'] ?><br>
            Fecha: <?= $row['fecha_firma'] ?>
        </div>
    <?php endif; ?>
    
    <section class="registro">
        <form action="HacerRCT.php" method="POST" class="needs-validation" id="formulario">
            <input type="hidden" value="<?= $row['id'] ?? '' ?>" name="id">
        
            <div class="registro-container">
                <!-- Columna 1 -->
                <div class="registro-column">
                    <!-- Provedor (CORREGIDO: name="Provedor" en lugar de "Proveedor") -->
                    <div>
                        <label for="Provedor">Provedor:</label>
                        <input type="text" id="Provedor" name="Provedor" 
                               value="<?= $row['Proveedor'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               placeholder="Ej. Nombre, locacion, periodo" required>
                    </div>

                    <!-- Folio -->
                    <div>
                        <label for="Folio">Folio:</label>
                        <input type="number" id="Folio" name="Folio" 
                               value="<?= $row['Folio'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               placeholder="Ej. 151" required>
                    </div>

                    <!-- FechaDictamen -->
                    <div>
                        <label for="FechaDictamen">Fecha de Dictamen:</label>
                        <input type="date" id="FechaDictamen" name="FechaDictamen" 
                               value="<?= $row['FechaDictamen'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               placeholder="Ej. 01/07/2025" required>
                    </div>

                    <!-- Remision -->
                    <div>
                        <label for="Remision">Remisión:</label>
                        <input type="text" id="Remision" name="Remision" 
                               value="<?= $row['Remision'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               placeholder="Ej. SJU-481" required>
                    </div>

                    <!-- Densidad -->
                    <div>
                        <label for="Densidad">Densidad (g/mL):</label>
                        <input type="number" step="0.0001" id="Densidad" name="Densidad" 
                               value="<?= $row['Densidad'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               placeholder="Ej. 1.0315" required>
                    </div>

                    <!-- Volumen -->
                    <div>
                        <label for="Volumen">Volumen (Litros):</label>
                        <input type="number" step="0.01" id="Volumen" name="Volumen" 
                               value="<?= $row['Volumen'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               placeholder="Ej. 14,009" required>
                    </div>

                    <!-- Grasa -->
                    <div>
                        <label for="Grasa">Grasa (g/L):</label>
                        <input type="number" step="0.1" id="Grasa" name="Grasa" 
                               value="<?= $row['Grasa'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               placeholder="Ej. 38.3" required>
                    </div>
                </div>
                
                <!-- Columna 2 -->
                <div class="registro-column">
                    <!-- SNG -->
                    <div>
                        <label for="SNG">S.N.G. (g/L):</label>
                        <input type="number" step="0.1" id="SNG" name="SNG" 
                               value="<?= $row['SNG'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               placeholder="Ej. 90.1" required>
                    </div>

                    <!-- Proteina -->
                    <div>
                        <label for="Proteina">Proteína (g/L):</label>
                        <input type="number" step="0.1" id="Proteina" name="Proteina" 
                               value="<?= $row['Proteina'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               placeholder="Ej. 32.8" required>
                    </div>

                    <!-- Caseina -->
                    <div>
                        <label for="Caseina">Caseína (g/L):</label>
                        <input type="number" step="0.1" id="Caseina" name="Caseina" 
                               value="<?= $row['Caseina'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               placeholder="Ej. 25.5" required>
                    </div>

                    <!-- Acidez -->
                    <div>
                        <label for="Acidez">Acidez (g/L):</label>
                        <input type="number" step="0.01" id="Acidez" name="Acidez" 
                               value="<?= $row['Acidez'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               placeholder="Ej. 1.45" required>
                    </div>

                    <!-- Temperatura -->
                    <div>
                        <label for="Temperatura">Temperatura (°C):</label>
                        <input type="number" step="0.1" id="Temperatura" name="Temperatura" 
                               value="<?= $row['Temperatura'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               placeholder="Ej. 5" required>
                    </div>

                    <!-- PH -->
                    <div>
                        <label for="PH">P.C. °H:</label>
                        <input type="number" step="0.001" id="PH" name="PH" 
                               value="<?= $row['PH'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               placeholder="Ej. -0.546" required>
                    </div>

                    <!-- Reductasa -->
                    <div>
                        <label for="Reductasa">Reductasa (min):</label>
                        <input type="number" id="Reductasa" name="Reductasa" 
                               value="<?= $row['Reductasa'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               placeholder="Ej. 340" required>
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
                    <input type="submit" name="g" value="Guardar Cambios">
                    <input type="button" value="Limpiar Campos" onclick="limpiarCampos()"
                           <?= ($solo_firma) ? 'disabled' : '' ?>>
                <?php else: ?>
                    <input type="submit" name="g" value="Guardar Cambios" 
                           <?= $es_admin ? '' : 'disabled' ?>>
                    <input type="button" value="Limpiar Campos" onclick="limpiarCampos()"
                           <?= ($solo_firma || !$es_admin) ? 'disabled' : '' ?>>
                    
                    <?php if ($es_admin && $formulario_firmado): ?>
                        <form method="POST" action="HacerRCT.php" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <input type="hidden" name="action" value="undo_signature">
                            <input type="submit" value="Deshacer Firma" class="btn-warning"
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
    
    <a href="MenuModifi.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90">
    </a>
</main>
</body>
</html>