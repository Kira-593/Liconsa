<?php
	
	include "Conexion.php";
	
	$query="select * from g_indicador_ma";
	$res= mysqli_query($link, $query);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/consulta.css">
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
	<img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">	
</head>

<body>
    <div class="contenedor">
        <h1>Modificación de Información de los Indicadores</h1>
        <p>Seleccione el ID del indicador.</p>

        <form method="get" action="actualizarIndiMa.php">
            <select name="sc" required>
                <?php
                    while ($fila = mysqli_fetch_array($res)) {
                    // Determinar el estado basado en ambos permisos
                    $permite_modificar = $fila['permitir_modificar'];
                    $permite_firmar = $fila['permitir_firmar'];
                    $esta_firmado = !empty($fila['firma_usuario']);
                    
                    if ($esta_firmado) {
                        $estado = ' (✅ FIRMADO - No editable)';
                        $color_clase = 'firmado';
                    } elseif ($permite_modificar && $permite_firmar) {
                        $estado = ' (✏️📝 Modificar y Firmar)';
                        $color_clase = 'completo';
                    } elseif ($permite_modificar) {
                        $estado = ' (✏️ Solo Modificar)';
                        $color_clase = 'modificar';
                    } elseif ($permite_firmar) {
                        $estado = ' (📝 Solo Firmar)';
                        $color_clase = 'firmar';
                    } else {
                        $estado = ' (❌ Sin permisos)';
                        $color_clase = 'bloqueado';
                    }
                    
                    echo "<option value='" . $fila['id'] . "' class='$color_clase'>" . 
                         $fila['id'] . " .- " . $fila['Mes'] . $estado . "</option>";
                }
                include "Cerrar.php";
                ?>
            </select>
            <input type="submit" name="elec" value="Buscar">
        </form>

        <a href="gestionP.php" class="link">
            <img src="../imagenes/home.png" height="100" width="90" alt="Inicio">
        </a>
    </div>
</body>
</html>