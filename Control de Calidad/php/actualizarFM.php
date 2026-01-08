<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Modificar Formulario FM</title>
    <meta charset="UTF-8">
    <!-- Nuevos scripts JS -->
    <script src="../js/cargas.js"></script>
    <script src="../js/SumaT.js"></script>
    <script src="../js/limpiar.js"></script>
    <script src="../js/ValidacionFirma.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Nuevo CSS para el formulario FM -->
    <link rel="stylesheet" href="../css/actualizarFM.css">
    
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC"> 
    
</head>
<body>
<main class="container">
    
    <h1>Modificar Formulario FM</h1>

      <?php
    include "Conexion.php";
    
    // Verificar si el usuario es administrador
    $es_admin = isset($_SESSION['departamento']) && $_SESSION['departamento'] === 'ADMIN';
    
    $ID = $_GET["id"] ?? $_GET["sc"] ?? die("<div class='alert alert-danger'>Error: ID de registro no proporcionado.</div>");
    $query = "SELECT * FROM c_formulariofm WHERE id='$ID'"; 
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

    
    <section class="Registro">
    <!-- El formulario envía los datos al script que procesa la actualización -->
    <!-- Usamos 'ActualizarFM.php' como acción del script de actualización -->
    <form action="HacerFM.php" method="POST" class="needs-validation" id="formulario">
                <!-- Campo oculto para pasar el ID del registro a actualizar -->
                <input type="hidden" value="<?= $row['id'] ?? '' ?>" name="id"> 

            <div class="registro-container">
                <div class="registro-column">
                    
                    <div>
                        <label for="Indicador">Indicador</label>
                        <select id="Indicador" name="Indicador" required <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'disabled' : '' ?>>
                            <!-- Preselecciona la opción actual de Análisis -->
                            <option value="Analisis Fisicoquimico" <?= ($row['Indicador'] == 'Analisis Fisicoquimico') ? 'selected' : '' ?>>Análisis Físicoquímico</option>
                            <option value="Analisis Microbiologico" <?= ($row['Indicador'] == 'Analisis Microbiologico') ? 'selected' : '' ?>>Análisis Microbiológico</option>
                        </select>
                    </div>

                    <div>
                        <label for="Mes">Mes:</label>
                        <!-- type="date" para el campo Mes -->
                        <input type="date" id="Mes" name="Mes" value="<?= $row['Mes'] ?? '' ?>" <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    
                    <h3 class="mt-4 mb-3">Cantidades de Análisis</h3>
                    
                    <div>
                        <label for="Cantidad_insumos">Cantidad de Insumos:</label>
                        <!-- Nuevo campo: Cantidad_insumos -->
                        <input type="number" id="Cantidad_insumos" name="Cantidad_insumos" value="<?= $row['Cantidad_insumos'] ?? '' ?>" placeholder="Cantidad" <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required step="any">
                    </div>
                    <div>
                        <label for="ProductosT">Productos Terminados:</label>
                        <!-- Nuevo campo: ProductosT -->
                        <input type="number" id="ProductosT" name="ProductosT" value="<?= $row['ProductosT'] ?? '' ?>" placeholder="Cantidad" <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required step="any">
                    </div>
                    <div>
                        <label for="ControlesD">Controles Diversos:</label>
                        <!-- Nuevo campo: ControlesD -->
                        <input type="number" id="ControlesD" name="ControlesD" value="<?= $row['ControlesD'] ?? '' ?>" placeholder="Cantidad" <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required step="any">
                    </div>
                    <div>
                        <label for="MaterialesA">Materiales auxiliares:</label>
                        <!-- Nuevo campo: MaterialesA -->
                        <input type="number" id="MaterialesA" name="MaterialesA" value="<?= $row['MaterialesA'] ?? '' ?>" placeholder="Cantidad" <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required step="any">
                    </div>
                    <div>
                        <label for="Total">Total:</label>
                        <!-- Nuevo campo: Total -->
                        <input type="number" id="Total" name="Total" value="<?= $row['Total'] ?? '' ?>" placeholder="Cantidad" <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required step="any">
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
                            <input type="checkbox" id="firmar_documento" name="firmar_documento" class="form-check-input" <?= !$row['permitir_firmar'] ? 'readonly' : '' ?> required>
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
                        <form method="POST" action="HacerFM.php" style="display:inline;">
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
    
    <!-- Se actualiza el enlace de regreso a TipoFormulario.php -->
    <a href="./MenuModifi.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90" alt="Volver a la página de inicio">
    </a>
</main>
</body>
</html>
