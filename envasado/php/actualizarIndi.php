<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Indicadores de Envasado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/actualizarIndi.css">
    <script src="../js/cargas.js"></script>
    <script src="../js/ValidacionFirma.js"></script>
    <script src="../js/limpiar.js"></script>
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">
</head>
<body>
<main class="container">
    
    <h1>Indicadores</h1>
    <h4>Actualizar Envasado</h4>

    <?php
    include "Conexion.php";
    
    $es_admin = isset($_SESSION['departamento']) && $_SESSION['departamento'] === 'ADMIN';
    $ID = $_GET["id"] ?? $_GET["sc"] ?? die("<div class='alert alert-danger'>Error: ID de registro no proporcionado.</div>");
    $query = "SELECT * FROM envasado_indicador WHERE id='$ID'"; 
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
            window.location.href = 'envasadoP.php';
        </script>";
        exit();
    }

    if (!$row['permitir_modificar'] && !$row['permitir_firmar'] && !$es_admin) {
        echo "<script>
            alert('No tienes permisos para modificar o firmar este formulario. Contacta al administrador.');
            window.location.href = 'envasadoP.php';
        </script>";
        exit();
    }

    if ($es_admin && $formulario_firmado) {
        echo "<div class='alert alert-warning alert-section'>
            <strong>🔓 Acceso de Administrador</strong><br>
            Como administrador, puedes modificar este formulario firmado y deshacer la firma si es necesario.
        </div>";
    }

    if ($formulario_firmado): ?>
        <div class="alert alert-info alert-section">
            <strong>✅ Formulario Firmado</strong><br>
            Firmado por: <?= $row['firma_usuario'] ?><br>
            Fecha: <?= $row['fecha_firma'] ?>
        </div>
    <?php endif; ?>
    
    <section class="registro">
        <form action="HacerIndi.php" method="POST" id="formulario">
            <input type="hidden" value="<?= $row['id'] ?? '' ?>" name="id">
            
            <div class="registro-container">
                <!-- Columna 1 -->
                <div class="registro-column">
                    <div>
                        <label for="Claveregis">Clave de Registro:</label>
                        <input type="text" id="Claveregis" name="Claveregis" 
                               value="<?= $row['Claveregis'] ?? '' ?>" 
                               placeholder="Ingrese la Clave" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               required>
                    </div>
                    
                    <div>
                        <label for="FechaAct">Fecha de Actualización:</label>
                        <input type="date" id="FechaAct" name="FechaAct" 
                               value="<?= $row['FechaAct'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               required>
                    </div>
                    
                    <div>
                        <label for="Mes">Fecha de Elaboración:</label>
                        <input type="date" id="Mes" name="Mes" 
                               value="<?= $row['Mes'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               required>
                    </div>
                    
                    <div>
                        <label for="Periodo">Periodo:</label>
                        <input type="date" id="Periodo" name="Periodo" 
                               value="<?= $row['Periodo'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               required>
                    </div>
                    
                    <div class="seccion-titulo">
                        <hr>
                        <label class="titulo-seccion">Calidad de leche Reconstruida (VOLUMEN) Abasto y Frisia</label>
                        <hr>
                    </div>
                </div>
                
                <!-- Columna 2 -->
                <div class="registro-column">
                    <div>
                        <label for="RepAbasto">Reporte Mensual de Control de Calidad de Leche Pasteurizada ABASTO:</label>
                        <input type="number" id="RepAbasto" name="RepAbasto" 
                               value="<?= $row['RepAbasto'] ?? '' ?>" 
                               placeholder="Ingrese la cantidad" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               required step="any">
                    </div>
                    
                    <div>
                        <label for="RepFrisia">Reporte Mensual de Control de Calidad de Leche Pasteurizada FRISIA:</label>
                        <input type="number" id="RepFrisia" name="RepFrisia" 
                               value="<?= $row['RepFrisia'] ?? '' ?>" 
                               placeholder="Ingrese la cantidad" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               required step="any">
                    </div>
                    
                    <div>
                        <label for="MetaEsperadaMB">Meta Esperada:</label>
                        <textarea id="MetaEsperadaMB" name="MetaEsperadaMB" 
                                  placeholder="La meta esperada es:" 
                                  <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                                  required><?= $row['MetaEsperadaMB'] ?? '' ?></textarea>
                    </div>
                    
                    <div>
                        <label for="RangoAcept">Rango de Aceptación:</label>
                        <textarea id="RangoAcept" name="RangoAcept" 
                                  placeholder="Ej. Volumen de Abasto: 2000 ml minimo, 2005 ml maximo" 
                                  <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                                  required><?= $row['RangoAcept'] ?? '' ?></textarea>
                    </div>
                    
                    <div>
                        <label for="TendenciaDeseadaMB">Tendencia Deseada:</label>
                        <input type="text" id="TendenciaDeseadaMB" name="TendenciaDeseadaMB" 
                               value="<?= $row['TendenciaDeseadaMB'] ?? '' ?>" 
                               placeholder="Ej. 100 puntos , Meta Alcanzada" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               required>
                    </div>
                    
                    <div class="espacio-adicional">
                        <!-- Espacio para campos adicionales si es necesario -->
                    </div>
                </div>
            </div>
            
            <!-- Campos Responsable y Fuente fuera de las columnas -->
            <div style="margin-top: 20px;">
                <div>
                    <label for="Responsable">Responsable:</label>
                    <input type="text" id="Responsable" name="Responsable" 
                           value="<?= $row['Responsable'] ?? '' ?>" 
                           placeholder="Nombre del responsable" 
                           <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                           required>
                </div>
                
                <div>
                    <label for="ObservacionesRes">Fuente:</label>
                    <textarea id="ObservacionesRes" name="ObservacionesRes" rows="4" 
                              placeholder="Reporte mensual de produccion, reporte de leche pasteurizada de control de calidad." 
                              <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                              required><?= $row['ObservacionesRes'] ?? '' ?></textarea>
                </div>
            </div>
            
            <!-- SECCIÓN DE FIRMA CENTRADA -->
            <div class="firma-section mt-4 p-3 border rounded" style="max-width: 800px; margin: 30px auto 20px auto;">
                <h4 style="text-align: center;">Firma Digital</h4>
                
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
                    
                    <div class="form-check mb-3" style="text-align: center;">
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
                    <input type="submit" name="g" value="Guardar Cambios" class="btn" 
                           <?= $es_admin ? '' : 'disabled' ?>>
                    <input type="button" value="Limpiar Campos" class="btn" onclick="limpiarCampos()"
                           <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'disabled' : '' ?>>
                    
                    <?php if ($es_admin && $formulario_firmado): ?>
                        <form method="POST" action="HacerIndi.php" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <input type="hidden" name="action" value="undo_signature">
                            <input type="submit" value="Deshacer Firma" class="btn"
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
    
    <a href="EnvasadoP.php" class="home-link">
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