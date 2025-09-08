<!DOCTYPE html>
<html lang="es">
<head>
	<title>Registro</title>
	<meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/camionero.css">
    <script src="../js/camionero.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
<img src="../Imagenes/logo.png" class="logo">
<main class="container">

    <h1>Registro de Choferes</h1>
    <section class="registro">
        <form method="post" action="Guardar.php">
        <div class="registro-container">
            <div class="registro-column">
                <div>
                    <label for="DNI">DNI:</label>
                    <input type="number" id="DNI" name="DNI" placeholder="1234..." required>
                </div>
                <div>
                    <label for="Nombre">Nombre:</label>
                    <input type="text" id="Nombre" name="Nombre" maxlength="50" placeholder="Raúl" required>
                </div>
                <div>
                    <label for="ap">Apellido paterno:</label>
                    <input type="text" id="ap" name="ap" maxlength="50" placeholder="González" required>
                </div>
                <div>
                    <label for="am">Apellido materno:</label>
                    <input type="text" id="am" name="am" maxlength="50" placeholder="Sánchez" required>
                </div>
                <div>
                    <label for="nt">Número telefónico:</label>
                    <input type="number" id="nt" name="nt" maxlength="10" placeholder="2461093105" required>
                </div>
                <div>
                    <label for="Estado">Estado:</label>
                    <input type="text" id="Estado" name="Estado" maxlength="50" placeholder="Tlaxcala" required>
                </div>
                <div>
                    <label for="CodigoP">Codigo Portal:</label>
                    <input type="number" id="CodigoP" name="CodigoP" placeholder="90180" required>
                </div>
            </div>

            <div class="registro-column">
                <div>
                    <label for="Población">Población:</label>
                    <input type="text" id="Población" name="Población" maxlength="20" placeholder="Zacatelco" required>
                </div>
                <div>
                    <label for="Colonia">Colonia:</label>
                    <input type="text" id="Colonia" name="Colonia" maxlength="20" placeholder="Centro" required>
                </div>
                <div>
                    <label for="Calle">Calle:</label>
                    <input type="text" id="Calle" name="Calle" maxlength="15" placeholder="Hidalgo" required>
                </div>
                <div>
                    <label for="nc">Número de casa:</label>
                    <input type="text" id="nc" name="nc" maxlength="5" placeholder="05" required>
                </div>
                <div>
                    <label for="Salario">Salario:</label>
                    <input type="text" id="Salario" name="Salario" maxlength="10" placeholder="2500" required>
                </div>
                <div>
                    <label for="Empresa">Empresa:</label>
                    <select id="Empresa" name="Empresa" required>
                        <?php
                        include "Conexion.php";
                        // Consulta para obtener las empresas
                        $query = "SELECT ID_EM, Nombre FROM empresa";
                        $res = mysqli_query($link, $query);

                        while ($fila = mysqli_fetch_array($res)) {
                            echo "<option value='" . $fila['ID_EM'] . "'>" . $fila['Nombre'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>

            <div class="form-buttons">
                <input type="submit" name="g" value="Guardar">
                <input type="reset" name="b" value="Limpiar">
            </div>
        </form>
    </section>
    <a href="index.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90">
    </a>
</main>
<?php include "Cerrar.php"; ?>                    
</body>
</html>