<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Existencia de Materiales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Se usa el CSS de formulario de Materiales para el estilo -->
    <link rel="stylesheet" href="../css/actualizarMaterial.css">
    <script src="../js/limpiar.js"></script>
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC"> 
</head>
<body>
<main class="container">
    
    <h1>Modificar Existencia de Materia Prima y Material de Envase</h1>
    
    <?php
    include "Conexion.php";
    
    // Se usa 'sc' para obtener el ID
    $ID = $_GET["sc"] ?? die("<div class='alert alert-danger'>Error: ID de registro (sc) no proporcionado.</div>");
    // Consulta para obtener los datos existentes de la tabla a_existenciasmaterial
    $query = "SELECT * FROM  a_existenciasmaterial WHERE id='$ID'"; 
    $res = mysqli_query($link, $query);
    
    if (!$res || mysqli_num_rows($res) == 0) {
        die("<div class='alert alert-danger'>Error: Registro con ID $ID no encontrado o error en la consulta.</div>");
    }
    
    $row = mysqli_fetch_array($res);
    ?>

    <section class="registro">
        <!-- El formulario envía los datos al script HacerMaterial.php -->
        <form action="HacerMaterial.php" method="POST" class="needs-validation" novalidate>
            <!-- Campo oculto para pasar el ID del registro a actualizar -->
            <input type="hidden" value="<?= $row['id'] ?? '' ?>" name="id"> 
        
            <div class="registro-container">
                <div class="registro-column">
                    
                    <div>
                        <label for="Indicador">Material</label>
                        <select id="Indicador" name="Indicador" required>
                             <!-- Preselecciona la opción actual -->
                            <option value="Existencias de Materia Prima" <?= ($row['Indicador'] == 'Existencias de Materia Prima') ? 'selected' : '' ?>>Existencias de Materia Prima</option>
                            <option value="Existencias de Material de Envase" <?= ($row['Indicador'] == 'Existencias de Material de Envase') ? 'selected' : '' ?>>Existencias de Material de Envase</option>
                        </select>
                    </div>

                    <div>
                        <label for="Mes">Mes:</label>
                        <input type="date" id="Mes" name="Mes" value="<?= $row['Mes'] ?? '' ?>" required>
                    </div>
                    
                    <h3 class="mt-4 mb-3">Detalles del Material</h3>
                    
                    <div>
                        <label for="CodigoTC">Código:</label>
                        <input type="number" id="CodigoTC" name="CodigoTC" value="<?= $row['CodigoTC'] ?? '' ?>" placeholder="Ej. 576" required step="any">
                    </div>
                    <div>
                        <label for="DescripcionTD">Descripción:</label>
                        <input type="text" id="DescripcionTD" name="DescripcionTD" value="<?= $row['DescripcionTD'] ?? '' ?>" placeholder="Ej. Polietileno para Frisia de 1LT" required>
                    </div>
                    
                    <h3 class="mt-4 mb-3">Cantidades (en Kg o Unidad equivalente)</h3>
                    
                    <div>
                        <label for="CantidadITC">Cantidad Inicial:</label>
                        <input type="number" id="CantidadITC" name="CantidadITC" value="<?= $row['CantidadITC'] ?? '' ?>" placeholder="Kg" required step="any">
                    </div>
                    <div>
                        <label for="CantidadETC">Cantidad de Entradas:</label>
                        <input type="number" id="CantidadETC" name="CantidadETC" value="<?= $row['CantidadETC'] ?? '' ?>" placeholder="Kg" required step="any">
                    </div>
                    <div>
                        <label for="CantidadCTC">Cantidad de Consumo:</label>
                        <input type="number" id="CantidadCTC" name="CantidadCTC" value="<?= $row['CantidadCTC'] ?? '' ?>" placeholder="Kg" required step="any">
                    </div>
                    <div>
                        <label for="CantidadFTC">Cantidad Final:</label>
                        <input type="number" id="CantidadFTC" name="CantidadFTC" value="<?= $row['CantidadFTC'] ?? '' ?>" placeholder="Kg" required step="any">
                    </div>
                </div>
            </div>
            
            <div class="form-buttons mt-4">
                <input type="submit" name="g" value="Guardar Cambios" class="btn btn-primary me-2">
                <input type="button" name="b" value="Limpiar Campos" class="btn btn-secondary" onclick="limpiarCampos()">
            </div>
        </form>
    </section>
    
    <?php include "Cerrar.php"; ?>
    
    <a href="MenuModifi.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90">
    </a>
</main>
</body>
</html>