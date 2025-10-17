<?php
// Incluye la conexión a la base de datos
include "Conexion.php";

// 1. Verificar y obtener el ID del registro a modificar
// Se usa 'sc' para obtener el ID.
$ID = $_GET["sc"] ?? die("
    <!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><title>Error</title></head><body>
    <div class='container mt-5'><div class='alert alert-danger'>Error: ID de registro (sc) no proporcionado.</div></div>
    </body></html>");

// NOTA: Se asume la tabla 'c_determinacion' basada en los nuevos campos.
// Seleccionamos TODOS los campos para prellenar el formulario
$query = "SELECT * FROM  c_formulariogps WHERE id='$ID'"; 
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
    <title>Modificar Determinación</title>
    <meta charset="UTF-8">
    <!-- Scripts JS originales -->
    <script src="../js/cargas.js"></script>
    <script src="../js/SumaT.js"></script>
    <!-- Se incluye el script de limpieza, si existe -->
    <script src="../js/limpiar.js"></script> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Se usa el CSS del formulario de Determinación (formGPS.css) -->
    <link rel="stylesheet" href="../css/formGPS.css">
    
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC"> 
    
</head>
<body>
<main class="container">
    
    <h1>Modificar Formulario de Determinación</h1>
    
    <section class="registro">
        <!-- La acción del formulario se dirige a HacerGPS.php para la actualización -->
        <form action="HacerGPS.php" method="POST" class="needs-validation" novalidate>
            <!-- Campo oculto para pasar el ID del registro a actualizar -->
            <input type="hidden" value="<?= $row['id'] ?? '' ?>" name="id"> 
        
            <div class="registro-container">
                <div class="registro-column">
                    
                    <!-- Indicador (Select) -->
                    <div>
                        <label for="Indicador">Tipo de Determinación</label>
                        <select id="Indicador" name="Indicador" required>
                            <?php 
                                $indicador_actual = $row['Indicador'] ?? '';
                                $opciones = [
                                    "Determinacion de Grasa" => "Determinación de Grasa",
                                    "Determinacion de Proteina" => "Determinación de Proteína",
                                    "Determinacion de Solidos No Grasos" => "Determinación de Sólidos No Grasos"
                                ];
                                foreach ($opciones as $valor => $texto) {
                                    $selected = ($indicador_actual == $valor) ? 'selected' : '';
                                    echo "<option value=\"$valor\" $selected>$texto</option>";
                                }
                            ?>
                        </select>
                    </div>

                    <!-- Mes (Fecha) -->
                    <div>
                        <label for="Mes">Mes:</label>
                        <input type="date" id="Mes" name="Mes" 
                               value="<?= $row['Mes'] ?? '' ?>" 
                               required>
                    </div>

                    <!-- Metodo -->
                    <div>
                        <label for="Metodo">Método:</label>
                        <input type="text" id="Metodo" name="Metodo" 
                               value="<?= $row['Metodo'] ?? '' ?>" 
                               placeholder="MILKO SCAN" required>
                    </div>

                    <!-- Muestra -->
                    <div>
                        <label for="Muestra">Muestra:</label>
                        <input type="text" id="Muestra" name="Muestra" 
                               value="<?= $row['Muestra'] ?? '' ?>" 
                               placeholder="Leche fortificada" required>
                    </div>

                    <!-- ValorR (Valor de Referencia) -->
                    <div>
                        <label for="ValorR">Valor de Referencia:</label>
                        <input type="number" step="any" id="ValorR" name="ValorR" 
                               value="<?= $row['ValorR'] ?? '' ?>" 
                               placeholder="30.52" required>
                    </div>

                    <!-- ValorMax (Valor Máximo) -->
                    <div>
                        <label for="ValorMax">Valor Máximo:</label>
                        <input type="number" step="any" id="ValorMax" name="ValorMax" 
                               value="<?= $row['ValorMax'] ?? '' ?>" 
                               placeholder="34.00" required>
                    </div>

                    <!-- ValorMin (Valor Mínimo) -->
                    <div>
                        <label for="ValorMin">Valor Mínimo:</label>
                        <input type="number" step="any" id="ValorMin" name="ValorMin" 
                               value="<?= $row['ValorMin'] ?? '' ?>" 
                               placeholder="13.3" required>
                    </div>

                    <!-- UnidadesKG (Promedio Mensual) -->
                    <div>
                        <label for="UnidadesKG">Promedio Mensual:</label>
                        <input type="number" step="any" id="UnidadesKG" name="UnidadesKG" 
                               value="<?= $row['UnidadesKG'] ?? '' ?>" 
                               placeholder="84.84" required>
                    </div>
                </div>
            </div>
            
            <div class="form-buttons mt-4">
                <input type="submit" name="g" value="Guardar Cambios">
                <!-- Se mantiene el uso de limpiarCampos() si el script JS existe -->
                <input type="button" name="b" value="Limpiar" onclick="limpiarCampos()">
            </div>
        </form>
    </section>
    
    <!-- Se mantiene el enlace de regreso -->
    <a href="MenuModifi.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90" alt="Volver a la página de inicio">
    </a>
</main>
</body>
</html>
