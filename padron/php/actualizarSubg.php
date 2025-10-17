<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Indicadores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/actualizarSubg.css">
    <script src="../js/cargas.js"></script>
    <script src="../js/limpiar.js"></script>
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
	<img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">	
</head>
<body>
<div class="container">
    
    <h2>Modificar Indicadores Mensuales</h2>
    
    <?php
    include "Conexion.php";
    
    // Asumiendo que la nueva tabla se llama 'indicadores_mensuales'
    // y se consulta por el campo 'Mes' o un ID. Mantendremos el ID original.
    $ID = $_GET["sc"]; 
    $query = "SELECT * FROM p_subgerenciaabasto WHERE id='$ID'"; // Ajusta el nombre de la tabla y la columna clave
    $res = mysqli_query($link, $query);
        $row = mysqli_fetch_array($res);
        ?>

        <form action="HacerSubg.php?action=hacer" method="POST" class="needs-validation" novalidate>
            <input type="hidden" value="<?= $row['id'] ?? '' ?>" name="id"> 
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="Mes">Mes:</label>
                <input type="date" id="Mes" name="Mes" value="<?= $row['Mes'] ?? '' ?>" required> 
            </div>
            <div class="col-md-6">
                <label for="MetaETM">Meta ETM:</label>
                <input type="number" id="MetaETM" name="MetaETM" value="<?= $row['MetaETM'] ?? '' ?>" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="CantidadDTC">Cantidad DTC:</label>
                <input type="number" id="CantidadDTC" name="CantidadDTC" value="<?= $row['CantidadDTC'] ?? '' ?>" required>
            </div>
            <div class="col-md-6">
                <label for="CantidadFTC">Cantidad FTC:</label>
                <input type="number" id="CantidadFTC" name="CantidadFTC" value="<?= $row['CantidadFTC'] ?? '' ?>" required>
            </div>
        </div>

        <h3 class="mt-4 mb-3">Tiempos Básicos y Porcentajes</h3>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="TBuno">TB Uno:</label>
                <input type="text" id="TBuno" name="TBuno" value="<?= $row['TBuno'] ?? '' ?>" required>
            </div>
            <div class="col-md-6">
                <label for="Porcentajebuno">% TB Uno:</label>
                <input type="text" id="Porcentajebuno" name="Porcentajebuno" value="<?= $row['Porcentajebuno'] ?? '' ?>" required>
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="TBdos">TB Dos:</label>
                <input type="text" id="TBdos" name="TBdos" value="<?= $row['TBdos'] ?? '' ?>" required>
            </div>
            <div class="col-md-6">
                <label for="Porcentajetbdos">% TB Dos:</label>
                <input type="text" id="Porcentajetbdos" name="Porcentajetbdos" value="<?= $row['Porcentajetbdos'] ?? '' ?>" required>
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="TBtres">TB Tres:</label>
                <input type="text" id="TBtres" name="TBtres" value="<?= $row['TBtres'] ?? '' ?>" required>
            </div>
            <div class="col-md-6">
                <label for="Porcentajetbtres">% TB Tres:</label>
                <input type="text" id="Porcentajetbtres" name="Porcentajetbtres" value="<?= $row['Porcentajetbtres'] ?? '' ?>" required>
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="TBCuatro">TB Cuatro:</label>
                <input type="text" id="TBCuatro" name="TBCuatro" value="<?= $row['TBCuatro'] ?? '' ?>" required>
            </div>
            <div class="col-md-6">
                <label for="Porcentajetbcuatro">% TB Cuatro:</label>
                <input type="text" id="Porcentajetbcuatro" name="Porcentajetbcuatro" value="<?= $row['Porcentajetbcuatro'] ?? '' ?>" required>
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="TBCinco">TB Cinco:</label>
                <input type="text" id="TBCinco" name="TBCinco" value="<?= $row['TBCinco'] ?? '' ?>" required>
            </div>
            <div class="col-md-6">
                <label for="Porcentajetbcinco">% TB Cinco:</label>
                <input type="text" id="Porcentajetbcinco" name="Porcentajetbcinco" value="<?= $row['Porcentajetbcinco'] ?? '' ?>" required>
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="TBseis">TB Seis:</label>
                <input type="text" id="TBseis" name="TBseis" value="<?= $row['TBseis'] ?? '' ?>" required>
            </div>
            <div class="col-md-6">
                <label for="Porcentajetbseis">% TB Seis:</label>
                <input type="text" id="Porcentajetbseis" name="Porcentajetbseis" value="<?= $row['Porcentajetbseis'] ?? '' ?>" required>
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="TBsiete">TB Siete:</label>
                <input type="text" id="TBsiete" name="TBsiete" value="<?= $row['TBsiete'] ?? '' ?>" required>
            </div>
            <div class="col-md-6">
                <label for="Porcentajetbsiete">% TB Siete:</label>
                <input type="text" id="Porcentajetbsiete" name="Porcentajetbsiete" value="<?= $row['Porcentajetbsiete'] ?? '' ?>" required>
            </div>
        </div>

        <h3 class="mt-4 mb-3">Movimientos y Variación</h3>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="BajasTB">Bajas TB:</label>
                <input type="number" id="BajasTB" name="BajasTB" value="<?= $row['BajasTB'] ?? '' ?>" required>
            </div>
            <div class="col-md-4">
                <label for="AltasTA">Altas TA:</label>
                <input type="number" id="AltasTA" name="AltasTA" value="<?= $row['AltasTA'] ?? '' ?>" required>
            </div>
            <div class="col-md-4">
                <label for="VariacionTV">Variación TV:</label>
                <input type="text" id="VariacionTV" name="VariacionTV" value="<?= $row['VariacionTV'] ?? '' ?>" required>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-12 text-center">
                <input type="submit" value="Guardar Cambios" class="btn btn-primary me-2">
                <input type="button" value="Limpiar Campos" class="btn btn-secondary" onclick="limpiarCampos()"><br><br>
            </div>
        </div>
    </form>

    <a href="MenuModifi.php" class="back-link"><img src="../Imagenes/home.png" height="100" width="90"></a>
</div>
</body>
</html>