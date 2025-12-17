<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Indicadores de Apoyo a la Infraestructura Informática</title>
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

    <h1>Actualizar Indicadores</h1>
    <h4>Apoyo a la Infraestructura Informática</h4>
    
    <?php
    include "Conexion.php";
    
    $ID = $_GET["id"] ?? $_GET["sc"] ?? die("<div class='alert alert-danger'>Error: ID de registro no proporcionado.</div>");
    $query = "SELECT * FROM i_indicador WHERE id='$ID'"; 
    $res = mysqli_query($link, $query);
    
    if (!$res || mysqli_num_rows($res) == 0) {
        die("<div class='alert alert-danger'>Error: Registro no encontrado.</div>");
    }
    
    $row = mysqli_fetch_array($res);

    // Verificar permisos
    $solo_firma = !empty($row['permitir_firmar']) && empty($row['permitir_modificar']);
    $formulario_firmado = !empty($row['firma_usuario']);
    
    // Si solo está permitido firmar y el formulario ya está firmado, bloquear todo
    if ($solo_firma && $formulario_firmado) {
        echo "<script>
            alert('Este formulario ya ha sido firmado y no puede ser modificado.');
            window.location.href = 'MenuIndi.php';
        </script>";
        exit();
    }

    // Si no tiene permisos de modificación ni firma
    if (empty($row['permitir_modificar']) && empty($row['permitir_firmar'])) {
        echo "<script>
            alert('No tienes permisos para modificar o firmar este formulario. Contacta al administrador.');
            window.location.href = 'MenuIndi.php';
        </script>";
        exit();
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
        <form method="post" action="HacerIndi.php" id="formulario">
            <input type="hidden" name="id" value="<?= $row['id'] ?? '' ?>">
            
            <div class="registro-container">
                <div class="registro-column">
                    <div>
                        <div>
                            <label for="Claveregis">Clave de Registro:</label>
                            <input type="text" id="Claveregis" name="Claveregis" 
                                   value="<?= $row['Claveregis'] ?? '' ?>" 
                                   placeholder="Ingrese la cantidad" 
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
                    
                    <!-- Solicitud de Servicio -->
                    <div>
                        <hr>
                        <label>Solicitud de Servicio</label><br>
                        <hr>
                        <label>Atender las solicitudes Generadas Por el Usuario</label>
                        <hr>

                        <label for="SolicitudesAtendidas">Solicitudes Atendidas:</label>
                        <input type="number" id="SolicitudesAtendidas" name="SolicitudesAtendidas" 
                               value="<?= $row['SolicitudesAtendidas'] ?? '' ?>" 
                               placeholder="Ingrese la cantidad" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required step="any">
                    </div>
                    <div>
                        <label for="NumSolicitudes">Solicitudes Generadas por el Usuario:</label>
                        <input type="number" id="NumSolicitudes" name="NumSolicitudes" 
                               value="<?= $row['NumSolicitudes'] ?? '' ?>" 
                               placeholder="Ingrese la cantidad" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required step="any">
                    </div>
                    <div>
                        <label for="PorSolicitudesAtendidas">Porcentaje de solicitudes Atendidas:</label>
                        <input type="number" id="PorSolicitudesAtendidas" name="PorSolicitudesAtendidas" 
                               value="<?= $row['PorSolicitudesAtendidas'] ?? '' ?>" 
                               placeholder="%:" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required step="any">
                    </div>
                    <div>
                        <label for="EventualidadesMes">Eventualidades Presentadas en el Mes:</label>
                        <input type="number" id="EventualidadesMes" name="EventualidadesMes" 
                               value="<?= $row['EventualidadesMes'] ?? '' ?>" 
                               placeholder="Ej. 0" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required step="any">
                    </div>
                    <div>
                        <label for="MetaEsperadaMB">Meta Esperada:</label>
                        <input type="text" id="MetaEsperadaMB" name="MetaEsperadaMB" 
                               value="<?= $row['MetaEsperadaMB'] ?? '' ?>" 
                               placeholder="La meta esperada es:" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="RangoAceptMB">Rango de Aceptación:</label>
                        <input type="text" id="RangoAceptMB" name="RangoAceptMB" 
                               value="<?= $row['RangoAceptMB'] ?? '' ?>" 
                               placeholder="Ej. 95% al 100%" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="TendenciaDeseadaMB">Tendencia Deseada:</label>
                        <input type="text" id="TendenciaDeseadaMB" name="TendenciaDeseadaMB" 
                               value="<?= $row['TendenciaDeseadaMB'] ?? '' ?>" 
                               placeholder="Ej. Mantener el 100% de las Solicitudes Atendidas" 
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
                        <label for="Fuente">Fuente:</label><br><br>
                        <textarea id="Fuente" name="Fuente" rows="4" 
                                  placeholder="Fuente" 
                                  <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                                  required><?= $row['Fuente'] ?? '' ?></textarea>
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

    <a href="InformaticaP.php" class="home-link">
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
<?php include "Cerrar.php"; ?>