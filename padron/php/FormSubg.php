<!DOCTYPE html>
<html lang="es">
<head>
	<title>Registro</title>
	<meta charset="UTF-8">
    <script src="../js/cargas.js"></script>
    <script src="../js/Variacion.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/formSubg.css">
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
	<img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">	
    
</head>
<body>
<main class="container">

    <h1>Formulario de Subgerencia de Abasto</h1>
    
    <section class="registro">
        <form method="post" action="Guardar.php">
        <div class="registro-container">
            <div class="registro-column">
            
                <div>
                    <label for="Mes">Mes:</label>
                    <input type="date" id="Mes" name="Mes" required>
                </div>
                <hr>
                <div>
                    <label>Hogares y Beneficiarios Atendidos</label><br><br>
                    <label for="MetaETM">Meta Establecida Para este mes:</label>
                    <input type="number" id="MetaETM" name="MetaETM" placeholder="Ej.106,000" required>
                </div>
                <div>
                    <label for="CantidadDTC">Cantidad de Derechohabientes:</label>
                    <input type="number" id="CantidadDTC" name="CantidadDTC" placeholder="Ej.106,000" required>
                </div>
                <div>
                    <label for="CantidadFTC">Cantidad de Familias:</label>
                    <input type="number" id="CantidadFTC" name="CantidadFTC" placeholder="Ej.56,731" required>
                </div>
                <hr>
                <div>
                    <label>Cantidad de Integrantes del Padron</label><br><br>
                    <label for="TBuno">Niñas y Niños de 6 a 12 Años (TB1):</label>
                    <input type="number" id="TBuno" name="TBuno" placeholder="Ej.42,490" required>
                </div>
                 <div>
                    <label for="Porcentajetbuno">porcentaje que Reprecenta en el Padron:</label>
                    <input type="number" id="Porcentajebuno" name="Porcentajebuno" placeholder="Ej. 40%" required>
                </div>
                <div>
                    <label for="TBdos">Mujeres en Periodo de Gestación (TB2):</label>
                    <input type="number" id="TBdos" name="TBdos" placeholder="Ej.117" required>
                </div>
                 <div>
                    <label for="Porcentajetbdos">porcentaje que Reprecenta en el Padron:</label>
                    <input type="number" id="Porcentajetbdos" name="Porcentajetbdos" placeholder="Ej. 0%" required>
                </div>
                 <div>
                    <label for="TBtres">Enfermos Cronicos o Con Discapacidad (TB3):</label>
                    <input type="number" id="TBtres" name="TBtres" placeholder="Ej.1,810" required>
                </div>
                 <div>
                    <label for="Porcentajetbtres">porcentaje que Reprecenta en el Padron:</label>
                    <input type="number" id="Porcentajetbtres" name="Porcentajetbtres" placeholder="Ej. 2%" required>
                </div>
                    <div>
                        <label for="TBCuatro">Adultos Mayores de 60 Años (TB4):</label>
                        <input type="number" id="TBCuatro" name="TBCuatro" placeholder="Ej.32,722" required>
                    </div>
                     <div>
                        <label for="Porcentajetbcuatro">porcentaje que Reprecenta en el Padron:</label>
                        <input type="number" id="Porcentajetbcuatro" name="Porcentajetbcuatro" placeholder="Ej. 31%" required>  
                    </div>
                     <div>
                        <label for="TBCinco">Adolescentes de 13 a 19 Años (TB5):</label>
                        <input type="number" id="TBCinco" name="TBCinco" placeholder="Ej.14,352" required>
                    </div>
                        <div>
                            <label for="Porcentajetbcinco">porcentaje que Reprecenta en el Padron:</label>
                            <input type="number" id="Porcentajetbcinco" name="Porcentajetbcinco" placeholder="Ej. 14%" required>
                        </div>
                        <div>
                             <div>
                    <label for="TBseis">Mujeres en Periodo de Lactancia (TB6):</label>
                    <input type="number" id="TBseis" name="TBseis" placeholder="Ej.312" required>
                </div>
                 <div>
                    <label for="Porcentajetbseis">porcentaje que Reprecenta en el Padron:</label>
                    <input type="number" id="Porcentajetbseis" name="Porcentajetbseis" placeholder="Ej. 0%" required>
                </div>
                 <div>
                    <label for="TBsiete">Mujeres de 45 Años en Adelante (TB7):</label>
                    <input type="number" id="TBsiete" name="TBsiete" placeholder="Ej.14,197" required>
                </div>
                 <div>
                    <label for="Porcentajetbsiete">porcentaje que Reprecenta en el Padron:</label>
                    <input type="number" id="Porcentajetbsiete" name="Porcentajetbsiete" placeholder="Ej. 13%" required>
                </div>
                <hr>
                <div>
                    <label>Bajas y Altas al Padron</label><br><br>
                    <label for="BajasTB">Bajas registradas este mes:</label>
                    <input type="number" id="BajasTB" name="BajasTB" placeholder="Ej. 630" required>
                </div>
    
                <div>
                    <label for="AltasTA">Altas registradas este mes:</label>
                    <input type="number" id="AltasTA" name="AltasTA" placeholder="Ej.1,130" required>
                </div>
                <div>
                    <label for="VariacionTV">variación del mes:</label>
                    <input type="number" id="VariacionTV" name="VariacionTV" placeholder="Ej.500" required>
                </div>
                

            

        
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