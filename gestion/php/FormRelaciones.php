<!DOCTYPE html>
<html lang="es">
<head>
	<title>Registro</title>
	<meta charset="UTF-8">
    <script src="../js/cargas.js"></script>
    <script src="../js/SumaT.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/formRelaciones.css">
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
	<img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">	
    
</head>
<body>
<main class="container">

    <h1>Relaciones Industriales</h1>
    
    <section class="registro">
        <form method="post" action="Guardar.php">
        <div class="registro-container">
            <div class="registro-column">
                <div>
                    <label for="Mes">Mes:</label>
                    <input type="date" id="Mes" name="Mes" required>
                </div>
               <div>
                    <hr>
                    <label>Plantilla de Personal</label><br>
                    <hr>
                    <label for="NumeroTrabajadores">Numero de Trabajadores:</label>
                    <input type="text" id="NumeroTrabajadores" name="NumeroTrabajadores" placeholder="EJ. 118 Personas" required>
                </div>
                 <div>
                    <label for="TrabajadoresH">Cantidad de Trabajadores Hombres:</label>
                    <input type="text" id="TrabajadoresH" name="TrabajadoresH" placeholder="EJ. 87 Hombres" required>
                </div>
                <div>
                    <label for="HombresConfianza">Cantidad de Hombres de Confianza:</label>
                    <input type="text" id="HombresConfianza" name="HombresConfianza" placeholder="EJ. 87 Hombres" required>
                </div>
                <div>
                    <label for="HombresSindicato">Cantidad de Hombres de Sindicato:</label>
                    <input type="text" id="HombresSindicato" name="HombresSindicato" placeholder="EJ. 87 Hombres" required>
                </div>
                 <div>
                    <label for="TrabajadoresM">Cantidad de Trabajadoras Mujeres:</label>
                    <input type="text" id="TrabajadoresM" name="TrabajadoresM" placeholder="EJ. 87 Mujeres" required>
                </div>
                <div>
                    <label for="MujeresConfianza">Cantidad de Mujeres de Confianza:</label>
                    <input type="text" id="MujeresConfianza" name="MujeresConfianza" placeholder="EJ. 87 Mujeres" required>
                </div>
                <div>
                    <label for="MujeresSindicato">Cantidad de Mujeres de Sindicato:</label>
                    <input type="text" id="MujeresSindicato" name="MujeresSindicato" placeholder="EJ. 87 Mujeres    " required>
                </div>
                <div>
                    <label for="TrabajadoresConfianza">Cantidad De Trabajadores de Confianza:</label>
                    <input type="text" id="TrabajadoresConfianza" name="TrabajadoresConfianza" placeholder="EJ. 57 Trabajadores" required>
                </div>
                <div>
                    <label for="TrabajadoresSindicato">Cantidad De Trabajadores de Sindicato:</label>
                    <input type="text" id="TrabajadoresSindicato" name="TrabajadoresSindicato" placeholder="EJ. 57 Trabajadores" required>
                </div>
                <div>
                    <label for="Vacantes">Numero Total de Plazas Ocupadas:</label>
                    <input type="text" id="NumeroPlazasOcupadas" name="NumeroPlazasOcupadas" placeholder="EJ. 117 Plazas" required>
                </div>
                <div>
                    <label for="VacantesTV">Vacantes:</label><br><br>
                    <textarea id="VacantesTV" name="VacantesTV" rows="4" placeholder="Ej. Jefe Operativo, Renuncia Voluntaria 11/09/2025" required></textarea>
                </div>
                <div>
                    <label for="IncapacidadesTI">Incapacidades (Nombre, Personal, Dias, Fecha inicio, Fecha de Termino, Folio):</label><br><br>
                    <textarea id="IncapacidadesTI" name="IncapacidadesTI" rows="4" placeholder="Ej. Abraham Rojas, Auxiliar, 5 dias, 01/09/2025, 06/09/2025, Folio:12345" required></textarea>
                </div>
                
                
        </div>
         </div>
                <div class="form-buttons">
                <input type="submit" name="g" value="Guardar">
                <input type="reset" name="b" value="Limpiar">
            </div>
                
        </form>
        
    </section>
    <a href="GestionP.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90">
    </a>
</main>

</body>
</html>