<?php
    // Incluye la conexión a la base de datos
    include "Conexion.php";

    $ID = $_GET["sc"] ?? die("
    <!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><title>Error</title></head><body>
    <div class='container mt-5'><div class='alert alert-danger'>Error: ID de registro (sc) no proporcionado.</div></div>
    </body></html>");
    
    $query = "SELECT * FROM  con_deptocontabilidad WHERE id='$ID'"; 
    $res = mysqli_query($link, $query);

      
   if (!$res || mysqli_num_rows($res) == 0) {
    // Si no hay resultados o hay error, detenemos la ejecución y mostramos un error
    die("
    <!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><title>Error</title></head><body>
    <div class='container mt-5'><div class='alert alert-danger'>Error: Registro con ID $ID_e no encontrado o error en la consulta.</div></div>
    </body></html>");
}
    $row = mysqli_fetch_array($res);

// Permisos y estado de firma
$solo_firma = !empty($row['permitir_firmar']) && empty($row['permitir_modificar']);
$formulario_firmado = !empty($row['firma_usuario']);


// Si solo está permitido firmar y ya está firmado, bloquear todo
if ($solo_firma && $formulario_firmado) {
    echo "<script>
        alert('Este formulario ya ha sido firmado y no puede ser modificado.');
        window.location.href = 'ModContabilidad.php';
    </script>";
    exit();
}

// Si no tiene permisos de modificación ni firma
if (empty($row['permitir_modificar']) && empty($row['permitir_firmar'])) {
        echo "<script>
            alert('No tienes permisos para modificar o firmar este formulario. Contacta al administrador.');
            window.location.href = 'MenuModifi.php';
        </script>";
        exit();
}
    
// Cierra la conexión de inmediato si no hay más consultas a la BD principal aquí
include "Cerrar.php"; 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Indicadores Contabilidad</title>
    <!-- Se mantiene Bootstrap para el diseño responsivo del contenedor y botones -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Se usan los estilos de Contabilidad -->
    <link rel="stylesheet" href="../css/actualizarContabilidad.css">
    
    <!-- Se usan los scripts de Contabilidad -->
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
    
    <section class="registro">
        <!-- Se cambia la acción al manejador de actualización de Contabilidad (ajusta el nombre del archivo si es necesario) -->
        <form action="HacerContabilidad.php?action=hacer" method="POST" id="formulario">
            <!-- Campo oculto para el ID del registro a modificar -->
            <input type="hidden" value="<?= $row['id'] ?? '' ?>" name="id"> 
            
            <?php if ($formulario_firmado): ?>
            <div class="alert alert-info">
                <strong>✅ Formulario Firmado</strong><br>
                Firmado por: <?= $row['firma_usuario'] ?><br>
                Fecha: <?= $row['fecha_firma'] ?>
            </div>
            <?php endif; ?>

            <div class="registro-container">
                <div class="registro-column">

                    <!-- Mes -->
                    <div>
                        <label for="Mes">Mes:</label>
                        <!-- El valor se carga desde la base de datos -->
                        <input type="date" id="Mes" name="Mes" value="<?= $row['Mes'] ?? '' ?>"
                         <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>

                    <!-- Presupuesto Disponible al cierre -->
                    <div>
                        <hr>
                        <label>Presupuesto Disponible al cierre</label><br>
                        <hr>
                        <label>Servicios Personales</label><br>
                        <hr>
                        <label>Mano de Obra</label><br>
                        
                        <!-- Mano de Obra - Comprometido -->
                        <label for="ComprometidoMAOB">Presupuesto Comprometido:</label>
                        <input type="text" id="ComprometidoMAOB" name="ComprometidoMAOB" placeholder="$" value="<?= $row['ComprometidoMAOB'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>
                    <!-- Mano de Obra - Disponible -->
                    <div>
                        <label for="DisponibleMAOB">Presupuesto Disponible:</label>
                        <input type="text" id="DisponibleMAOB" name="DisponibleMAOB" placeholder="$" value="<?= $row['DisponibleMAOB'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>

                    <!-- Empleados de Confianza -->
                    <div>
                        <hr>
                        <label>Empleados de Confianza</label><br><br>

                        <!-- Empleados de Confianza - Comprometido -->
                        <label for="ComprometidoEMCO">Presupuesto Comprometido:</label>
                        <input type="text" id="ComprometidoEMCO" name="ComprometidoEMCO" placeholder="$" value="<?= $row['ComprometidoEMCO'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>
                    <!-- Empleados de Confianza - Disponible -->
                    <div>
                        <label for="DisponibleEMCO">Presupuesto Disponible:</label>
                        <input type="text" id="DisponibleEMCO" name="DisponibleEMCO" placeholder="$" value="<?= $row['DisponibleEMCO'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>

                    <!-- Empleados Eventuales -->
                    <div>
                        <hr>
                        <label>Empleados Eventuales</label><br><br>

                        <!-- Empleados Eventuales - Comprometido -->
                        <label for="ComprometidoEMEV">Presupuesto Comprometido:</label>
                        <input type="text" id="ComprometidoEMEV" name="ComprometidoEMEV" placeholder="$" value="<?= $row['ComprometidoEMEV'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>
                    <!-- Empleados Eventuales - Disponible -->
                    <div>
                        <label for="DisponibleEMEV">Presupuesto Disponible:</label>
                        <input type="text" id="DisponibleEMEV" name="DisponibleEMEV" placeholder="$" value="<?= $row['DisponibleEMEV'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>

                    <!-- Totales Servicios Personales -->
                    <div>
                        <label for="TPCSEPE">Total de Presupuesto Comprometido de los servicios Personales:</label>
                        <input type="text" id="TPCSEPE" name="TPCSEPE" placeholder="$" value="<?= $row['TPCSEPE'] ?? '' ?>" 
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>
                    <div>
                        <label for="TPDSEPE">Total de Presupuesto Disponible de los servicios Personales:</label>
                        <input type="text" id="TPDSEPE" name="TPDSEPE" placeholder="$" value="<?= $row['TPDSEPE'] ?? '' ?>" 
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>

                    <!-- Materiales y Suministros -->
                    <div>
                        <br>
                        <hr>
                        <label>Materiales y Suministros</label><br>
                        <hr>
                        
                        <label>Prestaciones en Especie</label><br><br>
                        <!-- Prestaciones en Especie - Comprometido -->
                        <label for="ComprometidoPRES">Presupuesto Comprometido:</label>
                        <input type="text" id="ComprometidoPRES" name="ComprometidoPRES" placeholder="$" value="<?= $row['ComprometidoPRES'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>
                    <!-- Prestaciones en Especie - Disponible -->
                    <div>
                        <label for="DisponiblePRES">Presupuesto Disponible:</label>
                        <input type="text" id="DisponiblePRES" name="DisponiblePRES" placeholder="$" value="<?= $row['DisponiblePRES'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>

                    <!-- Materiales de Operación -->
                    <div>
                        <hr>
                        <label>Materiales de Operación</label><br><br>

                        <!-- Materiales de Operación - Comprometido -->
                        <label for="ComprometidoMAOP">Presupuesto Comprometido:</label>
                        <input type="text" id="ComprometidoMAOP" name="ComprometidoMAOP" placeholder="$" value="<?= $row['ComprometidoMAOP'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>
                    <!-- Materiales de Operación - Disponible -->
                    <div>
                        <label for="DisponibleMAOP">Presupuesto Disponible:</label>
                        <input type="text" id="DisponibleMAOP" name="DisponibleMAOP" placeholder="$" value="<?= $row['DisponibleMAOP'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>

                    <!-- Totales Materiales y Suministros -->
                    <div>
                        <label for="TPCMASU">Total de Presupuesto Comprometido de los Materiales y Suministros:</label>
                        <input type="text" id="TPCMASU" name="TPCMASU" placeholder="$" value="<?= $row['TPCMASU'] ?? '' ?>" 
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>
                    <div>
                        <label for="TPDMASU">Total de Presupuesto Disponible de los Materiales y Suministros:</label>
                        <input type="text" id="TPDMASU" name="TPDMASU" placeholder="$" value="<?= $row['TPDMASU'] ?? '' ?>" 
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>

                    <!-- Servicios Generales -->
                    <div>
                        <br>
                        <hr>
                        <label>Servicios Generales</label><br>
                        <hr>
                        
                        <label>Prestaciones en Empleados</label><br><br>
                        <!-- Prestaciones en Empleados - Comprometido -->
                        <label for="ComprometidoPREM">Presupuesto Comprometido:</label>
                        <input type="text" id="ComprometidoPREM" name="ComprometidoPREM" placeholder="$" value="<?= $row['ComprometidoPREM'] ?? '' ?>" 
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>
                    <!-- Prestaciones en Empleados - Disponible -->
                    <div>
                        <label for="DisponiblePREM">Presupuesto Disponible:</label>
                        <input type="text" id="DisponiblePREM" name="DisponiblePREM" placeholder="$" value="<?= $row['DisponiblePREM'] ?? '' ?>" 
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>

                    <!-- Mantenimiento y Conservación -->
                    <div>
                        <hr>
                        <label>Mantenimiento y Conservación</label><br><br>

                        <!-- Mantenimiento y Conservación - Comprometido -->
                        <label for="ComprometidoMACO">Presupuesto Comprometido:</label>
                        <input type="text" id="ComprometidoMACO" name="ComprometidoMACO" placeholder="$" value="<?= $row['ComprometidoMACO'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>
                    <!-- Mantenimiento y Conservación - Disponible -->
                    <div>
                        <label for="DisponibleMACO">Presupuesto Disponible:</label>
                        <input type="text" id="DisponibleMACO" name="DisponibleMACO" placeholder="$" value="<?= $row['DisponibleMACO'] ?? '' ?>" 
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>

                    <!-- Impuestos y Derechos -->
                    <div>
                        <hr>
                        <label>Impuestos y Derechos</label><br><br>

                        <!-- Impuestos y Derechos - Comprometido -->
                        <label for="ComprometidoIMDE">Presupuesto Comprometido:</label>
                        <input type="text" id="ComprometidoIMDE" name="ComprometidoIMDE" placeholder="$" value="<?= $row['ComprometidoIMDE'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>
                    <!-- Impuestos y Derechos - Disponible -->
                    <div>
                        <label for="DisponibleIMDE">Presupuesto Disponible:</label>
                        <input type="text" id="DisponibleIMDE" name="DisponibleIMDE" placeholder="$" value="<?= $row['DisponibleIMDE'] ?? '' ?>" 
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>

                    <!-- Seguros y Finanzas -->
                    <div>
                        <hr>
                        <label>Seguros y Finanzas</label><br><br>

                        <!-- Seguros y Finanzas - Comprometido -->
                        <label for="ComprometidoSEFI">Presupuesto Comprometido:</label>
                        <input type="text" id="ComprometidoSEFI" name="ComprometidoSEFI" placeholder="$" value="<?= $row['ComprometidoSEFI'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>
                    <!-- Seguros y Finanzas - Disponible -->
                    <div>
                        <label for="DisponibleSEFI">Presupuesto Disponible:</label>
                        <input type="text" id="DisponibleSEFI" name="DisponibleSEFI" placeholder="$" value="<?= $row['DisponibleSEFI'] ?? '' ?>" 
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>

                    <!-- Servicios Basicos, Asesorias y Consultas -->
                    <div>
                        <hr>
                        <label>Servicios Basicos, Asesorias y Consultas</label><br><br>

                        <!-- Servicios Basicos, Asesorias y Consultas - Comprometido -->
                        <label for="ComprometidoSERBA">Presupuesto Comprometido:</label>
                        <input type="text" id="ComprometidoSERBA" name="ComprometidoSERBA" placeholder="$" value="<?= $row['ComprometidoSERBA'] ?? '' ?>" 
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>
                    <!-- Servicios Basicos, Asesorias y Consultas - Disponible -->
                    <div>
                        <label for="DisponibleSERBA">Presupuesto Disponible:</label>
                        <input type="text" id="DisponibleSERBA" name="DisponibleSERBA" placeholder="$" value="<?= $row['DisponibleSERBA'] ?? '' ?>" 
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>

                    <!-- Transportación -->
                    <div>
                        <hr>
                        <label>Transportación</label><br><br>

                        <!-- Transportación - Comprometido -->
                        <label for="ComprometidoTRAN">Presupuesto Comprometido:</label>
                        <input type="text" id="ComprometidoTRAN" name="ComprometidoTRAN" placeholder="$" value="<?= $row['ComprometidoTRAN'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>
                    <!-- Transportación - Disponible -->
                    <div>
                        <label for="DisponibleTRAN">Presupuesto Disponible:</label>
                        <input type="text" id="DisponibleTRAN" name="DisponibleTRAN" placeholder="$" value="<?= $row['DisponibleTRAN'] ?? '' ?>" 
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>

                    <!-- Gastos por Reuniones de consejo y Comités -->
                    <div>
                        <hr>
                        <label>Gastos por Reuniones de consejo y Comités</label><br><br>

                        <!-- Gastos por Reuniones de consejo y Comités - Comprometido -->
                        <label for="ComprometidoGARE">Presupuesto Comprometido:</label>
                        <input type="text" id="ComprometidoGARE" name="ComprometidoGARE" placeholder="$" value="<?= $row['ComprometidoGARE'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>
                    <!-- Gastos por Reuniones de consejo y Comités - Disponible -->
                    <div>
                        <label for="DisponibleGARE">Presupuesto Disponible:</label>
                        <input type="text" id="DisponibleGARE" name="DisponibleGARE" placeholder="$" value="<?= $row['DisponibleGARE'] ?? '' ?>" 
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>
                    
                    <!-- Totales Servicios Generales -->
                    <div>
                        <label for="TPCSEGE">Total de Presupuesto Comprometido de los servicios Generales:</label>
                        <input type="text" id="TPCSEGE" name="TPCSEGE" placeholder="$" value="<?= $row['TPCSEGE'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>
                    <div>
                        <label for="TPDSEGE">Total de Presupuesto Disponible de los servicios Generales:</label>
                        <input type="text" id="TPDSEGE" name="TPDSEGE" placeholder="$" value="<?= $row['TPDSEGE'] ?? '' ?>" 
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>

                    <!-- Ventas, Costos, Gastos, Perdida o Utilidad -->
                    <div>
                        <hr>
                        <label>Ventas, Costos, Gastos, Perdida o Utilidad</label><br>
                        
                        <hr>
                        <label>Recursos Fiscales Mensuales</label><br><br>
                        <!-- Recursos Fiscales Mensuales - Se Recibió -->
                        <label for="ComprometidoVentas">Se Recibió:</label>
                        <input type="text" id="ComprometidoVentas" name="ComprometidoVentas" placeholder="$" value="<?= $row['ComprometidoVentas'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>
                    
                    <!-- Observaciones Acercas de ventas, Costos y Gastos -->
                    <div>
                        <label for="ObservacionesVentas">Observaciones Acerca de ventas, Costos y Gastos:</label><br><br>
                        <textarea id="ObservacionesVentas" name="ObservacionesVentas" rows="4" placeholder="Ej. Se Presenta una Utilidad por $4,927,293 Pesos al 31 del Mes" 
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required><?= $row['ObservacionesVentas'] ?? '' ?></textarea>
                    </div>

                    <!-- Concentrado de Costo y Fijo Mensuales -->
                    <div>
                        <hr>
                        <label>Concentrado de Costo y Fijo Mensuales</label><br>
                        <hr>
                        <label>Leche Fluida Parcialmente Descremada Fortificada Tipo A-RG</label><br><br>
                        
                        <!-- Costo Variable Leche Fluida -->
                        <label for="CostoVLF">Costo Variable:</label>
                        <input type="text" id="CostoVLF" name="CostoVLF" placeholder="$" value="<?= $row['CostoVLF'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>
                    <!-- Costo Fijo Leche Fluida -->
                    <div>
                        <label for="CostoFLF">Costo Fijo:</label>
                        <input type="text" id="CostoFLF" name="CostoFLF" placeholder="$" value="<?= $row['CostoFLF'] ?? '' ?>" 
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>

                    <!-- Mezcla de Leche con Grasa Vegetal Pasteurizada Tipo B-RG -->
                    <div>
                        <hr>
                        <label>Mezcla de Leche con Grasa Vegetal Pasteurizada Tipo B-RG</label><br><br>
                        <!-- Costo Variable Mezcla -->
                        <label for="CostoVMG">Costo Variable:</label>
                        <input type="text" id="CostoVMG" name="CostoVMG" placeholder="$" value="<?= $row['CostoVMG'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>
                    <!-- Costo Fijo Mezcla -->
                    <div>
                        <label for="CostoFMG">Costo Fijo:</label>
                        <input type="text" id="CostoFMG" name="CostoFMG" placeholder="$" value="<?= $row['CostoFMG'] ?? '' ?>" 
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>

                    <!-- Leche "Frisia" -->
                    <div>
                        <hr>
                        <label>Leche "Frisia"</label><br><br>
                        <!-- Costo Variable Frisia -->
                        <label for="CostoVLFRI">Costo Variable:</label>
                        <input type="text" id="CostoVLFRI" name="CostoVLFRI" placeholder="$" value="<?= $row['CostoVLFRI'] ?? '' ?>"
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>
                    <!-- Costo Fijo Frisia -->
                    <div>
                        <label for="CostoFLFRI">Costo Fijo:</label>
                        <input type="text" id="CostoFLFRI" name="CostoFLFRI" placeholder="$" value="<?= $row['CostoFLFRI'] ?? '' ?>" 
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
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
        
       <div class="form-buttons mt-4">
                <?php if (!$formulario_firmado): ?>
                    <input type="submit" name="g" value="Guardar Cambios">
                    <input type="button" name="b" value="Limpiar" onclick="limpiarCampos()"
                    <?= ($solo_firma) ? 'disabled' : '' ?>>
                <?php else: ?>
                    <div class="alert alert-warning">Este formulario ya ha sido firmado y no puede ser modificado.</div>
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
