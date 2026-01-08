<?php
	
	include "Conexion.php";
	
	$query="select * from envasado_indicador";
	$res= mysqli_query($link, $query);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/consulta.css">
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
	<img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">	
</head>

<body>
    <div class="contenedor">
        <h1>Impresion de Información de los Indicadores</h1>
        <p>Seleccione el ID del indicador.</p>

        <form method="get" action="ImpEnvasado.php" target="_blank">
            <select name="sc" required>
                <?php
                while ($fila = mysqli_fetch_array($res)) {
                    echo "<option value='" . $fila['id'] . "'>" . $fila['id'] . " .- " . $fila['Mes'] . "</option>";
                }
                include "Cerrar.php";
                ?>
            </select>
            <input type="submit" name="elec" value="Buscar">
        </form>

        <a href="MenuImpresion.php" class="link">
            <img src="../imagenes/home.png" height="100" width="90" alt="Inicio">
        </a>
    </div>
</body>
</html>