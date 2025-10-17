<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Mermas de Polietileno</title>
    <!-- Se ajusta el CSS para reflejar el contexto de Mermas -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/formMermas.css">
    <script src="../js/cargas.js"></script>
    <!-- Incluimos limpiar.js por si tiene la función de limpiarCampos -->
    <script src="../js/limpiar.js"></script> 
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC"> 
</head>
<body>
<main class="container">
    
    <h1>Modificar Registro de Mermas de Polietileno</h1>
    
    <?php
    include "Conexion.php";
    
    // Se usa 'sc' para obtener el ID del registro a modificar
    $ID = $_GET["sc"] ?? die("<div class='alert alert-danger'>Error: ID de registro (sc) no proporcionado.</div>");
    
    // Consulta para obtener los datos existentes de la nueva tabla e_mermas
    $query = "SELECT * FROM e_mermas WHERE id='$ID'"; 
    $res = mysqli_query($link, $query);
    
    if (!$res || mysqli_num_rows($res) == 0) {
        die("<div class='alert alert-danger'>Error: Registro de Mermas con ID $ID no encontrado o error en la consulta.</div>");
    }
    
    $row = mysqli_fetch_array($res);
    ?>

    <section class="registro">
        <!-- El formulario envía los datos al nuevo script HacerMermas.php -->
        <form action="HacerMermas.php" method="POST" class="needs-validation" novalidate>
            <!-- Campo oculto para pasar el ID del registro a actualizar -->
            <input type="hidden" value="<?= $row['id'] ?? '' ?>" name="id"> 
        
            <div class="registro-container">
                <div class="registro-column">
                    
                    <div>
                        <label for="Mes">Mes:</label>
                        <!-- Carga el valor actual de la base de datos -->
                        <input type="date" id="Mes" name="Mes" value="<?= $row['Mes'] ?? '' ?>" required>
                    </div>
                    
                    <div>
                        <label>Productos</label><br><br>
                        
                        <div>
                            <label for="Leche_FrisiaK">Leche Frisia:</label>
                            <!-- Carga el valor actual de la base de datos -->
                            <input type="number" id="Leche_FrisiaK" name="Leche_FrisiaK" value="<?= $row['Leche_FrisiaK'] ?? '' ?>" placeholder="Kilos" required step="any">
                        </div>
                        
                        <div>
                            <label for="porcentajeTF">Total porcentaje (Frisia):</label>
                            <!-- Carga el valor actual de la base de datos -->
                            <input type="number" id="porcentajeTF" name="porcentajeTF" value="<?= $row['porcentajeTF'] ?? '' ?>" placeholder="%" required step="any">
                        </div>

                        <div>
                            <label for="Leche_Abasto">Leche de Abasto:</label>
                            <!-- Carga el valor actual de la base de datos -->
                            <input type="number" id="Leche_Abasto" name="Leche_Abasto" value="<?= $row['Leche_Abasto'] ?? '' ?>" placeholder="Kilos" required step="any">
                        </div>
                        
                        <div>
                            <label for="porcentajeTA">Total porcentaje (Abasto):</label>
                            <!-- Carga el valor actual de la base de datos -->
                            <input type="number" id="porcentajeTA" name="porcentajeTA" value="<?= $row['porcentajeTA'] ?? '' ?>" placeholder="%" required step="any">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="form-buttons mt-4">
                <input type="submit" name="g" value="Guardar Cambios" class="btn btn-primary me-2">
                <input type="button" value="Limpiar Campos" onclick="limpiarCampos()">
            </div>
        </form>
    </section>
    
    <?php include "Cerrar.php"; ?>
    
    <!-- Enlace de regreso según el formulario de Mermas de referencia -->
    <a href="MenuModifi.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90" alt="Home">
    </a>
</main>
</body>
</html>
