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
    <h2>Modificar la Información de la Empresa</h2>
    <?php
    include "Conexion.php";

    // Obtener el ID de la empresa desde la URL
    $ID = $_GET["sc"];
    $query = "SELECT * FROM empresa WHERE ID_EM='$ID'";
    $res = mysqli_query($link, $query);
    $row = mysqli_fetch_array($res);
    ?>

    <form action="Hacer.php?action=hacer" method="POST">
        <input type="hidden" value="<?= $row['ID_EM'] ?>" name="ID">
        <div class="mb-3">
            <label for="ID">ID:</label>
            <p><?= $row['ID_EM'] ?></p>
        </div>
        <div class="mb-3">
            <label for="Nombre">Nombre:</label>
            <input type="text" value="<?= $row['Nombre'] ?>" name="Nombre" maxlength="35" class="form-control" required />
        </div>
        <div class="mb-3">
            <label for="RFC">RFC:</label>
            <input type="text" value="<?= $row['RFC'] ?>" name="RFC" class="form-control" required />
        </div>
        <div class="mb-3">
            <label for="Ubi">Ubicación:</label>
            <input type="text" value="<?= $row['Ubicacion'] ?>" name="Ubi" class="form-control" required />
        </div>
        <div class="text-center">
            <input type="submit" value="Guardar" class="btn btn-primary">
            <input type="button" value="Limpiar" class="btn btn-secondary" onclick="limpiarCampos()">
        </div>
        </form>
    <a href="Modificación.php" class="btn btn-warning mt-3">Regresar a Actualizar Otra Empresa</a><br>
    <a href="empresaP.php" class="back-link"><img src="../Imagenes/home.png" height="100" width="90"></a>
</div>
</body>
</html>