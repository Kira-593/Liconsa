<?php
// Incluye la conexión a la base de datos
include "Conexion.php";

// 1. Verificar y obtener el ID del registro a modificar
// Se usa 'sc' para obtener el ID.
$ID = $_GET["sc"] ?? die("
    <!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><title>Error</title></head><body>
    <div class='container mt-5'><div class='alert alert-danger'>Error: ID de registro (sc) no proporcionado.</div></div>
    </body></html>");

// La tabla es 'c_evaluaciondesemp'
// Seleccionamos TODOS los campos para prellenar el formulario
$query = "SELECT * FROM c_evaluaciondesempeno WHERE id='$ID'"; 
// Nota: Para mayor seguridad, se recomienda usar sentencias preparadas (prepared statements)
// en lugar de la concatenación directa de variables en la consulta.
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
    <title>Modificar Evaluación de Desempeño</title>
    <meta charset="UTF-8">
    <!-- Scripts JS originales -->
    <script src="../js/cargas.js"></script>
    <script src="../js/SumaT.js"></script>
    <!-- Se incluye el script de limpieza, si existe, para la función limpiarCampos() -->
    <script src="../js/limpiar.js"></script> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Se usa el CSS del formulario de Evaluación (formEvaluacion.css) -->
    <link rel="stylesheet" href="../css/formEvaluacion.css">
    
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC"> 
    
</head>
<body>
<main class="container">
    
    <h1>Modificar Registro de Evaluación del Desempeño</h1>
    
    <section class="registro">
        <!-- La acción del formulario se dirige al script de actualización para Evaluación (HacerEva.php) -->
        <form action="HacerEva.php" method="POST" class="needs-validation" novalidate>
            <!-- Campo oculto para pasar el ID del registro a actualizar -->
            <input type="hidden" value="<?= $row['id'] ?? '' ?>" name="id"> 
        
            <div class="registro-container">
                <div class="registro-column">
                    
                    <!-- Mes (Fecha) -->
                    <div>
                        <label for="Mes">Mes:</label>
                        <input type="date" id="Mes" name="Mes" 
                               value="<?= $row['Mes'] ?? '' ?>" 
                               required>
                    </div>

                    <!-- Servicios Solicitados (ServiciosSTS) -->
                    <div>
                        <label for="ServiciosSTS">Servicios Solicitados:</label>
                        <input type="text" id="ServiciosSTS" name="ServiciosSTS" 
                               value="<?= $row['ServiciosSTS'] ?? '' ?>" 
                               placeholder="No.Serv." required>
                    </div>

                    <!-- Servicios Atendidos en Tiempo (ServiciosATS) -->
                    <div>
                        <label for="ServiciosATS">Servicios Atendidos en Tiempo:</label>
                        <input type="text" id="ServiciosATS" name="ServiciosATS" 
                               value="<?= $row['ServiciosATS'] ?? '' ?>" 
                               placeholder="No.Serv." required>
                    </div>

                    <!-- Porcentaje de cumplimiento (PorcentajeCTP) -->
                    <div>
                        <label for="PorcentajeCTP">Porcentaje de cumplimiento:</label>
                        <input type="text" id="PorcentajeCTP" name="PorcentajeCTP" 
                               value="<?= $row['PorcentajeCTP'] ?? '' ?>" 
                               placeholder="Ej. 95%" required>
                    </div>

                    <!-- Meta (MetaTM) -->
                    <div>
                        <label for="MetaTM">Meta:</label>
                        <input type="number" step="0.0001" id="MetaTM" name="MetaTM" 
                               value="<?= $row['MetaTM'] ?? '' ?>" 
                               placeholder="Ej. MIN. 95%" required>
                    </div>
                </div>
            </div>
            
            <div class="form-buttons mt-4">
                <input type="submit" name="g" value="Guardar Cambios">
                <!-- Se mantiene el botón de Limpiar con la función JavaScript si está disponible -->
                <input type="button" name="b" value="Limpiar" onclick="limpiarCampos()">
            </div>
        </form>
    </section>
    
    <!-- Se mantiene el enlace de regreso -->
    <a href="TipoFormulario.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90" alt="Volver a la página de inicio">
    </a>
</main>
</body>
</html>
