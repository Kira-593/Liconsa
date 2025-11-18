<?php
    // Asegúrate de que este archivo exista y contenga la lógica de conexión a la base de datos
    include "Conexion.php";
    
    // Se usa 'sc' para obtener el ID del registro a modificar
$ID = $_GET["sc"] ?? die("
    <!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><title>Error</title></head><body>
    <div class='container mt-5'><div class='alert alert-danger'>Error: ID de registro (sc) no proporcionado.</div></div>
    </body></html>");      
    // Consulta para obtener los datos existentes de la nueva tabla
    // Se asume el nombre de tabla 'e_subgerencia_operaciones'
    $query = "SELECT * FROM e_subgerencia_operaciones WHERE id='$ID'"; 
    $res = mysqli_query($link, $query);
    
    if (!$res || mysqli_num_rows($res) == 0) {
        die("
        <!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><title>Error</title></head><body>
        <div class='container mt-5'><div class='alert alert-danger'>Error: Registro con ID $ID no encontrado o error en la consulta.</div></div>
        </body></html>");
    }
    
    $row = mysqli_fetch_array($res);

    // Verificar permisos (coincidente con actualizarEnvases.php)
    $solo_firma = !empty($row['permitir_firmar']) && empty($row['permitir_modificar']);
    $formulario_firmado = !empty($row['firma_usuario']);

    // Si solo está permitido firmar y el formulario ya está firmado, bloquear todo
    if ($solo_firma && $formulario_firmado) {
        echo "<script>
            alert('Este formulario ya ha sido firmado y no puede ser modificado.');
            window.location.href = 'MenuModifi.php';
        </script>";
        exit();
    }

    // Si no tiene permisos de modificación ni firma
    if (empty($row['permitir_modificar']) && empty($row['permitir_firmar'])) {
        echo "<script>
            alert('No tienes permisos para modificar o firmar este formulario. Contacta al administrador.');
            window.location.href = 'MenuModifi.php';
        </script>";
        exit();
    }

    include "Cerrar.php";
    ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Registro de Subgerencia de Operaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Se actualizan los scripts y CSS al contexto de Subgerencia -->
    <link rel="stylesheet" href="../css/actualizarSubG.css">
    <script src="../js/cargas.js"></script>
    <script src="../js/limpiar.js"></script>
    <script src="../js/SumaAprovechamieto.js"></script>
    <script src="../js/Multiplicaciondias.js"></script>
    <script src="../js/ValidacionFirma.js"></script>
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">
</head>
<body>
<main class="container">
    
    <h1>Modificar Registro de Subgerencia de Operaciones</h1>
    
    <section class="registro">
    <!-- El formulario envía los datos al script de actualización -->
    <form action="HacerSubG.php" method="POST" class="needs-validation" id="formulario">
            <!-- Campo oculto para pasar el ID del registro a actualizar -->
            <input type="hidden" value="<?= $row['id'] ?>" name="id"> 

            <?php if ($formulario_firmado): ?>
            <div class="alert alert-info">
                <strong>✅ Formulario Firmado</strong><br>
                Firmado por: <?= $row['firma_usuario'] ?><br>
                Fecha: <?= $row['fecha_firma'] ?>
            </div>
            <?php endif; ?>
            
            <div class="registro-container">
                <div class="registro-column">
                    
                    <!-- Mes -->
                    <div>
                        <label for="Mes">Mes:</label>
                        <input type="date" id="Mes" name="Mes" value="<?= $row['Mes'] ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>

                    <!-- Leche Fresca -->
                    <hr>
                    <label>Leche Fresca</label><br><br>
                    <div>
                        <label for="LitrosFres">Litros:</label>
                        <input type="number" id="LitrosFres" name="LitrosFres" value="<?= $row['LitrosFres'] ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="Litros" required step="any">
                    </div>
                    <div>
                        <label for="SHp">SG Promedio:</label>
                        <input type="number" id="SHp" name="SHp" value="<?= $row['SHp'] ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="%" required step="any">
                    </div>
                    <div>
                        <label for="SNGp">SNG Promedio:</label>
                        <input type="number" id="SNGp" name="SNGp" value="<?= $row['SNGp'] ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="%" required step="any">
                    </div>
                    
                    <!-- Leche Abasto Social -->
                    <hr class="my-4">
                    <label class="h5">Leche Abasto Social</label><br><br>
                    <div>
                        <label for="volumenTA">Volumen:</label>
                        <input type="number" id="volumenTA" name="volumenTA" value="<?= $row['volumenTA'] ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="Litros" required step="any">
                    </div>
                    <div>
                        <label for="solidosTA">Solidos grasos en producto terminado:</label>
                        <input type="number" id="solidosTA" name="solidosTA" value="<?= $row['solidosTA'] ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="Gramos/Litros" required step="any">
                    </div>

                    <!-- Leche Comercial Frisia -->
                    <hr class="my-4">
                    <label class="h5">Leche Comercial Frisia</label><br><br>
                    <div>
                        <label for="VolumenTC">Volumen:</label>
                        <input type="number" id="VolumenTC" name="VolumenTC" value="<?= $row['VolumenTC'] ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="Litros" required step="any">
                    </div>
                    <div>
                        <label for="TotalTC">% Total de Leche Fresca:</label>
                        <!-- Se usa TotalTC como el nombre del campo, ya que así aparece en la DB -->
                        <input type="number" id="%TotalTC" name="TotalTC" value="<?= $row['TotalTC'] ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="%" required step="any">
                    </div>
                    
                    <!-- Producción de abasto social -->
                    <hr class="my-4">
                    <label class="h5">Produccion de abasto social</label><br><br>
                    <div>
                        <label for="VolumenTP">Volumen:</label>
                        <input type="number" id="VolumenTP" name="VolumenTP" value="<?= $row['VolumenTP'] ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="Litros" required step="any">
                    </div>
                    <div>
                        <label for="LecheTP">Leche Fresca Para Abasto social:</label>
                        <input type="number" id="LecheTP" name="LecheTP" value="<?= $row['LecheTP'] ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="Litros" required step="any">
                    </div>
                    <div>
                        <label for="PorsentajeTP">%:</label>
                        <input type="number" id="PorsentajeTP" name="PorsentajeTP" value="<?= $row['PorsentajeTP'] ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="%" required step="any">
                    </div>
                    <div>
                        <label for="ProduccionTP">Produccion con LPD Estandarizado</label>
                        <input type="number" id="ProduccionTP" name="ProduccionTP" value="<?= $row['ProduccionTP'] ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="Litros" required step="any">
                    </div>
                    
                    <!-- Estandarización de leche -->
                    <hr class="my-4">
                    <label class="h5">Estandarización de leche</label><br><br>
                    <div>
                        <label for="ContenidoTC">Contenido de Solidos Grasos en el Producto Terminado:</label>
                        <input type="number" id="ContenidoTC" name="ContenidoTC" value="<?= $row['ContenidoTC'] ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="Gramos/Litros" required step="any">
                    </div>
                    
                    <!-- Aprovechamiento de la capacidad utilizada -->
                    <hr class="my-4">
                    <label class="h5">Aprovechamiento de la capacidad utilizada</label><br><br>
                    <div>
                        <label for="DiasOTD">Dias Operativos:</label>
                        <input type="number" id="DiasOTD" name="DiasOTD" value="<?= $row['DiasOTD'] ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="Dias" required step="any">
                    </div>
                    <div>
                        <label for="CapacidadITC">Capacidad Instalada Estandar de Maquina:</label>
                        <input type="number" id="CapacidadITC" name="CapacidadITC" value="<?= $row['CapacidadITC'] ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="Litros/Dias" required step="any">
                    </div>
                    <div>
                        <label for="TotalCapacidad">Total Capacidad por Mes:</label>
                        <input type="number" id="TotalCapacidad" name="TotalCapacidad" value="<?= $row['TotalCapacidad'] ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="Litros" required step="any">
                    </div>
                    <div>
                        <label for="ProduccionATP">Producción Abasto:</label>
                        <input type="number" id="ProduccionATP" name="ProduccionATP" value="<?= $row['ProduccionATP'] ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="Litros" required step="any">
                    </div>
                    <div>
                        <label for="ProduccionFTP">Producción Frisia:</label>
                        <input type="number" id="ProduccionFTP" name="ProduccionFTP" value="<?= $row['ProduccionFTP'] ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="Litros" required step="any">
                    </div>
                    <div>
                        <label for="TotalProduccion">Total de Producción por mes:</label>
                        <input type="number" id="TotalProduccion" name="TotalProduccion" value="<?= $row['TotalProduccion'] ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="Litros" required step="any">
                    </div>
                    
                    <!-- Productos Utilizados en la Limpieza Química -->
                    <hr class="my-4">
                    <label class="h5">Productos Utilizados en la Limpieza Química de Lineas y Equipos de Proceso</label><br><br>
                    <div>
                        <label for="DiasATD">Dias Operativos Acumulados hasta el mes:</label>
                        <input type="number" id="DiasATD" name="DiasATD" value="<?= $row['DiasATD'] ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="Dias" required step="any">
                    </div>

                    <!-- Hidróxido de sodio -->
                    <hr class="my-3">
                    <label class="h6">Hidroxido de sodio</label><br>
                    <div>
                        <label for="HidroxidoTH">Consumo Mensual:</label>
                        <input type="number" id="HidroxidoTH" name="HidroxidoTH" value="<?= $row['HidroxidoTH'] ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="Kg/Mes" required step="any">
                    </div>
                    <div>
                        <label for="TotalATT_Hidroxido">Total Anual:</label>
                        <input type="number" id="TotalATT_Hidroxido" name="TotalATT_Hidroxido" value="<?= $row['TotalATT_Hidroxido'] ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="Kg" required step="any">
                    </div>
                    <div>
                        <label for="AcumuladoCTA_Hidroxido">Acumulado consumo diario:</label>
                        <input type="number" id="AcumuladoCTA_Hidroxido" name="AcumuladoCTA_Hidroxido" value="<?= $row['AcumuladoCTA_Hidroxido'] ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="Kg" required step="any">
                    </div>

                    <!-- Ácido Fosfórico -->
                    <hr class="my-3">
                    <label class="h6">Ácido Fosfórico</label><br>
                    <div>
                        <label for="AcidoFTA">Consumo Mensual:</label>
                        <input type="number" id="AcidoFTA" name="AcidoFTA" value="<?= $row['AcidoFTA'] ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="Kg/Mes" required step="any">
                    </div>
                    <div>
                        <label for="TotalATT_Acido">Total Anual:</label>
                        <input type="number" id="TotalATT_Acido" name="TotalATT_Acido" value="<?= $row['TotalATT_Acido'] ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="Kg" required step="any">
                    </div>
                    <div>
                        <label for="AcumuladoCTA_Acido">Acumulado consumo diario:</label>
                        <input type="number" id="AcumuladoCTA_Acido" name="AcumuladoCTA_Acido" value="<?= $row['AcumuladoCTA_Acido'] ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="Kg" required step="any">
                    </div>
                </div>
            </div>
            
            <!-- SECCIÓN DE FIRMA -->
            <div class="firma-section mt-4 p-3 border rounded">
                <h4>Firma Digital</h4>
                
                <?php if ($row['permitir_firmar'] && !$formulario_firmado): ?>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="clave_firma">Clave de Firma:</label>
                            <input type="password" id="clave_firma" name="clave_firma" class="form-control" 
                                placeholder="Ingrese su clave única de firma" <?= !$row['permitir_firmar'] ? 'readonly' : '' ?>>
                            <small>Ingrese su clave única de firma para validar este formulario.</small>
                        </div>
                        <div class="col-md-6">
                            <label for="confirmar_clave">Confirmar Clave:</label>
                            <input type="password" id="confirmar_clave" name="confirmar_clave" class="form-control" 
                                placeholder="Confirme su clave de firma" <?= !$row['permitir_firmar'] ? 'readonly' : '' ?>>
                        </div>
                    </div>
                    
                    <div class="form-check mb-3">
                        <label class="form-check-label" for="firmar_documento" style="display:inline-flex;align-items:center;gap:6px;cursor:pointer;">
                            <input type="checkbox" id="firmar_documento" name="firmar_documento" class="form-check-input" <?= !$row['permitir_firmar'] ? 'disabled' : '' ?> required>
                            Deseo firmar este documento digitalmente
                        </label>
                    </div>
                <?php elseif ($formulario_firmado): ?>
                    <div class="alert alert-success">
                        <strong>✅ Documento Firmado</strong><br>
                        Este formulario fue firmado por: <strong><?= $row['firma_usuario'] ?></strong><br>
                        Fecha de firma: <strong><?= $row['fecha_firma'] ?></strong>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning">
                        <strong>⚠️ Firma no disponible</strong><br>
                        No tienes permisos para firmar este documento o la firma no está habilitada.
                    </div>
                <?php endif; ?>
            </div>

            <div class="row mt-4">
                <div class="col-12 text-center">
                    <?php if (!$formulario_firmado): ?>
                        <input type="submit" value="Guardar Cambios" class="btn btn-primary me-2" id="btnGuardar">
                        <input type="button" value="Limpiar Campos" class="btn btn-secondary" onclick="limpiarCampos()"
                        <?= ($solo_firma) ? 'disabled' : '' ?>>
                    <?php else: ?>
                        <div class="alert alert-warning">Este formulario ya ha sido firmado y no puede ser modificado.</div>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </section>
    
    <?php include "Cerrar.php"; ?>
    
    <!-- Enlace de regreso al menú de modificación general -->
    <a href="MenuModifi.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90" alt="Home">
    </a>
</main>
</body>
</html>