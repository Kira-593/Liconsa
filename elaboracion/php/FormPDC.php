<!DOCTYPE html>
<html lang="es">
<head>
	<title>Registro</title>
	<meta charset="UTF-8">
    <script src="../js/cargas.js"></script>
    <script src="../js/SumaT.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/formPDC.css">
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
	<img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">	
    
</head>
<body>
<main class="container">

    <h1>Formulario de Producción    </h1>
    <section class="registro">
        <form method="post" action="Guardar.php">
        <div class="registro-container">
            <div class="registro-column">
                <div>
                    <label for="Indicador">Indicador</label>
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
                    <label>Productos</label><br><br>
                    <label for="Leche_Frisa">Leche Frisa:</label>
                    <input type="number" id="Leche_Frisa" name="Leche_Frisa" placeholder="Litros" required>
                </div>
                <div>
                    <label for="Leche_Abasto">Leche de Abasto:</label>
                    <input type="number" id="Leche_Abasto" name="Leche_Abasto" placeholder="Litros" required>
                </div>
                <div>
                    <label for="Total">Total:</label>
                    <input type="number" id="Total" name="Total" placeholder="Litros" required>
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