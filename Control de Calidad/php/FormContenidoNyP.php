<!DOCTYPE html>
<html lang="es">
<head>
	<title>Registro de Leche</title>
	<meta charset="UTF-8">
    <script src="../js/cargas.js"></script>
    <script src="../js/SumaT.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/formContenidoNyP.css">
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
	<img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">	
</head>
<body>
<main class="container">

    <h1>Formulario de Contenido Neto y Peso de Envase Vacío</h1>
    <h5>(Leche Fortificada y Frisia)</h5>
    
    <section class="registro">
        <form method="post" action="Guardar.php">
        <div class="registro-container">
            <div class="registro-column">
            
                <div>
                    <label for="Indicador">Indicador</label>
                     <select id="Indicador" name="Indicador" required>
                        <?php
                        include "Conexion.php";

                        // Consulta para obtener los camiones
                        $query = "SELECT ID_CA, Marca FROM camiones";
                        $res = mysqli_query($link, $query);

                        while ($fila = mysqli_fetch_array($res)) {
                            echo "<option value='" . $fila['ID_CA'] . "'>" . $fila['ID_CA'] . " - " . $fila['Marca'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div>
                    <label for="Mes">Mes:</label>
                    <input type="date" id="Mes" name="Mes" required>
                </div>
                <hr>
                <div>
                    <label for="ContenidoNTC">CONTENIDO NETO</label></br></br>
                    <label for="MinimoTMN">Minimo:</label>
                    <input type="Text" id="MinimoTMN" name="MinimoTMN" placeholder="(ml)" required>
                </div>

               <div>
                    <label for="MaximoTMN">Maximo:</label>
                    <input type="Text" id="MaximoTMN" name="MaximoTMN" placeholder="(ml)" required>
                </div>

                <div>
                    <label for="PromedioTPN">Promedio:</label>
                    <input type="text" id="PromedioTPN" name="PromedioTPN" placeholder="(ml)" required>
                </div>
                <hr>
                <div>
                    <label for="PesoETE">PESO DEL ENVASE</label></br></br>
                    <label for="MinimoTE">Minimo:</label>
                    <input type="Text" id="MinimoTE" name="MinimoTE" placeholder="(gr)" required>
                </div>

               <div>
                    <label for="MaximoTE">Maximo:</label>
                    <input type="Text" id="MaximoTE" name="MaximoTE" placeholder="(gr)" required>
                </div>

                <div>
                    <label for="PromedioTP">Promedio:</label>
                    <input type="text" id="PromedioTP" name="PromedioTP" placeholder="(gr)" required>
                </div>

    


                <div class="form-buttons">
                    <input type="submit" name="g" value="Guardar">
                    <input type="reset" name="b" value="Limpiar">
                </div>
                

            </div>
        </div>
        </form>
    </section>

    <a href="TipoFormulario.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90">
    </a>
</main>

</body>
</html>
