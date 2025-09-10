<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/actualizar.css">
    <script src="../js/cargas.js"></script>
    <script src="../js/limpiar.js"></script>
</head>
<body>
<img src="../Imagenes/logo.png" class="logo">
<div class="contenedor">
        <h2>Modificar la Información del Horario</h2>
        <?php
        include "Conexion.php";

        $ID = $_GET["sc"];
        $query = "SELECT * FROM mantenimiento WHERE ID_MAN='$ID'";
        $res = mysqli_query($link, $query);
        $row = mysqli_fetch_array($res);
        ?>

        <form action="Hacer.php?action=hacer" method="POST">
            <input type="hidden" value="<?= $row[0] ?>" name="ID">
            <div class="row">
                <div class="col-md-6">
                    <label for="ID">ID:</label>
                    <input type="number" id="ID" name="ID" value="<?= $row['ID_MAN'] ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="Descripcion">Descripción:</label>
                    <input type="text" id="Descripcion" name="Descripcion" value="<?= $row['Descripcion'] ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="Fecha_I">Fecha Ide Ingreso</label>
                    <input type="date" id="Fecha_I" name="Fecha_I" value="<?= $row['Fecha_I'] ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="Fecha_F">Fecha de Salida:</label>
                    <input type="date" id="Fecha_F" name="Fecha_F" value="<?= $row['Fecha_S'] ?>" required>
                </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="Camion">ID de Camión:</label>
                    <select id="Camion" name="Camion" required>
                    <?php
                        $query = "SELECT * FROM camiones";
                        $res = mysqli_query($link, $query);

                        while ($fila = mysqli_fetch_array($res)) {
                            $selected = ($fila[0] == $row[4]) ? "selected" : "";
                            echo "<option value='" . $fila[0] . "' $selected>" . $fila[0] . " - " . $fila[1] . "</option>";
                        }
                    ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <input type="submit" value="Guardar" class="btn btn-primary">
                    <input type="button" value="Limpiar" class="btn btn-secondary" onclick="limpiarCampos()">
                </div>
            </div>
        </form>
        <a href="Modificación.php" class="btn btn-warning mt-3">Regresar a Actualizar Otro Mantenimiento</a><br>
        <a href="mantenimientoP.php" class="back-link"><img src="../Imagenes/home.png" height="100" width="90"></a>
    </div>
</body>
</html>