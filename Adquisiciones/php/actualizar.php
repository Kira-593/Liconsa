<?php
// Incluye la conexión a la base de datos
include "Conexion.php";

// 1. Verificar y obtener el ID del registro a modificar (usando 'sc' como clave)
$ID = $_GET["sc"] ?? die("
    <!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><title>Error</title></head><body>
    <div class='container mt-5'><div class='alert alert-danger'>Error: ID de registro (sc) no proporcionado.</div></div>
    </body></html>");

// ************** INICIO DE MITIGACIÓN SQL INJECTION ******************
$ID_e = mysqli_real_escape_string($link, $ID);
// ************** FIN DE MITIGACIÓN SQL INJECTION ******************

// 2. Consulta para seleccionar los datos de la tabla 'c_resumenadquisiciones'
$query = "SELECT * FROM c_resumenadquisiciones WHERE id='$ID_e'"; 
$res = mysqli_query($link, $query);

if (!$res || mysqli_num_rows($res) == 0) {
    // Si no hay resultados o hay error, detenemos la ejecución y mostramos un error
    die("
    <!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><title>Error</title></head><body>
    <div class='container mt-5'><div class='alert alert-danger'>Error: Registro con ID $ID_e no encontrado o error en la consulta.</div></div>
    </body></html>");
}

$row = mysqli_fetch_array($res);

// 3. Cierra la conexión después de obtener los datos
include "Cerrar.php"; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Modificar Resumen de Adquisiciones</title>
    <meta charset="UTF-8">
    <!-- Scripts JS originales (se mantienen si se usan las funciones) -->
    <script src="../js/cargas.js"></script>
    <script src="../js/SumaT.js"></script>
    <!-- Se asume que limpiar.js define la función limpiarCampos() -->
    <script src="../js/limpiar.js"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Se usa el CSS del formulario de Resumen de Adquisiciones -->
    <link rel="stylesheet" href="../css/actualizar.css">
    
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC"> 
    
</head>
<body>
<main class="container">

    <h1>Modificar Registro de Resumen de Adquisiciones</h1>
    
    <section class="registro">
        <!-- El formulario apunta al script de actualización que creamos en el paso anterior -->
        <form method="post" action="Hacer.php"> 
            <!-- Campo oculto para pasar el ID del registro a actualizar -->
            <input type="hidden" value="<?= $row['id'] ?? '' ?>" name="id"> 
        <div class="registro-container">
            <div class="registro-column">

                <!-- Mes -->
                <div>
                    <label for="Mes">Mes:</label>
                    <input type="date" id="Mes" name="Mes" 
                        value="<?= $row['Mes'] ?? '' ?>" required>
                </div>
                
                <!-- CodigoTC -->
                <div>
                    <label></label> <br>
                    <label for="CodigoTC">Codigo:</label>
                    <input type="number" id="CodigoTC" name="CodigoTC" placeholder="Ej. 1" 
                        value="<?= $row['CodigoTC'] ?? '' ?>" required>
                </div>
                
                <!-- DescripcionBTD -->
                <div>
                    <label for="DescripcionBTD">Descripcion de los Bienes y/o Servicios:</label>
                    <input type="text" id="DescripcionBTD" name="DescripcionBTD" placeholder="Ej.EQUIPO DE PROTECCIÓN PERSONAL" 
                        value="<?= $row['DescripcionBTD'] ?? '' ?>" required>
                </div>
                
                <!-- MontoSIT (Monto sin Iva) -->
                <div>
                    <label for="MontoSIT">Monto sin Iva:</label>
                    <input type="number" id="MontoSIT" name="MontoSIT" placeholder="Ej. $33,434.48" 
                        value="<?= $row['MontoSIT'] ?? '' ?>" required step="any">
                </div>
                
                <!-- LPAD -->
                <div>
                    <label for="LPAD">(LP,I3P,AD):</label>
                    <input type="text" id="LPAD" name="LPAD" placeholder="Ej. 55 PRIMER PARRAFO" 
                        value="<?= $row['LPAD'] ?? '' ?>" required>
                </div>
                
                <!-- EmpresaATE -->
                <div>
                    <label for="EmpresaATE">Empresa Adjudicada:</label>
                    <input type="text" id="EmpresaATE" name="EmpresaATE" placeholder="HOC MAC, S.A de CV" 
                        value="<?= $row['EmpresaATE'] ?? '' ?>" required>
                </div>
                
                <!-- TotalGET (Total Gerencia Estatal Tlaxcala) 
                     *** ATENCIÓN: El campo HTML original tenía name="MontoSIT" por error. 
                     Aquí se corrige a name="TotalGET" para coincidir con la base de datos. *** -->
                <div>
                    <label for="TotalGET">Total Gerencia Estatal Tlaxcala:</label>
                    <input type="number" id="TotalGET" name="TotalGET" placeholder="Ej. $7,736,698.35" 
                        value="<?= $row['TotalGET'] ?? '' ?>" required step="any">
                </div>
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <input type="submit" name="g" value="Guardar Cambios" class="btn btn-primary">
                    <input type="button" name="b" value="Limpiar" onclick="limpiarCampos()" class="btn btn-secondary">
                </div>  
            </div>
        </div>
        </form>
    </section>
    
    <!-- Enlaces de navegación actualizados para el contexto de Adquisiciones -->
    <a href="AdquisicionesP.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90" alt="Volver al menú principal de Adquisiciones">
    </a>
</main>
</body>
</html>
