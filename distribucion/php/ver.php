<?php
include "Conexion.php";

$ID = $_GET["sc"];

// Consulta para obtener la información del horario y los camioneros asignados
$query = "SELECT h.ID_H, h.H_In, h.H_Fin, h.Dias_Lab, c.CA_DNI, c.Nombre AS Nombre_Camionero
          FROM horario_lab h
          JOIN horarios_camioneros hc ON h.ID_H = hc.id_horario
          JOIN camioneros c ON hc.id_camionero = c.CA_DNI
          WHERE h.ID_H = '$ID'";
$res = mysqli_query($link, $query);

// Verificar si la consulta devolvió resultados
if (!$res) {
    die("Error en la consulta: " . mysqli_error($link));
}

// Obtener la primera fila para la información del horario
$row = mysqli_fetch_array($res);

if (!$row) {
    die("No se encontró el horario.");
}

// Mostrar la información del horario
echo "
    <!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <title>Información de los horarios</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
        <link rel='stylesheet' href='../css/ver.css'>
    </head>
    <body>
    <img src='../Imagenes/logo.png' class='logo'>

        <div class='contenedor'>
            <h1>Información de los horarios</h1>
            <hr>
            <section class='registro'>
                <h2>Información Encontrada</h2>
                <hr>
                <table class='info-tabla'>
                <tr><td>ID:</td><td>{$row['ID_H']}</td></tr>
                <tr><td>Hora de Inicio:</td><td>{$row['H_In']}</td></tr>
                <tr><td>Hora de Fin:</td><td>{$row['H_Fin']}</td></tr>
                <tr><td>Días Laborales:</td><td>{$row['Dias_Lab']}</td></tr>
                <tr><td>Camioneros Asignados:</td><td>";

// Mostrar todos los camioneros asignados
echo "<ul>";
do {
    echo "<li>{$row['CA_DNI']} - {$row['Nombre_Camionero']}</li>";
} while ($row = mysqli_fetch_array($res)); // Iterar sobre todas las filas
echo "</ul>";

echo "
                </td></tr>
                </table>
                <hr>
                <div class='links'>
                    <a href='Consulta.php' class='btn'>Realizar Otra Consulta</a>
                    <a href='horarioP.php' class='home-link'><img src='../imagenes/home.png' alt='Inicio' height='50' width='50'></a>
                </div>
            </section>
            </div>
        </body>
        </html>
";
include "Cerrar.php";
?>