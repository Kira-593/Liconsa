<!DOCTYPE html>
<html lang="es">
<head>
	<title>Registro</title>
	<meta charset="UTF-8">
    <script src="../js/cargas.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/registro.css">
    
</head>
<body>
<img src="../Imagenes/logo.png" class="logo">
<main class="container">

    <h1>Registro de Cargas</h1>
    <section class="registro">
        <form method="post" action="Guardar.php">
        <div class="registro-container">
            <div class="registro-column">
                <div>
                    <label for="ID">ID:</label>
                    <input type="number" id="ID" name="ID" placeholder="1234..." required>
                </div>
                <div>
                    <label for="Fecha">Nombre de la Carga:</label>
                    <input type="text" id="Nombre_C" name="Nombre_C" placeholder="Arena" maxlength="20" required>
                <div>
                    <label for="Descripcion">Descripción:</label>
                    <input type="text" id="Descripcion" name="Descripcion" maxlength="100" placeholder="Arena fina..." required>
                </div>
                <div>
                    <label for="Peso">Peso:</label>
                    <input type="number" id="Peso" name="Peso" placeholder="200.5" required>
                </div>
                <div>
                    <label for="ID_CA">ID camion:</label>
                    <select id="ID_CA" name="ID_CA" required>
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
            <div class="form-buttons">
                <input type="submit" name="g" value="Guardar">
                <input type="reset" name="b" value="Limpiar">
            </div>
        </form>
    </section>
    <a href="cargasP.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90">
    </a>
</main>

</body>
</html>