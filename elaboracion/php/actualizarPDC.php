<?php
// Incluye la conexión a la base de datos
include "Conexion.php";

// 1. Verificar y obtener el ID del registro a modificar
// Se usa 'sc' para obtener el ID, como en el ejemplo proporcionado.
$ID = $_GET["sc"] ?? die("
    <!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><title>Error</title></head><body>
    <div class='container mt-5'><div class='alert alert-danger'>Error: ID de registro (sc) no proporcionado.</div></div>
    </body></html>");

// Asumimos que la tabla para las ventas de leche se llama 'a_ventaleche'
$query = "SELECT * FROM e_pdc WHERE id='$ID'"; 
$res = mysqli_query($link, $query);

if (!$res || mysqli_num_rows($res) == 0) {
    die("
    <!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><title>Error</title></head><body>
    <div class='container mt-5'><div class='alert alert-danger'>Error: Registro con ID $ID no encontrado o error en la consulta.</div></div>
    </body></html>");
}

$row = mysqli_fetch_array($res);

// Verificar permisos (misma lógica que en actualizarMaterial)
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
// Cierra la conexión después de obtener los datos
include "Cerrar.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Producción</title>
    <!-- Se actualiza la ruta del CSS y los scripts para reflejar el contexto de Producción -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/actualizarPDC.css">
    <script src="../js/cargas.js"></script>
    <script src="../js/SumaT.js"></script>
    <script src="../js/limpiar.js"></script>
    <script src="../js/ValidacionFirma.js"></script>
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC"> 
</head>
<body>
<main class="container">
    
    <h1>Modificar Registro de Producción</h1>
    
    <section class="registro">
        <!-- El formulario envía los datos al script HacerPDC.php (creado en la respuesta anterior) -->
        <form action="HacerPDC.php" method="POST" class="needs-validation" id="formulario">
            <!-- Campo oculto para pasar el ID del registro a actualizar -->
            <input type="hidden" value="<?= $row['id'] ?? '' ?>" name="id"> 

            <?php if ($formulario_firmado): ?>
            <div class="alert alert-info">
                <strong>✅ Formulario Firmado</strong><br>
                Firmado por: <?= $row['firma_usuario'] ?><br>
                Fecha: <?= $row['fecha_firma'] ?>
            </div>
            <?php endif; ?>
        
            <div class="registro-container">
                <div class="registro-column">
                    
                    <div>
                        <label for="Indicador">Indicador</label>
                        <select id="Indicador" name="Indicador" <?= ($solo_firma  || $formulario_firmado) ? 'disabled' : '' ?>  required>
                             <!-- Preselecciona la opción actual -->
                            <option value="Leche Frisia" <?= ($row['Indicador'] == 'Leche Frisia') ? 'selected' : '' ?>>Leche Frisia</option>
                            <option value="Leche de Abasto" <?= ($row['Indicador'] == 'Leche de Abasto') ? 'selected' : '' ?>>Leche de Abasto</option>
                        </select>
                    </div>

                    <div>
                        <label for="Mes">Mes:</label>
                        <input type="date" id="Mes" name="Mes" value="<?= $row['Mes'] ?? '' ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> required>
                    </div>
                    
                    <div>
                        <label>Productos</label><br><br>
                        
                        <div>
                            <label for="Leche_Frisia">Leche Frisia:</label>
                            <!-- Carga el valor actual de la base de datos -->
                            <input type="number" id="Leche_Frisia" name="Leche_Frisia" value="<?= $row['Leche_Frisia'] ?? '' ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="Litros" required step="any">
                        </div>
                        
                        <div>
                            <label for="Leche_Abasto">Leche de Abasto:</label>
                            <!-- Carga el valor actual de la base de datos -->
                            <input type="number" id="Leche_Abasto" name="Leche_Abasto" value="<?= $row['Leche_Abasto'] ?? '' ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="Litros" required step="any">
                        </div>
                        
                        <div>
                            <label for="Total">Total:</label>
                            <!-- Carga el valor actual de la base de datos -->
                            <input type="number" id="Total" name="Total" value="<?= $row['Total'] ?? '' ?>" <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?> placeholder="Litros" required step="any">
                        </div>
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
    
    <a href="MenuModifi.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90" alt="Home">
    </a>
</main>
</body>
</html>
