<?php
    include "Conexion.php";

    // Obtener y sanitizar los datos del formulario
    $Indicador = isset($_POST["Indicador"]) ? $_POST["Indicador"] : '';
    $Mes = isset($_POST["Mes"]) ? $_POST["Mes"] : '';
    $MinimoTMN = isset($_POST["MinimoTMN"]) ? $_POST["MinimoTMN"] : '';
    $MaximoTMN = isset($_POST["MaximoTMN"]) ? $_POST["MaximoTMN"] : '';
    $PromedioTPN = isset($_POST["PromedioTPN"]) ? $_POST["PromedioTPN"] : '';
    $MinimoTE = isset($_POST["MinimoTE"]) ? $_POST["MinimoTE"] : '';
    $MaximoTE = isset($_POST["MaximoTE"]) ? $_POST["MaximoTE"] : '';
    $PromedioTP = isset($_POST["PromedioTP"]) ? $_POST["PromedioTP"] : '';

    // Preparar sentencia para evitar inyección y problemas con valores sin comillas
    $stmt = mysqli_prepare($link, "INSERT INTO c_contenidonetopesoenvase (
        Indicador, Mes, MinimoTMN, MaximoTMN, PromedioTPN, MinimoTE, MaximoTE, PromedioTP
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    $error = '';
    $affected = 0;

    if ($stmt) {
        // Enlazamos todos como strings para que MySQL maneje la conversión; la sentencia preparada se encarga de las comillas
        mysqli_stmt_bind_param($stmt, 'ssssssss', $Indicador, $Mes, $MinimoTMN, $MaximoTMN, $PromedioTPN, $MinimoTE, $MaximoTE, $PromedioTP);
        if (mysqli_stmt_execute($stmt)) {
            $affected = mysqli_stmt_affected_rows($stmt);
        } else {
            $error = mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        $error = mysqli_error($link);
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Guardar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/guardar.css">
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">	
</head>
<body>
    <div class="contenedor">
        <?php
            if (isset($affected) && $affected > 0) {
                echo "<div class='mensaje correcto'>Registro guardado correctamente</div>";
            } else {
                $msg = '';
                if (isset($error) && $error !== '') {
                    $msg = $error;
                } else {
                    $msg = mysqli_error($link);
                }
                if ($msg === '') {
                    $msg = 'Error desconocido al ejecutar la consulta.';
                }
                echo "<div class='mensaje error'>Error al guardar el registro. Error: " . htmlspecialchars($msg) . "</div>";
            }
            include "Cerrar.php";
        ?>
        <br><a href='FormContenidoNyP.php' class='btn'>Realizar Otro Registro</a><br>
        <br><a href='TipoFormulario.php' class='home-link'><img src='../imagenes/home.png' height='100' width='90'></a>
    </div>
</body>
</html>