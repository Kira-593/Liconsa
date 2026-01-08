<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Modificar Relaciones Industriales</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/cargas.js"></script>
    <script src="../js/SumaT.js"></script>
    <script src="../js/limpiar.js"></script> 
    <script src="../js/ValidacionFirma.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/actualizarRelaciones.css">
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC"> 
</head>
<body>
<main class="container">

    <h1>Modificar Registro de Relaciones Industriales</h1>

    <?php
    include "Conexion.php";
    
    $es_admin = isset($_SESSION['departamento']) && $_SESSION['departamento'] === 'ADMIN';
    
    $ID = $_GET["id"] ?? $_GET["sc"] ?? die("<div class='alert alert-danger'>Error: ID de registro no proporcionado.</div>");
    $query = "SELECT * FROM g_relacionesindustriales WHERE id='$ID'"; 
    $res = mysqli_query($link, $query);
    
    if (!$res || mysqli_num_rows($res) == 0) {
        die("<div class='alert alert-danger'>Error: Registro no encontrado.</div>");
    }
    
    $row = mysqli_fetch_array($res);

    $solo_firma = $row['permitir_firmar'] && !$row['permitir_modificar'];
    $formulario_firmado = !empty($row['firma_usuario']);
    
    if ($solo_firma && $formulario_firmado && !$es_admin) {
        echo "<script>
            alert('Este formulario ya ha sido firmado y no puede ser modificado.');
            window.location.href = 'gestionP.php';
        </script>";
        exit();
    }

    if (!$row['permitir_modificar'] && !$row['permitir_firmar'] && !$es_admin) {
        echo "<script>
            alert('No tienes permisos para modificar o firmar este formulario. Contacta al administrador.');
            window.location.href = 'gestionP.php';
        </script>";
        exit();
    }

    if ($es_admin && $formulario_firmado) {
        echo "<div class='alert alert-warning'>
            <strong>🔓 Acceso de Administrador</strong><br>
            Como administrador, puedes modificar este formulario firmado y deshacer la firma si es necesario.
        </div>";
    }

    if ($formulario_firmado): ?>
        <div class="alert alert-info">
            <strong>✅ Formulario Firmado</strong><br>
            Firmado por: <?= $row['firma_usuario'] ?><br>
            Fecha: <?= $row['fecha_firma'] ?>
        </div>
    <?php endif; ?>
    
    <section class="registro">
        <form method="post" action="HacerRelaciones.php" class="needs-validation" id="formulario">
            <input type="hidden" value="<?= $row['id'] ?? '' ?>" name="id"> 
            
            <div class="registro-container">
                <!-- Columna 1 -->
                <div class="registro-column">
                    <div>
                        <label for="Mes">Mes:</label>
                        <input type="date" id="Mes" name="Mes" value="<?= $row['Mes'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> required>
                    </div>
                    
                    <hr>
                    
                    <h4>Plantilla de Personal</h4>
                    
                    <div>
                        <label for="NumeroTrabajadores">Numero de Trabajadores:</label>
                        <input type="number" id="NumeroTrabajadores" name="NumeroTrabajadores" 
                               value="<?= $row['NumeroTrabajadores'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> 
                               placeholder="EJ. 118" required>
                    </div>
                    
                    <div>
                        <label for="TrabajadoresH">Cantidad de Trabajadores Hombres:</label>
                        <input type="number" id="TrabajadoresH" name="TrabajadoresH" 
                               value="<?= $row['TrabajadoresH'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> 
                               placeholder="EJ. 87" required>
                    </div>
                    
                    <div>
                        <label for="HombresConfianza">Cantidad de Hombres de Confianza:</label>
                        <input type="number" id="HombresConfianza" name="HombresConfianza" 
                               value="<?= $row['HombresConfianza'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> 
                               placeholder="EJ. 87" required>
                    </div>
                    
                    <div>
                        <label for="HombresSindicato">Cantidad de Hombres de Sindicato:</label>
                        <input type="number" id="HombresSindicato" name="HombresSindicato" 
                               value="<?= $row['HombresSindicato'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> 
                               placeholder="EJ. 87" required>
                    </div>
                    
                    <div>
                        <label for="TrabajadoresM">Cantidad de Trabajadoras Mujeres:</label>
                        <input type="number" id="TrabajadoresM" name="TrabajadoresM" 
                               value="<?= $row['TrabajadoresM'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> 
                               placeholder="EJ. 87" required>
                    </div>
                    
                    <div>
                        <label for="MujeresConfianza">Cantidad de Mujeres de Confianza:</label>
                        <input type="number" id="MujeresConfianza" name="MujeresConfianza" 
                               value="<?= $row['MujeresConfianza'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> 
                               placeholder="EJ. 87" required>
                    </div>
                </div>
                
                <!-- Columna 2 -->
                <div class="registro-column">
                    <div>
                        <label for="MujeresSindicato">Cantidad de Mujeres de Sindicato:</label>
                        <input type="number" id="MujeresSindicato" name="MujeresSindicato" 
                               value="<?= $row['MujeresSindicato'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> 
                               placeholder="EJ. 87" required>
                    </div>
                    
                    <div>
                        <label for="TrabajadoresConfianza">Cantidad De Trabajadores de Confianza:</label>
                        <input type="number" id="TrabajadoresConfianza" name="TrabajadoresConfianza" 
                               value="<?= $row['TrabajadoresConfianza'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> 
                               placeholder="EJ. 57" required>
                    </div>
                    
                    <div>
                        <label for="TrabajadoresSindicato">Cantidad De Trabajadores de Sindicato:</label>
                        <input type="number" id="TrabajadoresSindicato" name="TrabajadoresSindicato" 
                               value="<?= $row['TrabajadoresSindicato'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> 
                               placeholder="EJ. 57" required>
                    </div>
                    
                    <div>
                        <label for="NumeroPlazasOcupadas">Numero Total de Plazas Ocupadas:</label>
                        <input type="number" id="NumeroPlazasOcupadas" name="NumeroPlazasOcupadas" 
                               value="<?= $row['NumeroPlazasOcupadas'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?> 
                               placeholder="EJ. 117" required>
                    </div>
                    
                    <div>
                        <label for="VacantesTV">Vacantes:</label>
                        <textarea id="VacantesTV" name="VacantesTV" rows="3" 
                                  <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                                  placeholder="Ej. Jefe Operativo, Renuncia Voluntaria 11/09/2025" required><?= $row['VacantesTV'] ?? '' ?></textarea>
                    </div>
                    
                    <div>
                        <label for="IncapacidadesTI">Incapacidades (Nombre, Personal, Dias, Fecha inicio, Fecha de Termino, Folio):</label>
                        <textarea id="IncapacidadesTI" name="IncapacidadesTI" rows="3" 
                                  <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                                  placeholder="Ej. Abraham Rojas, Auxiliar, 5 dias, 01/09/2025, 06/09/2025, Folio:12345" required><?= $row['IncapacidadesTI'] ?? '' ?></textarea>
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
                        <form method="POST" action="HacerRelaciones.php" style="display:inline;">
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
    
    <a href="GestionP.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90">
    </a>
</main>
</body>
</html>