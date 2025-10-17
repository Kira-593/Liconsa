<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Distribución de Leche</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Se usa el CSS de formulario de distribución para el estilo -->
    <script src="../js/limpiar.js"></script>
    <link rel="stylesheet" href="../css/actualizarDistribucion.css"> 
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC"> 
</head>
<body>
<div class="container">
    
    <h2>Modificar Registro de Distribución de Leche</h2>
    
    <?php
    include "Conexion.php";
    
    // Asumimos que la clave (id) se pasa por la URL
    // Usamos 'id' ya que el esquema de la base de datos lo indica.
    $ID = $_GET["sc"] ?? die("Error: ID de registro no proporcionado.");
    
    // Consulta para obtener los datos existentes
    $query = "SELECT * FROM p_distribucionleche WHERE id='$ID'"; 
    $res = mysqli_query($link, $query);
    
    if (!$res || mysqli_num_rows($res) == 0) {
        die("<div class='alert alert-danger'>Error: Registro con ID $ID no encontrado o error en la consulta.</div>");
    }
    
    $row = mysqli_fetch_array($res);
    ?>

    <!-- El formulario envía los datos al nuevo script HacerDistribucion.php -->
    <form action="HacerDistribucion.php" method="POST" class="needs-validation" novalidate>
        <!-- Campo oculto para pasar el ID del registro a actualizar -->
        <input type="hidden" value="<?= $row['id'] ?? '' ?>" name="id"> 
    
        <div class="registro-container">
            <div class="registro-column">
                
                <div class="mb-3">
                    <label for="Indicador">Tipo de Leche</label>
                    <select id="Indicador" name="Indicador" class="Indicardor" required>
                        <option value="Liquida de Abasto" <?= ($row['Indicador'] == 'Liquida de Abasto') ? 'selected' : '' ?>>Liquida de Abasto</option>
                        <option value="Polvo de Abasto" <?= ($row['Indicador'] == 'Polvo de Abasto') ? 'selected' : '' ?>>Polvo de Abasto</option>
                        <option value="Frisia" <?= ($row['Indicador'] == 'Frisia') ? 'selected' : '' ?>>Frisia</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="Mes">Mes:</label>
                    <!-- Asegúrate de que el tipo de input sea 'date' si el campo 'Mes' lo requiere -->
                    <input type="date" id="Mes" name="Mes" class="form-control" value="<?= $row['Mes'] ?? '' ?>" required>
                </div>
                
                <h3 class="mt-4 mb-3">Meta Vs Alcance</h3>
                
                <div class="mb-3">
                    <label for="MetaTM">Meta de Distribución del Mes (TM):</label>
                    <input type="number" id="MetaTM" name="MetaTM"  value="<?= $row['MetaTM'] ?? '' ?>" placeholder="Cantidad" required>
                </div>
                
                <div class="mb-3">
                    <label for="AlcanceTA">Alcance de la Distribución del Mes (TA):</label>
                    <input type="number" id="AlcanceTA" name="AlcanceTA"  value="<?= $row['AlcanceTA'] ?? '' ?>" placeholder="Cantidad" required>
                </div>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-12 text-center">
                <input type="submit" value="Guardar Cambios" class="btn btn-primary me-2">
                <!-- Se asume que el script ../js/limpiar.js existe y funciona con este formulario -->
                <input type="button" value="Limpiar Campos" class="btn btn-secondary" onclick="limpiarCampos()"><br><br>
            </div>
        </div>
    </form>
    
    <?php include "Cerrar.php"; // Cierra la conexión si no se hace en Modificación.php ?>
    
    <!-- Se asume Modificación.php es el listado de registros -->
    <a href="MenuModifi.php" class="back-link"><img src="../imagenes/home.png" height="100" width="90"></a>
</div>
</body>
</html>