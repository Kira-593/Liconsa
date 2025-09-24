<!DOCTYPE html>
<html lang="es">
<head>
	<title>Registro</title>
	<meta charset="UTF-8">
    <script src="../js/cargas.js"></script>
    <script src="../js/SumaT.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/formMaterial.css">
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
	<img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">	
    
</head>
<body>
<main class="container">

    <h1>Existencia de Materia Prima y Material de Envase</h1>
    
    <section class="registro">
        <form method="post" action="Guardar.php">
        <div class="registro-container">
            <div class="registro-column">
                <div>
                    <label for="Indicador">Material</label>
                     <select id="Indicador" name="Indicador" required>
                        <?php
                        include "Conexion.php";

                        // Consulta para obtener los camiones
                        $query = "SELECT ID_CA, Marca FROM camiones";
                        $res = mysqli_query($link, $query);

                        while ($fila = mysqli_fetch_array($res)) {
                            echo "<option value='" . $fila['ID_CA'] . "'>" . $fila['ID_CA'] . " - " . $fila['Marca'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div>
                    <label for="Mes">Mes:</label>
                    <input type="date" id="Mes" name="Mes" required>
                </div>
                <div>
                    <label></label>Cantidad Mensual<br><br>
                    <label for="CodigoTC">Codigo:</label>
                    <input type="number" id="CodigoTC" name="CodigoTC" placeholder="Ej. 576" required>
                </div>
                <div>
                    <label for="DescripcionTD">Descripcion:</label>
                    <input type="text" id="DescripcionTD" name="DescripcionTD" placeholder="Ej.Polietileno para Frisia de 1LT" required>
                </div>
                 <div>
                    <label for="CantidadITC">Cantidad Inicial:</label>
                    <input type="number" id="CantidadITC" name="CantidadITC" placeholder="Kg" required>
                </div>
                <div>
                    <label for="CantidadETC">Cantidad de Entradas:</label>
                    <input type="number" id="CantidadETC" name="CantidadETC" placeholder="Kg" required>
                </div>
                <div>
                    <label for="CantidadCTC">Cantidad de Consumo:</label>
                    <input type="number" id="CantidadCTC" name="CantidadCTC" placeholder="Kg" required>
                </div>
                 <div>
                    <label for="CantidadFTC">Cantidad Final:</label>
                    <input type="number" id="CantidadFTC" name="CantidadFTC" placeholder="Kg" required>
                </div>
            </div>
             </div>
                <div class="form-buttons">
                <input type="submit" name="g" value="Guardar">
                <input type="reset" name="b" value="Limpiar">
            </div>
        </form>
    </section>
    <a href="TipoFormulario.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90">
    </a>
</main>

</body>
</html>