<?php
include "Conexion.php";
require_once __DIR__ . '/vendor/autoload.php';

// Consulta para obtener el reporte general
$query = "SELECT 
            c.CA_DNI AS ID_Camionero,
            c.Nombre AS Nombre_Camionero,
            ca.ID_CA AS ID_Camion,
            ca.Marca AS Marca_Camion,
            carga.Nombre_C AS Carga_Asignada,
            m.ID_MAN AS ID_Mantenimiento,
            m.Descripcion AS Descripcion_Mantenimiento,
            e.Nombre AS Empresa,
            r.Ru_In AS Ruta_Inicio,
            r.Ru_FIN AS Ruta_Final
          FROM 
            camioneros c
          LEFT JOIN 
            camiones ca ON c.CA_DNI = ca.CA_DNI
          LEFT JOIN 
            carga ON ca.ID_CA = carga.ID_CA
          LEFT JOIN 
            mantenimiento m ON ca.ID_CA = m.ID_CA
          LEFT JOIN 
            empresa e ON c.ID_EM = e.ID_EM
          LEFT JOIN 
            ruta r ON c.CA_DNI = r.CA_DNI";
$res = mysqli_query($link, $query);

$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
$mpdf->SetMargins(10, 10, 10); 
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
        table { border-collapse: collapse; width: 100%; font-family: Arial, sans-serif; }
        th, td { border: 1px solid black; padding: 8px; text-align: center; font-size: 12px; }
        h2 { font-family: Arial, sans-serif; font-size: 16px; }
    </style>
');

$mpdf->WriteHTML('<br><br><br><h2 align="center">Reporte General</h2>');
$mpdf->WriteHTML('
    <table>
        <tr>
            <th>ID Camionero</th>
            <th>Nombre Camionero</th>
            <th>ID Camión</th>
            <th>Marca Camión</th>
            <th>Carga Asignada</th>
            <th>ID Mantenimiento</th>
            <th>Descripción Mantenimiento</th>
            <th>Ruta Inicio</th>
            <th>Ruta Final</th>
            <th>Empresa</th>
        </tr>
');

while ($fila = mysqli_fetch_assoc($res)) {
    $mpdf->WriteHTML("
        <tr>
            <td>{$fila['ID_Camionero']}</td>
            <td>{$fila['Nombre_Camionero']}</td>
            <td>{$fila['ID_Camion']}</td>
            <td>{$fila['Marca_Camion']}</td>
            <td>{$fila['Carga_Asignada']}</td>
            <td>{$fila['ID_Mantenimiento']}</td>
            <td>{$fila['Descripcion_Mantenimiento']}</td>
            <td>{$fila['Ruta_Inicio']}</td>
            <td>{$fila['Ruta_Final']}</td>
            <td>{$fila['Empresa']}</td>
        </tr>
    ");
}

$mpdf->WriteHTML('</table>');
$mpdf->Output();
include "Cerrar.php";
?>