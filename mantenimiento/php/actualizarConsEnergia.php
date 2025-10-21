<!DOCTYPE html>
<html lang="es">
<head>
    <title>Modificar Consumo de Energía Térmica y Eléctrica</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Carga de scripts requeridos -->
    <script src="../js/cargas.js"></script>
    <script src="../js/SumaAprovechamieto.js"></script>
    <script src="../js/Multiplicaciondias.js"></script>
    <script src="../js/limpiar.js"></script> <!-- Nuevo script para validaciones específicas -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Se usa el CSS del formulario de Consumo de Energía para el estilo -->
    <link rel="stylesheet" href="../css/formConsEnergia.css"> 
    
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC"> 
</head>
<body>
<main class="container">

    <!-- Título actualizado al nuevo enfoque -->
    <h1>Modificar Registro de Consumo de Energía Térmica y Eléctrica</h1>

    <section class="registro">
    <?php
    // Incluye la conexión a la base de datos
    include "Conexion.php";
    
    // Asumimos que la clave (id) se pasa por la URL
    $ID = $_GET["sc"] ?? die("<div class='alert alert-danger'>Error: ID de registro no proporcionado.</div>");
    
    // Consulta para obtener los datos existentes
    // Se utiliza la tabla m_consumo_energia que coincide con los nuevos campos
    $query = "SELECT * FROM  m_consumo_energia_termica_electrica WHERE id='$ID'"; 
    $res = mysqli_query($link, $query);
    
    if (!$res || mysqli_num_rows($res) == 0) {
        die("<div class='alert alert-danger'>Error: Registro con ID $ID no encontrado o error en la consulta.</div>");
    }
    
    $row = mysqli_fetch_array($res);
    // Asegúrate de que $row contenga todos los campos de la BD proporcionados:
    // id, Mes, CantidadDieselCTC, ReduccionITD, PromedioRID, LitrosDLL, ReduccionILD, PromedioRILD, 
    // CantidadEnergiaCTC, ReduccionITR, PromedioRIT, CantidadLLT, ReduccionIKL, PromedioRIK
    ?>

    <!-- El formulario envía los datos a HacerConsEnergia.php (asumiendo que es el script de UPDATE) -->
    <form method="post" action="HacerConsEnergia.php" class="needs-validation">
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
                
                <!-- Consumo de Energía Térmica (Diesel) -->
                <th><h5>Consumo de Energía Termica(Diesel)</h5></th>
                <hr>
                <div>
                    <label for="CantidadDieselCTC">Cantidad de Litros de Diesel consumidos:</label>
                    <input type="number" id="CantidadDieselCTC" name="CantidadDieselCTC" 
                            value="<?= $row['CantidadDieselCTC'] ?? '' ?>" placeholder="Kw/hr" required step="any">
                </div>
                
                <div>
                    <label for="ReduccionITD">Reducción(-) o Incremento(+) en Comparacion al Mismo Mes del Año Anterior:</label>
                    <input type="number" id="ReduccionITD" name="ReduccionITD" 
                            value="<?= $row['ReduccionITD'] ?? '' ?>" placeholder="%" required step="any">
                </div>
                <div>
                    <label for="PromedioRID">Promedio de Reducción o Incremento:</label>
                    <input type="number" id="PromedioRID" name="PromedioRID" 
                            value="<?= $row['PromedioRID'] ?? '' ?>" placeholder="%" required step="any">
                </div>
                <div>
                    <label for="LitrosDLL">Litros de Diesel por litro de leche producida:</label>
                    <input type="number" id="LitrosDLL" name="LitrosDLL" 
                            value="<?= $row['LitrosDLL'] ?? '' ?>" placeholder="Kw/Litros" required step="any">
                </div>
                <div>
                    <label for="ReduccionILD">Reducción(-) o Incremento(+) de litros de diesel /Litros leche en Comparacion al Mismo Mes del Año Anterior:</label>
                    <input type="number" id="ReduccionILD" name="ReduccionILD" 
                            value="<?= $row['ReduccionILD'] ?? '' ?>" placeholder="%" required step="any">
                </div>
                <div>
                    <label for="PromedioRILD">Promedio de Reducción o Incremento de litros de diesel /Litros leche:</label>
                    <input type="number" id="PromedioRILD" name="PromedioRILD" 
                            value="<?= $row['PromedioRILD'] ?? '' ?>" placeholder="%" required step="any">
                </div>
                <hr>
                
                <!-- Consumo de Energía Eléctrica -->
                <th><h5>Consumo de Energía Electrica</h5></th>
                <hr>
                <div>
                    <label for="CantidadEnergiaCTC">Cantidad de Energía consumida:</label>
                    <input type="number" id="CantidadEnergiaCTC" name="CantidadEnergiaCTC" 
                            value="<?= $row['CantidadEnergiaCTC'] ?? '' ?>" placeholder="Kw/hr" required step="any">
                </div>
                
                <div>
                    <label for="ReduccionITR">Reducción(-) o Incremento(+) en Comparacion al Mismo Mes del Año Anterior:</label>
                    <input type="number" id="ReduccionITR" name="ReduccionITR" 
                            value="<?= $row['ReduccionITR'] ?? '' ?>" placeholder="%" required step="any">
                </div>
                <div>
                    <label for="PromedioRIT">Promedio de Reducción o Incremento:</label>
                    <input type="number" id="PromedioRIT" name="PromedioRIT" 
                            value="<?= $row['PromedioRIT'] ?? '' ?>" placeholder="%" required step="any">
                </div>
                <div>
                    <label for="CantidadLLT">Cantidad de Kw por litro de leche producida.:</label>
                    <input type="number" id="CantidadLLT" name="CantidadLLT" 
                            value="<?= $row['CantidadLLT'] ?? '' ?>" placeholder="Kw/Litros" required step="any">
                </div>
                <div>
                    <label for="ReduccionIKL">Reducción(-) o Incremento(+) de Kw/Litros en Comparacion al Mismo Mes del AñoAnterior:</label>
                    <input type="number" id="ReduccionIKL" name="ReduccionIKL" 
                            value="<?= $row['ReduccionIKL'] ?? '' ?>" placeholder="%" required step="any">
                </div>
                <div>
                    <label for="PromedioRIK">Promedio de Reducción o Incremento de Kw/Litros:</label>
                    <input type="number" id="PromedioRIK" name="PromedioRIK" 
                            value="<?= $row['PromedioRIK'] ?? '' ?>" placeholder="%" required step="any">
                </div>

            </div> 
        </div> <!-- Fin de registro-container -->
            
        <div class="form-buttons">
            <!-- Mantenemos "Guardar Cambios" para reflejar la acción de actualización -->
            <input type="submit" name="g" value="Guardar Cambios">
            <!-- Usamos type="reset" para la limpieza de campos, como en el formulario de destino -->
            <input type="button" name="b" value="Limpiar" onclick="limpiarCampos()">
        </div>
    </form>
    </section>
    
    <?php include "Cerrar.php"; // Cierra la conexión ?>
    
    <!-- Enlace de regreso adaptado al destino -->
    <a href="./MenuModifi.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90">
    </a>

</main>
</body>
</html>
