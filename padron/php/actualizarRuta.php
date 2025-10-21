<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Rutas de Distribución</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/formRutas.css">
    <script src="../js/cargas.js"></script>
    <script src="../js/SumaT.js"></script>
    <script src="../js/limpiar.js"></script>
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">
</head>
<body>
<?php
include "Conexion.php";

$ID = $_GET['sc'] ?? die('<div class="container mt-5"><div class="alert alert-danger">Error: ID no proporcionado.</div></div>');

$query = "SELECT * FROM p_rutasdistribucion WHERE id='$ID'";
$res = mysqli_query($link, $query);
if (!$res || mysqli_num_rows($res) == 0) {
    die('<div class="container mt-5"><div class="alert alert-danger">Registro no encontrado.</div></div>');
}
$row = mysqli_fetch_array($res);
include "Cerrar.php";
?>

<main class="container">

    <h1>Modificar Rutas de Distribución y Litros Desplazados</h1>
    
    <section class="registro">
        <form method="post" action="HacerRutas.php">
            <input type="hidden" name="id" value="<?= $row['id'] ?? '' ?>">
            <div class="registro-container">
                <div class="registro-column">

                    <div>
                        <label for="Mes">Mes:</label>
                        <input type="date" id="Mes" name="Mes" value="<?= $row['Mes'] ?? '' ?>" required>
                    </div>
                    <div>
                        <hr>
                        <label>Transporte Propio</label><br>
                        <hr>
                        <label for="LitrosTRuno">Litros Desplazados de R1:</label>
                        <input type="number" id="LitrosTRuno" name="LitrosTRuno" placeholder="Ej. 185,220" value="<?= $row['LitrosTRuno'] ?? '' ?>" required>
                    </div>
                    <div>
                        <label for="PorcentajeTRuno">Porcentaje que Representa R1:</label>
                        <input type="number" id="PorcentajeTRuno" name="PorcentajeTRuno" placeholder="Ej. 27%" value="<?= $row['PorcentajeTRuno'] ?? '' ?>" required>
                    </div>
                    <div>
                        <label for="LitrosTRdos">Litros Desplazados de R2:</label>
                        <input type="number" id="LitrosTRdos" name="LitrosTRdos" placeholder="Ej. 184,680" value="<?= $row['LitrosTRdos'] ?? '' ?>" required>
                    </div>
                    <div>
                        <label for="PorcentajeTRdos">Porcentaje que Representa R2:</label>
                        <input type="number" id="PorcentajeTRdos" name="PorcentajeTRdos" placeholder="Ej. 26%" value="<?= $row['PorcentajeTRdos'] ?? '' ?>" required>
                    </div>
                    <div>
                        <label for="LitrosTRtres">Litros Desplazados de R3:</label>
                        <input type="number" id="LitrosTRtres" name="LitrosTRtres" placeholder="Ej. 202,300" value="<?= $row['LitrosTRtres'] ?? '' ?>" required>
                    </div>
                    <div>
                        <label for="PorcentajeTRtres">Porcentaje que Representa R3:</label>
                        <input type="number" id="PorcentajeTRtres" name="PorcentajeTRtres" placeholder="Ej. 29%" value="<?= $row['PorcentajeTRtres'] ?? '' ?>" required>
                    </div>
                    <div>
                        <label for="LitrosTRcuatro">Litros Desplazados de R4:</label>
                        <input type="number" id="LitrosTRcuatro" name="LitrosTRcuatro" placeholder="Ej. 126,000" value="<?= $row['LitrosTRcuatro'] ?? '' ?>" required>
                    </div>
                    <div>
                        <label for="PorcentajeTRcuatro">Porcentaje que Representa R4:</label>
                        <input type="number" id="PorcentajeTRcuatro" name="PorcentajeTRcuatro" placeholder="Ej. 18%" value="<?= $row['PorcentajeTRcuatro'] ?? '' ?>" required>
                    </div>

                </div>
            </div>
            
            <div class="form-buttons">
                <input type="submit" name="g" value="Guardar Cambios">
                <input type="button" name="b" value="Limpiar" onclick="limpiarCampos()">
            </div>

        </form>
    </section>
    <a href="MenuModifi.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90" alt="Volver">
    </a>
</main>

</body>
</html>