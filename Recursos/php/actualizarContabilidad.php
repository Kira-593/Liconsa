<?php
   session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Indicadores Contabilidad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/actualizarContabilidad.css">
    <script src="../js/cargas.js"></script>
    <script src="../js/SumasConta.js"></script>
    <script src="../js/limpiar.js"></script>
    <script src="../js/ValidacionFirma.js"></script>
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC"> 
</head>
<body>
<main class="container">
    
    <h1>Depto. de Contabilidad</h1>

    <?php
    include "Conexion.php";
    
    $es_admin = isset($_SESSION['departamento']) && $_SESSION['departamento'] === 'ADMIN';
    $ID = $_GET["id"] ?? $_GET["sc"] ?? die("<div class='alert alert-danger'>Error: ID de registro no proporcionado.</div>");
    $query = "SELECT * FROM con_deptocontabilidad WHERE id='$ID'"; 
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
        <form action="HacerContabilidad.php?action=hacer" method="POST" id="formulario">
            <input type="hidden" value="<?= $row['id'] ?? '' ?>" name="id">

            <div class="registro-container">
                <!-- Columna 1 -->
                <div class="registro-column">
                    <div>
                        <label for="Mes">Mes:</label>
                        <input type="date" id="Mes" name="Mes" value="<?= $row['Mes'] ?? '' ?>"
                         <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    
                    <hr>
                    
                    <h4>Presupuesto Disponible al Cierre</h4>
                    
                    <h5>Servicios Personales</h5>
                    
                    <h6>Mano de Obra</h6>
                    <div>
                        <label for="ComprometidoMAOB">Presupuesto Comprometido:</label>
                        <input type="text" id="ComprometidoMAOB" name="ComprometidoMAOB" placeholder="$" value="<?= $row['ComprometidoMAOB'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    <div>
                        <label for="DisponibleMAOB">Presupuesto Disponible:</label>
                        <input type="text" id="DisponibleMAOB" name="DisponibleMAOB" placeholder="$" value="<?= $row['DisponibleMAOB'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    
                    <h6>Empleados de Confianza</h6>
                    <div>
                        <label for="ComprometidoEMCO">Presupuesto Comprometido:</label>
                        <input type="text" id="ComprometidoEMCO" name="ComprometidoEMCO" placeholder="$" value="<?= $row['ComprometidoEMCO'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    <div>
                        <label for="DisponibleEMCO">Presupuesto Disponible:</label>
                        <input type="text" id="DisponibleEMCO" name="DisponibleEMCO" placeholder="$" value="<?= $row['DisponibleEMCO'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    
                    <h6>Empleados Eventuales</h6>
                    <div>
                        <label for="ComprometidoEMEV">Presupuesto Comprometido:</label>
                        <input type="text" id="ComprometidoEMEV" name="ComprometidoEMEV" placeholder="$" value="<?= $row['ComprometidoEMEV'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    <div>
                        <label for="DisponibleEMEV">Presupuesto Disponible:</label>
                        <input type="text" id="DisponibleEMEV" name="DisponibleEMEV" placeholder="$" value="<?= $row['DisponibleEMEV'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    
                    <div>
                        <label for="TPCSEPE">Total de Presupuesto Comprometido de los servicios Personales:</label>
                        <input type="text" id="TPCSEPE" name="TPCSEPE" placeholder="$" value="<?= $row['TPCSEPE'] ?? '' ?>" 
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    <div>
                        <label for="TPDSEPE">Total de Presupuesto Disponible de los servicios Personales:</label>
                        <input type="text" id="TPDSEPE" name="TPDSEPE" placeholder="$" value="<?= $row['TPDSEPE'] ?? '' ?>" 
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    
                    <hr>
                    
                    <h5>Materiales y Suministros</h5>
                    
                    <h6>Prestaciones en Especie</h6>
                    <div>
                        <label for="ComprometidoPRES">Presupuesto Comprometido:</label>
                        <input type="text" id="ComprometidoPRES" name="ComprometidoPRES" placeholder="$" value="<?= $row['ComprometidoPRES'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    <div>
                        <label for="DisponiblePRES">Presupuesto Disponible:</label>
                        <input type="text" id="DisponiblePRES" name="DisponiblePRES" placeholder="$" value="<?= $row['DisponiblePRES'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    
                    <h6>Materiales de Operación</h6>
                    <div>
                        <label for="ComprometidoMAOP">Presupuesto Comprometido:</label>
                        <input type="text" id="ComprometidoMAOP" name="ComprometidoMAOP" placeholder="$" value="<?= $row['ComprometidoMAOP'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    <div>
                        <label for="DisponibleMAOP">Presupuesto Disponible:</label>
                        <input type="text" id="DisponibleMAOP" name="DisponibleMAOP" placeholder="$" value="<?= $row['DisponibleMAOP'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                </div>
                
                <!-- Columna 2 -->
                <div class="registro-column">
                    <div>
                        <label for="TPCMASU">Total de Presupuesto Comprometido de los Materiales y Suministros:</label>
                        <input type="text" id="TPCMASU" name="TPCMASU" placeholder="$" value="<?= $row['TPCMASU'] ?? '' ?>" 
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    <div>
                        <label for="TPDMASU">Total de Presupuesto Disponible de los Materiales y Suministros:</label>
                        <input type="text" id="TPDMASU" name="TPDMASU" placeholder="$" value="<?= $row['TPDMASU'] ?? '' ?>" 
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    
                    <hr>
                    
                    <h5>Servicios Generales</h5>
                    
                    <h6>Prestaciones en Empleados</h6>
                    <div>
                        <label for="ComprometidoPREM">Presupuesto Comprometido:</label>
                        <input type="text" id="ComprometidoPREM" name="ComprometidoPREM" placeholder="$" value="<?= $row['ComprometidoPREM'] ?? '' ?>" 
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    <div>
                        <label for="DisponiblePREM">Presupuesto Disponible:</label>
                        <input type="text" id="DisponiblePREM" name="DisponiblePREM" placeholder="$" value="<?= $row['DisponiblePREM'] ?? '' ?>" 
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    
                    <h6>Mantenimiento y Conservación</h6>
                    <div>
                        <label for="ComprometidoMACO">Presupuesto Comprometido:</label>
                        <input type="text" id="ComprometidoMACO" name="ComprometidoMACO" placeholder="$" value="<?= $row['ComprometidoMACO'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    <div>
                        <label for="DisponibleMACO">Presupuesto Disponible:</label>
                        <input type="text" id="DisponibleMACO" name="DisponibleMACO" placeholder="$" value="<?= $row['DisponibleMACO'] ?? '' ?>" 
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    
                    <h6>Impuestos y Derechos</h6>
                    <div>
                        <label for="ComprometidoIMDE">Presupuesto Comprometido:</label>
                        <input type="text" id="ComprometidoIMDE" name="ComprometidoIMDE" placeholder="$" value="<?= $row['ComprometidoIMDE'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    <div>
                        <label for="DisponibleIMDE">Presupuesto Disponible:</label>
                        <input type="text" id="DisponibleIMDE" name="DisponibleIMDE" placeholder="$" value="<?= $row['DisponibleIMDE'] ?? '' ?>" 
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    
                    <h6>Seguros y Finanzas</h6>
                    <div>
                        <label for="ComprometidoSEFI">Presupuesto Comprometido:</label>
                        <input type="text" id="ComprometidoSEFI" name="ComprometidoSEFI" placeholder="$" value="<?= $row['ComprometidoSEFI'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    <div>
                        <label for="DisponibleSEFI">Presupuesto Disponible:</label>
                        <input type="text" id="DisponibleSEFI" name="DisponibleSEFI" placeholder="$" value="<?= $row['DisponibleSEFI'] ?? '' ?>" 
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    
                    <h6>Servicios Basicos, Asesorias y Consultas</h6>
                    <div>
                        <label for="ComprometidoSERBA">Presupuesto Comprometido:</label>
                        <input type="text" id="ComprometidoSERBA" name="ComprometidoSERBA" placeholder="$" value="<?= $row['ComprometidoSERBA'] ?? '' ?>" 
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    <div>
                        <label for="DisponibleSERBA">Presupuesto Disponible:</label>
                        <input type="text" id="DisponibleSERBA" name="DisponibleSERBA" placeholder="$" value="<?= $row['DisponibleSERBA'] ?? '' ?>" 
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    
                    <h6>Transportación</h6>
                    <div>
                        <label for="ComprometidoTRAN">Presupuesto Comprometido:</label>
                        <input type="text" id="ComprometidoTRAN" name="ComprometidoTRAN" placeholder="$" value="<?= $row['ComprometidoTRAN'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    <div>
                        <label for="DisponibleTRAN">Presupuesto Disponible:</label>
                        <input type="text" id="DisponibleTRAN" name="DisponibleTRAN" placeholder="$" value="<?= $row['DisponibleTRAN'] ?? '' ?>" 
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                </div>
                
                <!-- Columna 3 -->
                <div class="registro-column">
                    <hr>
                    <h6>Gastos por Reuniones de consejo y Comités</h6>
                    <div>
                        <label for="ComprometidoGARE">Presupuesto Comprometido:</label>
                        <input type="text" id="ComprometidoGARE" name="ComprometidoGARE" placeholder="$" value="<?= $row['ComprometidoGARE'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    <div>
                        <label for="DisponibleGARE">Presupuesto Disponible:</label>
                        <input type="text" id="DisponibleGARE" name="DisponibleGARE" placeholder="$" value="<?= $row['DisponibleGARE'] ?? '' ?>" 
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    
                    <div>
                        <label for="TPCSEGE">Total de Presupuesto Comprometido de los servicios Generales:</label>
                        <input type="text" id="TPCSEGE" name="TPCSEGE" placeholder="$" value="<?= $row['TPCSEGE'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    <div>
                        <label for="TPDSEGE">Total de Presupuesto Disponible de los servicios Generales:</label>
                        <input type="text" id="TPDSEGE" name="TPDSEGE" placeholder="$" value="<?= $row['TPDSEGE'] ?? '' ?>" 
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    
                    <hr>
                    
                    <h4>Ventas, Costos, Gastos, Pérdida o Utilidad</h4>
                    
                    <h5>Recursos Fiscales Mensuales</h5>
                    <div>
                        <label for="ComprometidoVentas">Se Recibió:</label>
                        <input type="text" id="ComprometidoVentas" name="ComprometidoVentas" placeholder="$" value="<?= $row['ComprometidoVentas'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    
                    <div>
                        <label for="ObservacionesVentas">Observaciones Acerca de ventas, Costos y Gastos:</label>
                        <textarea id="ObservacionesVentas" name="ObservacionesVentas" rows="3" placeholder="Ej. Se Presenta una Utilidad por $4,927,293 Pesos al 31 del Mes" 
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required><?= $row['ObservacionesVentas'] ?? '' ?></textarea>
                    </div>
                    
                    <hr>
                    
                    <h4>Concentrado de Costo Fijo Mensuales</h4>
                    
                    <h5>Leche Fluida Parcialmente Descremada Fortificada Tipo A-RG</h5>
                    <div>
                        <label for="CostoVLF">Costo Variable:</label>
                        <input type="text" id="CostoVLF" name="CostoVLF" placeholder="$" value="<?= $row['CostoVLF'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    <div>
                        <label for="CostoFLF">Costo Fijo:</label>
                        <input type="text" id="CostoFLF" name="CostoFLF" placeholder="$" value="<?= $row['CostoFLF'] ?? '' ?>" 
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    
                    <h5>Mezcla de Leche con Grasa Vegetal Pasteurizada Tipo B-RG</h5>
                    <div>
                        <label for="CostoVMG">Costo Variable:</label>
                        <input type="text" id="CostoVMG" name="CostoVMG" placeholder="$" value="<?= $row['CostoVMG'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    <div>
                        <label for="CostoFMG">Costo Fijo:</label>
                        <input type="text" id="CostoFMG" name="CostoFMG" placeholder="$" value="<?= $row['CostoFMG'] ?? '' ?>" 
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    
                    <h5>Leche "Frisia"</h5>
                    <div>
                        <label for="CostoVLFRI">Costo Variable:</label>
                        <input type="text" id="CostoVLFRI" name="CostoVLFRI" placeholder="$" value="<?= $row['CostoVLFRI'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    <div>
                        <label for="CostoFLFRI">Costo Fijo:</label>
                        <input type="text" id="CostoFLFRI" name="CostoFLFRI" placeholder="$" value="<?= $row['CostoFLFRI'] ?? '' ?>" 
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                </div>
            </div>
            
            <!-- SECCIÓN DE FIRMA CENTRADA -->
            <div class="firma-section mt-4 p-3 border rounded" style="max-width: 800px; margin: 0 auto;">
                <h4 style="text-align: center;">Firma Digital</h4>

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

                    <div class="form-check mb-3" style="text-align: center;">
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
                    <input type="submit" name="g" value="Guardar Cambios" class="btn">
                    <input type="button" value="Limpiar Campos" class="btn" onclick="limpiarCampos()"
                        <?= ($solo_firma) ? 'disabled' : '' ?>>
                <?php else: ?>
                    <input type="submit" name="g" value="Guardar Cambios" class="btn" 
                        <?= $es_admin ? '' : 'disabled' ?>>
                    <input type="button" value="Limpiar Campos" class="btn" onclick="limpiarCampos()"
                        <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'disabled' : '' ?>>
                    
                    <?php if ($es_admin && $formulario_firmado): ?>
                        <form method="POST" action="HacerContabilidad.php" style="display:inline;">
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
    
    <!-- Enlace de regreso -->
    <a href="MenuModifi.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90" alt="Regresar al Menú">
    </a>
</main>
</body>
</html>