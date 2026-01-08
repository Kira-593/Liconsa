<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Registro de Subgerencia de Operaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

    <?php
    include "Conexion.php";
    
    // Verificar si el usuario es administrador
    $es_admin = isset($_SESSION['departamento']) && $_SESSION['departamento'] === 'ADMIN';
    
    $ID = $_GET["id"] ?? $_GET["sc"] ?? die("<div class='alert alert-danger'>Error: ID de registro no proporcionado.</div>");
    $query = "SELECT * FROM e_subgerencia_operaciones WHERE id='$ID'"; 
    $res = mysqli_query($link, $query);
    
    if (!$res || mysqli_num_rows($res) == 0) {
        die("<div class='alert alert-danger'>Error: Registro no encontrado.</div>");
    }
    
    $row = mysqli_fetch_array($res);

    // Verificar permisos
    $solo_firma = $row['permitir_firmar'] && !$row['permitir_modificar'];
    $formulario_firmado = !empty($row['firma_usuario']);
    
    // Si solo está permitido firmar y el formulario ya está firmado, y NO es admin: bloquear
    if ($solo_firma && $formulario_firmado && !$es_admin) {
        echo "<script>
            alert('Este formulario ya ha sido firmado y no puede ser modificado.');
            window.location.href = 'MenuModifi.php';
        </script>";
        exit();
    }

    // Si no tiene permisos de modificación ni firma, y NO es admin
    if (!$row['permitir_modificar'] && !$row['permitir_firmar'] && !$es_admin) {
        echo "<script>
            alert('No tienes permisos para modificar o firmar este formulario. Contacta al administrador.');
            window.location.href = 'MenuModifi.php';
        </script>";
        exit();
    }

    // Mostrar alerta si es admin accediendo a un registro firmado
    if ($es_admin && $formulario_firmado) {
        echo "<div class='alert alert-warning'>
            <strong>🔓 Acceso de Administrador</strong><br>
            Como administrador, puedes modificar este formulario firmado y deshacer la firma si es necesario.
        </div>";
    }

    // Mostrar estado de firma si ya está firmado
    if ($formulario_firmado): ?>
        <div class="alert alert-info">
            <strong>✅ Formulario Firmado</strong><br>
            Firmado por: <?= $row['firma_usuario'] ?><br>
            Fecha: <?= $row['fecha_firma'] ?>
        </div>
    <?php endif; ?>
    
    <section class="registro">
        <form action="HacerSubG.php" method="POST" class="needs-validation" id="formulario">
            <input type="hidden" value="<?= $row['id'] ?>" name="id"> 
            
            <div class="registro-container">
                <!-- Columna 1 -->
                <div class="registro-column">
                    <div>
                        <label for="Mes">Mes:</label>
                        <input type="date" id="Mes" name="Mes" value="<?= $row['Mes'] ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    <hr>
                    
                    <h4>Leche Fresca</h4>
                    <div class="mb-3">
                        <label for="LitrosFres">Litros:</label>
                        <input type="number" id="LitrosFres" name="LitrosFres" value="<?= $row['LitrosFres'] ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> placeholder="Litros" required step="any">
                    </div>
                    
                    <div class="mb-3">
                        <label for="SHp">SG Promedio:</label>
                        <input type="number" id="SHp" name="SHp" value="<?= $row['SHp'] ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> placeholder="%" required step="any">
                    </div>
                    
                    <div class="mb-3">
                        <label for="SNGp">SNG Promedio:</label>
                        <input type="number" id="SNGp" name="SNGp" value="<?= $row['SNGp'] ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> placeholder="%" required step="any">
                    </div>
                    
                    <hr>
                    
                    <h4>Leche Abasto Social</h4>
                    <div class="mb-3">
                        <label for="volumenTA">Volumen:</label>
                        <input type="number" id="volumenTA" name="volumenTA" value="<?= $row['volumenTA'] ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> placeholder="Litros" required step="any">
                    </div>
                    
                    <div class="mb-3">
                        <label for="solidosTA">Solidos grasos en producto terminado:</label>
                        <input type="number" id="solidosTA" name="solidosTA" value="<?= $row['solidosTA'] ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> placeholder="Gramos/Litros" required step="any">
                    </div>
                    
                    <hr>
                    
                    <h4>Leche Comercial Frisia</h4>
                    <div class="mb-3">
                        <label for="VolumenTC">Volumen:</label>
                        <input type="number" id="VolumenTC" name="VolumenTC" value="<?= $row['VolumenTC'] ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> placeholder="Litros" required step="any">
                    </div>
                    
                    <div class="mb-3">
                        <label for="TotalTC">% Total de Leche Fresca:</label>
                        <input type="number" id="%TotalTC" name="TotalTC" value="<?= $row['TotalTC'] ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> placeholder="%" required step="any">
                    </div>
                </div>
                
                <!-- Columna 2 -->
                <div class="registro-column">
                    <h4>Producción de Abasto Social</h4>
                    <div class="mb-3">
                        <label for="VolumenTP">Volumen:</label>
                        <input type="number" id="VolumenTP" name="VolumenTP" value="<?= $row['VolumenTP'] ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> placeholder="Litros" required step="any">
                    </div>
                    
                    <div class="mb-3">
                        <label for="LecheTP">Leche Fresca Para Abasto social:</label>
                        <input type="number" id="LecheTP" name="LecheTP" value="<?= $row['LecheTP'] ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> placeholder="Litros" required step="any">
                    </div>
                    
                    <div class="mb-3">
                        <label for="PorsentajeTP">%:</label>
                        <input type="number" id="PorsentajeTP" name="PorsentajeTP" value="<?= $row['PorsentajeTP'] ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> placeholder="%" required step="any">
                    </div>
                    
                    <div class="mb-3">
                        <label for="ProduccionTP">Producción con LPD Estandarizado:</label>
                        <input type="number" id="ProduccionTP" name="ProduccionTP" value="<?= $row['ProduccionTP'] ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> placeholder="Litros" required step="any">
                    </div>
                    
                    <hr>
                    
                    <h4>Estandarización de Leche</h4>
                    <div class="mb-3">
                        <label for="ContenidoTC">Contenido de Solidos Grasos en el Producto Terminado:</label>
                        <input type="number" id="ContenidoTC" name="ContenidoTC" value="<?= $row['ContenidoTC'] ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> placeholder="Gramos/Litros" required step="any">
                    </div>
                    
                    <hr>
                    
                    <h4>Aprovechamiento de la Capacidad Utilizada</h4>
                    <div class="mb-3">
                        <label for="DiasOTD">Dias Operativos:</label>
                        <input type="number" id="DiasOTD" name="DiasOTD" value="<?= $row['DiasOTD'] ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> placeholder="Dias" required step="any">
                    </div>
                    
                    <div class="mb-3">
                        <label for="CapacidadITC">Capacidad Instalada Estandar de Maquina:</label>
                        <input type="number" id="CapacidadITC" name="CapacidadITC" value="<?= $row['CapacidadITC'] ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> placeholder="Litros/Dias" required step="any">
                    </div>
                    
                    <div class="mb-3">
                        <label for="TotalCapacidad">Total Capacidad por Mes:</label>
                        <input type="number" id="TotalCapacidad" name="TotalCapacidad" value="<?= $row['TotalCapacidad'] ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> placeholder="Litros" required step="any">
                    </div>
                </div>
                
                <!-- Columna 3 -->
                <div class="registro-column">
                    <h4>Producción Total</h4>
                    <div class="mb-3">
                        <label for="ProduccionATP">Producción Abasto:</label>
                        <input type="number" id="ProduccionATP" name="ProduccionATP" value="<?= $row['ProduccionATP'] ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> placeholder="Litros" required step="any">
                    </div>
                    
                    <div class="mb-3">
                        <label for="ProduccionFTP">Producción Frisia:</label>
                        <input type="number" id="ProduccionFTP" name="ProduccionFTP" value="<?= $row['ProduccionFTP'] ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> placeholder="Litros" required step="any">
                    </div>
                    
                    <div class="mb-3">
                        <label for="TotalProduccion">Total de Producción por mes:</label>
                        <input type="number" id="TotalProduccion" name="TotalProduccion" value="<?= $row['TotalProduccion'] ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> placeholder="Litros" required step="any">
                    </div>
                    
                    <hr>
                    
                    <h3>Productos de Limpieza Química</h3>
                    <div class="mb-3">
                        <label for="DiasATD">Dias Operativos Acumulados hasta el mes:</label>
                        <input type="number" id="DiasATD" name="DiasATD" value="<?= $row['DiasATD'] ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> placeholder="Dias" required step="any">
                    </div>
                    
                    <h4>Hidróxido de Sodio</h4>
                    <div class="mb-3">
                        <label for="HidroxidoTH">Consumo Mensual:</label>
                        <input type="number" id="HidroxidoTH" name="HidroxidoTH" value="<?= $row['HidroxidoTH'] ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> placeholder="Kg/Mes" required step="any">
                    </div>
                    
                    <div class="mb-3">
                        <label for="TotalATT_Hidroxido">Total Anual:</label>
                        <input type="number" id="TotalATT_Hidroxido" name="TotalATT_Hidroxido" value="<?= $row['TotalATT_Hidroxido'] ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> placeholder="Kg" required step="any">
                    </div>
                    
                    <div class="mb-3">
                        <label for="AcumuladoCTA_Hidroxido">Acumulado consumo diario:</label>
                        <input type="number" id="AcumuladoCTA_Hidroxido" name="AcumuladoCTA_Hidroxido" value="<?= $row['AcumuladoCTA_Hidroxido'] ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> placeholder="Kg" required step="any">
                    </div>
                    
                    <h4>Ácido Fosfórico</h4>
                    <div class="mb-3">
                        <label for="AcidoFTA">Consumo Mensual:</label>
                        <input type="number" id="AcidoFTA" name="AcidoFTA" value="<?= $row['AcidoFTA'] ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> placeholder="Kg/Mes" required step="any">
                    </div>
                    
                    <div class="mb-3">
                        <label for="TotalATT_Acido">Total Anual:</label>
                        <input type="number" id="TotalATT_Acido" name="TotalATT_Acido" value="<?= $row['TotalATT_Acido'] ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> placeholder="Kg" required step="any">
                    </div>
                    
                    <div class="mb-3">
                        <label for="AcumuladoCTA_Acido">Acumulado consumo diario:</label>
                        <input type="number" id="AcumuladoCTA_Acido" name="AcumuladoCTA_Acido" value="<?= $row['AcumuladoCTA_Acido'] ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> placeholder="Kg" required step="any">
                    </div>
                </div>
            </div>
            
            <!-- SECCIÓN DE FIRMA - FUERA DE LAS COLUMNAS -->
            <div class="firma-section mt-4 p-3 border rounded">
                <h4>Firma Digital</h4>
                
                <?php if ($row['permitir_firmar'] && !$formulario_firmado): ?>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="clave_firma">Clave de Firma:</label>
                            <input type="password" id="clave_firma" name="clave_firma" class="form-control" 
                                placeholder="Ingrese su clave única de firma">
                        </div>
                        <div class="col-md-6">
                            <label for="confirmar_clave">Confirmar Clave:</label>
                            <input type="password" id="confirmar_clave" name="confirmar_clave" class="form-control" 
                                placeholder="Confirme su clave de firma">
                        </div>
                    </div>
                    
                    <div class="form-check mb-3">
                        <label class="form-check-label" for="firmar_documento" style="display:inline-flex;align-items:center;gap:6px;cursor:pointer;">
                            <input type="checkbox" id="firmar_documento" name="firmar_documento" class="form-check-input" required>
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

            <div class="form-buttons">
                <?php if (!$formulario_firmado): ?>
                    <input type="submit" name="g" value="Guardar Cambios">
                    <input type="button" value="Limpiar Campos" onclick="limpiarCampos()"
                           <?= ($solo_firma) ? 'disabled' : '' ?>>
                <?php else: ?>
                    <input type="submit" name="g" value="Guardar Cambios" 
                           <?= $es_admin ? '' : 'disabled' ?>>
                    <input type="button" value="Limpiar Campos" onclick="limpiarCampos()"
                           <?= ($solo_firma || !$es_admin) ? 'disabled' : '' ?>>
                    
                    <?php if ($es_admin && $formulario_firmado): ?>
                        <form method="POST" action="HacerSubG.php" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <input type="hidden" name="action" value="undo_signature">
                            <input type="submit" value="Deshacer Firma" class="btn-warning"
                                   onclick="return confirm('¿Estás seguro de que deseas deshacer la firma de este formulario?')">
                        </form>
                    <?php endif; ?>
                    
                    <?php if (!$es_admin): ?>
                        <div class="alert alert-warning mt-3">
                            Este formulario ya ha sido firmado y no puede ser modificado.
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </form>
    </section>
    
    <?php include "Cerrar.php"; ?>
    
    <a href="MenuModifi.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90" alt="Home">
    </a>
</main>
</body>
</html>