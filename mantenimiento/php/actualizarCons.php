<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Registro de Consumo y Producción</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Carga de scripts requeridos por el formulario de Consumo -->
    <script src="../js/cargas.js"></script>
    <script src="../js/SumaAprovechamieto.js"></script>
    <script src="../js/Multiplicaciondias.js"></script>
    <script src="../js/limpiar.js"></script>
    <!-- Se mantiene el script limpiar.js por si es necesario para el botón de limpiar -->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Se usa el CSS de formulario de Consumo para el estilo -->
    <link rel="stylesheet" href="../css/formCons.css"> 
    
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC"> 
</head>
<body>
<main class="container">

    <!-- Título adaptado al nuevo formulario -->
    <h1>Modificar Registro de Consumo de Energía y Producción</h1>

    <section class="registro">
    <?php
    // Incluye la conexión a la base de datos
    include "Conexion.php";
    
    // Asumimos que la clave (id) se pasa por la URL
    $ID = $_GET["sc"] ?? die("<div class='alert alert-danger'>Error: ID de registro no proporcionado.</div>");
    
    // Consulta para obtener los datos existentes
    // Se asume que la tabla 'p_distribucionleche' ha sido reemplazada o renombrada
    // o que contiene los campos nuevos, mantendré el nombre de la tabla original
    // ya que no puedo inferir el nuevo.
    $query = "SELECT * FROM m_consumo_energia_produccion WHERE id='$ID'"; 
    $res = mysqli_query($link, $query);
    
    if (!$res || mysqli_num_rows($res) == 0) {
        die("<div class='alert alert-danger'>Error: Registro con ID $ID no encontrado o error en la consulta.</div>");
    }
    
    $row = mysqli_fetch_array($res);
    ?>

    <!-- El formulario ahora envía los datos a GuardarCons.php -->
    <form method="post" action="HacerCons.php">
        <!-- Campo oculto para pasar el ID del registro a actualizar -->
        <input type="hidden" value="<?= $row['id'] ?? '' ?>" name="id"> 

        <div class="registro-container">
            <div class="registro-column">
                
                <!-- Mes (Fecha) -->
                <div>
                    <label for="Mes">Mes</label>
                    <!-- Asegúrate de que el campo 'Mes' sea de tipo date en la BD si es necesario -->
                    <input type="date" id="Mes" name="Mes" value="<?= $row['Mes'] ?? '' ?>" required>
                </div>
                
                <!-- Producción de Leche -->
                <div>
                    <label for="ProduccionLecheTP">Producción de Leche Total Mensual:</label>
                    <input type="number" id="ProduccionLecheTP" name="ProduccionLecheTP" 
                           value="<?= $row['ProduccionLecheTP'] ?? '' ?>" placeholder="Litros" required>
                </div>
                <div>
                    <label for="ReduccionITR_Leche">Reducción(-) e Incremento(+):</label>
                    <input type="number" id="ReduccionITR_Leche" name="ReduccionITR_Leche" 
                           value="<?= $row['ReduccionITR_Leche'] ?? '' ?>" placeholder="%" required>
                </div>
                <hr>
    
                <!-- Energía Eléctrica (kWh y GJ) -->
                <div>
                    <label for="EnergiaElectricaTE">Energía Eléctrica Total Mensual:</label>
                    <input type="number" id="EnergiaElectricaTE" name="EnergiaElectricaTE" 
                           value="<?= $row['EnergiaElectricaTE'] ?? '' ?>" placeholder="kW/hr" required>
                </div>
                <div>
                    <label for="EnergiaElectricaTEG">Energía Eléctrica Total Mensual en GJ:</label>
                    <input type="number" id="EnergiaElectricaTEG" name="EnergiaElectricaTEG" 
                           value="<?= $row['EnergiaElectricaTEG'] ?? '' ?>" placeholder="GJ" required>
                </div>
                <div>
                    <label for="ReduccionITR_Energia">Reducción(-) e Incremento(+):</label>
                    <input type="number" id="ReduccionITR_Energia" name="ReduccionITR_Energia" 
                           value="<?= $row['ReduccionITR_Energia'] ?? '' ?>" placeholder="%" required>
                </div>
                <hr>
                
                <!-- Consumo de Diesel (Litros y GJ) -->
                <div>
                    <label for="ConsumoDieselTP">Consumo de Diesel Total Mensual:</label>
                    <input type="number" id="ConsumoDieselTP" name="ConsumoDieselTP" 
                           value="<?= $row['ConsumoDieselTP'] ?? '' ?>" placeholder="Litros" required>
                </div>
                <div>
                    <label for="ConsumoDieselTPG">Consumo de Diesel Total Mensual EN GJ:</label>
                    <input type="number" id="ConsumoDieselTPG" name="ConsumoDieselTPG" 
                           value="<?= $row['ConsumoDieselTPG'] ?? '' ?>" placeholder="GJ" required>
                </div>
                <div>
                    <label for="ReduccionITR_Diesel">Reducción(-) e Incremento(+):</label>
                    <input type="number" id="ReduccionITR_Diesel" name="ReduccionITR_Diesel" 
                           value="<?= $row['ReduccionITR_Diesel'] ?? '' ?>" placeholder="%" required>
                </div>
                <hr>
            </div> 
        </div> <!-- Fin de registro-container -->
            
        <div">
            <input type="submit" name="g" value="Guardar Cambios">
            <input type="button" name="b" value="Limpiar Campos" onclick="limpiarCampos();">
        </div>
    </form>
    </section>
    
    <?php include "Cerrar.php"; // Cierra la conexión ?>
    
    <!-- Enlace de regreso adaptado al destino del segundo archivo -->
    <a href="./MenuModifi.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90">
    </a>

</main>
</body>
</html>
