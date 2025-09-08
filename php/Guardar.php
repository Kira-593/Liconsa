<?php
include "Conexion.php";

// Obtener los datos del formulario
$DNI1 = $_POST["DNI"];
$Nombre1 = $_POST["Nombre"];
$ap1 = $_POST["ap"];
$am1 = $_POST["am"];
$nt1 = $_POST["nt"];
$CodigoP1 = $_POST["CodigoP"];
$Estado1 = $_POST["Estado"];
$Población1 = $_POST["Población"];
$Colonia1 = $_POST["Colonia"];
$Calle1 = $_POST["Calle"];
$nc1 = $_POST["nc"];
$Salario1 = $_POST["Salario"];
$Empresa1 = $_POST["Empresa"];

// Verifica que los nombres de los campos coincidan con los nombres en la tabla 'camioneros'
$query = "INSERT INTO camioneros (CA_DNI, Nombre, Apellido_p, Apellido_m, N_teléfono, Codigo_Postal, Estado_vive, Población, Colonia, Calle, N_casa, Salario, ID_EM) 
          VALUES ('$DNI1', '$Nombre1', '$ap1', '$am1', '$nt1', '$CodigoP1', '$Estado1', '$Población1', '$Colonia1', '$Calle1', '$nc1', '$Salario1', '$Empresa1')";

// Ejecutar la consulta
mysqli_query($link, $query);
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Guardar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/guardar.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <img src="../Imagenes/logo.png" class="logo">
    <div class="contenedor">
        <?php
        if (mysqli_affected_rows($link) > 0) {
            echo "<div class='mensaje correcto'>Inserción correcta</div>";
        } else {
            if (mysqli_errno($link) == 1062) {
                echo "<div class='mensaje error'>DNI de Camionero duplicado, favor de revisar</div>";
            } else {
                echo "<div class='mensaje error'>Inserción incorrecta. Error: " . mysqli_errno($link) . "</div>";
            }
        }
        include "Cerrar.php";
        ?>
        <br><a href='Camionero.php' class='btn'>Realizar Otra Inserción</a><br>
        <br><a href='index.php'><img src='..\imagenes\home.png' height='100' width='90'></a>
    </div>
</body>
</html>