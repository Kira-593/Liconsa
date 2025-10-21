<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Indicadores Crédito y Cobranza</title>
    <!-- Se mantiene Bootstrap para el diseño responsivo del contenedor y botones -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Se actualiza el CSS y scripts según el nuevo contexto -->
    <link rel="stylesheet" href="../css/actualizarCredito.css">
    <script src="../js/cargas.js"></script>
    <script src="../js/limpiar.js"></script> 
    <script src="../js/SumaT.js"></script>

    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC"> 
</head>
<body>
<main class="container">
    
    <h1>Depto. Crédito y Cobranza</h1>
    <h2>Modificar Indicadores Mensuales</h2>
    
    <?php
    // Incluye la conexión a la base de datos
    include "Conexion.php";
    
    // --- Lógica PHP para obtener datos a modificar ---
    // Asume que la nueva tabla para Crédito y Cobranza se llama 'cred_depto_credito_cobranza'
    $ID = $_GET["sc"]; 
    $query = "SELECT * FROM cred_depto_credito_cobranza WHERE id='$ID'"; 
    $res = mysqli_query($link, $query);
    $row = mysqli_fetch_array($res);
    ?>

    <section class="registro">
        <!-- Se cambia la acción al manejador de actualización de Crédito (ajusta el nombre del archivo si es necesario) -->
        <form action="HacerCredito.php?action=hacer" method="POST" class="needs-validation">
            <!-- Campo oculto para el ID del registro a modificar -->
            <input type="hidden" value="<?= $row['id'] ?? '' ?>" name="id"> 
            
            <div class="registro-container">
                <div class="registro-column">

                    <!-- Mes -->
                    <div>
                        <label for="Mes">Mes:</label>
                        <input type="date" id="Mes" name="Mes" value="<?= $row['Mes'] ?? '' ?>" required>
                    </div>

                    <!-- Resumen de Facturación - Leche Fortificada -->
                    <div>
                        <hr>
                        <label>Resumen de Facturación</label><br>
                        <hr>
                        <label>Leche Fortificada</label><br><br>
                        
                        <label for="CantidadLTF">Cantidad de litros:</label>
                        <input type="text" id="CantidadLTF" name="CantidadLTF" placeholder="Lts" value="<?= $row['CantidadLTF'] ?? '' ?>" required step="any">
                    </div>
                    <div>
                        <label for="ImporteTF">Importe:</label>
                        <input type="text" id="ImporteTF" name="ImporteTF" placeholder="$" value="<?= $row['ImporteTF'] ?? '' ?>" required step="any">
                    </div>
                    <div>
                        <label for="PorcentajeTF">Porcentaje que Representa en la Factura:</label>
                        <input type="number" id="PorcentajeTF" name="PorcentajeTF" placeholder="%" value="<?= $row['PorcentajeTF'] ?? '' ?>" required step="any">
                    </div>

                    <!-- Leche Frisia -->
                    <div>
                        <hr>
                        <label>Leche Frisia</label><br><br>
                        
                        <label for="CantidadLTFR">Cantidad de litros:</label>
                        <input type="text" id="CantidadLTFR" name="CantidadLTFR" placeholder="Lts" value="<?= $row['CantidadLTFR'] ?? '' ?>" required step="any">
                    </div>
                    <div>
                        <label for="ImporteTFR">Importe:</label>
                        <input type="text" id="ImporteTFR" name="ImporteTFR" placeholder="$" value="<?= $row['ImporteTFR'] ?? '' ?>" required step="any">
                    </div>
                    <div>
                        <label for="PorcentajeTFR">Porcentaje que Representa en la Factura:</label>
                        <input type="number" id="PorcentajeTFR" name="PorcentajeTFR" placeholder="%" value="<?= $row['PorcentajeTFR'] ?? '' ?>" required step="any">
                    </div>

                    <!-- Leche de Polvo AS -->
                    <div>
                        <hr>
                        <label>Leche de Polvo AS</label><br><br>
                        
                        <label for="CantidadLTPAS">Cantidad de litros:</label>
                        <input type="text" id="CantidadLTPAS" name="CantidadLTPAS" placeholder="Lts" value="<?= $row['CantidadLTPAS'] ?? '' ?>" required step="any">
                    </div>
                    <div>
                        <label for="ImporteTPAS">Importe:</label>
                        <input type="text" id="ImporteTPAS" name="ImporteTPAS" placeholder="$" value="<?= $row['ImporteTPAS'] ?? '' ?>" required step="any">
                    </div>
                    <div>
                        <label for="PorcentajeTPAS">Porcentaje que Representa en la Factura:</label>
                        <input type="number" id="PorcentajeTPAS" name="PorcentajeTPAS" placeholder="%" value="<?= $row['PorcentajeTPAS'] ?? '' ?>" required step="any">
                    </div>

                    <!-- Leche de Polvo Comercial -->
                    <div>
                        <hr>
                        <label>Leche de Polvo Comercial</label><br><br>
                        
                        <label for="CantidadLTPC">Cantidad de litros:</label>
                        <input type="text" id="CantidadLTPC" name="CantidadLTPC" placeholder="Lts" value="<?= $row['CantidadLTPC'] ?? '' ?>" required step="any">
                    </div>
                    <div>
                        <label for="ImporteLTPC">Importe:</label>
                        <input type="text" id="ImporteLTPC" name="ImporteLTPC" placeholder="$" value="<?= $row['ImporteLTPC'] ?? '' ?>" required step="any">
                    </div>
                    <div>
                        <label for="PorcentajeLTPC">Porcentaje que Representa en la Factura:</label>
                        <input type="number" id="PorcentajeLTPC" name="PorcentajeLTPC" placeholder="%" value="<?= $row['PorcentajeLTPC'] ?? '' ?>" required step="any">
                    </div>

                    <!-- Leche de UHT -->
                    <div>
                        <hr>
                        <label>Leche de UHT</label><br><br>

                        <label for="CantidadLTUHT">Cantidad de litros:</label>
                        <input type="text" id="CantidadLTUHT" name="CantidadLTUHT" placeholder="Lts" value="<?= $row['CantidadLTUHT'] ?? '' ?>" required step="any">
                    </div>
                    <div>
                        <label for="ImporteLTUHT">Importe:</label>
                        <input type="text" id="ImporteLTUHT" name="ImporteLTUHT" placeholder="$" value="<?= $row['ImporteLTUHT'] ?? '' ?>" required step="any">
                    </div>
                    <div>
                        <label for="PorcentajeLTUHT">Porcentaje que Representa en la Factura    :</label>
                        <input type="number" id="PorcentajeLTUHT" name="PorcentajeLTUHT" placeholder="%" value="<?= $row['PorcentajeLTUHT'] ?? '' ?>" required step="any">
                    </div>
                    
                    <!-- Observaciones Resumen -->
                    <hr>
                    <div>
                        <label for="ObservacionesRes">Observaciones Resumen de Facturación:</label><br><br>
                        <textarea id="ObservacionesRes" name="ObservacionesRes" rows="4" placeholder="Ej. La Facturación Disminuyó 5.25% al cierre del mes" required><?= $row['ObservacionesRes'] ?? '' ?></textarea>
                    </div>

                    <!-- Análisis de Saldos Vencidos -->
                    <div>
                        <hr>
                        <label>Análisis de Saldos Vencidos</label><br>
                        <hr>
                        <label for="TotalFacturadoMes">Total Facturado en el Mes:</label>
                        <input type="text" id="TotalFacturadoMes" name="TotalFacturadoMes" placeholder="$" value="<?= $row['TotalFacturadoMes'] ?? '' ?>" required step="any">
                    </div>
                    <div>
                        <label for="TotalDepositosMes">Total de Depositos en el Mes:</label>
                        <input type="number" id="TotalDepositosMes" name="TotalDepositosMes" placeholder="$" value="<?= $row['TotalDepositosMes'] ?? '' ?>" required step="any">
                    </div>
                    
                    <!-- Observaciones Facturas/Depósitos -->
                    <hr>
                    <div>
                        <label for="ObservacionesFacturasDepositos">Observaciones Facturas y Depositos:</label><br><br>
                        <textarea id="ObservacionesFacturasDepositos" name="ObservacionesFacturasDepositos" rows="4" placeholder="Ej. Al cierre del Mes , Los Depositos comparados con nuestra facturación Representan un Deficit del 8.37%" required><?= $row['ObservacionesFacturasDepositos'] ?? '' ?></textarea>
                    </div>

                    <!-- Saldos del Mes -->
                    <div>
                        <hr>
                        <label>Saldos del Mes</label><br><br>
                        <label for="SaldoTS">Saldo:</label>
                        <input type="number" id="SaldoTS" name="SaldoTS" placeholder="$" value="<?= $row['SaldoTS'] ?? '' ?>" required step="any">
                    </div>
                    <div>
                        <label for="SaldoPV">Saldo por Vencer:</label>
                        <input type="number" id="SaldoPV" name="SaldoPV" placeholder="$" value="<?= $row['SaldoPV'] ?? '' ?>" required step="any">
                    </div>
                    <div>
                        <label for="SaldoV">Saldo Vencido:</label>
                        <input type="number" id="SaldoV" name="SaldoV" placeholder="$" value="<?= $row['SaldoV'] ?? '' ?>" required step="any">
                    </div>
                    <div>
                        <label for="Saldotreina">Saldo a 30 días:</label>
                        <input type="number" id="Saldotreina" name="Saldotreina" placeholder="$" value="<?= $row['Saldotreina'] ?? '' ?>" required step="any">
                    </div>
                    <div>
                        <label for="Saldosesenta">Saldo a 60 días:</label>
                        <input type="number" id="Saldosesenta" name="Saldosesenta" placeholder="$" value="<?= $row['Saldosesenta'] ?? '' ?>" required step="any">
                    </div>
                    <div>
                        <label for="Saldonoventa">Saldo a 90 días:</label>
                        <input type="number" id="Saldonoventa" name="Saldonoventa" placeholder="$" value="<?= $row['Saldonoventa'] ?? '' ?>" required step="any">
                    </div>
                    <div>
                        <label for="Saldosecenta">Saldo a mas de 90 días:</label>
                        <input type="number" id="Saldosecenta" name="Saldosecenta" placeholder="$" value="<?= $row['Saldosecenta'] ?? '' ?>" required step="any">
                    </div>

                    <!-- Observaciones Saldos -->
                    <hr>
                    <div>
                        <label for="ObservacionesSaldos">Observaciones de los Saldos:</label><br><br>
                        <textarea id="ObservacionesSaldos" name="ObservacionesSaldos" rows="4" placeholder="Ej. La Facturación Disminuyó 5.25% al cierre del mes" required><?= $row['ObservacionesSaldos'] ?? '' ?></textarea>
                    </div>

                    <!-- Saldo DICONSA -->
                    <div>
                        <hr>
                        <label>Saldo del Cliente Alimentación Para el Bienestar (DICONSA)</label><br>
                        <hr> 
                        <label for="TotalSaldo">Total del Saldo:</label>
                        <input type="text" id="TotalSaldo" name="TotalSaldo" placeholder="$" value="<?= $row['TotalSaldo'] ?? '' ?>" required step="any">
                    </div>
                    
                    <!-- Observaciones Saldo Mes -->
                    <div>
                        <label for="ObservacionesSaldomes">Observaciones del Saldo de la Alimentación Para el Bienestar:</label><br><br>
                        <textarea id="ObservacionesSaldomes" name="ObservacionesSaldomes" rows="4" placeholder="Ej. Alimentación Para el Bienestar al cierre del Mes Presenta un Saldo Deudor de $344,250.00" required><?= $row['ObservacionesSaldomes'] ?? '' ?></textarea>
                    </div>
                    
                </div>
            </div>
            
            <!-- Botones -->
            <div class="form-buttons">
                <input type="submit" name="g" value="Guardar Cambios"">
                <input type="button" name="b" value="Limpiar Campos" onclick="limpiarCampos()">
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
