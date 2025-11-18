<?php
    // Incluye la conexión a la base de datos
    include "Conexion.php";
    
    // Asumimos que la clave (id) se pasa por la URL
$ID = $_GET["sc"] ?? die("
    <!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><title>Error</title></head><body>
    <div class='container mt-5'><div class='alert alert-danger'>Error: ID de registro (sc) no proporcionado.</div></div>
    </body></html>");     
    // Consulta para obtener los datos existentes
    // Se utiliza la tabla m_consumo_energia que coincide con los nuevos campos
    $query = "SELECT * FROM  m_consumo_energia_termica_electrica WHERE id='$ID'"; 
    $res = mysqli_query($link, $query);
    
   if (!$res || mysqli_num_rows($res) == 0) {
        die("
        <!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><title>Error</title></head><body>
        <div class='container mt-5'><div class='alert alert-danger'>Error: Registro con ID $ID no encontrado o error en la consulta.</div></div>
        </body></html>");
    }
    
    $row = mysqli_fetch_array($res);

    // Verificar permisos (coincidente con otros formularios)
    $solo_firma = !empty($row['permitir_firmar']) && empty($row['permitir_modificar']);
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
    if (empty($row['permitir_modificar']) && empty($row['permitir_firmar'])) {
        echo "<script>
            alert('No tienes permisos para modificar o firmar este formulario. Contacta al administrador.');
            window.location.href = 'MenuModifi.php';
        </script>";
        exit();
    }

    include "Cerrar.php";
   ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Modificar Consumo de Energía Térmica y Eléctrica</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Carga de scripts requeridos -->
    <script src="../js/cargas.js"></script>
    <script src="../js/SumaAprovechamieto.js"></script>
    <script src="../js/Multiplicaciondias.js"></script>
    <script src="../js/limpiar.js"></script> <!-- Nuevo script para validaciones específicas -->
    <script src="../js/ValidacionFirma.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Se usa el CSS del formulario de Consumo de Energía para el estilo -->
    <link rel="stylesheet" href="../css/actualizarConsEnergia.css"> 
    
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC"> 
</head>
<body>
<main class="container">

    <!-- Título actualizado al nuevo enfoque -->
    <h1>Modificar Registro de Consumo de Energía Térmica y Eléctrica</h1>

    <section class="registro">
    
    <!-- El formulario envía los datos a HacerConsEnergia.php (asumiendo que es el script de UPDATE) -->
    <form method="post" action="HacerConsEnergia.php" class="needs-validation" id="formulario">
        <!-- Campo oculto para pasar el ID del registro a actualizar -->
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
                
                <!-- Mes (Fecha) -->
                <div>
                    <label for="Mes">Mes:</label>
                    <input type="date" id="Mes" name="Mes" value="<?= $row['Mes'] ?? '' ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                </div>
                <hr>
                
                <!-- Consumo de Energía Térmica (Diesel) -->
                <th><h5>Consumo de Energía Termica(Diesel)</h5></th>
                <hr>
                <div>
                    <label for="CantidadDieselCTC">Cantidad de Litros de Diesel consumidos:</label>
            <input type="number" id="CantidadDieselCTC" name="CantidadDieselCTC" 
                value="<?= $row['CantidadDieselCTC'] ?? '' ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="Kw/hr" required step="any">
                </div>
                
                <div>
                    <label for="ReduccionITD">Reducción(-) o Incremento(+) en Comparacion al Mismo Mes del Año Anterior:</label>
            <input type="number" id="ReduccionITD" name="ReduccionITD" 
                value="<?= $row['ReduccionITD'] ?? '' ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="%" required step="any">
                </div>
                <div>
                    <label for="PromedioRID">Promedio de Reducción o Incremento:</label>
            <input type="number" id="PromedioRID" name="PromedioRID" 
                value="<?= $row['PromedioRID'] ?? '' ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="%" required step="any">
                </div>
                <div>
                    <label for="LitrosDLL">Litros de Diesel por litro de leche producida:</label>
            <input type="number" id="LitrosDLL" name="LitrosDLL" 
                value="<?= $row['LitrosDLL'] ?? '' ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="Kw/Litros" required step="any">
                </div>
                <div>
                    <label for="ReduccionILD">Reducción(-) o Incremento(+) de litros de diesel /Litros leche en Comparacion al Mismo Mes del Año Anterior:</label>
            <input type="number" id="ReduccionILD" name="ReduccionILD" 
                value="<?= $row['ReduccionILD'] ?? '' ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="%" required step="any">
                </div>
                <div>
                    <label for="PromedioRILD">Promedio de Reducción o Incremento de litros de diesel /Litros leche:</label>
            <input type="number" id="PromedioRILD" name="PromedioRILD" 
                value="<?= $row['PromedioRILD'] ?? '' ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="%" required step="any">
                </div>
                <hr>
                
                <!-- Consumo de Energía Eléctrica -->
                <th><h5>Consumo de Energía Electrica</h5></th>
                <hr>
                <div>
                    <label for="CantidadEnergiaCTC">Cantidad de Energía consumida:</label>
            <input type="number" id="CantidadEnergiaCTC" name="CantidadEnergiaCTC" 
                value="<?= $row['CantidadEnergiaCTC'] ?? '' ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="Kw/hr" required step="any">
                </div>
                
                <div>
                    <label for="ReduccionITR">Reducción(-) o Incremento(+) en Comparacion al Mismo Mes del Año Anterior:</label>
            <input type="number" id="ReduccionITR" name="ReduccionITR" 
                value="<?= $row['ReduccionITR'] ?? '' ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="%" required step="any">
                </div>
                <div>
                    <label for="PromedioRIT">Promedio de Reducción o Incremento:</label>
            <input type="number" id="PromedioRIT" name="PromedioRIT" 
                value="<?= $row['PromedioRIT'] ?? '' ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="%" required step="any">
                </div>
                <div>
                    <label for="CantidadLLT">Cantidad de Kw por litro de leche producida.:</label>
            <input type="number" id="CantidadLLT" name="CantidadLLT" 
                value="<?= $row['CantidadLLT'] ?? '' ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="Kw/Litros" required step="any">
                </div>
                <div>
                    <label for="ReduccionIKL">Reducción(-) o Incremento(+) de Kw/Litros en Comparacion al Mismo Mes del AñoAnterior:</label>
            <input type="number" id="ReduccionIKL" name="ReduccionIKL" 
                value="<?= $row['ReduccionIKL'] ?? '' ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="%" required step="any">
                </div>
                <div>
                    <label for="PromedioRIK">Promedio de Reducción o Incremento de Kw/Litros:</label>
            <input type="number" id="PromedioRIK" name="PromedioRIK" 
                value="<?= $row['PromedioRIK'] ?? '' ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="%" required step="any">
                </div>

            </div> 
        </div> <!-- Fin de registro-container -->
            
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

            <div class="row mt-4">
                <div class="col-12 text-center">
                    <?php if (!$formulario_firmado): ?>
                        <input type="submit" value="Guardar Cambios" class="btn btn-primary me-2" id="btnGuardar">
                        <input type="button" value="Limpiar Campos" class="btn btn-secondary" onclick="limpiarCampos()">
                    <?php else: ?>
                        <div class="alert alert-warning">Este formulario ya ha sido firmado y no puede ser modificado.</div>
                    <?php endif; ?>
                </div>
            </div>
    </form>
    </section>
    
    <?php include "Cerrar.php"; // Cierra la conexión ?>
    
    <!-- Enlace de regreso adaptado al destino -->
    <a href="./MenuModifi.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90">
    </a>

</main>
</body>
</html>
