<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Indicadores del Padrón</title>
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

    <h1>Actualizar Indicadores</h1>
    <h4>Administrador del Padron de Beneficiarios</h4>
    
    <?php
    include "Conexion.php";
    
    $ID = $_GET["id"] ?? $_GET["sc"] ?? die("<div class='alert alert-danger'>Error: ID de registro no proporcionado.</div>");
    $query = "SELECT * FROM P_indicador WHERE id='$ID'"; 
    $res = mysqli_query($link, $query);
    
    if (!$res || mysqli_num_rows($res) == 0) {
        die("<div class='alert alert-danger'>Error: Registro no encontrado.</div>");
    }
    
    $row = mysqli_fetch_array($res);

    // Verificar permisos
    $solo_firma = $row['permitir_firmar'] && !$row['permitir_modificar'];
    $formulario_firmado = !empty($row['firma_usuario']);
    
    // Si solo está permitido firmar y el formulario ya está firmado, bloquear todo
    if ($solo_firma && $formulario_firmado) {
        echo "<script>
            alert('Este formulario ya ha sido firmado y no puede ser modificado.');
            window.location.href = 'MenuIndi.php';
        </script>";
        exit();
    }

    // Si no tiene permisos de modificación ni firma
    if (!$row['permitir_modificar'] && !$row['permitir_firmar']) {
        echo "<script>
            alert('No tienes permisos para modificar o firmar este formulario. Contacta al administrador.');
            window.location.href = 'MenuIndi.php';
        </script>";
        exit();
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
        <form method="post" action="HacerIndi.php" id="formulario">
            <input type="hidden" name="id" value="<?= $row['id'] ?? '' ?>">
            
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
                    
                    <!-- Meta de Beneficiarios -->
                    <div>
                        <hr>
                        <label>Meta de Beneficiarios</label><br>
                        <hr>
                        <label for="NumBenefi">Numero de Beneficiarios:</label>
                        <input type="number" id="NumBenefi" name="NumBenefi" 
                               value="<?= $row['NumBenefi'] ?? '' ?>" 
                               placeholder="Ingrese la cantidad" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="MetaBeneficiarios">Meta de Beneficiarios:</label>
                        <input type="number" id="MetaBeneficiarios" name="MetaBeneficiarios" 
                               value="<?= $row['MetaBeneficiarios'] ?? '' ?>" 
                               placeholder="Ingrese la meta" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="MetaReal">Meta Alcanzada:</label>
                        <input type="number" id="MetaReal" name="MetaReal" 
                               value="<?= $row['MetaReal'] ?? '' ?>" 
                               placeholder="La meta real es:" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="MetaEsperadaMB">Meta Esperada:</label>
                        <input type="text" id="MetaEsperadaMB" name="MetaEsperadaMB" 
                               value="<?= $row['MetaEsperadaMB'] ?? '' ?>" 
                               placeholder="La meta esperada es:" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="RangoAceptMB">Rango de Aceptación:</label>
                        <input type="text" id="RangoAceptMB" name="RangoAceptMB" 
                               value="<?= $row['RangoAceptMB'] ?? '' ?>" 
                               placeholder="Ej. Cumplimiento del 93% al 99%" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="TendenciaDeseadaMB">Tendencia Deseada:</label>
                        <input type="text" id="TendenciaDeseadaMB" name="TendenciaDeseadaMB" 
                               value="<?= $row['TendenciaDeseadaMB'] ?? '' ?>" 
                               placeholder="Ej. Cumplimiento al 100%" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    
                    <!-- Factor de retiro Global Liquida -->
                    <div>
                        <hr>
                        <label>Factor de retiro Global Liquida</label><br>
                        <hr>
                        <label for="LitrosVendidos">Litros vendidos:</label>
                        <input type="number" id="LitrosVendidos" name="LitrosVendidos" 
                               value="<?= $row['LitrosVendidos'] ?? '' ?>" 
                               placeholder="Ingrese la cantidad" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="NumBenefiActivos">Número de Beneficiarios Activos:</label>
                        <input type="number" id="NumBenefiActivos" name="NumBenefiActivos" 
                               value="<?= $row['NumBenefiActivos'] ?? '' ?>" 
                               placeholder="Ingrese la cantidad" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="DiasVenta">Dias de Venta:</label>
                        <input type="number" id="DiasVenta" name="DiasVenta" 
                               value="<?= $row['DiasVenta'] ?? '' ?>" 
                               placeholder="Ingrese la cantidad" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="FacRetLi">Factor de retiro Global Liquida:</label>
                        <input type="number" id="FacRetLi" name="FacRetLi" 
                               value="<?= $row['FacRetLi'] ?? '' ?>" 
                               placeholder="Ingrese la cantidad" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required step="any">
                    </div>
                    <div>
                        <label for="MetaEsperadaFRL">Meta Esperada:</label>
                        <input type="text" id="MetaEsperadaFRL" name="MetaEsperadaFRL" 
                               value="<?= $row['MetaEsperadaFRL'] ?? '' ?>" 
                               placeholder="La meta esperada es:" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="RangoAceptFRL">Rango de Aceptación:</label>
                        <input type="text" id="RangoAceptFRL" name="RangoAceptFRL" 
                               value="<?= $row['RangoAceptFRL'] ?? '' ?>" 
                               placeholder="Ej. Cumplimiento del 93% al 99%" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="TendenciaDeseadaFRL">Tendencia Deseada:</label>
                        <input type="text" id="TendenciaDeseadaFRL" name="TendenciaDeseadaFRL" 
                               value="<?= $row['TendenciaDeseadaFRL'] ?? '' ?>" 
                               placeholder="Ej. Cumplimiento al 100%" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    
                    <!-- Factor de retiro Global Polvo -->
                    <div>
                        <hr>
                        <label>Factor de retiro Global polvo</label><br>
                        <hr>
                        <label for="LitrosVendidosPol">Litros vendidos:</label>
                        <input type="number" id="LitrosVendidosPol" name="LitrosVendidosPol" 
                               value="<?= $row['LitrosVendidosPol'] ?? '' ?>" 
                               placeholder="Ingrese la cantidad" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="NumBenefiActivosPol">Número de Beneficiarios Activos:</label>
                        <input type="number" id="NumBenefiActivosPol" name="NumBenefiActivosPol" 
                               value="<?= $row['NumBenefiActivosPol'] ?? '' ?>" 
                               placeholder="Ingrese la cantidad" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="DiasVentaPol">Dias de Venta:</label>
                        <input type="number" id="DiasVentaPol" name="DiasVentaPol" 
                               value="<?= $row['DiasVentaPol'] ?? '' ?>" 
                               placeholder="Ingrese la cantidad" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="FacRetPol">Factor de retiro Global Polvo:</label>
                        <input type="number" id="FacRetPol" name="FacRetPol" 
                               value="<?= $row['FacRetPol'] ?? '' ?>" 
                               placeholder="Ingrese la cantidad" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required step="any">
                    </div>
                    <div>
                        <label for="MetaEsperadaFRP">Meta Esperada:</label>
                        <input type="text" id="MetaEsperadaFRP" name="MetaEsperadaFRP" 
                               value="<?= $row['MetaEsperadaFRP'] ?? '' ?>" 
                               placeholder="La meta esperada es:" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="RangoAceptFRP">Rango de Aceptación:</label>
                        <input type="text" id="RangoAceptFRP" name="RangoAceptFRP" 
                               value="<?= $row['RangoAceptFRP'] ?? '' ?>" 
                               placeholder="Ej. Cumplimiento del 93% al 99%" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="TendenciaDeseadaFRP">Tendencia Deseada:</label>
                        <input type="text" id="TendenciaDeseadaFRP" name="TendenciaDeseadaFRP" 
                               value="<?= $row['TendenciaDeseadaFRP'] ?? '' ?>" 
                               placeholder="Ej. Cumplimiento al 100%" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    
                    <!-- Tarjetas no Entregadas -->
                    <div>
                        <hr>
                        <label>Tarjetas no Entregadas</label><br>
                        <hr>
                        <label for="TNE">Número de Tarjetas no Entregadas:</label>
                        <input type="number" id="TNE" name="TNE" 
                               value="<?= $row['TNE'] ?? '' ?>" 
                               placeholder="Ingrese la cantidad" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="FamiliasInscritas">Número de Familias Inscritas en el Padron:</label>
                        <input type="number" id="FamiliasInscritas" name="FamiliasInscritas" 
                               value="<?= $row['FamiliasInscritas'] ?? '' ?>" 
                               placeholder="Ingrese la cantidad" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="PorcentajeTNE"> Porcentaje de Tarjetas no Entregadas:</label>
                        <input type="number" id="PorcentajeTNE" name="PorcentajeTNE" 
                               value="<?= $row['PorcentajeTNE'] ?? '' ?>" 
                               placeholder="Ingrese la cantidad" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required step="any">
                    </div>
                    <div>
                        <label for="MetaEsperadaTNE">Meta Esperada:</label>
                        <input type="text" id="MetaEsperadaTNE" name="MetaEsperadaTNE" 
                               value="<?= $row['MetaEsperadaTNE'] ?? '' ?>" 
                               placeholder="La meta esperada es:" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="RangoAceptTNE">Rango de Aceptación:</label>
                        <input type="text" id="RangoAceptTNE" name="RangoAceptTNE" 
                               value="<?= $row['RangoAceptTNE'] ?? '' ?>" 
                               placeholder="Ej. Cumplimiento del 93% al 99%" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="TendenciaDeseadaTNE">Tendencia Deseada:</label>
                        <input type="text" id="TendenciaDeseadaTNE" name="TendenciaDeseadaTNE" 
                               value="<?= $row['TendenciaDeseadaTNE'] ?? '' ?>" 
                               placeholder="Ej. Cumplimiento al 100%" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    
                    <!-- Atención a Quejas -->
                    <div>
                        <hr>
                        <label>Atencion a Quejas</label><br>
                        <hr>
                        <label for="QuejasRecibidas">Quejas Recibidas:</label>
                        <input type="number" id="QuejasRecibidas" name="QuejasRecibidas" 
                               value="<?= $row['QuejasRecibidas'] ?? '' ?>" 
                               placeholder="Ingrese la cantidad" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="QuejasAtendidas">Quejas Atendidas:</label>
                        <input type="number" id="QuejasAtendidas" name="QuejasAtendidas" 
                               value="<?= $row['QuejasAtendidas'] ?? '' ?>" 
                               placeholder="Ingrese la cantidad" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="PQNA">Porcentaje de Quejas Atendidas:</label>
                        <input type="number" id="PQNA" name="PQNA" 
                               value="<?= $row['PQNA'] ?? '' ?>" 
                               placeholder="Ingrese la cantidad" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required step="any">
                    </div>
                    <div>
                        <label for="MetaEsperadaAQ">Meta Esperada:</label>
                        <input type="text" id="MetaEsperadaAQ" name="MetaEsperadaAQ" 
                               value="<?= $row['MetaEsperadaAQ'] ?? '' ?>" 
                               placeholder="La meta esperada es:" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="RangoAceptAQ">Rango de Aceptación:</label>
                        <input type="text" id="RangoAceptAQ" name="RangoAceptAQ" 
                               value="<?= $row['RangoAceptAQ'] ?? '' ?>" 
                               placeholder="Ej. Cumplimiento del 93% al 99%" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="TendenciaDeseadaAQ">Tendencia Deseada:</label>
                        <input type="text" id="TendenciaDeseadaAQ" name="TendenciaDeseadaAQ" 
                               value="<?= $row['TendenciaDeseadaAQ'] ?? '' ?>" 
                               placeholder="Ej. Cumplimiento al 100%" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    
                    <!-- Encuesta de Satisfacción al Cliente -->
                    <div>
                        <hr>
                        <label>Encuesta de Satisfacción al Cliente</label><br>
                        <hr>
                        <label for="TotalEncues">Total de Encuestas:</label>
                        <input type="number" id="TotalEncues" name="TotalEncues" 
                               value="<?= $row['TotalEncues'] ?? '' ?>" 
                               placeholder="Ingrese la cantidad" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="MaxPuntos">Maximo de puntos:</label>
                        <input type="number" id="MaxPuntos" name="MaxPuntos" 
                               value="<?= $row['MaxPuntos'] ?? '' ?>" 
                               placeholder="Ingrese la cantidad" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="TPTE">Total de puntos del Total de Encuestas:</label>
                        <input type="number" id="TPTE" name="TPTE" 
                               value="<?= $row['TPTE'] ?? '' ?>" 
                               placeholder="Ingrese la cantidad" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="PorcentajeEncuestas"> Porcentaje de Encuestas de Satisfacción:</label>
                        <input type="number" id="PorcentajeEncuestas" name="PorcentajeEncuestas" 
                               value="<?= $row['PorcentajeEncuestas'] ?? '' ?>" 
                               placeholder="Ingrese la cantidad" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required step="any">
                    </div>
                    <div>
                        <label for="MetaEsperadaES">Meta Esperada:</label>
                        <input type="text" id="MetaEsperadaES" name="MetaEsperadaES" 
                               value="<?= $row['MetaEsperadaES'] ?? '' ?>" 
                               placeholder="La meta esperada es:" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="RangoAceptES">Rango de Aceptación:</label>
                        <input type="text" id="RangoAceptES" name="RangoAceptES" 
                               value="<?= $row['RangoAceptES'] ?? '' ?>" 
                               placeholder="Ej. Cumplimiento del 93% al 99%" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    <div>
                        <label for="TendenciaDeseadaES">Tendencia Deseada:</label>
                        <input type="text" id="TendenciaDeseadaES" name="TendenciaDeseadaES" 
                               value="<?= $row['TendenciaDeseadaES'] ?? '' ?>" 
                               placeholder="Ej. Cumplimiento al 100%" 
                               <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                               required>
                    </div>
                    
                    <!-- Información Adicional -->
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
                        <label for="Fuente">Fuente:</label><br><br>
                        <textarea id="Fuente" name="Fuente" rows="4" 
                                  placeholder="Ej. La Facturación Disminuyó 5.25% al cierre del mes" 
                                  <?= ($solo_firma || $formulario_firmado) ? 'readonly' : '' ?>
                                  required><?= $row['Fuente'] ?? '' ?></textarea>
                    </div>
                    <hr>
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
                    <div class="alert alert-warning">
                        Este formulario ya ha sido firmado y no puede ser modificado.
                    </div>
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
<?php include "Cerrar.php"; ?>