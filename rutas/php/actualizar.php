<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/actualizar.css">
    <script src="../js/rutas.js"></script>
    <script src="../js/limpiar.js"></script>
</head>
<body>
<img src="../Imagenes/logo.png" class="logo">
<div class="contenedor">
        <h2>Modificar la Información de la ruta</h2>
        <?php
        include "Conexion.php";

        $ID = $_GET["sc"];
        $query = "SELECT * FROM ruta WHERE ID_RU='$ID'";
        $res = mysqli_query($link, $query);
        $row = mysqli_fetch_array($res);
        ?>

        <form action="Hacer.php?action=hacer" method="POST">
            <input type="hidden" value="<?= $row[0] ?>" name="ID">
            <div class="row">
                <div class="col-md-6">
                    <label for="ID">ID de la Ruta:</label>
                    <p><?= $row[0] ?></p>
                </div>
                <div class="col-md-6">
                    <label for="Origen">Origen:</label>
                    <input type="text" value="<?= $row[1] ?>" name="Origen" required />
                </div>
            </div>
            <div class="row">
                
                <div class="col-md-6">
                    <label for="Destino">Destino:</label>
                    <input type="text" value="<?= $row[2] ?>" name="Destino" required />
                </div>
                <div class="col-md-6">
                    <label for="DNI">DNI del Camionero:</label>
                    <select name="DNI" required>
                    <?php
                        $query = "SELECT * FROM camioneros";
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
        <a href="Modificación.php" class="btn btn-warning mt-3">Regresar a Actualizar Otra Ruta</a><br>
        <a href="rutasP.php" class="back-link"><img src="../Imagenes/home.png" height="100" width="90"></a>
    </div>
</body>
</html>