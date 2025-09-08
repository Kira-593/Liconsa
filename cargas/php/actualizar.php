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
        <h2>Modificar la Información de la Carga</h2>
        <?php
        include "Conexion.php";

        $ID = $_GET["sc"];
        $query = "SELECT * FROM carga WHERE ID_C='$ID'";
        $res = mysqli_query($link, $query);
        $row = mysqli_fetch_array($res);
        ?>

        <form action="Hacer.php?action=hacer" method="POST">
            <input type="hidden" value="<?= $row[0] ?>" name="ID">
            <div class="row">
                <div class="col-md-6">
                    <label for="ID">ID de la Carga:</label>
                    <p><?= $row[0] ?></p>
                </div>
                <div class="col-md-6">
                    <label for="Nombre_C">Nombre de la Carga:</label>
                    <input type="text" value="<?= $row['Nombre_C'] ?>" name="Nombre_C" maxlength="50" required />
                </div>
                <div class="col-md-6">
                    <label for="Descripcion">Descripción:</label>
                    <input type="text" value="<?= $row['Descripcion'] ?>" name="Descripcion" maxlength="100" required />
                </div>
                <div class="col-md-6">
                    <label for="ID_CA">ID Camion:</label>
                    <select name="ID_CA" required>
                        <?php
                        $camionQuery = "SELECT ID_CA, Marca FROM camiones";
                        $camionRes = mysqli_query($link, $camionQuery);
                        while ($camionRow = mysqli_fetch_array($camionRes)) {
                            $selected = ($camionRow['ID_CA'] == $row['ID_CA']) ? 'selected' : '';
                            echo "<option value='{$camionRow['ID_CA']}' $selected>{$camionRow['ID_CA']} - {$camionRow['Marca']}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="Peso">Peso:</label>
                    <input type="number" value="<?= $row['Peso'] ?>" name="Peso" required />
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <input type="submit" value="Guardar" class="btn btn-primary">
                    <input type="button" value="Limpiar" class="btn btn-secondary" onclick="limpiarCampos()">
                </div>
            </div>
        </form>
        <a href="Modificación.php" class="btn btn-warning mt-3">Regresar a Actualizar Otra carga</a><br>
        <a href="cargasP.php" class="back-link"><img src="../Imagenes/home.png" height="100" width="90"></a>
    </div>
</body>
</html>