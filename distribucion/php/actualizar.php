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
        $query = "SELECT * FROM horario_lab WHERE ID_H='$ID'";
        $res = mysqli_query($link, $query);
        $row = mysqli_fetch_array($res);
        ?>

        <form action="Hacer.php?action=hacer" method="POST">
            <input type="hidden" value="<?= $row[0] ?>" name="ID">
            <div class="row">
                <div class="col-md-6">
                    <label for="ID">ID:</label>
                    <input type="number" id="ID" name="ID" value="<?= $row['ID_H'] ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="H_I">Hora inicio:</label>
                    <input type="time" id="H_I" name="H_I" value="<?= $row['H_In'] ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="H_F">Hora fin:</label>
                    <input type="time" id="H_F" name="H_F" value="<?= $row['H_Fin'] ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="D_L">Días Laborales:</label>
                    <input type="text" id="D_L" name="D_L" value="<?= $row['Dias_Lab'] ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <input type="submit" value="Guardar" class="btn btn-primary">
                    <input type="button" value="Limpiar" class="btn btn-secondary" onclick="limpiarCampos()">
                </div>
            </div>
        </form>
        <a href="Modificación.php" class="btn btn-warning mt-3">Regresar a Actualizar Otro Horario</a><br>
        <a href="horarioP.php" class="back-link"><img src="../Imagenes/home.png" height="100" width="90"></a>
    </div>
</body>
</html>