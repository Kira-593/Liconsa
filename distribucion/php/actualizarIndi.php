<?php
session_start();
// Incluye la conexión a la base de datos
include "Conexion.php";

// 1. Verificar y obtener el ID del registro a modificar
$ID = $_GET["sc"] ?? die("
    <!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><title>Error</title></head><body>
    <div class='container mt-5'><div class='alert alert-danger'>Error: ID de registro (sc) no proporcionado.</div></div>
    </body></html>");

// La tabla para los indicadores de distribución se llama 'distribucion_indicador'
$query = "SELECT * FROM d_indicador WHERE id='$ID'"; 
$res = mysqli_query($link, $query);

if (!$res || mysqli_num_rows($res) == 0) {
    die("
    <!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><title>Error</title></head><body>
    <div class='container mt-5'><div class='alert alert-danger'>Error: Registro con ID $ID no encontrado o error en la consulta.</div></div>
    </body></html>");
}

$row = mysqli_fetch_array($res);

// Verificar permisos
$solo_firma = !empty($row['permitir_firmar']) && empty($row['permitir_modificar']);
$formulario_firmado = !empty($row['firma_usuario']);

// Si solo está permitido firmar y el formulario ya está firmado, bloquear todo
if ($solo_firma && $formulario_firmado) {
    echo "<script>
        alert('Este formulario ya ha sido firmado y no puede ser modificado.');
        window.location.href = 'distribucionP.php';
    </script>";
    include 'Cerrar.php';
    exit();
}

// Si no tiene permisos de modificación ni firma
if (empty($row['permitir_modificar']) && empty($row['permitir_firmar'])) {
    echo "<script>
        alert('No tienes permisos para modificar o firmar este formulario. Contacta al administrador.');
        window.location.href = 'distribucionP.php';
    </script>";
    include 'Cerrar.php';
    exit();
}

// Cierra la conexión después de obtener los datos
include "Cerrar.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Indicadores de Distribución</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/actualizarIndi.css">
    <script src="../js/cargas.js"></script>
    <script src="../js/Indicadores.js"></script>
    <script src="../js/ValidacionFirma.js"></script>
    <script src="../js/limpiar.js"></script>
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">
    
</head>
<body>
<main class="container">
    
    <h1>Indicadores</h1>
    <h4>Actualizar Distribución</h4>
    
    <section class="registro">
        <!-- El formulario envía los datos al script HacerIndi.php -->
        <form action="HacerIndi.php" method="POST" id="formulario">
            <!-- Campo oculto para pasar el ID del registro a actualizar -->
            <input type="hidden" value="<?= $row['id'] ?? '' ?>" name="id"> 

            <?php if ($formulario_firmado): ?>
            <div class="alert alert-info alert-section">
                <strong>✅ Formulario Firmado</strong><br>
                Firmado por: <?= $row['firma_usuario'] ?><br>
                Fecha: <?= $row['fecha_firma'] ?>
            </div>
            <?php endif; ?>
        
            <div class="registro-container">
                <div class="registro-column">
                    
                    <div>
                        <div>
                            <label for="Claveregis">Clave de Registro:</label>
                            <input type="text" id="Claveregis" name="Claveregis" 
                                   value="<?= $row['Claveregis'] ?? '' ?>" 
                                   placeholder="Ingrese la Clave" 
                                   <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                                   required>
                        </div>

                        <label for="Mes">Fecha de Elaboración:</label>
                        <input type="date" id="Mes" name="Mes" 
                               value="<?= $row['Mes'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>

                        <label for="Periodo">Periodo:</label>
                        <input type="date" id="Periodo" name="Periodo" 
                               value="<?= $row['Periodo'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>

                    <div>
                        <hr>
                        <label>Cumplimiento con el Despacho Programado de Leche Liquida P.A.S Tlaxcala</label><br>
                        <hr>

                        <label for="CumplRealProgDia">Cumplimiento Real al Programa Diaria de Despacho:</label>
                        <input type="number" id="CumplRealProgDia" name="CumplRealProgDia" 
                               value="<?= $row['CumplRealProgDia'] ?? '' ?>" 
                               placeholder="Ingrese la cantidad" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required step="any">
                    </div>

                    <div>
                        <label for="ProgDiarioDespacho">Programa Diario de Despacho:</label>
                        <input type="number" id="ProgDiarioDespacho" name="ProgDiarioDespacho" 
                               value="<?= $row['ProgDiarioDespacho'] ?? '' ?>" 
                               placeholder="Ingrese la cantidad" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required step="any">
                    </div>

                    <div>
                        <label for="PCDP">Porcentaje del cumplimiento Con el Despacho Programado:</label>
                        <input type="number" id="PCDP" name="PCDP" 
                               value="<?= $row['PCDP'] ?? '' ?>" 
                               placeholder="Los Puntos son:" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required step="any">
                    </div>

                    <div>
                        <label for="MetaEsperada">Meta Esperada:</label>
                        <input type="text" id="MetaEsperadaMB" name="MetaEsperadaMB" 
                               value="<?= $row['MetaEsperadaMB'] ?? '' ?>" 
                               placeholder="La meta esperada es:" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>

                    <div>
                        <label for="RangoAcept">Rango de Aceptación:</label>
                        <input type="text" id="RangoAceptMB" name="RangoAceptMB" 
                               value="<?= $row['RangoAceptMB'] ?? '' ?>" 
                               placeholder="Ej. 90 a 100 Puntos" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>

                    <div>
                        <label for="TendenciaDeseada">Tendencia Deseada:</label>
                        <input type="text" id="TendenciaDeseadaMB" name="TendenciaDeseadaMB" 
                               value="<?= $row['TendenciaDeseadaMB'] ?? '' ?>" 
                               placeholder="Ej. Alcanzar la meta propuesta" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>

                    <div>
                        <hr>
                        <label>Cumplimiento de Ventas Programadas</label><br>
                        <hr>

                        <label for="Ventatot">Venta Total:</label>
                        <input type="number" id="Ventatot" name="Ventatot" 
                               value="<?= $row['Ventatot'] ?? '' ?>" 
                               placeholder="Ingrese la cantidad" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required step="any">
                    </div>

                    <div>
                        <label for="DotEntre">Dotación Entregada:</label>
                        <input type="number" id="DotEntre" name="DotEntre" 
                               value="<?= $row['DotEntre'] ?? '' ?>" 
                               placeholder="Ingrese la Dotacion Entregada" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required step="any">
                    </div>

                    <div>
                        <label for="CumplimientoVentas">Cumplimiento de Ventas Programadas:</label>
                        <input type="number" id="CumplimientoVentas" name="CumplimientoVentas" 
                               value="<?= $row['CumplimientoVentas'] ?? '' ?>" 
                               placeholder="cumplimiento del:" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required step="any">
                    </div>

                    <div>
                        <label for="MetaEsperadaCVP">Meta Esperada:</label>
                        <input type="text" id="MetaEsperadaCVP" name="MetaEsperadaCVP" 
                               value="<?= $row['MetaEsperadaCVP'] ?? '' ?>" 
                               placeholder="La meta esperada es:" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>

                    <div>
                        <label for="RangoAceptCVP">Rango de Aceptación:</label>
                        <input type="text" id="RangoAceptCVP" name="RangoAceptCVP" 
                               value="<?= $row['RangoAceptCVP'] ?? '' ?>" 
                               placeholder="Ej. 90 a 100 Puntos" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>

                    <div>
                        <label for="TendenciaDeseadaCVP">Tendencia Deseada:</label>
                        <input type="text" id="TendenciaDeseadaCVP" name="TendenciaDeseadaCVP" 
                               value="<?= $row['TendenciaDeseadaCVP'] ?? '' ?>" 
                               placeholder="Ej. Alcanzar la meta propuesta" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>

                    <div>
                        <hr>
                        <label>Control de Envases Rotos...</label><br>
                        <hr>

                        <label for="MermasEnva">Mermas:</label>
                        <input type="number" id="MermasEnva" name="MermasEnva" 
                               value="<?= $row['MermasEnva'] ?? '' ?>" 
                               placeholder="Ingrese la cantidad de mermas" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required step="any">
                    </div>

                    <div>
                        <label for="DotEnva">Dotación:</label>
                        <input type="number" id="DotEnva" name="DotEnva" 
                               value="<?= $row['DotEnva'] ?? '' ?>" 
                               placeholder="Ingrese la Dotación" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required step="any">
                    </div>

                    <div>
                        <label for="CantidadEnvRotos">Cantidad de Envases Rotos:</label>
                        <input type="number" id="CantidadEnvRotos" name="CantidadEnvRotos" 
                               value="<?= $row['CantidadEnvRotos'] ?? '' ?>" 
                               placeholder="Ingrese la cantidad" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required step="any">
                    </div>

                    <div>
                        <label for="MetaEsperadaCER">Meta Esperada:</label>
                        <input type="text" id="MetaEsperadaCER" name="MetaEsperadaCER" 
                               value="<?= $row['MetaEsperadaCER'] ?? '' ?>" 
                               placeholder="La meta esperada es:" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>

                    <div>
                        <label for="RangoAceptCER">Rango de Aceptación:</label>
                        <input type="text" id="RangoAceptCER" name="RangoAceptCER" 
                               value="<?= $row['RangoAceptCER'] ?? '' ?>" 
                               placeholder="Ej. 90 a 100 Puntos" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>

                    <div>
                        <label for="TendenciaDeseadaCER">Tendencia Deseada:</label>
                        <input type="text" id="TendenciaDeseadaCER" name="TendenciaDeseadaCER" 
                               value="<?= $row['TendenciaDeseadaCER'] ?? '' ?>" 
                               placeholder="Ej. Alcanzar la meta propuesta" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>

                    <div>
                        <hr>
                        <label>Devoluciones del P.A.S. Tlaxcala</label><br>
                        <hr>

                        <label for="Devoluciones">Devoluciones:</label>
                        <input type="number" id="Devoluciones" name="Devoluciones" 
                               value="<?= $row['Devoluciones'] ?? '' ?>" 
                               placeholder="Ingrese la cantidad de devoluciones" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required step="any">
                    </div>

                    <div>
                        <label for="DotDev">Dotación:</label>
                        <input type="number" id="DotDev" name="DotDev" 
                               value="<?= $row['DotDev'] ?? '' ?>" 
                               placeholder="Ingrese la Dotación" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required step="any">
                    </div>

                    <div>
                        <label for="DevolucionesDPAS">Devoluciones Del P.A.S. Tlaxcala:</label>
                        <input type="number" id="DevolucionesDPAS" name="DevolucionesDPAS" 
                               value="<?= $row['DevolucionesDPAS'] ?? '' ?>" 
                               placeholder="Ingrese la cantidad" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required step="any">
                    </div>

                    <div>
                        <label for="MetaEsperadaDPAS">Meta Esperada:</label>
                        <input type="text" id="MetaEsperadaDPAS" name="MetaEsperadaDPAS" 
                               value="<?= $row['MetaEsperadaDPAS'] ?? '' ?>" 
                               placeholder="La meta esperada es:" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>

                    <div>
                        <label for="RangoAceptDPAS">Rango de Aceptación:</label>
                        <input type="text" id="RangoAceptDPAS" name="RangoAceptDPAS" 
                               value="<?= $row['RangoAceptDPAS'] ?? '' ?>" 
                               placeholder="Ej. 90 a 100 Puntos" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>

                    <div>
                        <label for="TendenciaDeseadaDPAS">Tendencia Deseada:</label>
                        <input type="text" id="TendenciaDeseadaDPAS" name="TendenciaDeseadaDPAS" 
                               value="<?= $row['TendenciaDeseadaDPAS'] ?? '' ?>" 
                               placeholder="Ej. Alcanzar la meta propuesta" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>

                    <div>
                        <hr>
                        <label>Gastos de Distribución</label><br>
                        <hr>

                        <label for="GastosTD">Gastos Totales de Distribución:</label>
                        <input type="number" id="GastosTD" name="GastosTD" 
                               value="<?= $row['GastosTD'] ?? '' ?>" 
                               placeholder="Ingrese la cantidad de gastos" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required step="any">
                    </div>

                    <div>
                        <label for="LitrosDistribucion">Litros Distribución:</label>
                        <input type="number" id="LitrosDistribucion" name="LitrosDistribucion" 
                               value="<?= $row['LitrosDistribucion'] ?? '' ?>" 
                               placeholder="Ingrese la cantidad de litros" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required step="any">
                    </div>

                    <div>
                        <label for="GastosDistribucion">Gastos de distribución:</label>
                        <input type="number" id="GastosDistribucion" name="GastosDistribucion" 
                               value="<?= $row['GastosDistribucion'] ?? '' ?>" 
                               placeholder="Ingrese la cantidad" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required step="any">
                    </div>

                    <div>
                        <label for="MetaEsperadaGD">Meta Esperada:</label>
                        <input type="text" id="MetaEsperadaGD" name="MetaEsperadaGD" 
                               value="<?= $row['MetaEsperadaGD'] ?? '' ?>" 
                               placeholder="La meta esperada es:" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>

                    <div>
                        <label for="RangoAceptGD">Rango de Aceptación:</label>
                        <input type="text" id="RangoAceptGD" name="RangoAceptGD" 
                               value="<?= $row['RangoAceptGD'] ?? '' ?>" 
                               placeholder="Ej. 90 a 100 Puntos" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>

                    <div>
                        <label for="TendenciaDeseadaGD">Tendencia Deseada:</label>
                        <input type="text" id="TendenciaDeseadaGD" name="TendenciaDeseadaGD" 
                               value="<?= $row['TendenciaDeseadaGD'] ?? '' ?>" 
                               placeholder="Ej. Alcanzar la meta propuesta" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>

                    <div>
                        <hr>
                        <label for="Responsable">Responsable:</label>
                        <input type="text" id="Responsable" name="Responsable" 
                               value="<?= $row['Responsable'] ?? '' ?>" 
                               placeholder="Nombre del responsable" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>

                    <div>
                        <label for="Observ">Observaciones:</label><br><br>
                        <textarea id="Observ" name="Observ" rows="4" 
                                  placeholder="Ej.  En el punto uno, tuvimos un incremento del despacho por 14000 litros" 
                                  <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                                  required><?= $row['Observ'] ?? '' ?></textarea>
                    </div>
                </div>
            </div>
            
            <!-- SECCIÓN DE FIRMA -->
            <div class="firma-section">
                <h4>Firma Digital</h4>
                
                <?php if ($row['permitir_firmar'] && !$formulario_firmado): ?>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="clave_firma">Clave de Firma:</label>
                            <input type="password" id="clave_firma" name="clave_firma" class="form-control" 
                                   placeholder="Ingrese su clave única de firma">
                            <small>Ingrese su clave única de firma para validar este formulario.</small>
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
                    <input type="submit" name="g" value="Guardar Cambios" class="btn btn-primary">
                    <input type="button" value="Limpiar Campos" class="btn btn-secondary" onclick="limpiarCampos()"
                           <?= ($solo_firma) ? 'disabled' : '' ?>>
                <?php else: ?>
                    <div class="alert alert-warning">
                        Este formulario ya ha sido firmado y no puede ser modificado.
                    </div>
                <?php endif; ?>
            </div>
        </form>
    </section>
    
    <a href="distribucionP.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90">
    </a>
</main>

<script>
    // Convertir automáticamente a mayúsculas en los campos relevantes
    (function() {
        function enableUppercase(id) {
            var el = document.getElementById(id);
            if (!el) return;
            el.addEventListener('input', function() {
                var start = this.selectionStart;
                var end = this.selectionEnd;
                this.value = this.value.toUpperCase();
                // intentar restaurar la posición del cursor
                if (typeof this.setSelectionRange === 'function') {
                    this.setSelectionRange(start, end);
                }
            });
        }

        enableUppercase('Claveregis');
        enableUppercase('Responsable');
    })();
</script>

</body>
</html>