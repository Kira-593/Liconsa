<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Registro de Subgerencia de Operaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Se actualizan los scripts y CSS al contexto de Subgerencia -->
    <link rel="stylesheet" href="../css/actualizarSubG.css">
    <script src="../js/cargas.js"></script>
    <script src="../js/limpiar.js"></script>
    <script src="../js/SumaAprovechamieto.js"></script>
    <script src="../js/Multiplicaciondias.js"></script>
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">
</head>
<body>
<main class="container">
    
    <h1>Modificar Registro de Subgerencia de Operaciones</h1>
    
    <?php
    // Asegúrate de que este archivo exista y contenga la lógica de conexión a la base de datos
    include "Conexion.php";
    
    // Se usa 'sc' para obtener el ID del registro a modificar
    $ID = $_GET["sc"] ?? die("<div class='alert alert-danger'>Error: ID de registro (sc) no proporcionado.</div>");
    
    // Consulta para obtener los datos existentes de la nueva tabla
    // Se asume el nombre de tabla 'e_subgerencia_operaciones'
    $query = "SELECT * FROM e_subgerencia_operaciones WHERE id='$ID'"; 
    $res = mysqli_query($link, $query);
    
    if (!$res || mysqli_num_rows($res) == 0) {
        // En caso de error, puedes imprimir el error de MySQL para depuración
        $error_msg = mysqli_error($link) ? ": " . mysqli_error($link) : "";
        die("<div class='alert alert-danger'>Error: Registro de Subgerencia con ID $ID no encontrado o error en la consulta" . $error_msg . "</div>");
    }
    
    $row = mysqli_fetch_array($res);
    // Función auxiliar para obtener el valor de la columna de forma segura
    function get_value($row, $key) {
        return htmlspecialchars($row[$key] ?? '');
    }
    ?>

    <section class="registro">
        <!-- El formulario envía los datos al script de actualización -->
        <form action="HacerSubG.php" method="POST" class="needs-validation">
            <!-- Campo oculto para pasar el ID del registro a actualizar -->
            <input type="hidden" value="<?= get_value($row, 'id') ?>" name="id"> 
            
            <div class="registro-container">
                <div class="registro-column">
                    
                    <!-- Mes -->
                    <div>
                        <label for="Mes">Mes:</label>
                        <input type="date" id="Mes" name="Mes" value="<?= get_value($row, 'Mes') ?>" required>
                    </div>

                    <!-- Leche Fresca -->
                    <hr>
                    <label>Leche Fresca</label><br><br>
                    <div>
                        <label for="LitrosFres">Litros:</label>
                        <input type="number" id="LitrosFres" name="LitrosFres" value="<?= get_value($row, 'LitrosFres') ?>" placeholder="Litros" required step="any">
                    </div>
                    <div>
                        <label for="SHp">SG Promedio:</label>
                        <input type="number" id="SHp" name="SHp" value="<?= get_value($row, 'SHp') ?>" placeholder="%" required step="any">
                    </div>
                    <div>
                        <label for="SNGp">SNG Promedio:</label>
                        <input type="number" id="SNGp" name="SNGp" value="<?= get_value($row, 'SNGp') ?>" placeholder="%" required step="any">
                    </div>
                    
                    <!-- Leche Abasto Social -->
                    <hr class="my-4">
                    <label class="h5">Leche Abasto Social</label><br><br>
                    <div>
                        <label for="volumenTA">Volumen:</label>
                        <input type="number" id="volumenTA" name="volumenTA" value="<?= get_value($row, 'volumenTA') ?>" placeholder="Litros" required step="any">
                    </div>
                    <div>
                        <label for="solidosTA">Solidos grasos en producto terminado:</label>
                        <input type="number" id="solidosTA" name="solidosTA" value="<?= get_value($row, 'solidosTA') ?>" placeholder="Gramos/Litros" required step="any">
                    </div>

                    <!-- Leche Comercial Frisia -->
                    <hr class="my-4">
                    <label class="h5">Leche Comercial Frisia</label><br><br>
                    <div>
                        <label for="VolumenTC">Volumen:</label>
                        <input type="number" id="VolumenTC" name="VolumenTC" value="<?= get_value($row, 'VolumenTC') ?>" placeholder="Litros" required step="any">
                    </div>
                    <div>
                        <label for="TotalTC">% Total de Leche Fresca:</label>
                        <!-- Se usa TotalTC como el nombre del campo, ya que así aparece en la DB -->
                        <input type="number" id="%TotalTC" name="TotalTC" value="<?= get_value($row, 'TotalTC') ?>" placeholder="%" required step="any">
                    </div>
                    
                    <!-- Producción de abasto social -->
                    <hr class="my-4">
                    <label class="h5">Produccion de abasto social</label><br><br>
                    <div>
                        <label for="VolumenTP">Volumen:</label>
                        <input type="number" id="VolumenTP" name="VolumenTP" value="<?= get_value($row, 'VolumenTP') ?>" placeholder="Litros" required step="any">
                    </div>
                    <div>
                        <label for="LecheTP">Leche Fresca Para Abasto social:</label>
                        <input type="number" id="LecheTP" name="LecheTP" value="<?= get_value($row, 'LecheTP') ?>" placeholder="Litros" required step="any">
                    </div>
                    <div>
                        <label for="PorsentajeTP">%:</label>
                        <input type="number" id="PorsentajeTP" name="PorsentajeTP" value="<?= get_value($row, 'PorsentajeTP') ?>" placeholder="%" required step="any">
                    </div>
                    <div>
                        <label for="ProduccionTP">Produccion con LPD Estandarizado</label>
                        <input type="number" id="ProduccionTP" name="ProduccionTP" value="<?= get_value($row, 'ProduccionTP') ?>" placeholder="Litros" required step="any">
                    </div>
                    
                    <!-- Estandarización de leche -->
                    <hr class="my-4">
                    <label class="h5">Estandarización de leche</label><br><br>
                    <div>
                        <label for="ContenidoTC">Contenido de Solidos Grasos en el Producto Terminado:</label>
                        <input type="number" id="ContenidoTC" name="ContenidoTC" value="<?= get_value($row, 'ContenidoTC') ?>" placeholder="Gramos/Litros" required step="any">
                    </div>
                    
                    <!-- Aprovechamiento de la capacidad utilizada -->
                    <hr class="my-4">
                    <label class="h5">Aprovechamiento de la capacidad utilizada</label><br><br>
                    <div>
                        <label for="DiasOTD">Dias Operativos:</label>
                        <input type="number" id="DiasOTD" name="DiasOTD" value="<?= get_value($row, 'DiasOTD') ?>" placeholder="Dias" required step="any">
                    </div>
                    <div>
                        <label for="CapacidadITC">Capacidad Instalada Estandar de Maquina:</label>
                        <input type="number" id="CapacidadITC" name="CapacidadITC" value="<?= get_value($row, 'CapacidadITC') ?>" placeholder="Litros/Dias" required step="any">
                    </div>
                    <div>
                        <label for="TotalCapacidad">Total Capacidad por Mes:</label>
                        <input type="number" id="TotalCapacidad" name="TotalCapacidad" value="<?= get_value($row, 'TotalCapacidad') ?>" placeholder="Litros" required step="any">
                    </div>
                    <div>
                        <label for="ProduccionATP">Producción Abasto:</label>
                        <input type="number" id="ProduccionATP" name="ProduccionATP" value="<?= get_value($row, 'ProduccionATP') ?>" placeholder="Litros" required step="any">
                    </div>
                    <div>
                        <label for="ProduccionFTP">Producción Frisia:</label>
                        <input type="number" id="ProduccionFTP" name="ProduccionFTP" value="<?= get_value($row, 'ProduccionFTP') ?>" placeholder="Litros" required step="any">
                    </div>
                    <div>
                        <label for="TotalProduccion">Total de Producción por mes:</label>
                        <input type="number" id="TotalProduccion" name="TotalProduccion" value="<?= get_value($row, 'TotalProduccion') ?>" placeholder="Litros" required step="any">
                    </div>
                    
                    <!-- Productos Utilizados en la Limpieza Química -->
                    <hr class="my-4">
                    <label class="h5">Productos Utilizados en la Limpieza Química de Lineas y Equipos de Proceso</label><br><br>
                    <div>
                        <label for="DiasATD">Dias Operativos Acumulados hasta el mes:</label>
                        <input type="number" id="DiasATD" name="DiasATD" value="<?= get_value($row, 'DiasATD') ?>" placeholder="Dias" required step="any">
                    </div>

                    <!-- Hidróxido de sodio -->
                    <hr class="my-3">
                    <label class="h6">Hidroxido de sodio</label><br>
                    <div>
                        <label for="HidroxidoTH">Consumo Mensual:</label>
                        <input type="number" id="HidroxidoTH" name="HidroxidoTH" value="<?= get_value($row, 'HidroxidoTH') ?>" placeholder="Kg/Mes" required step="any">
                    </div>
                    <div>
                        <label for="TotalATT_Hidroxido">Total Anual:</label>
                        <input type="number" id="TotalATT_Hidroxido" name="TotalATT_Hidroxido" value="<?= get_value($row, 'TotalATT_Hidroxido') ?>" placeholder="Kg" required step="any">
                    </div>
                    <div>
                        <label for="AcumuladoCTA_Hidroxido">Acumulado consumo diario:</label>
                        <input type="number" id="AcumuladoCTA_Hidroxido" name="AcumuladoCTA_Hidroxido" value="<?= get_value($row, 'AcumuladoCTA_Hidroxido') ?>" placeholder="Kg" required step="any">
                    </div>

                    <!-- Ácido Fosfórico -->
                    <hr class="my-3">
                    <label class="h6">Ácido Fosfórico</label><br>
                    <div>
                        <label for="AcidoFTA">Consumo Mensual:</label>
                        <input type="number" id="AcidoFTA" name="AcidoFTA" value="<?= get_value($row, 'AcidoFTA') ?>" placeholder="Kg/Mes" required step="any">
                    </div>
                    <div>
                        <label for="TotalATT_Acido">Total Anual:</label>
                        <input type="number" id="TotalATT_Acido" name="TotalATT_Acido" value="<?= get_value($row, 'TotalATT_Acido') ?>" placeholder="Kg" required step="any">
                    </div>
                    <div>
                        <label for="AcumuladoCTA_Acido">Acumulado consumo diario:</label>
                        <input type="number" id="AcumuladoCTA_Acido" name="AcumuladoCTA_Acido" value="<?= get_value($row, 'AcumuladoCTA_Acido') ?>" placeholder="Kg" required step="any">
                    </div>
                </div>
            </div>
            
            <div class="form-buttons mt-4">
                <input type="submit" name="g" value="Guardar Cambios" >
                <!-- Se cambia a type="reset" para usar la función de limpieza nativa del navegador -->
                <input type="button" name="b" value="Limpiar Campos" onclick="limpiarCampos()"> 
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