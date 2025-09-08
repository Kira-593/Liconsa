<!DOCTYPE html>
<html lang="es">
<head>
	<title>Registro</title>
	<meta charset="UTF-8">
    <script src="../js/camiones.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/registro.css">
    
</head>
<body>
<img src="../Imagenes/logo.png" class="logo">
<main class="container">

    <h1>Registro de Camiones</h1>
    <section class="registro">
        <form method="post" action="Guardar.php">
        <div class="registro-container">
            <div class="registro-column">
                <div>
                    <label for="ID">ID:</label>
                    <input type="number" id="ID" name="ID" placeholder="1234..." required>
                </div>
                <div>
                    <label for="Marca">Marca:</label>
                    <input type="text" id="Marca" name="Marca" maxlength="35" placeholder="VOLVO" required>
                </div>
                <div>
                    <label for="Modelo">Modelo:</label>
                    <input type="number" id="Modelo" name="Modelo" placeholder="2001" required>
                </div>
                <div>
                    <label for="Placas">Placas:</label>
                    <input type="text" id="Placas" name="Placas" maxlength="7" placeholder="583-ABC" required>
                </div>
                <div>
                    <label for="DNI">DNI camionero:</label>
                    <select id="DNI" name="DNI" required>
                        <?php
                        include "Conexion.php";
                        // Consulta para obtener los DNI de los camioneros
                        $query = "SELECT CA_DNI, Nombre FROM camioneros";
                        $res = mysqli_query($link, $query);

                        while ($fila = mysqli_fetch_array($res)) {
                            echo "<option value='" . $fila[0] . "'>" . $fila[0] . " - " . $fila['Nombre'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                
            <div class="form-buttons">
                <input type="submit" name="g" value="Guardar">
                <input type="reset" name="b" value="Limpiar">
            </div>
        </form>
    </section>
    <a href="camP.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90">
    </a>
</main>

</body>
</html>