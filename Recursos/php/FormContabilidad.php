<!DOCTYPE html>
<html lang="es">
<head>
	<title>Registro</title>
	<meta charset="UTF-8">
    <script src="../js/cargas.js"></script>
    <script src="../js/SumasConta.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/formContabilidad.css">
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
	<img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">	
    
</head>
<body>
<main class="container">

    <h1>Depto. de Contabilidad</h1>
    
    <section class="registro">
        <form method="post" action="GuardarContabilidad.php">
        <div class="registro-container">
            <div class="registro-column">

                <div>
                    <label for="Mes">Mes:</label>
                    <input type="date" id="Mes" name="Mes" required>
                </div>
                <div>
                    <hr>
                    <label>Presupuesto Disponible al cierre</label><br>
                    <hr>
                    <label>Servicios Personales</label><br>
                    <hr>
                    <label>Mano de Obra</label><br>
                    <label for="ComprometidoMAOB">Presupuesto Comprometido:</label>
                    <input type="number" id="ComprometidoMAOB" name="ComprometidoMAOB" placeholder="$" required>
                </div>
                <div>
                    <label for="DisponibleMAOB">Presupuesto Disponible:</label>
                    <input type="number" id="DisponibleMAOB" name="DisponibleMAOB" placeholder="$" required>
                </div>
                <div>
                    <hr>
            
                    <label>Empleados de Confianza</label><br><br>

                    <label for="ComprometidoEMCO">Presupuesto Comprometido:</label>
                    <input type="number" id="ComprometidoEMCO" name="ComprometidoEMCO" placeholder="$" required>
                </div>
                <div>
                    <label for="DisponibleEMCO">Presupuesto Disponible:</label>
                    <input type="number" id="DisponibleEMCO" name="DisponibleEMCO" placeholder="$" required>
                </div>
                <div>
                    <hr>

                    <label>Empleados Eventuales</label><br><br>

                    <label for="ComprometidoEMEV">Presupuesto Comprometido:</label>
                    <input type="number" id="ComprometidoEMEV" name="ComprometidoEMEV" placeholder="$" required>
                </div>
                <div>
                    <label for="DisponibleEMEV">Presupuesto Disponible:</label>
                    <input type="number" id="DisponibleEMEV" name="DisponibleEMEV" placeholder="$" required>
                </div>
                <div>
                    <label for="TPCSEPE">Total de Presupuesto Comprometido de los servicios Personales:</label>
                    <input type="number" id="TPCSEPE" name="TPCSEPE" placeholder="$" required>
                </div>
                 <div>
                    <label for="TPDSEPE">Total de Presupuesto Disponible de los servicios Personales:</label>
                    <input type="number" id="TPDSEPE" name="TPDSEPE" placeholder="$" required>
                </div>
                <div>
                    <br>
                    <hr>
                    <label>Materiales y Suministros</label><br>
                    <hr>
                    
                    <label>Prestaciones en Especie</label><br><br>
                    <label for="ComprometidoPRES">Presupuesto Comprometido:</label>
                    <input type="number" id="ComprometidoPRES" name="ComprometidoPRES" placeholder="$" required>
                </div>
                <div>
                    <label for="DisponiblePRES">Presupuesto Disponible:</label>
                    <input type="number" id="DisponiblePRES" name="DisponiblePRES" placeholder="$" required>
                </div>
                <div>
                    <hr>

                    <label>Materiales de Operación</label><br><br>

                    <label for="ComprometidoMAOP">Presupuesto Comprometido:</label>
                    <input type="number" id="ComprometidoMAOP" name="ComprometidoMAOP" placeholder="$" required>
                </div>
                <div>
                    <label for="DisponibleMAOP">Presupuesto Disponible:</label>
                    <input type="number" id="DisponibleMAOP" name="DisponibleMAOP" placeholder="$" required>
                </div>
                <div>
                    <label for="TPCMASU">Total de Presupuesto Comprometido de los Materiales y Suministros:</label>
                    <input type="number" id="TPCMASU" name="TPCMASU" placeholder="$" required>
                </div>
                 <div>
                    <label for="TPDMASU">Total de Presupuesto Disponible de los Materiales y Suministros:</label>
                    <input type="number" id="TPDMASU" name="TPDMASU" placeholder="$" required>
                </div>
                <div>
                    <br>
                    <hr>
                    <label>Servicios Generales</label><br>
                    <hr>
                    
                    <label>Prestaciones en Empleados</label><br><br>
                    <label for="ComprometidoPREM">Presupuesto Comprometido:</label>
                    <input type="number" id="ComprometidoPREM" name="ComprometidoPREM" placeholder="$" required>
                </div>
                <div>
                    <label for="DisponiblePREM">Presupuesto Disponible:</label>
                    <input type="number" id="DisponiblePREM" name="DisponiblePREM" placeholder="$" required>
                </div>
                <div>
                    <hr>

                    <label>Mantenimiento y Conservación</label><br><br>

                    <label for="ComprometidoMACO">Presupuesto Comprometido:</label>
                    <input type="number" id="ComprometidoMACO" name="ComprometidoMACO" placeholder="$" required>
                </div>
                <div>
                    <label for="DisponibleMACO">Presupuesto Disponible:</label>
                    <input type="number" id="DisponibleMACO" name="DisponibleMACO" placeholder="$" required>
                </div>
                <div>
                    <hr>

                    <label>Impuestos y Derechos</label><br><br>

                    <label for="ComprometidoIMDE">Presupuesto Comprometido:</label>
                    <input type="number" id="ComprometidoIMDE" name="ComprometidoIMDE" placeholder="$" required>
                </div>
                <div>
                    <label for="DisponibleIMDE">Presupuesto Disponible:</label>
                    <input type="number" id="DisponibleIMDE" name="DisponibleIMDE" placeholder="$" required>
                </div>
                <div>
                    <hr>

                    <label>Seguros y Finanzas</label><br><br>

                    <label for="ComprometidoSEFI">Presupuesto Comprometido:</label>
                    <input type="number" id="ComprometidoSEFI" name="ComprometidoSEFI" placeholder="$" required>
                </div>
                <div>
                    <label for="DisponibleSEFI">Presupuesto Disponible:</label>
                    <input type="number" id="DisponibleSEFI" name="DisponibleSEFI" placeholder="$" required>
                </div>
                <div>
                    <hr>

                    <label>Servicios Basicos, Asesorias y Consultas</label><br><br>

                    <label for="ComprometidoSERBA">Presupuesto Comprometido:</label>
                    <input type="number" id="ComprometidoSERBA" name="ComprometidoSERBA" placeholder="$" required>
                </div>
                <div>
                    <label for="DisponibleSERBA">Presupuesto Disponible:</label>
                    <input type="number" id="DisponibleSERBA" name="DisponibleSERBA" placeholder="$" required>
                </div>
                <div>
                    <hr>

                    <label>Transportación</label><br><br>

                    <label for="ComprometidoTRAN">Presupuesto Comprometido:</label>
                    <input type="number" id="ComprometidoTRAN" name="ComprometidoTRAN" placeholder="$" required>
                </div>
                <div>
                    <label for="DisponibleTRAN">Presupuesto Disponible:</label>
                    <input type="number" id="DisponibleTRAN" name="DisponibleTRAN" placeholder="$" required>
                </div>
                <div>
                    <hr>

                    <label>Gastos por Reuniones de consejo y Comités</label><br><br>

                    <label for="ComprometidoGARE">Presupuesto Comprometido:</label>
                    <input type="number" id="ComprometidoGARE" name="ComprometidoGARE" placeholder="$" required>
                </div>
                <div>
                    <label for="DisponibleGARE">Presupuesto Disponible:</label>
                    <input type="number" id="DisponibleGARE" name="DisponibleGARE" placeholder="$" required>
                </div>
                <div>
                    <label for="TPCSEGE">Total de Presupuesto Comprometido de los servicios Generales:</label>
                    <input type="number" id="TPCSEGE" name="TPCSEGE" placeholder="$" required>
                </div>
                 <div>
                    <label for="TPDSEGE">Total de Presupuesto Disponible de los servicios Generales:</label>
                    <input type="number" id="TPDSEGE" name="TPDSEGE" placeholder="$" required>
                </div>
                <div>
                    <hr>
                    <label>Ventas, Costos, Gastos, Perdida o Utilidad</label><br>
                    
                    <hr>
                    <label>Recursos Fiscales Mensuales</label><br><br>
                    <label for="ComprometidoVentas">Se Recibió:</label>
                    <input type="number" id="ComprometidoVentas" name="ComprometidoVentas" placeholder="$" required>
                </div>
                <div>
                    <label for="ObservacionesVentas">Observaciones Acerca de ventas, Costos y Gastos:</label><br><br>
                    <textarea id="ObservacionesVentas" name="ObservacionesVentas" rows="4" placeholder="Ej. Se Presenta una Utilidad por $4,927,293 Pesos al 31 del Mes" required></textarea>
                </div>
                <div>
                    <hr>
                    <label>Concentrado de Costo y Fijo Mensuales</label><br>
                    <hr>
                    <label>Leche Fluida Parcialmente Descremada Fortificada Tipo A-RG</label><br><br>
                    <label for="CostoVLF">Costo Variable:</label>
                    <input type="number" id="CostoVLF" name="CostoVLF" placeholder="$" required>
                </div>
                <div>
                    <label for="CostoFLF">Costo Fijo:</label>
                    <input type="number" id="CostoFLF" name="CostoFLF" placeholder="$" required>
                </div>
                <div>
                    <hr>
                    <label>Mezcla de Leche con Grasa Vegetal Pasteurizada Tipo B-RG</label><br><br>
                    <label for="CostoVMG">Costo Variable:</label>
                    <input type="number" id="CostoVMG" name="CostoVMG" placeholder="$" required>
                </div>
                <div>
                    <label for="CostoFMG">Costo Fijo:</label>
                    <input type="number" id="CostoFMG" name="CostoFMG" placeholder="$" required>
                </div>
                <div>
                    <hr>
                    <label>Leche "Frisia"</label><br><br>
                    <label for="CostoVLFRI">Costo Variable:</label>
                    <input type="number" id="CostoVLFRI" name="CostoVLFRI" placeholder="$" required>
                </div>
                <div>
                    <label for="CostoFLFRI">Costo Fijo:</label>
                    <input type="number" id="CostoFLFRI" name="CostoFLFRI" placeholder="$" required>
                </div>
                 
            </div>
             </div>
                <div class="form-buttons">
                <input type="submit" name="g" value="Guardar" class="btn">
                <input type="button" name="b" value="Limpiar" class="btn" onclick="limpiarCampos()">
            </div>
            
        </form>
    </section>
    <a href="TipoFormulario.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90">
    </a>
</main>

</body>
</html>