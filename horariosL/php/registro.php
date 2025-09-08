<!DOCTYPE html>
<html lang="es">
<head>
	<title>Registro</title>
	<meta charset="UTF-8">
    <script src="../js/horario.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/registro.css">
    
</head>
<body>
<img src="../Imagenes/logo.png" class="logo">
<main class="container">

    <h1>Registro de Cargas</h1>
    <section class="registro">
        <form method="post" action="Guardar.php">
        <div class="registro-container">
            <div class="registro-column">
                <div>
                    <label for="ID">ID:</label>
                    <input type="number" id="ID" name="ID" placeholder="1234..." required>
                </div>
                <div>
                    <label for="H_I">Hora inicio:</label>
                    <input type="time" id="H_I" name="H_I" placeholder="12:30" required>
                </div>
                <div>
                    <label for="H_F">Hora fin:</label>
                    <input type="time" id="H_F" name="H_F" placeholder="20:30" required>
                </div>
                <div>
                    <label for="D_L">Dias Laborales:</label>
                    <input type="text" id="D_L" name="D_L" required>
                </div>                  
            <div class="form-buttons">
                <input type="submit" name="g" value="Guardar">
                <input type="reset" name="b" value="Limpiar">
            </div>
        </form>
    </section>
    <a href="horarioP.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90">
    </a>
</main>

</body>
</html>