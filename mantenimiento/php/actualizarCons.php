<?php
    // Incluye la conexión a la base de datos
    include "Conexion.php";
    
    // Asumimos que la clave (id) se pasa por la URL
$ID = $_GET["sc"] ?? die("
    <!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><title>Error</title></head><body>
    <div class='container mt-5'><div class='alert alert-danger'>Error: ID de registro (sc) no proporcionado.</div></div>
    </body></html>");    
    // Consulta para obtener los datos existentes
    $query = "SELECT * FROM m_consumo_energia_produccion WHERE id='$ID'"; 
    $res = mysqli_query($link, $query);
    
    if (!$res || mysqli_num_rows($res) == 0) {
        die("
        <!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><title>Error</title></head><body>
        <div class='container mt-5'><div class='alert alert-danger'>Error: Registro con ID $ID no encontrado o error en la consulta.</div></div>
        </body></html>");
    }
    
    $row = mysqli_fetch_array($res);

    // Verificar permisos (coincidente con actualizarSubG.php)
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
    <meta charset="UTF-8">
    <title>Actualizar Registro de Consumo y Producción</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Carga de scripts requeridos por el formulario de Consumo -->
    <script src="../js/cargas.js"></script>
    <script src="../js/SumaAprovechamieto.js"></script>
    <script src="../js/Multiplicaciondias.js"></script>
    <script src="../js/limpiar.js"></script>
    <script src="../js/ValidacionFirma.js"></script>
    <!-- Se mantiene el script limpiar.js por si es necesario para el botón de limpiar -->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Se usa el CSS de formulario de Consumo para el estilo -->
    <link rel="stylesheet" href="../css/actualizarCons.css"> 
    
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC"> 
</head>
<body>
<main class="container">

    <!-- Título adaptado al nuevo formulario -->
    <h1>Modificar Registro de Consumo de Energía y Producción</h1>

    <section class="registro">

    <!-- El formulario ahora envía los datos a GuardarCons.php -->
    <form method="post" action="HacerCons.php" class="needs-validation" id="formulario">
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
                    <label for="Mes">Mes</label>
                    <!-- Asegúrate de que el campo 'Mes' sea de tipo date en la BD si es necesario -->
                    <input type="date" id="Mes" name="Mes" value="<?= $row['Mes'] ?? '' ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                </div>
                
                <!-- Producción de Leche -->
                <div>
                    <label for="ProduccionLecheTP">Producción de Leche Total Mensual:</label>
              <input type="number" id="ProduccionLecheTP" name="ProduccionLecheTP" 
                  value="<?= $row['ProduccionLecheTP'] ?? '' ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="Litros" required>
                </div>
                <div>
              <label for="ReduccionITR_Leche">Reducción(-) e Incremento(+):</label>
              <input type="number" id="ReduccionITR_Leche" name="ReduccionITR_Leche" 
                  value="<?= $row['ReduccionITR_Leche'] ?? '' ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="%" required>
                </div>
                <hr>
    
                <!-- Energía Eléctrica (kWh y GJ) -->
                <div>
                    <label for="EnergiaElectricaTE">Energía Eléctrica Total Mensual:</label>
              <input type="number" id="EnergiaElectricaTE" name="EnergiaElectricaTE" 
                  value="<?= $row['EnergiaElectricaTE'] ?? '' ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="kW/hr" required>
                </div>
                <div>
              <label for="EnergiaElectricaTEG">Energía Eléctrica Total Mensual en GJ:</label>
              <input type="number" id="EnergiaElectricaTEG" name="EnergiaElectricaTEG" 
                  value="<?= $row['EnergiaElectricaTEG'] ?? '' ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="GJ" required>
                </div>
                <div>
              <label for="ReduccionITR_Energia">Reducción(-) e Incremento(+):</label>
              <input type="number" id="ReduccionITR_Energia" name="ReduccionITR_Energia" 
                  value="<?= $row['ReduccionITR_Energia'] ?? '' ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="%" required>
                </div>
                <hr>
                
                <!-- Consumo de Diesel (Litros y GJ) -->
                <div>
                    <label for="ConsumoDieselTP">Consumo de Diesel Total Mensual:</label>
                    <input type="number" id="ConsumoDieselTP" name="ConsumoDieselTP" 
                           value="<?= $row['ConsumoDieselTP'] ?? '' ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="Litros" required>
                </div>
                <div>
                    <label for="ConsumoDieselTPG">Consumo de Diesel Total Mensual EN GJ:</label>
                    <input type="number" id="ConsumoDieselTPG" name="ConsumoDieselTPG" 
                           value="<?= $row['ConsumoDieselTPG'] ?? '' ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="GJ" required>
                </div>
                <div>
                    <label for="ReduccionITR_Diesel">Reducción(-) e Incremento(+):</label>
                    <input type="number" id="ReduccionITR_Diesel" name="ReduccionITR_Diesel" 
                           value="<?= $row['ReduccionITR_Diesel'] ?? '' ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="%" required>
                </div>
                <hr>
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
    
    <!-- Enlace de regreso adaptado al destino del segundo archivo -->
    <a href="./MenuModifi.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90">
    </a>

</main>
</body>
</html>
