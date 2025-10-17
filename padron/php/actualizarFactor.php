<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Factor de Retiro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Se actualiza la referencia al CSS según el nuevo contexto -->
    <link rel="stylesheet" href="../css/actualizarfactor.css">
    <script src="../js/limpiar.js"></script>
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC"> 
</head>
<body>
<main class="container">
    
    <h2>Modificar Factor de Retiro</h2>
    
    <?php
    include "Conexion.php";
    
    // Se usa 'sc' para obtener el ID, como indica la referencia
    $ID = $_GET["sc"] ?? die("<div class='alert alert-danger'>Error: ID de registro (sc) no proporcionado.</div>");
    
    // Consulta para obtener los datos existentes de la tabla p_factorretiro
    $query = "SELECT * FROM p_factorretiro WHERE id='$ID'"; 
    $res = mysqli_query($link, $query);
    
    if (!$res || mysqli_num_rows($res) == 0) {
        die("<div class='alert alert-danger'>Error: Registro con ID $ID no encontrado o error en la consulta.</div>");
    }
    
    $row = mysqli_fetch_array($res);
    ?>

    <!-- El formulario envía los datos al script HacerFactor.php para el UPDATE -->
    <section class="registro">
        <form action="HacerFactor.php" method="POST" class="needs-validation" novalidate>
            <!-- Campo oculto para pasar el ID del registro a actualizar -->
            <input type="hidden" value="<?= $row['id'] ?? '' ?>" name="id"> 
        
            <div class="registro-container">
                <div class="registro-column">
                    
                    <div class="mb-3">
                        <label for="Indicador">Tipo de Leche</label>
                        <select id="Indicador" name="Indicador"  required>
                            <!-- Preselecciona la opción actual -->
                            <option value="Liquida de Abasto" <?= ($row['Indicador'] == 'Liquida de Abasto') ? 'selected' : '' ?>>Liquida de Abasto</option>
                            <option value="Polvo de Abasto" <?= ($row['Indicador'] == 'Polvo de Abasto') ? 'selected' : '' ?>>Polvo de Abasto</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="Mes">Mes:</label>
                        <!-- Se usa type="date" para el campo Mes -->
                        <input type="date" id="Mes" name="Mes" value="<?= $row['Mes'] ?? '' ?>" required>
                    </div>
                    
                    <h3 class="mt-4 mb-3">Cantidades</h3>
                    
                    <div class="mb-3">
                        <label for="FactorRTF">Factor de Retiro Mínimo:</label>
                        <input type="number" id="FactorRTF" name="FactorRTF" value="<?= $row['FactorRTF'] ?? '' ?>" placeholder="Ej. 301" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="AlcanceTA">Alcance del Mes:</label>
                        <input type="number" id="AlcanceTA" name="AlcanceTA" value="<?= $row['AlcanceTA'] ?? '' ?>" placeholder="Ej. 361" required>
                    </div>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-12 text-center form-buttons">
                    <input type="submit" value="Guardar Cambios" class="btn btn-primary me-2">
                    <input type="button" value="Limpiar Campos" class="btn btn-secondary" onclick="limpiarCampos()">
                </div>
            </div>
        </form>
    </section>
    
    <?php include "Cerrar.php"; ?>
    
    <a href="MenuModifi.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90">
    </a>