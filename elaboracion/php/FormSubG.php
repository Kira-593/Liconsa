<!DOCTYPE html>
<html lang="es">
<head>
	<title>Registro</title>
	<meta charset="UTF-8">
    <script src="../js/cargas.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/FormSubG.css">
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">
</head>
<body>
<main class="container">

    <h1>Formulario de Subgerencia de Operaciones</h1>
    <section class="registro">
        <form method="post" action="Guardar.php">
        <div class="registro-container">
            <div class="registro-column">
                <div>
                    <label for="Mes">Mes</label>
                    <input type="date" id="Mes" name="Mes" required>
                </div>
                <div>
                    <label>Leche Fresca</label><br><br>
                    <label for="LitrosFres">Litros:</label>
                    <input type="number" id="LitrosFres" name="LitrosFres" placeholder="Litos" required>
                </div>
                <div>
                    <label for="SHp">SG Promedio:</label>
                    <input type="number" id="SHp" name="SHp" placeholder="%" required>
                </div>
                <div>
                    <label for="SNGp">SNG Promedio:</label>
                    <input type="number" id="SNGp" name="SNGp" placeholder="%" required>
                    <hr>
                </div>
                <div>
                    <label>Leche Abasto Social</label><br><br>
                    <label for="volumenTA">Volumen:</label>
                    <input type="number" id="volumenTA" name="volumenTA" placeholder="Litros" required>
                </div>
                 <div>
                    
                    <label for="solidosTA">Solidos grasos en producto terminado:</label>
                    <input type="number" id="solidosTA" name="solidosTA" placeholder="Gramos/Litros" required>
                </div>
                <hr>
                <div>
                    <label>Leche Comercial Frisia</label><br><br>
                    <label for="VolumenTC">Volumen:</label>
                    <input type="number" id="VolumenTC" name="VolumenTC" placeholder="Litros" required>
                </div>
                <div>
                    <label for="%TotalTC">% Total de Leche Fresca:</label>
                    <input type="number" id="%TotalTC" name="%TotalTC" placeholder="%" required>
                </div>
  
                 <hr>
                <div>
                    <label>Produccion de abasto social</label><br><br>
                    <label for="VolumenTP">Volumen:</label>
                    <input type="number" id="VolumenTP" name="VolumenTP" placeholder="Litros" required>
                </div>
               <div>
                    <label for="LecheTP">Leche Fresca Para Abasto social:</label>
                    <input type="number" id="VolumenTP" name="VolumenTP" placeholder="Litros" required>
                </div>
                 <div>
                    <label for="PorsentajeTP">%:</label>
                    <input type="number" id="PorsentajeTP" name="PorsentajeTP" placeholder="%" required>
                </div>
                 <div>
                    <label for="ProduccionTP">Produccion con LPD Estandarizado</label>
                    <input type="number" id="ProduccionTP" name="ProduccionTP" placeholder="Litros" required>
                </div>
                

                <div>
                 
            <div class="form-buttons">
                <input type="submit" name="g" value="Guardar">
                <input type="reset" name="b" value="Limpiar">
            </div>
        </form>
    </section>
    <a href="TipoFormulario.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90">
    </a>
</main>

</body>
</html>