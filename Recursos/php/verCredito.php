<?php
    include "Conexion.php";

    $Mes = $_GET["sc"];

    $query = "SELECT * FROM cred_depto_credito_cobranza WHERE id = '$Mes'";
    $res = mysqli_query($link, $query);
    $row = mysqli_fetch_array($res);

   echo "
       <!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <title>Informe Mensual del Departamento de Crédito y Cobranza</title>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
            <link rel='stylesheet' href='../css/verCredito.css'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <img src='../imagenes/AgriculturaLogo.png' class='logo-superior' alt='Logo Agricultura'>
            <img src='../imagenes/sgc.png' class='logo-sgc' alt='Logo SGC'>
        </head>
        <body>

            <div class='contenedor'>
            <h1>Informe del Departamento de Crédito y Cobranza</h1>
            <hr>
            <section class='registro'>
                <h2>Resumen Financiero del Mes: {$row['Mes']}</h2>
                <hr>
                
                <table class='info-tabla'>
                    
                    <tr><td colspan='3'><strong>1. Resumen de Facturación por Producto</strong></td></tr>
                    <!-- Encabezados de Columna -->
                    <tr class='table-header'>
                        <td>Producto</td>
                        <td>Litros / Cantidad</td>
                        <td>Importe</td>
                        <td>% de la Factura</td>
                    </tr>
                    
                    <!-- Leche Fortificada -->
                    <tr>
                        <td>Leche Fortificada</td>
                        <td>{$row['CantidadLTF']} Lts</td>
                        <td>$ {$row['ImporteTF']}</td>
                        <td>{$row['PorcentajeTF']}%</td>
                    </tr>
                    <!-- Leche Frisia -->
                    <tr>
                        <td>Leche Frisia</td>
                        <td>{$row['CantidadLTFR']} Lts</td>
                        <td>$ {$row['ImporteTFR']}</td>
                        <td>{$row['PorcentajeTFR']}%</td>
                    </tr>
                    <!-- Leche de Polvo AS -->
                    <tr>
                        <td>Leche de Polvo AS</td>
                        <td>{$row['CantidadLTPAS']} Lts</td>
                        <td>$ {$row['ImporteTPAS']}</td>
                        <td>{$row['PorcentajeTPAS']}%</td>
                    </tr>
                    <!-- Leche de Polvo Comercial -->
                    <tr>
                        <td>Leche de Polvo Comercial</td>
                        <td>{$row['CantidadLTPC']} Lts</td>
                        <td>$ {$row['ImporteLTPC']}</td>
                        <td>{$row['PorcentajeLTPC']}%</td>
                    </tr>
                    <!-- Leche UHT -->
                    <tr>
                        <td>Leche de UHT</td>
                        <td>{$row['CantidadLTUHT']} Lts</td>
                        <td>$ {$row['ImporteLTUHT']}</td>
                        <td>{$row['PorcentajeLTUHT']}%</td>
                    </tr>

                    <tr><td colspan='4'>&nbsp;</td></tr>
                    <tr><td colspan='4'><strong>Observaciones del Resumen de Facturación:</strong></td></tr>
                    <tr><td colspan='4'>{$row['ObservacionesRes']}</td></tr>
                    
                    <tr><td colspan='4'>&nbsp;</td></tr>
                    <tr><td colspan='4'><strong>2. Análisis de Facturas vs. Depósitos</strong></td></tr>

                    <tr><td colspan='2'>Total Facturado en el Mes:</td><td colspan='2'>$ {$row['TotalFacturadoMes']}</td></tr>
                    <tr><td colspan='2'>Total de Depósitos en el Mes:</td><td colspan='2'>$ {$row['TotalDepositosMes']}</td></tr>
                    
                    <tr><td colspan='4'>&nbsp;</td></tr>
                    <tr><td colspan='4'><strong>Observaciones Facturas y Depósitos:</strong></td></tr>
                    <tr><td colspan='4'>{$row['ObservacionesFacturasDepositos']}</td></tr>

                    <tr><td colspan='4'>&nbsp;</td></tr>
                    <tr><td colspan='4'><strong>3. Saldos de Cartera Vencida</strong></td></tr>

                    <tr><td colspan='2'>**Saldo Total (TS):**</td><td colspan='2'><strong>$ {$row['SaldoTS']}</strong></td></tr>
                    <tr><td colspan='2'>Saldo por Vencer (PV):</td><td colspan='2'>$ {$row['SaldoPV']}</td></tr>
                    <tr><td colspan='2'>Saldo Vencido (V):</td><td colspan='2'>$ {$row['SaldoV']}</td></tr>
                    
                    <tr><td colspan='4'>&nbsp;</td></tr>
                    <tr><td colspan='4'>**Antigüedad de la Cartera Vencida:**</td></tr>
                    <tr><td colspan='2'>Saldo a 30 días:</td><td colspan='2'>$ {$row['Saldotreina']}</td></tr>
                    <tr><td colspan='2'>Saldo a 60 días:</td><td colspan='2'>$ {$row['Saldosesenta']}</td></tr>
                    <tr><td colspan='2'>Saldo a 90 días:</td><td colspan='2'>$ {$row['Saldonoventa']}</td></tr>
                    <tr><td colspan='2'>Saldo a más de 90 días:</td><td colspan='2'>$ {$row['Saldosecenta']}</td></tr>
                    
                    <tr><td colspan='4'>&nbsp;</td></tr>
                    <tr><td colspan='4'><strong>Observaciones de los Saldos:</strong></td></tr>
                    <tr><td colspan='4'>{$row['ObservacionesSaldos']}</td></tr>
                    
                    <tr><td colspan='4'>&nbsp;</td></tr>
                    <tr><td colspan='4'><strong>4. Saldo del Cliente Alimentación Para el Bienestar (DICONSA)</strong></td></tr>
                    <tr><td colspan='2'>Total del Saldo DICONSA:</td><td colspan='2'>$ {$row['TotalSaldo']}</td></tr>

                    <tr><td colspan='4'>&nbsp;</td></tr>
                    <tr><td colspan='4'><strong>Observaciones del Saldo de la Alimentación Para el Bienestar:</strong></td></tr>
                    <tr><td colspan='4'>{$row['ObservacionesSaldomes']}</td></tr>

                </table>
                <hr>
                <div class='links'>
                    <!-- El formulario de guardado es GuardarCredito.php, el enlace de consulta se ajusta a ConCredito.php -->
                    <a href='ConCredito.php' class='btn'>Realizar Otra Consulta</a>
                    <a href='MenuConsulta.php' class='home-link'><img src='../imagenes/home.png' alt='Inicio' height='50' width='50'></a>
                </div>
            </section>
            </div>
        </body>
        </html>
    ";
    include "Cerrar.php";
?>