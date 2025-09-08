<?php
include "Conexion.php";

    $dni_camionero = $_POST['camionero'];
    $id_horario = $_POST['horario'];

    // Inserción en la tabla de muchos a muchos
    $query_asignacion = "INSERT INTO horarios_camioneros (id_horario, id_camionero) VALUES ('$id_horario', '$dni_camionero')";
    
?>

    <meta charset="UTF-8">
    <title>Hacer Asignación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/guardar.css">
</head>
<body>
    <img src="../Imagenes/logo.png" class="logo">
    <div class="contenedor">
        <?php
            if (mysqli_query($link, $query_asignacion)) {
                echo "<div class='mensaje correcto'>Horario asignado correctamente.</div>";
            }else {
                    echo "<div class='mensaje error'>Error al asignar el horario. Error: " . mysqli_errno($link) . "</div>";
                }
            include "Cerrar.php";
        ?>
        <br><a href='Asignacion.php' class='btn'>Realizar Otra Asignación</a><br>
        <br><a href='horarioP.php'><img src='..\imagenes\home.png' height='100' width='90'></a>
    </div>
</body>
</html>