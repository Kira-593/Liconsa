<?php
    // Incluye la conexión a la base de datos
    include "Conexion.php";
    
   $ID = $_GET["sc"] ?? die("
    <!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><title>Error</title></head><body>
    <div class='container mt-5'><div class='alert alert-danger'>Error: ID de registro (sc) no proporcionado.</div></div>
    </body></html>");
    
    // Consulta para obtener el registro y los permisos
    $query = "SELECT * FROM cred_depto_credito_cobranza WHERE id='$ID'";    
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
        window.location.href = 'ModCredito.php';
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
    <title>Modificar Indicadores Crédito y Cobranza</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="stylesheet" href="../css/actualizarCredito.css">
    <script src="../js/cargas.js"></script>
    <script src="../js/limpiar.js"></script> 
    <script src="../js/SumaT.js"></script>
    <script src="../js/ValidacionFirma.js"></script>


    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">    
</head>
<body>
<main class="container">
    
    <h1>Depto. Crédito y Cobranza</h1>
    <h2>Modificar Indicadores Mensuales</h2>
    

    <section class="registro">
        <form action="HacerCredito.php?action=hacer" method="POST" class="needs-validation" id="formulario" >
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
                        <input type="date" id="Mes" name="Mes" value="<?= $row['Mes'] ?? '' ?>" required <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>>
                    </div>

                    <div>
                        <hr>
                        <label>Resumen de Facturación</label><br>
                        <hr>
                        <label>Leche Fortificada</label><br><br>
                        
                        <label for="CantidadLTF">Cantidad de litros:</label>
                        <input type="text" id="CantidadLTF" name="CantidadLTF" placeholder="Lts" value="<?= $row['CantidadLTF'] ?? '' ?>" required step="any" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>>
                    </div>
                    <div>
                        <label for="ImporteTF">Importe:</label>
                        <input type="text" id="ImporteTF" name="ImporteTF" placeholder="$" value="<?= $row['ImporteTF'] ?? '' ?>" required step="any" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>>
                    </div>
                    <div>
                        <label for="PorcentajeTF">Porcentaje que Representa en la Factura:</label>
                        <input type="number" id="PorcentajeTF" name="PorcentajeTF" placeholder="%" value="<?= $row['PorcentajeTF'] ?? '' ?>" required step="any" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>>
                    </div>

                    <div>
                        <hr>
                        <label>Leche Frisia</label><br><br>
                        
                        <label for="CantidadLTFR">Cantidad de litros:</label>
                        <input type="text" id="CantidadLTFR" name="CantidadLTFR" placeholder="Lts" value="<?= $row['CantidadLTFR'] ?? '' ?>" required step="any" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>>
                    </div>
                    <div>
                        <label for="ImporteTFR">Importe:</label>
                        <input type="text" id="ImporteTFR" name="ImporteTFR" placeholder="$" value="<?= $row['ImporteTFR'] ?? '' ?>" required step="any" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>>
                    </div>
                    <div>
                        <label for="PorcentajeTFR">Porcentaje que Representa en la Factura:</label>
                        <input type="number" id="PorcentajeTFR" name="PorcentajeTFR" placeholder="%" value="<?= $row['PorcentajeTFR'] ?? '' ?>" required step="any" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : ''   ?>>
                    </div>

                    <div>
                        <hr>
                        <label>Leche de Polvo AS</label><br><br>
                        
                        <label for="CantidadLTPAS">Cantidad de litros:</label>
                        <input type="text" id="CantidadLTPAS" name="CantidadLTPAS" placeholder="Lts" value="<?= $row['CantidadLTPAS'] ?? '' ?>" required step="any" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>>
                    </div>
                    <div>
                        <label for="ImporteTPAS">Importe:</label>
                        <input type="text" id="ImporteTPAS" name="ImporteTPAS" placeholder="$" value="<?= $row['ImporteTPAS'] ?? '' ?>" required step="any" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>>
                    </div>
                    <div>
                        <label for="PorcentajeTPAS">Porcentaje que Representa en la Factura:</label>
                        <input type="number" id="PorcentajeTPAS" name="PorcentajeTPAS" placeholder="%" value="<?= $row['PorcentajeTPAS'] ?? '' ?>" required step="any" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>>
                    </div>

                    <div>
                        <hr>
                        <label>Leche de Polvo Comercial</label><br><br>
                        
                        <label for="CantidadLTPC">Cantidad de litros:</label>
                        <input type="text" id="CantidadLTPC" name="CantidadLTPC" placeholder="Lts" value="<?= $row['CantidadLTPC'] ?? '' ?>" required step="any" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>>
                    </div>
                    <div>
                        <label for="ImporteLTPC">Importe:</label>
                        <input type="text" id="ImporteLTPC" name="ImporteLTPC" placeholder="$" value="<?= $row['ImporteLTPC'] ?? '' ?>" required step="any" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>>
                    </div>
                    <div>
                        <label for="PorcentajeLTPC">Porcentaje que Representa en la Factura:</label>
                        <input type="number" id="PorcentajeLTPC" name="PorcentajeLTPC" placeholder="%" value="<?= $row['PorcentajeLTPC'] ?? '' ?>" required step="any" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>>
                    </div>

                    <div>
                        <hr>
                        <label>Leche de UHT</label><br><br>

                        <label for="CantidadLTUHT">Cantidad de litros:</label>
                        <input type="text" id="CantidadLTUHT" name="CantidadLTUHT" placeholder="Lts" value="<?= $row['CantidadLTUHT'] ?? '' ?>" required step="any" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>>
                    </div>
                    <div>
                        <label for="ImporteLTUHT">Importe:</label>
                        <input type="text" id="ImporteLTUHT" name="ImporteLTUHT" placeholder="$" value="<?= $row['ImporteLTUHT'] ?? '' ?>" required step="any" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>>
                    </div>
                    <div>
                        <label for="PorcentajeLTUHT">Porcentaje que Representa en la Factura:</label>
                        <input type="number" id="PorcentajeLTUHT" name="PorcentajeLTUHT" placeholder="%" value="<?= $row['PorcentajeLTUHT'] ?? '' ?>" required step="any" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>>
                    </div>
                    
                    <hr>
                    <div>
                        <label for="ObservacionesRes">Observaciones Resumen de Facturación:</label><br><br>
                        <textarea id="ObservacionesRes" name="ObservacionesRes" rows="4" placeholder="Ej. La Facturación Disminuyó 5.25% al cierre del mes" required <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>><?= $row['ObservacionesRes'] ?? '' ?></textarea>
                    </div>

                    <div>
                        <hr>
                        <label>Análisis de Saldos Vencidos</label><br>
                        <hr>
                        <label for="TotalFacturadoMes">Total Facturado en el Mes:</label>
                        <input type="text" id="TotalFacturadoMes" name="TotalFacturadoMes" placeholder="$" value="<?= $row['TotalFacturadoMes'] ?? '' ?>" required step="any"
                         <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>>
                    </div>
                    <div>
                        <label for="TotalDepositosMes">Total de Depositos en el Mes:</label>
                        <input type="number" id="TotalDepositosMes" name="TotalDepositosMes" placeholder="$" value="<?= $row['TotalDepositosMes'] ?? '' ?>" required step="any"
                         <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>>
                    </div>
                    
                    <hr>
                    <div>
                        <label for="ObservacionesFacturasDepositos">Observaciones Facturas y Depositos:</label><br><br>
                        <textarea id="ObservacionesFacturasDepositos" name="ObservacionesFacturasDepositos" rows="4" placeholder="Ej. Al cierre del Mes , Los Depositos comparados con nuestra facturación Representan un Deficit del 8.37%" required 
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>><?= $row['ObservacionesFacturasDepositos'] ?? '' ?></textarea>
                    </div>

                    <div>
                        <hr>
                        <label>Saldos del Mes</label><br><br>
                        <label for="SaldoTS">Saldo:</label>
                        <input type="number" id="SaldoTS" name="SaldoTS" placeholder="$" value="<?= $row['SaldoTS'] ?? '' ?>" required step="any"
                         <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>>
                    </div>
                    <div>
                        <label for="SaldoPV">Saldo por Vencer:</label>
                        <input type="number" id="SaldoPV" name="SaldoPV" placeholder="$" value="<?= $row['SaldoPV'] ?? '' ?>" required step="any" 
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>>
                    </div>
                    <div>
                        <label for="SaldoV">Saldo Vencido:</label>
                        <input type="number" id="SaldoV" name="SaldoV" placeholder="$" value="<?= $row['SaldoV'] ?? '' ?>" required step="any" 
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>>
                    </div>
                    <div>
                        <label for="Saldotreina">Saldo a 30 días:</label>
                        <input type="number" id="Saldotreina" name="Saldotreina" placeholder="$" value="<?= $row['Saldotreina'] ?? '' ?>" required step="any" 
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>>
                    </div>
                    <div>
                        <label for="Saldosesenta">Saldo a 60 días:</label>
                        <input type="number" id="Saldosesenta" name="Saldosesenta" placeholder="$" value="<?= $row['Saldosesenta'] ?? '' ?>" required step="any" 
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>>
                    </div>
                    <div>
                        <label for="Saldonoventa">Saldo a 90 días:</label>
                        <input type="number" id="Saldonoventa" name="Saldonoventa" placeholder="$" value="<?= $row['Saldonoventa'] ?? '' ?>" required step="any" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>>
                    </div>
                    <div>
                        <label for="Saldosecenta">Saldo a mas de 90 días:</label>
                        <input type="number" id="Saldosecenta" name="Saldosecenta" placeholder="$" value="<?= $row['Saldosecenta'] ?? '' ?>" required step="any" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>>
                    </div>

                    <hr>
                    <div>
                        <label for="ObservacionesSaldos">Observaciones de los Saldos:</label><br><br>
                        <textarea id="ObservacionesSaldos" name="ObservacionesSaldos" rows="4" placeholder="Ej. La Facturación Disminuyó 5.25% al cierre del mes" required 
                            <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>><?= $row['ObservacionesSaldos'] ?? '' ?></textarea>
                    </div>

                    <div>
                        <hr>
                        <label>Saldo del Cliente Alimentación Para el Bienestar (DICONSA)</label><br>
                        <hr>    
                        <label for="TotalSaldo">Total del Saldo:</label>
                        <input type="text" id="TotalSaldo" name="TotalSaldo" placeholder="$" value="<?= $row['TotalSaldo'] ?? '' ?>" required step="any"
                         <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>>
                    </div>
                    
                    <div>
                        <label for="ObservacionesSaldomes">Observaciones del Saldo de la Alimentación Para el Bienestar:</label><br><br>
                        <textarea id="ObservacionesSaldomes" name="ObservacionesSaldomes" rows="4" placeholder="Ej. Alimentación Para el Bienestar al cierre del Mes Presenta un Saldo Deudor de $344,250.00" required 
                        <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>><?= $row['ObservacionesSaldomes'] ?? '' ?></textarea>
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
    
    
    <a href="MenuModifi.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90" alt="Regresar al Menú">
    </a>
</main>
</body>
</html>