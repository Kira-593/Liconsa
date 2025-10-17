<!DOCTYPE html>
<html lang="es">
<head>
	<title>Subgerencia de Operaciones</title>
	<meta charset="UTF-8">
    <script src="../js/cargas.js"></script>
    <script src="../js/SumaAprovechamieto.js"></script>
    <script src="../js/Multiplicaciondias.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/FormSubG.css">
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">
</head>
<body>
<main class="container">

    <h1>Formulario de Subgerencia de Operaciones</h1>
    <section class="registro">
        <form method="post" action="GuardarSubG.php">
        <div class="registro-container">
            <div class="registro-column">
                <div>
                    <label for="Mes">Mes</label>
                    <input type="date" id="Mes" name="Mes" required>
                </div>
                <div>
                    <label>Leche Fresca</label><br><br>
                    <label for="LitrosFres">Litros:</label>
                    <input type="number" id="LitrosFres" name="LitrosFres" placeholder="Litos" required step="any">
                </div>
                <div>
                    <label for="SHp">SG Promedio:</label>
                    <input type="number" id="SHp" name="SHp" placeholder="%" required step="any">
                </div>
                <div>
                    <label for="SNGp">SNG Promedio:</label>
                    <input type="number" id="SNGp" name="SNGp" placeholder="%" required step="any">
                    <hr>
                </div>
                <div>
                    <label>Leche Abasto Social</label><br><br>
                    <label for="volumenTA">Volumen:</label>
                    <input type="number" id="volumenTA" name="volumenTA" placeholder="Litros" required step="any">
                </div>
                 <div>
                    
                    <label for="solidosTA">Solidos grasos en producto terminado:</label>
                    <input type="number" id="solidosTA" name="solidosTA" placeholder="Gramos/Litros" required step="any">
                </div>
                <hr>
                <div>
                    <label>Leche Comercial Frisia</label><br><br>
                    <label for="VolumenTC">Volumen:</label>
                    <input type="number" id="VolumenTC" name="VolumenTC" placeholder="Litros" required step="any">
                </div>
                <div>
                    <label for="%TotalTC">% Total de Leche Fresca:</label>
                    <input type="number" id="%TotalTC" name="%TotalTC" placeholder="%" required step="any">
                </div>
  
                 <hr>
                <div>
                    <label>Produccion de abasto social</label><br><br>
                    <label for="VolumenTP">Volumen:</label>
                    <input type="number" id="VolumenTP" name="VolumenTP" placeholder="Litros" required step="any">
                </div>
               <div>
                    <label for="LecheTP">Leche Fresca Para Abasto social:</label>
                    <input type="number" id="LecheTP" name="LecheTP" placeholder="Litros" required step="any">
                </div>
                 <div>
                    <label for="PorsentajeTP">%:</label>
                    <input type="number" id="PorsentajeTP" name="PorsentajeTP" placeholder="%" required step="any">
                </div>
                 <div>
                    <label for="ProduccionTP">Produccion con LPD Estandarizado</label>
                    <input type="number" id="ProduccionTP" name="ProduccionTP" placeholder="Litros" required step="any">
                </div>
                <hr>
                <div>
                    <label>Estandarización de leche</label><br><br>
                    <label for="ContenidoTC">Contenido de Solidos Grasos en el Producto Terminado:</label>
                    <input type="number" id="ContenidoTC" name="ContenidoTC" placeholder="Gramos/Litros" required step="any">
                </div>
                 <hr>
                <div>
                    <label>Aprovechamiento de la capacidad utilizada</label><br><br>
                    <label for="DiasOTD">Dias Operativos:</label>
                    <input type="number" id="DiasOTD" name="DiasOTD" placeholder="Dias" required step="any">
                </div>
                 <div>
                    <label for="CapacidadITC">Capacidad Instalada Estandar de Maquina:</label>
                    <input type="number" id="CapacidadITC" name="CapacidadITC" placeholder="Litros/Dias" required step="any">
                </div>
                <div>
                    <label for="TotalCapacidad">Total Capacidad por Mes:</label>
                    <input type="number" id="TotalCapacidad" name="TotalCapacidad" placeholder="Litros" required step="any">
                </div>
            
                <div>
                    <label for="ProduccionATP">Producción Abasto:</label>
                    <input type="number" id="ProduccionATP" name="ProduccionATP" placeholder="Litros" required step="any">
                </div>
                 <div>
                    <label for="ProduccionFTP">Producción Frisia:</label>
                    <input type="number" id="ProduccionFTP" name="ProduccionFTP" placeholder="Litros" required step="any">
                </div>
                <div>
                    <label for="TotalProduccion">Total de Producción por mes:</label>
                    <input type="number" id="TotalProduccion" name="TotalProduccion" placeholder="Litros" required step="any">
                </div>
                <hr>
                 <div>
                    <label>Productos Utilizados en la Limpieza Química de Lineas y Equipos de Proceso</label><br><br>
                    <label for="DiasATD">Dias Operativos Acumulados hasta el mes:</label>
                    <input type="number" id="DiasATD" name="DiasATD" placeholder="Dias" required step="any">
                </div>
                <div>
                    <label for="HidroxidoTH">Hidroxido de sodio:</label>
                    <input type="number" id="HidroxidoTH" name="HidroxidoTH" placeholder="Kg/Mes" required step="any">
                </div>
                 <div>
                    <label for="TotalATT">Total Anual:</label>
                    <input type="number" id="TotalATT" name="TotalATT" placeholder="Kg" required step="any">
                </div>
                <div>
                    <label for="AcumuladoCTA">Acumulado consumo diario:</label>
                    <input type="number" id="AcumuladoCTA" name="AcumuladoCTA" placeholder="Kg" required step="any">
                </div>

                <div>
                    <label for="AcidoFTA">Acido Fosfórico:</label>
                    <input type="number" id="AcidoFTA" name="AcidoFTA" placeholder="Kg/Mes" required step="any">
                </div>
                 <div>
                    <label for="TotalATT">Total Anual:</label>
                    <input type="number" id="TotalATT" name="TotalATT" placeholder="Kg" required step="any">
                </div>
                <div>
                    <label for="AcumuladoCTA">Acumulado consumo diario:</label>
                    <input type="number" id="AcumuladoCTA" name="AcumuladoCTA" placeholder="Kg" required step="any">
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