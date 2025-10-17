<?php
// Incluye la conexión a la base de datos
include "Conexion.php";
 
// Asumimos que la clave (id) se pasa por la URL con el parámetro 'sc'
$ID = $_GET["sc"] ?? die("<div class='alert alert-danger'>Error: ID de registro no proporcionado.</div>");
 
// Consulta para obtener los datos existentes
// Se utiliza la tabla 'm_consumo_agua_proceso' con los nuevos campos
$query = "SELECT * FROM m_consumoaguaproceso WHERE id='$ID'"; 
$res = mysqli_query($link, $query);
 
if (!$res || mysqli_num_rows($res) == 0) {
    die("<div class='alert alert-danger'>Error: Registro con ID $ID no encontrado o error en la consulta (Tabla m_consumo_agua_proceso).</div>");
}
 
$row = mysqli_fetch_array($res);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Consumo de Agua Para Proceso</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Carga de scripts requeridos -->
    <script src="../js/cargas.js"></script>
    <script src="../js/SumaAprovechamieto.js"></script>
    <script src="../js/Multiplicaciondias.js"></script>
    <script src="../js/limpiar.js"></script> 
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Se usa el CSS de formulario de Consumo de Agua (formAguaP.css) -->
    <link rel="stylesheet" href="../css/formAguaP.css"> 
    
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC"> 
</head>
<body>
<main class="container">

    <!-- Título actualizado -->
    <h1>Modificar Registro de Consumo de Agua Para Proceso</h1>

    <section class="registro">
    
    <!-- El formulario envía los datos a HacerAguaP.php para la actualización -->
    <form method="post" action="HacerAguaP.php">
        <!-- Campo oculto para pasar el ID del registro a actualizar -->
        <input type="hidden" value="<?= $row['id'] ?? '' ?>" name="id"> 

        <div class="registro-container">
            <div class="registro-column">
                
                <!-- Mes (Fecha) -->
                <div>
                    <label for="Mes">Mes:</label>
                    <input type="date" id="Mes" name="Mes" value="<?= $row['Mes'] ?? '' ?>" required>
                </div>
                <hr>

                <!-- Consumo de Agua de pozo Profundo por Mes -->
                <div>
                    <label for="AguaPM">Consumo de Agua de pozo Profundo por Mes:</label>
                    <input type="number" id="AguaPM" name="AguaPM" 
                            value="<?= $row['AguaPM'] ?? '' ?>" placeholder="M³/Mes" required step="any">
                </div>
                
                <!-- Consumo de Agua de pozo Profundo Total Acumulado -->
                <div>
                    <label for="AguaPTA">Consumo de Agua de pozo Profundo Total Acumulado:</label>
                    <input type="number" id="AguaPTA" name="AguaPTA" 
                            value="<?= $row['AguaPTA'] ?? '' ?>" placeholder="M³/Mes" required step="any">
                </div>
                
            </div> 
        </div> <!-- Fin de registro-container -->
            
        <div class="form-buttons">
            <input type="submit" name="g" value="Guardar Cambios">
            <input type="button" name="b" value="Limpiar Campos" onclick="limpiarCampos();">
        </div>
    </form>
    </section>
    
    <?php include "Cerrar.php"; // Cierra la conexión ?>
    
    <!-- Enlace de regreso al menú principal o de formularios -->
    <a href="TipoFormulario.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90" alt="Regresar a Inicio">
    </a>

</main>
</body>
</html>
