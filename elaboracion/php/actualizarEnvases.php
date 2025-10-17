<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Envases Rotos</title>
    <!-- Se ajusta el CSS y los scripts para reflejar el contexto de Envases -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/formEn.css">
    <script src="../js/cargas.js"></script>
    <script src="../js/SumaT.js"></script> 
    <script src="../js/limpiar.js"></script> 
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC"> 
</head>
<body>
<main class="container">
    
    <h1>Modificar Registro de Envases Rotos</h1>
    
    <?php
    include "Conexion.php";
    
    // Se usa 'sc' para obtener el ID del registro a modificar
    $ID = $_GET["sc"] ?? die("<div class='alert alert-danger'>Error: ID de registro (sc) no proporcionado.</div>");
    
    // Consulta para obtener los datos existentes de la nueva tabla e_envases
    $query = "SELECT * FROM e_envases_rotos WHERE id='$ID'"; 
    $res = mysqli_query($link, $query);
    
    if (!$res || mysqli_num_rows($res) == 0) {
        die("<div class='alert alert-danger'>Error: Registro de Envases Rotos con ID $ID no encontrado o error en la consulta.</div>");
    }
    
    $row = mysqli_fetch_array($res);
    ?>

    <section class="registro">
        <!-- El formulario envía los datos al nuevo script HacerEnvases.php -->
        <form action="HacerEnvases.php" method="POST" class="needs-validation" novalidate>
            <!-- Campo oculto para pasar el ID del registro a actualizar -->
            <input type="hidden" value="<?= $row['id'] ?? '' ?>" name="id"> 
        
            <div class="registro-container">
                <div class="registro-column">
                    
                    <div>
                        <label for="Indicador">Indicador</label>
                        <select id="Indicador" name="Indicador" required>
                             <!-- Preselecciona la opción actual -->
                            <option value="Leche Frisia" <?= ($row['Indicador'] == 'Leche Frisia') ? 'selected' : '' ?>>Leche Frisia</option>
                            <option value="Leche de Abasto Social" <?= ($row['Indicador'] == 'Leche de Abasto Social') ? 'selected' : '' ?>>Leche de Abasto Social</option>
                        </select>
                    </div>

                    <div>
                        <label for="Mes">Mes:</label>
                        <!-- Carga el valor actual de la base de datos -->
                        <input type="date" id="Mes" name="Mes" value="<?= $row['Mes'] ?? '' ?>" required>
                    </div>
                    
                    <div>
                        <label>Motivo</label><br><br>
                        
                        <div>
                            <label for="DF">Defecto de fabricación:</label>
                            <!-- Carga el valor actual de la base de datos -->
                            <input type="number" id="DF" name="DF" value="<?= $row['DF'] ?? '' ?>" placeholder="Litros" required step="any">
                        </div>
                        
                        <div>
                            <label for="MC">Manejo de canastilla:</label>
                            <!-- Carga el valor actual de la base de datos -->
                            <input type="number" id="MC" name="MC" value="<?= $row['MC'] ?? '' ?>" placeholder="Litros" required step="any">
                        </div>

                        <div>
                            <label for="MI">De manera intencional:</label>
                            <!-- Carga el valor actual de la base de datos -->
                            <input type="number" id="MI" name="MI" value="<?= $row['MI'] ?? '' ?>" placeholder="Litros" required step="any">
                        </div>
                        
                        <div>
                            <label for="Total">Total:</label>
                            <!-- Carga el valor actual de la base de datos -->
                            <input type="number" id="Total" name="Total" value="<?= $row['Total'] ?? '' ?>" placeholder="Litros" required step="any">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="form-buttons mt-4">
                <input type="submit" name="g" value="Guardar Cambios">
                <input type="button" name="b" value="Limpiar Campos"onclick="limpiarCampos()">
            </div>
        </form>
    </section>
    
    <?php include "Cerrar.php"; ?>
    
    <!-- Enlace de regreso al menú de modificación general -->
    <a href="MenuModifi.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90" alt="Home">
    </a>
</main>
</body>
</html>
