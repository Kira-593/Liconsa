<?php
include "Conexion.php";
require_once __DIR__ . '/vendor/autoload.php';

$query = "SELECT * FROM camioneros";
$res = mysqli_query($link, $query);

$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [279, 215]]);
$mpdf->SetMargins(0, 0, 30); 
$mpdf->SetWatermarkImage('../Imagenes/marcaagua.png', 0.1, 10, 10);
$mpdf->showWatermarkImage = true;

$mpdf->SetHTMLHeader('
    <div style="position: absolute; top: 0; right: 0;">
        <img src="../Imagenes/logo.png" width="150px" height="150px">
    </div>
');
$mpdf->SetHTMLFooter('Página {PAGENO} de {nb}');
$mpdf->WriteHTML('
    <style>
        table { border-collapse: collapse; width: 100%; font-family:Arial, sans-serif;}
        th, td { border: 1px solid black; padding: 1px; text-align: center; font-size: 13px;}
        h2 { font-family: Arial, sans-serif; font-size: 16px; }
    </style>
');

$mpdf->WriteHTML('<h2 align="center" style="font-family: Arial, sans-serif; font-size: 16px;">Datos de Choferes</h2>');
$mpdf->WriteHTML('
    
    <table>
        <tr>
            <th>DNI</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>No. Telefónico</th>
            <th>Codigo Postal</th>
            <th>Estado Residente</th>
            <th>Población</th>
            <th>Colonia</th>
            <th>Calle</th>
            <th>No. Casa</th>
            <th>Salario</th>
            <th>Empresa</th>
        </tr>
');

$rowCount = 0;
while ($fila = mysqli_fetch_row($res)) {
    $empresaID = $fila[12];
    $query_empresa = "SELECT Nombre FROM empresa WHERE ID_EM = '$empresaID'";
    $res_empresa = mysqli_query($link, $query_empresa);
    $row_empresa = mysqli_fetch_array($res_empresa);
    $nombre_empresa = $row_empresa['Nombre'];

    $mpdf->WriteHTML("
        <tr>
            <td>{$fila[0]}</td>
            <td>{$fila[1]}</td> 
            <td>{$fila[2]}</td>
            <td>{$fila[3]}</td>
            <td>{$fila[4]}</td>
            <td>{$fila[5]}</td>
            <td>{$fila[6]}</td>
            <td>{$fila[7]}</td>
            <td>{$fila[8]}</td>
            <td>{$fila[9]}</td>
            <td>{$fila[10]}</td>
            <td>$ {$fila[11]}</td>
            <td>{$nombre_empresa}</td>
        </tr>
    ");
    $rowCount++;

    if ($rowCount > 18) {
        $mpdf->WriteHTML('</table>');
        $mpdf->AddPage('');
        $mpdf->WriteHTML('<h2 align="center">Datos de Choferes</h2>');
        $mpdf->WriteHTML('
        <table>
        <tr>
            <th>DNI</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>No. Telefónico</th>
            <th>Codigo Postal</th>
            <th>Estado Residente</th>
            <th>Población</th>
            <th>Colonia</th>
            <th>Calle</th>
            <th>No. Casa</th>
            <th>Salario</th>
            <th>Empresa</th>
        </tr>');
        $rowCount = 0;
    }
}
$mpdf->WriteHTML('</table>');
$mpdf->Output();
include "Cerrar.php";
?>