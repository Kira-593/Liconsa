<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Indicadores de Elaboración</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/actualizarindi.css">
    <script src="../js/cargas.js"></script>
    <script src="../js/Indicadores.js"></script>
    <script src="../js/ValidacionFirma.js"></script>
    <script src="../js/limpiar.js"></script>
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">
    
</head>
<body>
<main class="container">
    
    <h1>Actualizar Indicadores de Elaboración</h1>
    <h4>Elaboración</h4>
    
     <?php
    include "Conexion.php";
    
    // Verificar si el usuario es administrador
    $es_admin = isset($_SESSION['departamento']) && $_SESSION['departamento'] === 'ADMIN';
    
    $ID = $_GET["id"] ?? $_GET["sc"] ?? die("<div class='alert alert-danger'>Error: ID de registro no proporcionado.</div>");
    $query = "SELECT * FROM e_indicador WHERE id='$ID'"; 
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
            window.location.href = 'MenuIndi.php';
        </script>";
        exit();
    }

    // Si no tiene permisos de modificación ni firma, y NO es admin
    if (!$row['permitir_modificar'] && !$row['permitir_firmar'] && !$es_admin) {
        echo "<script>
            alert('No tienes permisos para modificar o firmar este formulario. Contacta al administrador.');
            window.location.href = 'MenuIndi.php';
        </script>";
        exit();
    }

    // Mostrar alerta si es admin accediendo a un registro firmado
    if ($es_admin && $formulario_firmado) {
        echo "<div class='alert alert-warning alert-section'>
            <strong>🔓 Acceso de Administrador</strong><br>
            Como administrador, puedes modificar este formulario firmado y deshacer la firma si es necesario.
        </div>";
    }

    // Mostrar estado de firma si ya está firmado
    if ($formulario_firmado): ?>
        <div class="alert alert-info alert-section">
            <strong>✅ Formulario Firmado</strong><br>
            Firmado por: <?= $row['firma_usuario'] ?><br>
            Fecha: <?= $row['fecha_firma'] ?>
        </div>
    <?php endif; ?>
    
    <section class="registro">
        <!-- El formulario envía los datos al script HacerElaboracion.php -->
        <form action="HacerIndi.php" method="POST" id="formulario">
            <!-- Campo oculto para pasar el ID del registro a actualizar -->
            <input type="hidden" value="<?= $row['id'] ?? '' ?>" name="id"> 
        
            <div class="registro-container">
                <div class="registro-column">
                    
                    <div>
                        <div>
                            <label for="Claveregis">Clave de Registro:</label>
                            <input type="text" id="Claveregis" name="Claveregis" 
                                   value="<?= $row['Claveregis'] ?? '' ?>" 
                                   placeholder="Ingrese la Clave" 
                                   <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                                   required>
                        </div>
                        <label for="Mes">Fecha de Elaboración:</label>
                        <input type="date" id="Mes" name="Mes" 
                               value="<?= $row['Mes'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               required>
                        
                        <label for="Periodo">Periodo:</label>
                        <input type="date" id="Periodo" name="Periodo" 
                               value="<?= $row['Periodo'] ?? '' ?>" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               required>
                    </div>
                    
                    <!-- Cumplimiento al Programa de Distribución Mensual de Leche -->
                    <div>
                        <hr>
                        <label>Cumplimiento al Programa de Distribución Mensual de Leche del Programa de Abasto Social</label><br>
                        <hr>
                        <label for="DBPAS">Despacho Brutos del Programa de Abasto Social:</label>
                        <input type="number" id="DBPAS" name="DBPAS" 
                               value="<?= $row['DBPAS'] ?? '' ?>" 
                               placeholder="Litros de leche" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               required step="any">
                    </div>
                    <div>
                        <label for="PDOACP">Programa de Despacho Original Autorizado Por el Comite de Producción, Distribución y Comercialización y Abasto:</label>
                        <input type="number" id="PDOACP" name="PDOACP" 
                               value="<?= $row['PDOACP'] ?? '' ?>" 
                               placeholder="Litros de Leche" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               required step="any">
                    </div>
                    <div>
                        <label for="LRAPMDOL">Litros Resultantes del Ajuste al Programa Mensual de Distribución Original de leche (+-):</label>
                        <input type="number" id="LRAPMDOL" name="LRAPMDOL" 
                               value="<?= $row['LRAPMDOL'] ?? '' ?>" 
                               placeholder="(+-) Litros de Leche" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               required step="any">
                    </div>
                    <div>
                        <label for="PC">Porcentaje de Cumplimiento:</label>
                        <input type="number" id="PC" name="PC" 
                               value="<?= $row['PC'] ?? '' ?>" 
                               placeholder="Porcentaje de Cumplimiento" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               required step="any">
                    </div>
                    <div>
                        <label for="MetaEsperadaDMLPS">Meta Esperada:</label>
                        <textarea id="MetaEsperadaDMLPS" name="MetaEsperadaDMLPS"   
                                  placeholder="La meta esperada es:" 
                                  <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                                  required><?= $row['MetaEsperadaDMLPS'] ?? '' ?></textarea>
                    </div>
                    <div>
                        <label for="RangoAceptDMLPS">Rango de Aceptación:</label>
                        <input type="text" id="RangoAceptDMLPS" name="RangoAceptDMLPS" 
                               value="<?= $row['RangoAceptDMLPS'] ?? '' ?>" 
                               placeholder="Ej. minimo 100%" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="TendenciaDeseadaDMLPS">Tendencia Deseada:</label>
                        <input type="text" id="TendenciaDeseadaDMLPS" name="TendenciaDeseadaDMLPS" 
                               value="<?= $row['TendenciaDeseadaDMLPS'] ?? '' ?>" 
                               placeholder="Ej. mensual" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               required>
                    </div>
                    
                    <!-- Entrega de Producto no Cubiertas -->
                    <div>
                        <hr>
                        <label>Entrega de Producto no Cubiertas por Factores Imputable a la operación de Plantas</label><br>
                        <hr>
                        <label for="CDLPAS">Cifra Generadora Directa: Leche del Programa de Abasto Social no Entregada a Distribución por Factores Atribuibles o Imputables a la Operación de Planta:</label>
                        <input type="number" id="CDLPAS" name="CDLPAS" 
                               value="<?= $row['CDLPAS'] ?? '' ?>" 
                               placeholder="Ej. 0" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               required step="any">
                    </div>
                    <div>
                        <label for="MetaEsperadaEPNC">Meta Esperada:</label>
                        <textarea id="MetaEsperadaEPNC" name="MetaEsperadaEPNC" 
                                  placeholder="La meta esperada es:" 
                                  <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                                  required><?= $row['MetaEsperadaEPNC'] ?? '' ?></textarea>
                    </div>
                    <div>
                        <label for="RangoAceptEPNC">Rango de Aceptación:</label>
                        <input type="text" id="RangoAceptEPNC" name="RangoAceptEPNC" 
                               value="<?= $row['RangoAceptEPNC'] ?? '' ?>" 
                               placeholder="Ej. Maximo 0" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="TendenciaDeseadaEPNC">Tendencia Deseada:</label>
                        <input type="text" id="TendenciaDeseadaEPNC" name="TendenciaDeseadaEPNC" 
                               value="<?= $row['TendenciaDeseadaEPNC'] ?? '' ?>" 
                               placeholder="Ej. mensual" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               required>
                    </div>
                    
                    <!-- Cumplimiento Con la Producción Solicitada -->
                    <div>
                        <hr>
                        <label>Cumplimiento Con la Producción Solicitada en el Programa de Distribución</label><br>
                        <hr>
                        <label for="DespaReal">Despacho Real:</label>
                        <input type="number" id="DespaReal" name="DespaReal" 
                               value="<?= $row['DespaReal'] ?? '' ?>" 
                               placeholder="Litros de leche" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               required step="any">
                    </div>
                    <div>
                        <label for="DespaProg">Despacho Programado:</label>
                        <input type="number" id="DespaProg" name="DespaProg" 
                               value="<?= $row['DespaProg'] ?? '' ?>" 
                               placeholder="Litros de Leche" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               required step="any">
                    </div>
                    <div>
                        <label for="LechePrograma">Litros de Leche del Programa de Producción:</label>
                        <input type="number" id="LechePrograma" name="LechePrograma" 
                               value="<?= $row['LechePrograma'] ?? '' ?>" 
                               placeholder="Litros de Leche" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               required step="any">
                    </div>
                    <div>
                        <label for="PorcentajeProduccion">Porcentaje de Producción de leche:</label>
                        <input type="number" id="PorcentajeProduccion" name="PorcentajeProduccion" 
                               value="<?= $row['PorcentajeProduccion'] ?? '' ?>" 
                               placeholder="Litros de Leche" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               required step="any">
                    </div>
                    <div>
                        <label for="PPL">Porcentaje de Cumplimiento de Con la Producción Solicitada:</label>
                        <input type="number" id="PPL" name="PPL" 
                               value="<?= $row['PPL'] ?? '' ?>" 
                               placeholder="Litros de Leche" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               required step="any">
                    </div>
                    <div>
                        <label for="MetaEsperadaCPSP">Meta Esperada:</label>
                        <textarea id="MetaEsperadaCPSP" name="MetaEsperadaCPSP" 
                                  placeholder="La meta esperada es:" 
                                  <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                                  required><?= $row['MetaEsperadaCPSP'] ?? '' ?></textarea>
                    </div>
                    <div>
                        <label for="RangoAceptCPSP">Rango de Aceptación:</label>
                        <input type="text" id="RangoAceptCPSP" name="RangoAceptCPSP" 
                               value="<?= $row['RangoAceptCPSP'] ?? '' ?>" 
                               placeholder="Ej. Maximo 0" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="TendenciaDeseadaCPSP">Tendencia Deseada:</label>
                        <input type="text" id="TendenciaDeseadaCPSP" name="TendenciaDeseadaCPSP" 
                               value="<?= $row['TendenciaDeseadaCPSP'] ?? '' ?>" 
                               placeholder="Ej. mensual" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               required>
                    </div>
                    
                    <!-- Calidad de la leche de Abasto - Grasa -->
                    <div>
                        <hr>
                        <label>Calidad de la leche de Abasto</label><br>
                        <label>(reporte mensual de control de calidad de leche pasteurizada)</label><br>
                    </div>
                    <div>
                        <hr>
                        <label>Grasa</label><br>
                        <hr>
                        <label for="GLCMGV">LCMGV:</label>
                        <input type="number" id="GLCMGV" name="GLCMGV" 
                               value="<?= $row['GLCMGV'] ?? '' ?>" 
                               placeholder="g/l" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               required step="any">
                    </div>
                    <div>
                        <label for="GLPD">LPD:</label>
                        <input type="number" id="GLPD" name="GLPD" 
                               value="<?= $row['GLPD'] ?? '' ?>" 
                               placeholder="g/l" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               required step="any">
                    </div>
                    
                    <!-- Calidad de la leche de Abasto - Proteína -->
                    <div>
                        <hr>
                        <label>Proteína</label><br>
                        <hr>
                        <label for="PLCMGV">LCMGV:</label>
                        <input type="number" id="PLCMGV" name="PLCMGV" 
                               value="<?= $row['PLCMGV'] ?? '' ?>" 
                               placeholder="g/l" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               required step="any">
                    </div>
                    <div>
                        <label for="PLPD">LPD:</label>
                        <input type="number" id="PLPD" name="PLPD" 
                               value="<?= $row['PLPD'] ?? '' ?>" 
                               placeholder="g/l" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               required step="any">
                    </div>
                    <div>
                        <label for="MetaEsperadaCLA">Meta Esperada:</label>
                        <textarea id="MetaEsperadaCLA" name="MetaEsperadaCLA" 
                                  placeholder="La meta esperada es:" 
                                  <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                                  required><?= $row['MetaEsperadaCLA'] ?? '' ?></textarea>
                    </div>
                    <div>
                        <label for="RangoAceptCLA">Rango de Aceptación:</label>
                        <input type="text" id="RangoAceptCLA" name="RangoAceptCLA" 
                               value="<?= $row['RangoAceptCLA'] ?? '' ?>" 
                               placeholder="Ej. Maximo 0" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="TendenciaDeseadaCLA">Tendencia Deseada:</label>
                        <input type="text" id="TendenciaDeseadaCLA" name="TendenciaDeseadaCLA" 
                               value="<?= $row['TendenciaDeseadaCLA'] ?? '' ?>" 
                               placeholder="Ej. mensual" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               required>
                    </div>
                    
                    <!-- Cumplimiento de las Buenas Prácticas de Higiene -->
                    <div>
                        <hr>
                        <label>Cumplimiento de las Buenas Prácticas de Higiene y Manufactura</label><br>
                        <hr>
                        <label for="PCBH">Porcentaje de Cumplimiento de la verificación Continua del PCC:</label>
                        <input type="number" id="PCBH" name="PCBH" 
                               value="<?= $row['PCBH'] ?? '' ?>" 
                               placeholder="Ej.100%" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               required step="any">
                    </div>
                    <div>
                        <label for="MetaEsperadaCBC">Meta Esperada:</label>
                        <textarea id="MetaEsperadaCBC" name="MetaEsperadaCBC" 
                                  placeholder="La meta esperada es:" 
                                  <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                                  required><?= $row['MetaEsperadaCBC'] ?? '' ?></textarea>
                    </div>
                    <div>
                        <label for="RangoAceptCBC">Rango de Aceptación:</label>
                        <input type="text" id="RangoAceptCBC" name="RangoAceptCBC" 
                               value="<?= $row['RangoAceptCBC'] ?? '' ?>" 
                               placeholder="Ej. Maximo 0" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="TendenciaDeseadaCBC">Tendencia Deseada:</label>
                        <input type="text" id="TendenciaDeseadaCBC" name="TendenciaDeseadaCBC" 
                               value="<?= $row['TendenciaDeseadaCBC'] ?? '' ?>" 
                               placeholder="Ej. mensual" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               required>
                    </div>
                    
                    <!-- Cumplimiento a los Lineamientos Internos -->
                    <div>
                        <hr>
                        <label>Cumplimiento a los Lineamientos Internos y Criterios de la NOM 251-SSA1-2009</label><br>
                        <hr>
                        <label for="PCCL">Porcentaje de Cumplimiento de los 129 Puntos (Recorrido de Comisión Mixta Seguridad e Higiene):</label>
                        <input type="number" id="PCCL" name="PCCL" 
                               value="<?= $row['PCCL'] ?? '' ?>" 
                               placeholder="Ej.85%" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               required step="any">
                    </div>
                    <div>
                        <label for="MetaEsperadaCLI">Meta Esperada:</label>
                        <textarea id="MetaEsperadaCLI" name="MetaEsperadaCLI" 
                                  placeholder="La meta esperada es:" 
                                  <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                                  required><?= $row['MetaEsperadaCLI'] ?? '' ?></textarea>
                    </div>
                    <div>
                        <label for="RangoAceptCLI">Rango de Aceptación:</label>
                        <input type="text" id="RangoAceptCLI" name="RangoAceptCLI" 
                               value="<?= $row['RangoAceptCLI'] ?? '' ?>" 
                               placeholder="Ej. Maximo 0" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="TendenciaDeseadaCLI">Tendencia Deseada:</label>
                        <input type="text" id="TendenciaDeseadaCLI" name="TendenciaDeseadaCLI" 
                               value="<?= $row['TendenciaDeseadaCLI'] ?? '' ?>" 
                               placeholder="Ej. mensual" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               required>
                    </div>
                    
                    <!-- Información Adicional -->
                    <div>
                        <hr>
                        <label for="Responsable">Responsable:</label>
                        <input type="text" id="Responsable" name="Responsable" 
                               value="<?= $row['Responsable'] ?? '' ?>" 
                               placeholder="Nombre del responsable" 
                               <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="Fuente">Fuente:</label><br><br>
                        <textarea id="Fuente" name="Fuente" rows="4" 
                                  placeholder="Fuente" 
                                  <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'readonly' : '' ?>
                                  required><?= $row['Fuente'] ?? '' ?></textarea>
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
                    <input type="submit" name="g" value="Guardar Cambios" class="btn btn-primary" 
                           <?= $es_admin ? '' : 'disabled' ?>>
                    <input type="button" value="Limpiar Campos" class="btn btn-secondary" onclick="limpiarCampos()"
                           <?= ($solo_firma || $formulario_firmado) && !$es_admin ? 'disabled' : '' ?>>
                    
                    <?php if ($es_admin && $formulario_firmado): ?>
                        <form method="POST" action="HacerIndi.php" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <input type="hidden" name="action" value="undo_signature">
                            <input type="submit" value="Deshacer Firma" class="btn btn-warning"
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
    
    <a href="MenuIndi.php" class="home-link">
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