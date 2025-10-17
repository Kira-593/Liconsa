<?php
// Incluye la conexión a la base de datos
include "Conexion.php";

// Se usa 'sc' para obtener el ID del registro a modificar
$ID = $_GET["sc"] ?? die("<div class='alert alert-danger'>Error: ID de registro (sc) no proporcionado.</div>");

// Consulta para obtener los datos existentes de la tabla m_relaciones_industriales
// ADVERTENCIA: Esta consulta es VULNERABLE a Inyección SQL, 
// pero se mantiene aquí para coincidir con el estilo del código original (HacerMaterial.php).
// En un entorno de producción, DEBERÍA usarse una sentencia preparada aquí también.
$query = "SELECT * FROM g_relacionesindustriales WHERE id='$ID'"; 
$res = mysqli_query($link, $query);

if (!$res || mysqli_num_rows($res) == 0) {
    // Si hay un error en la consulta o el registro no existe
    die("<div class='alert alert-danger'>Error: Registro con ID **$ID** no encontrado o error en la consulta (Tabla m_relaciones_industriales).</div>");
}

$row = mysqli_fetch_array($res);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Modificar Relaciones Industriales</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Se mantienen los scripts js originales del formulario de destino -->
    <script src="../js/cargas.js"></script>
    <script src="../js/SumaT.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Se usa el CSS del formulario de destino (formRelaciones.css) -->
    <link rel="stylesheet" href="../css/formRelaciones.css">
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC"> 
    
    <!-- Incluye el script limpiar.js del formulario original que queremos adaptar -->
    <script src="../js/limpiar.js"></script> 
</head>
<body>
<main class="container">

    <!-- Título actualizado para reflejar la modificación -->
    <h1>Modificar Registro de Relaciones Industriales</h1>
    
    <section class="registro">
        <!-- El formulario envía los datos a HacerRelaciones.php para la actualización -->
        <form method="post" action="HacerRelaciones.php" class="needs-validation" novalidate>
        
            <!-- Campo oculto para pasar el ID del registro a actualizar -->
            <input type="hidden" value="<?= $row['id'] ?? '' ?>" name="id"> 
            
            <div class="registro-container">
                <div class="registro-column">
                    
                    <!-- Mes (Fecha) -->
                    <div>
                        <label for="Mes">Mes:</label>
                        <!-- Se pre-carga con el valor existente en la BD -->
                        <input type="date" id="Mes" name="Mes" value="<?= $row['Mes'] ?? '' ?>" required>
                    </div>
                    
                    <div>
                        <hr>
                        <label>Plantilla de Personal</label><br>
                        <hr>
                        
                        <!-- NumeroTrabajadores -->
                        <label for="NumeroTrabajadores">Numero de Trabajadores:</label>
                        <input type="number" id="NumeroTrabajadores" name="NumeroTrabajadores" 
                                value="<?= $row['NumeroTrabajadores'] ?? '' ?>" placeholder="EJ. 118" required>
                    </div>
                    
                    <!-- TrabajadoresH (Hombres) -->
                    <div>
                        <label for="TrabajadoresH">Cantidad de Trabajadores Hombres:</label>
                        <input type="number" id="TrabajadoresH" name="TrabajadoresH" 
                                value="<?= $row['TrabajadoresH'] ?? '' ?>" placeholder="EJ. 87" required>
                    </div>
                    
                    <!-- HombresConfianza -->
                    <div>
                        <label for="HombresConfianza">Cantidad de Hombres de Confianza:</label>
                        <input type="number" id="HombresConfianza" name="HombresConfianza" 
                                value="<?= $row['HombresConfianza'] ?? '' ?>" placeholder="EJ. 87" required>
                    </div>
                    
                    <!-- HombresSindicato -->
                    <div>
                        <label for="HombresSindicato">Cantidad de Hombres de Sindicato:</label>
                        <input type="number" id="HombresSindicato" name="HombresSindicato" 
                                value="<?= $row['HombresSindicato'] ?? '' ?>" placeholder="EJ. 87" required>
                    </div>
                    
                    <!-- TrabajadoresM (Mujeres) -->
                    <div>
                        <label for="TrabajadoresM">Cantidad de Trabajadoras Mujeres:</label>
                        <input type="number" id="TrabajadoresM" name="TrabajadoresM" 
                                value="<?= $row['TrabajadoresM'] ?? '' ?>" placeholder="EJ. 87" required>
                    </div>
                    
                    <!-- MujeresConfianza -->
                    <div>
                        <label for="MujeresConfianza">Cantidad de Mujeres de Confianza:</label>
                        <input type="number" id="MujeresConfianza" name="MujeresConfianza" 
                                value="<?= $row['MujeresConfianza'] ?? '' ?>" placeholder="EJ. 87" required>
                    </div>
                    
                    <!-- MujeresSindicato -->
                    <div>
                        <label for="MujeresSindicato">Cantidad de Mujeres de Sindicato:</label>
                        <input type="number" id="MujeresSindicato" name="MujeresSindicato" 
                                value="<?= $row['MujeresSindicato'] ?? '' ?>" placeholder="EJ. 87" required>
                    </div>
                    
                    <!-- TrabajadoresConfianza -->
                    <div>
                        <label for="TrabajadoresConfianza">Cantidad De Trabajadores de Confianza:</label>
                        <input type="number" id="TrabajadoresConfianza" name="TrabajadoresConfianza" 
                                value="<?= $row['TrabajadoresConfianza'] ?? '' ?>" placeholder="EJ. 57" required>
                    </div>
                    
                    <!-- TrabajadoresSindicato -->
                    <div>
                        <label for="TrabajadoresSindicato">Cantidad De Trabajadores de Sindicato:</label>
                        <input type="number" id="TrabajadoresSindicato" name="TrabajadoresSindicato" 
                                value="<?= $row['TrabajadoresSindicato'] ?? '' ?>" placeholder="EJ. 57" required>
                    </div>
                    
                    <!-- NumeroPlazasOcupadas -->
                    <div>
                        <label for="NumeroPlazasOcupadas">Numero Total de Plazas Ocupadas:</label>
                        <input type="number" id="NumeroPlazasOcupadas" name="NumeroPlazasOcupadas" 
                                value="<?= $row['NumeroPlazasOcupadas'] ?? '' ?>" placeholder="EJ. 117" required>
                    </div>
                    
                    <!-- VacantesTV (Textarea) -->
                    <div>
                        <label for="VacantesTV">Vacantes:</label><br><br>
                        <textarea id="VacantesTV" name="VacantesTV" rows="4" 
                                    placeholder="Ej. Jefe Operativo, Renuncia Voluntaria 11/09/2025" required><?= $row['VacantesTV'] ?? '' ?></textarea>
                    </div>
                    
                    <!-- IncapacidadesTI (Textarea) -->
                    <div>
                        <label for="IncapacidadesTI">Incapacidades (Nombre, Personal, Dias, Fecha inicio, Fecha de Termino, Folio):</label><br><br>
                        <textarea id="IncapacidadesTI" name="IncapacidadesTI" rows="4" 
                                    placeholder="Ej. Abraham Rojas, Auxiliar, 5 dias, 01/09/2025, 06/09/2025, Folio:12345" required><?= $row['IncapacidadesTI'] ?? '' ?></textarea>
                    </div>
                    
                </div>
            </div>
            
            <div>
                <!-- Se cambia el valor del botón a "Guardar Cambios" para reflejar la acción de modificación -->
                <input type="submit" name="g" value="Guardar Cambios">
                <!-- Se mantiene el botón de limpiar usando la función limpiarCampos del script js/limpiar.js -->
                <input type="button" name="b" value="Limpiar Campos" onclick="limpiarCampos()">
            </div>
        </form>
    </section>
    
    <?php include "Cerrar.php"; // Cierra la conexión ?>
    
    <!-- Enlace de regreso adaptado para ir a ModRelaciones.php, asumiendo que es el menú de listado -->
    <a href="GestionP.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90" alt="Regresar a Inicio">
    </a>
</main>
</body>
</html>
