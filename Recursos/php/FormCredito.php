<!DOCTYPE html>
<html lang="es">
<head>
	<title>Registro</title>
	<meta charset="UTF-8">
    <script src="../js/cargas.js"></script>
    <script src="../js/SumaT.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/formCredito.css">
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
	<img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">	
    
</head>
<body>
<main class="container">

    <h1>Depto. Credito y Cobranza</h1>
    
    <section class="registro">
        <form method="post" action="GuardarCredito.php">
        <div class="registro-container">
            <div class="registro-column">

                <div>
                    <label for="Mes">Mes:</label>
                    <input type="date" id="Mes" name="Mes" required>
                </div>
                <div>
                    <hr>
                    <label>Resumen de Facturación</label><br>
                    <hr>
                    <label>Leche Fortificada</label><br><br>
                    

                    <label for="CantidadLTF">Cantidad de litros:</label>
                    <input type="text" id="CantidadLTF" name="CantidadLTF" placeholder="Lts" required step="any" >
                </div>
                <div>
                    <label for="ImporteTF">Importe:</label>
                    <input type="text" id="ImporteTF" name="ImporteTF" placeholder="$" required step="any">
                </div>
                 <div>
                    <label for="PorcentajeTF">Porcentaje que Representa en la Factura:</label>
                    <input type="number" id="PorcentajeTF" name="PorcentajeTF" placeholder="%" required step="any">
                </div>
                <div>
                    <hr>
                    <label>Leche Frisia</label><br><br>
                    
                    <label for="CantidadLTFR">Cantidad de litros:</label>
                    <input type="text" id="CantidadLTFR" name="CantidadLTFR" placeholder="Lts" required step="any">
                </div>
                <div>
                    <label for="ImporteTFR">Importe:</label>
                    <input type="text" id="ImporteTFR" name="ImporteTFR" placeholder="$" required step="any">
                </div>
                 <div>
                    <label for="PorcentajeTFR">Porcentaje que Representa en la Factura:</label>
                    <input type="number" id="PorcentajeTFR" name="PorcentajeTFR" placeholder="%" required step="any">
                </div>
                <div>
                    <hr>
                    <label>Leche de Polvo AS</label><br><br>
                    
                    <label for="CantidadLTPAS">Cantidad de litros:</label>
                    <input type="text" id="CantidadLTPAS" name="CantidadLTPAS" placeholder="Lts" required step="any">
                </div>
                <div>
                    <label for="ImporteTPAS">Importe:</label>
                    <input type="text" id="ImporteTPAS" name="ImporteTPAS" placeholder="$" required step="any">
                </div>
                 <div>
                    <label for="PorcentajeTPAS">Porcentaje que Representa en la Factura:</label>
                    <input type="number" id="PorcentajeTPAS" name="PorcentajeTPAS" placeholder="%" required step="any">
                </div>
                <div>
                    <hr>
                    <label>Leche de Polvo Comercial</label><br><br>
                    
                    <label for="CantidadLTPC">Cantidad de litros:</label>
                    <input type="text" id="CantidadLTPC" name="CantidadLTPC" placeholder="Lts" required step="any">
                </div>
                <div>
                    <label for="ImporteLTPC">Importe:</label>
                    <input type="text" id="ImporteLTPC" name="ImporteLTPC" placeholder="$" required step="any">
                </div>
                 <div>
                    <label for="PorcentajeLTPC">Porcentaje que Representa en la Factura:</label>
                    <input type="number" id="PorcentajeLTPC" name="PorcentajeLTPC" placeholder="%" required step="any">
                </div>
                <div>
                    <hr>
                    <label>Leche de UHT</label><br><br>

                    <label for="CantidadLTUHT">Cantidad de litros:</label>
                    <input type="text" id="CantidadLTUHT" name="CantidadLTUHT" placeholder="Lts" required step="any">
                </div>
                <div>
                    <label for="ImporteLTUHT">Importe:</label>
                    <input type="text" id="ImporteLTUHT" name="ImporteLTUHT" placeholder="$" required step="any">
                </div>
                 <div>
                    <label for="PorcentajeLTUHT">Porcentaje que Representa en la Factura    :</label>
                    <input type="number" id="PorcentajeLTUHT" name="PorcentajeLTUHT" placeholder="%" required step="any">
                </div>
                <hr>
                 <div>
                    <label for="ObservacionesRes">Observaciones Resumen de Facturación:</label><br><br>
                    <textarea id="ObservacionesRes" name="ObservacionesRes" rows="4" placeholder="Ej. La Facturación Disminuyó 5.25% al cierre del mes" required ></textarea>
                </div>
                
                <div>
                    
                    <hr>
                    <label>Análisis de Saldos Vencidos</label><br>
                    <hr>
                    <label for="TotalFacturadoMes">Total Facturado en el Mes:</label>
                    <input type="text" id="TotalFacturadoMes" name="TotalFacturadoMes" placeholder="$" required step="any">
                </div>
                 <div>
                    <label for="TotalDepositosMes">Total de Depositos en el Mes:</label>
                    <input type="number" id="TotalDepositosMes" name="TotalDepositosMes" placeholder="$" required step="any"    >
                </div>
                <hr>
                <div>
                    <label for="ObservacionesFacturasDepositos">Observaciones Facturas y Depositos:</label><br><br>
                    <textarea id="ObservacionesFacturasDepositos" name="ObservacionesFacturasDepositos" rows="4" placeholder="Ej. Al cierre del Mes , Los Depositos comparados con nuestra facturación Representan un Deficit del 8.37%" required></textarea>
                </div>
                
                 <div>
                    <hr>
                    <label>Saldos del Mes</label><br><br>
                    <label for="SaldoTS">Saldo:</label>
                    <input type="number" id="SaldoTS" name="SaldoTS" placeholder="$" required step="any">
                </div>
                 <div>
                    <label for="SaldoPV">Saldo por Vencer:</label>
                    <input type="number" id="SaldoPV" name="SaldoPV" placeholder="$" required step="any">
                </div>
                <div>
                    <label for="SaldoV">Saldo Vencido:</label>
                    <input type="number" id="SaldoV" name="SaldoV" placeholder="$" required step="any">
                </div>
                <div>
                    <label for="Saldotreina">Saldo a 30 días:</label>
                    <input type="number" id="Saldotreina" name="Saldotreina" placeholder="$" required step="any">
                </div>
                <div>
                    <label for="Saldosesenta">Saldo a 60 días:</label>
                    <input type="number" id="Saldosesenta" name="Saldosesenta" placeholder="$" required step="any">
                </div>
                <div>
                    <label for="Saldonoventa">Saldo a 90 días:</label>
                    <input type="number" id="Saldonoventa" name="Saldonoventa" placeholder="$" required step="any">
                </div>
                <div>
                    <label for="Saldosecenta">Saldo a mas de 90 días:</label>
                    <input type="number" id="Saldosecenta" name="Saldosecenta" placeholder="$" required step="any">
                </div>
                <hr>
                 <div>
                    <label for="ObservacionesSaldos">Observaciones de los Saldos:</label><br><br>
                    <textarea id="ObservacionesSaldos" name="ObservacionesSaldos" rows="4" placeholder="Ej. La Facturación Disminuyó 5.25% al cierre del mes" required></textarea>
                </div>
                <div>
                    <hr>
                    <label>Saldo del Cliente Alimentación Para el Bienestar (DICONSA)</label><br>
                    <hr> 
                    <label for="TotalSaldo">Total del Saldo:</label>
                    <input type="text" id="TotalSaldo" name="TotalSaldo" placeholder="$" required step="any">
                </div>
                <div>
                    <label for="ObservacionesSaldomes">Observaciones del Saldo de la Alimentación Para el Bienestar:</label><br><br>
                    <textarea id="ObservacionesSaldomes" name="ObservacionesSaldomes" rows="4" placeholder="Ej. Alimentación Para el Bienestar al cierre del Mes Presenta un Saldo Deudor de $344,250.00" required></textarea>
                </div>
                
                
            </div>
             </div>
                <div class="form-buttons">
                <input type="submit" name="g" value="Guardar">
                <input type="reset" name="b" value="Limpiar">
            </div>
            
        </form>
    </section>
    <a href="TipoFormulario.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90">
    </a>
</main>

</body>
</html>