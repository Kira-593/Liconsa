<?php
// Incluye la conexión a la base de datos
include "Conexion.php";

// 1. Verificar y obtener el ID del registro a modificar
// Se usa 'sc' para obtener el ID, como en el ejemplo proporcionado.
// NOTA: Para seguridad, siempre se recomienda sanitizar o usar prepared statements
$ID = $_GET["sc"] ?? die("
    <!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><title>Error</title></head><body>
    <div class='container mt-5'><div class='alert alert-danger'>Error: ID de registro (sc) no proporcionado.</div></div>
    </body></html>");

// Asumimos que la tabla para el Formulario FM se llama 'a_fm'
// Seleccionamos los campos necesarios para prellenar el formulario
$query = "SELECT *  FROM c_formulariofm WHERE id='$ID'"; 
$res = mysqli_query($link, $query);

if (!$res || mysqli_num_rows($res) == 0) {
    die("
    <!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><title>Error</title></head><body>
    <div class='container mt-5'><div class='alert alert-danger'>Error: Registro con ID $ID no encontrado o error en la consulta.</div></div>
    </body></html>");
}

$row = mysqli_fetch_array($res);

// Cierra la conexión después de obtener los datos
include "Cerrar.php"; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Modificar Formulario FM</title>
    <meta charset="UTF-8">
    <!-- Nuevos scripts JS -->
    <script src="../js/cargas.js"></script>
    <script src="../js/SumaT.js"></script>
    <script src="../js/limpiar.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Nuevo CSS para el formulario FM -->
    <link rel="stylesheet" href="../css/actualizarFM.css">
    
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC"> 
    
</head>
<body>
<main class="container">
    
    <h1>Modificar Formulario FM</h1>
    
    <section class="Registro">
        <!-- El formulario envía los datos al script que procesa la actualización -->
        <!-- Usamos 'ActualizarFM.php' como acción del script de actualización -->
        <form action="HacerFM.php" method="POST" class="needs-validation">
            <!-- Campo oculto para pasar el ID del registro a actualizar -->
            <input type="hidden" value="<?= $row['id'] ?? '' ?>" name="id"> 
        
            <div class="registro-container">
                <div class="registro-column">
                    
                    <div>
                        <label for="Indicador">Indicador</label>
                        <select id="Indicador" name="Indicador" required>
                            <!-- Preselecciona la opción actual de Análisis -->
                            <option value="Analisis Fisicoquimico" <?= ($row['Indicador'] == 'Analisis Fisicoquimico') ? 'selected' : '' ?>>Análisis Físicoquímico</option>
                            <option value="Analisis Microbiologico" <?= ($row['Indicador'] == 'Analisis Microbiologico') ? 'selected' : '' ?>>Análisis Microbiológico</option>
                        </select>
                    </div>

                    <div>
                        <label for="Mes">Mes:</label>
                        <!-- type="date" para el campo Mes -->
                        <input type="date" id="Mes" name="Mes" value="<?= $row['Mes'] ?? '' ?>" required>
                    </div>
                    
                    <h3 class="mt-4 mb-3">Cantidades de Análisis</h3>
                    
                    <div>
                        <label for="Cantidad_insumos">Cantidad de Insumos:</label>
                        <!-- Nuevo campo: Cantidad_insumos -->
                        <input type="number" id="Cantidad_insumos" name="Cantidad_insumos" value="<?= $row['Cantidad_insumos'] ?? '' ?>" placeholder="Cantidad" required step="any">
                    </div>
                    <div>
                        <label for="ProductosT">Productos Terminados:</label>
                        <!-- Nuevo campo: ProductosT -->
                        <input type="number" id="ProductosT" name="ProductosT" value="<?= $row['ProductosT'] ?? '' ?>" placeholder="Cantidad" required step="any">
                    </div>
                    <div>
                        <label for="ControlesD">Controles Diversos:</label>
                        <!-- Nuevo campo: ControlesD -->
                        <input type="number" id="ControlesD" name="ControlesD" value="<?= $row['ControlesD'] ?? '' ?>" placeholder="Cantidad" required step="any">
                    </div>
                    <div>
                        <label for="MaterialesA">Materiales auxiliares:</label>
                        <!-- Nuevo campo: MaterialesA -->
                        <input type="number" id="MaterialesA" name="MaterialesA" value="<?= $row['MaterialesA'] ?? '' ?>" placeholder="Cantidad" required step="any">
                    </div>
                    <div>
                        <label for="Total">Total:</label>
                        <!-- Nuevo campo: Total -->
                        <input type="number" id="Total" name="Total" value="<?= $row['Total'] ?? '' ?>" placeholder="Cantidad" required step="any">
                    </div>
                </div>
            </div>
            
            <div class="form-buttons mt-4">
                <input type="submit" name="g" value="Guardar Cambios">
                <!-- Se cambia a type="reset" y valor "Limpiar" para coincidir con el formulario de destino -->
                <input type="button" name="b" value="Limpiar" onclick="limpiarCampos()">
            </div>
        </form>
    </section>
    
    <!-- Se actualiza el enlace de regreso a TipoFormulario.php -->
    <a href="./MenuModifi.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90" alt="Volver a la página de inicio">
    </a>
</main>
</body>
</html>
