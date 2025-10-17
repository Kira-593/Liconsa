<?php
// Incluye la conexión a la base de datos
include "Conexion.php";

// 1. Verificar y obtener el ID del registro a modificar
// Se usa 'sc' para obtener el ID, como en el ejemplo proporcionado.
$ID = $_GET["sc"] ?? die("
    <!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><title>Error</title></head><body>
    <div class='container mt-5'><div class='alert alert-danger'>Error: ID de registro (sc) no proporcionado.</div></div>
    </body></html>");

// Asumimos que la tabla para las ventas de leche se llama 'a_ventaleche'
$query = "SELECT * FROM a_ventaleche WHERE id='$ID'"; 
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
    <meta charset="UTF-8">
    <title>Actualizar Venta de Leche</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Se usa un CSS de formulario para el estilo (asumimos el nombre actualizarVenta.css) -->
    <link rel="stylesheet" href="../css/actualizarVenta.css">
    <script src="../js/limpiar.js"></script>
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC"> 
</head>
<body>
<main class="container">
    
    <h1>Modificar Venta de Leche en Polvo y UHT</h1>
    
    <section class="registro">
        <!-- El formulario envía los datos al script HacerVenta.php -->
        <form action="HacerVenta.php" method="POST" class="needs-validation" novalidate>
            <!-- Campo oculto para pasar el ID del registro a actualizar -->
            <input type="hidden" value="<?= $row['id'] ?? '' ?>" name="id"> 
        
            <div class="registro-container">
                <div class="registro-column">
                    
                    <div>
                        <label for="Indicador">Tipo de Leche</label>
                        <select id="Indicador" name="Indicador" required>
                            <!-- Preselecciona la opción actual -->
                            <option value="Polvo" <?= ($row['Indicador'] == 'Polvo') ? 'selected' : '' ?>>Polvo</option>
                            <option value="UHT" <?= ($row['Indicador'] == 'UHT') ? 'selected' : '' ?>>UHT</option>
                        </select>
                    </div>

                    <div>
                        <label for="Mes">Mes:</label>
                        <!-- Usamos type="date" para el campo Mes -->
                        <input type="date" id="Mes" name="Mes" value="<?= $row['Mes'] ?? '' ?>" required>
                    </div>
                    
                    <h3 class="mt-4 mb-3">Detalles del Producto</h3>
                    
                    <div>
                        <label for="CodigoTC">Código:</label>
                        <input type="number" id="CodigoTC" name="CodigoTC" value="<?= $row['CodigoTC'] ?? '' ?>" placeholder="Ej. 576" required step="any">
                    </div>
                    <div>
                        <label for="DescripcionTD">Descripción:</label>
                        <input type="text" id="DescripcionTD" name="DescripcionTD" value="<?= $row['DescripcionTD'] ?? '' ?>" placeholder="Ej. Leche Descremada UHT" required>
                    </div>
                    
                    <h3 class="mt-4 mb-3">Cantidades (en Cajas)</h3>
                    
                    <div>
                        <label for="CantidadITC">Cantidad Inicial:</label>
                        <input type="number" id="CantidadITC" name="CantidadITC" value="<?= $row['CantidadITC'] ?? '' ?>" placeholder="Cajas" required step="any">
                    </div>
                    <div>
                        <label for="CantidadETC">Cantidad de Entradas:</label>
                        <input type="number" id="CantidadETC" name="CantidadETC" value="<?= $row['CantidadETC'] ?? '' ?>" placeholder="Cajas" required step="any">
                    </div>
                    <div>
                        <label for="CantidadCTC">Cantidad de Cajas vendidas:</label>
                        <input type="number" id="CantidadCTC" name="CantidadCTC" value="<?= $row['CantidadCTC'] ?? '' ?>" placeholder="Cajas" required step="any">
                    </div>
                    <div>
                        <label for="CantidadFTC">Cantidad Final:</label>
                        <input type="number" id="CantidadFTC" name="CantidadFTC" value="<?= $row['CantidadFTC'] ?? '' ?>" placeholder="Cajas" required step="any">
                    </div>
                </div>
            </div>
            
            <div class="form-buttons mt-4">
                <input type="submit" name="g" value="Guardar Cambios"   >
                <input type="button" name="b" value="Limpiar Campos" class="btn btn-secondary" onclick="limpiarCampos()">
            </div>
        </form>
    </section>
    
    <a href="MenuModifi.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90">
    </a>
</main>
</body>
</html>