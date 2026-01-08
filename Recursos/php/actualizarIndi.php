<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Modificar Indicadores de Recursos Financieros</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/cargas.js"></script>
    <script src="../js/Indicadores.js"></script>
    <script src="../js/limpiar.js"></script>
    <script src="../js/ValidacionFirma.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/actualizarIndi.css">
    
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC"> 
    
</head>
<body>
<main class="container">
    
    <h1>Indicadores</h1>
    <h4>Recursos Financieros</h4>

     <?php
    include "Conexion.php";
    
    // Verificar si el usuario es administrador
    $es_admin = isset($_SESSION['departamento']) && $_SESSION['departamento'] === 'ADMIN';
    
    $ID = $_GET["id"] ?? $_GET["sc"] ?? die("<div class='alert alert-danger'>Error: ID de registro no proporcionado.</div>");
    $query = "SELECT * FROM r_indicador WHERE id='$ID'"; 
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
            window.location.href = 'MenuIndi.php';
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
        <form action="HacerIndi.php" method="POST" class="needs-validation" id="formulario">
            <!-- Campo oculto para pasar el ID del registro a actualizar -->
            <input type="hidden" value="<?= $row['id'] ?? '' ?>" name="id"> 
    
            <div class="registro-container">
                <div class="registro-column">

                    <div>
                        <label for="Claveregis">Clave de Registro:</label>
                        <input type="text" id="Claveregis" name="Claveregis" 
                               value="<?= $row['Claveregis'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> 
                               placeholder="Ingrese la cantidad" required>

                        <label for="Mes">Fecha de Elaboración:</label>
                        <input type="date" id="Mes" name="Mes" 
                               value="<?= $row['Mes'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                        <label for="Periodo">Periodo:</label>
                        <input type="date" id="Periodo" name="Periodo" 
                               value="<?= $row['Periodo'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>

                    <div>
                        <hr>
                        <label>Suficiencia Presupuestal</label><br>
                        <hr>

                        <label for="ExpedinAut">Numero de Expendientes de Sufuciencia Presupuestal Autorizados:</label>
                        <input type="number" id="ExpedinAut" name="ExpedinAut" 
                               value="<?= $row['ExpedinAut'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               placeholder="Ingrese la cantidad" required step="any">
                    </div>

                    <div>
                        <label for="ExpendiReci">Numero de Expendientes de Sificiencia Presupuestal Recibidos:</label>
                        <input type="number" id="ExpendiReci" name="ExpendiReci" 
                               value="<?= $row['ExpendiReci'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               placeholder="Ingrese la cantidad" required step="any">
                    </div>

                    <div>
                        <label for="PorcentajeExpAut">Porcentaje de Expendientes Autorizados:</label>
                        <input type="number" id="PorcentajeExpAut" name="PorcentajeExpAut" 
                               value="<?= $row['PorcentajeExpAut'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               placeholder="Ingrese el porcentaje" required step="any">
                    </div>

                    <div>
                        <label for="MetaEsperadaMB">Meta Esperada:</label>
                        <textarea id="MetaEsperadaMB" name="MetaEsperadaMB" rows="3"
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               placeholder="La meta esperada es:" required><?= $row['MetaEsperadaMB'] ?? '' ?></textarea>
                    </div>

                    <div>
                        <label for="RangoAceptMB">Rango de Aceptación:</label>
                        <input type="text" id="RangoAceptMB" name="RangoAceptMB" 
                               value="<?= $row['RangoAceptMB'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               placeholder="Ej. 70% de expedientes autorizados" required>
                    </div>

                    <div>
                        <label for="TendenciaDeseadaMB">Tendencia Deseada:</label>
                        <input type="text" id="TendenciaDeseadaMB" name="TendenciaDeseadaMB" 
                               value="<?= $row['TendenciaDeseadaMB'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               placeholder="Ej. 100 puntos , Meta Alcanzada" required>
                    </div>

                    <div>
                        <hr>
                        <label for="Responsable">Responsable:</label>
                        <input type="text" id="Responsable" name="Responsable" 
                               value="<?= $row['Responsable'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               placeholder="Nombre del responsable" required>
                    </div>

                    <div>
                        <label for="Fuente">Fuente:</label><br><br>
                        <textarea id="Fuente" name="Fuente" rows="4" 
                                  <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                                  placeholder="" required><?= $row['Fuente'] ?? '' ?></textarea>
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

                    <hr>

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
    
    <a href="./RecursosP.php" class="home-link">
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