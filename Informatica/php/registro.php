<!DOCTYPE html>
<html lang="es">
<head>
	<title>Registro</title>
	<meta charset="UTF-8">
    <script src="../js/mantenimiento.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/registro.css">
    
</head>
<body>
<img src="../Imagenes/logo.png" class="logo">
<main class="container">

    <h1>Registro de Mantenimientos</h1>
    <section class="registro">
        <form method="post" action="Guardar.php">
        <div class="registro-container">
            <div class="registro-column">
                <div>
                    <label for="ID">ID:</label>
                    <input type="number" id="ID" name="ID" placeholder="1234..." required>
                </div>
                <div>
                    <label for="Descripcion">Descripción:</label>
                    <input type="text" id="Descripcion" name="Descripcion" placeholder="Cambio de llantas" required>
                </div>
                <div>
                    <label for="Fecha_I">Fecha de Ingreso:</label>
                    <input type="date" id="Fecha_I" name="Fecha_I" required>
                <div>
                <div>
                    <label for="Fecha_S">Fecha de Salida:</label>
                    <input type="date" id="Fecha_S" name="Fecha_S" required>
                <div>
                    <label for="CA_DNI">ID Camion:</label>
                    <select id="CA_DNI" name="CA_DNI" required>
                    <?php
                        include "Conexion.php";
                        $query = "SELECT ID_CA, Marca FROM camiones";
                        $res = mysqli_query($link, $query);

                        while ($fila = mysqli_fetch_array($res)) {
                            echo "<option value='" . $fila[0] . "'>" . $fila[0] . " - " . $fila['Marca'] . "</option>";
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
    <a href="mantenimientoP.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90">
    </a>
</main>

</body>
</html>