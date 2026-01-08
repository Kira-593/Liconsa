<?php
include "Conexion.php";

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
            ruta r ON c.CA_DNI = r.CA_DNI"; // Todos los JOIN cambiados a LEFT JOIN

// Ejecutar la consulta
$res = mysqli_query($link, $query);

// Verificar si la consulta devolvió resultados
if (!$res) {
    die("Error en la consulta: " . mysqli_error($link));
}

// Verificar si hay registros
if (mysqli_num_rows($res) == 0) {
    die("No se encontraron registros.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte General</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/reporteP.css">
</head>

<body>
    <h1>Reporte General</h1>
    
    <table class="table table-striped">
        <thead>
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
        </thead>
        <tbody>
        <?php
        // Recorrer los resultados y mostrarlos en la tabla
        while ($fila = mysqli_fetch_assoc($res)) {
            echo "<tr>
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
            </tr>";
        }
        ?>
        </tbody>
    </table>
    
    <center>
        <a href="generarPDF.php" target="_blank" class="btn btn-primary">Imprimir</a><br>
        <a href="../../menuphp/php/menuP.php"><img src="../imagenes/home.png" height="100" width="90" alt="Inicio"></a>
    </center>
</body>
</html>

<?php
include "Cerrar.php";
?>