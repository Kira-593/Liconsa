<?php
// Incluye la conexión a la base de datos
include "Conexion.php";

// 1. Verificar y obtener el ID del registro a modificar (usando 'sc' como clave)
$ID = $_GET["sc"] ?? die("
    <!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><title>Error</title></head><body>
    <div class='container mt-5'><div class='alert alert-danger'>Error: ID de registro (sc) no proporcionado.</div></div>
    </body></html>");


$query = "SELECT * FROM c_resumenadquisiciones WHERE id='$ID'"; 
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
        window.location.href = 'AdquisicionesP.php';
    </script>";
    exit();
}

// Si no tiene permisos de modificación ni firma
if (empty($row['permitir_modificar']) && empty($row['permitir_firmar'])) {
        echo "<script>
            alert('No tienes permisos para modificar o firmar este formulario. Contacta al administrador.');
            window.location.href = 'Modificación.php';
        </script>";
        exit();
}

include "Cerrar.php"; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Modificar Resumen de Adquisiciones</title>
    <meta charset="UTF-8">
    <script src="../js/cargas.js"></script>
    <script src="../js/SumaT.js"></script>
    <script src="../js/limpiar.js"></script>
    <script src="../js/ValidacionFirma.js"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/actualizar.css">
    
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC"> 
    
</head>
<body>
<main class="container">

    <h1>Modificar Registro de Resumen de Adquisiciones</h1>
    
    <section class="registro">
        <form method="post" action="Hacer.php" class="needs-validation" id="formulario"> 
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

                <div>
                    <label for="Mes">Mes:</label>
                    <input type="date" id="Mes" name="Mes" 
                        value="<?= $row['Mes'] ?? '' ?>" required 
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>>
                </div>
                
                <div>
                    <label></label> <br>
                    <label for="CodigoTC">Codigo:</label>
                    <input type="number" id="CodigoTC" name="CodigoTC" placeholder="Ej. 1" 
                        value="<?= $row['CodigoTC'] ?? '' ?>" required 
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>>
                </div>
                
                <div>
                    <label for="DescripcionBTD">Descripcion de los Bienes y/o Servicios:</label>
                    <input type="text" id="DescripcionBTD" name="DescripcionBTD" placeholder="Ej.EQUIPO DE PROTECCIÓN PERSONAL" 
                        value="<?= $row['DescripcionBTD'] ?? '' ?>" required 
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>>
                </div>
                
                <div>
                    <label for="MontoSIT">Monto sin Iva:</label>
                    <input type="number" id="MontoSIT" name="MontoSIT" placeholder="Ej. $33,434.48" 
                        value="<?= $row['MontoSIT'] ?? '' ?>" required step="any" 
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>>
                </div>
                
                <div>
                    <label for="LPAD">(LP,I3P,AD):</label>
                    <input type="text" id="LPAD" name="LPAD" placeholder="Ej. 55 PRIMER PARRAFO" 
                        value="<?= $row['LPAD'] ?? '' ?>" required 
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>>
                </div>
                
                <div>
                    <label for="EmpresaATE">Empresa Adjudicada:</label>
                    <input type="text" id="EmpresaATE" name="EmpresaATE" placeholder="HOC MAC, S.A de CV" 
                        value="<?= $row['EmpresaATE'] ?? '' ?>" required 
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>>
                </div>
                
                <div>
                    <label for="TotalGET">Total Gerencia Estatal Tlaxcala:</label>
                    <input type="number" id="TotalGET" name="TotalGET" placeholder="Ej. $7,736,698.35" 
                        value="<?= $row['TotalGET'] ?? '' ?>" required step="any"
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>>
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
    
    <a href="AdquisicionesP.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90" alt="Volver al menú principal de Adquisiciones">
    </a>
</main>
</body>
</html>