<?php
    include "Conexion.php";

    $ID = $_GET["sc"];

    $query = "SELECT * FROM mantenimiento WHERE ID_MAN = '$ID'";
    $res = mysqli_query($link, $query);
    $row = mysqli_fetch_array($res);

    $id_camion = $row['ID_CA'];
    $query_camion = "SELECT Marca FROM camiones WHERE ID_CA = '$id_camion'";
    $res_camion = mysqli_query($link, $query_camion);
    $row_camion = mysqli_fetch_array($res_camion);
    $marca_camion = $row_camion['Marca'];


    echo "
        <!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <title>Información de la carga</title>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
            <link rel='stylesheet' href='../css/ver.css'>
        </head>
        <body>
        <img src='../Imagenes/logo.png' class='logo'>

            <div class='contenedor'>
            <h1>Información del Mantenimiento</h1>
            <hr>
            <section class='registro'>
                <h2>Información Encontrada</h2>
                <hr>
                <table class='info-tabla'>
                <tr><td>ID:</td><td>{$row['ID_MAN']}</td></tr>
                <tr><td>Descripción:</td><td>{$row['Descripcion']}</td></tr>
                <tr><td>Fecha de Ingreso:</td><td>{$row['Fecha_I']}</td></tr>
                <tr><td>Fecha de Salida:</td><td>{$row['Fecha_S']}</td></tr>
                <tr><td>ID camion:</td><td>{$row['ID_CA']} - {$marca_camion}</td></tr>
                </table>
                <hr>
                <div class='links'>
                    <a href='Consulta.php' class='btn'>Realizar Otra Consulta</a>
                    <a href='mantenimientoP.php' class='home-link'><img src='../imagenes/home.png' alt='Inicio' height='50' width='50'></a>
                </div>
            </section>
            </div>
        </body>
        </html>
    ";
    include "Cerrar.php";
?>