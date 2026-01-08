<?php
include "Conexion.php";

$id = $_GET["sc"] ?? '';
$query = "SELECT * FROM g_indicador_ma where id= '$id'";
$res = mysqli_query($link, $query);
$fila = mysqli_fetch_assoc($res);
// Configuración inicial
error_reporting(0);
ini_set('display_errors', 0);

// Función para limpiar buffers
function cleanBuffers() {
    while (ob_get_level() > 0) {
        ob_end_clean();
    }
}

// Limpiar buffers al inicio
cleanBuffers();

// Verificar autoload
$autoloadPath = __DIR__ . '/vendor/autoload.php';
if (!file_exists($autoloadPath)) {
    cleanBuffers();
    header('Content-Type: text/html; charset=utf-8');
    die('
        <h3>Error: mPDF no instalado</h3>
        <p><b>Ejecuta en la terminal:</b></p>
        <pre style="background:#f0f0f0;padding:10px;">composer require mpdf/mpdf</pre>
        <p>Desde la carpeta: ' . htmlspecialchars(__DIR__) . '</p>
    ');
}

// Incluir mPDF
require_once $autoloadPath;

try {
    // ====================================================
    // 1. CONFIGURACIÓN mPDF
    // ====================================================
    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'Letter-L',
        'margin_left' => 10,
        'margin_right' => 10,
        'margin_top' => 10,
        'margin_bottom' => 10,
        'default_font_size' => 8,
        'tempDir' => sys_get_temp_dir(),
        'showWatermarkText' => false,
        'autoScriptToLang' => false,
        'autoLangToFont' => false,
        'fontDir' =>  array_merge (
            [
                __DIR__ . '../Patria', // Directorio donde están las fuentes
            ],
            (new \Mpdf\Config\ConfigVariables())->getDefaults()['fontDir']
        ),
    ]);

    $fontPath = __DIR__ . '../Patria';

    // Verificar si existen archivos Patria
    $patriaFiles = [
        'Patria_Regular.otf',
        'Patria_Bold.otf',
        'Patria_Regular.otf',
    ];
    
    $patriaFound = false;
    foreach ($patriaFiles as $file) {
        if (file_exists($fontPath . $file)) {
            $patriaFound = true;
            // Extraer el nombre base sin extensión
            $baseName = pathinfo($file, PATHINFO_FILENAME);
            
            // Determinar si es regular o bold
            if (stripos($baseName, 'bold') !== false) {
                $mpdf->AddFont('Patria', 'B', $file);
            } else {
                $mpdf->AddFont('Patria', '', $file);
            }
        }
    }
    // ====================================================
    // 2. CSS ESTILOS
    // ====================================================
    $css = '<style>
    
       body { 
            font-family: Arial, sans-serif; 
            margin: 0; 
            padding: 0; 
        }
        
        .font-patria {
            font-family: ' . ($patriaFound ? '"Patria", ' : '') . 'DejaVuSerif, Arial, sans-serif;
            font-weight: bold;
        }
        
        .font-patria-regular {
            font-family: ' . ($patriaFound ? '"Patria", ' : '') . 'DejaVuSerif, Arial, sans-serif;
        }
        
        table { 
            width: 100%; 
            border-collapse: collapse; 
        }
        
        td, th { 
            border: 1px solid #000; 
            padding: 3px; 
            vertical-align: middle; 
        }
        
        .no-border {
            border: none;
        }
        
        .header-cell { 
            background: #ffffffff; 
            text-align: center; 
            font-weight: bold; 
            font-size: 6.5pt;
        }
        
        .text-center { 
            text-align: center; 
        }
        
        .text-bold { 
            font-weight: bold; 
        }
        
        .bg-gray {
            background: #e8e8e8;
        }
        
        .font-7 { font-size: 7pt; }
        .font-8 { font-size: 8pt; }
        .font-9 { font-size: 9pt; }
        .font-10 { font-size: 10pt; }
        .font-11 { font-size: 11pt; }
        .font-6 { font-size: 6pt; }
        .font-6-5 { font-size: 6.5pt; }
    </style>';
    

    // ====================================================
    // 3. VERIFICAR SI HAY FIRMA
    // ====================================================
    // Verificar si el usuario ha firmado (firma_usuario no es null ni vacío)
    $mostrarFirma = false;
    $rutaFirma = '';
    
    if (isset($fila['firma_usuario']) && !empty($fila['firma_usuario']) && trim($fila['firma_usuario']) !== '') {
        // El usuario ha firmado (hay un correo en la columna)
        $rutaFirmaRelativa = '../Imagenes/firmas/RI.JPG';
        $rutaFirmaAbsoluta = __DIR__ . '/../Imagenes/firmas/RI.JPG';
        
        // Verificar si el archivo existe
        if (file_exists($rutaFirmaAbsoluta)) {
            $mostrarFirma = true;
            $rutaFirma = $rutaFirmaRelativa;
        } else {
            // También verificar otras posibles extensiones o nombres
            $extensiones = ['.JPG', '.jpg', '.JPEG', '.jpeg', '.PNG', '.png'];
            $nombresPosibles = ['Padron', 'padron', 'PADRON', 'firma', 'Firma'];
            
            foreach ($nombresPosibles as $nombre) {
                foreach ($extensiones as $ext) {
                    $rutaComprobacion = __DIR__ . '/../Imagenes/firmas/' . $nombre . $ext;
                    if (file_exists($rutaComprobacion)) {
                        $mostrarFirma = true;
                        $rutaFirma = '../Imagenes/firmas/' . $nombre . $ext;
                        break 2;
                    }
                }
            }
        }
    }
    


    // ====================================================
    // 4. CONTENIDO HTML - TODO EN TABLA
    // ====================================================
    $html = '
    <table>
        <!-- ENCABEZADO EN UNA FILA -->
        <tr>
            <td colspan="2" class="text-center font-9 text-bold">
                <img src="../Imagenes/LogoIndi.png" width="150px" height="80px">
            </td>
            <td colspan="3" class="text-center font-9 font-patria-regular">
                LECHE PARA EL BIENESTAR<br>
                <span class="font-8" style="font-weight:normal;">GERENCIA ESTATAL TLAXCALA</span><br>
                <span class="font-11 text-bold">INDICADORES</span>
            </td>
            <td colspan="1" style="padding: 0; border: 1px solid #000; vertical-align: top;">
    <table style="width: 100%; border-collapse: collapse; margin: 0; padding: 0;">
        <tr>
            <td style="background-color: #808080; color: #ffffff; text-align: center; padding: 3px; font-weight: bold; font-size: 7pt; border-bottom: 1px solid #000;">
                CLAVE DE REGISTRO:
            </td>
        </tr>
        <tr>
            <td style="background-color: #ffffff; color: #000000; text-align: center; padding: 4px; font-weight: bold; font-size: 8pt; border-bottom: 1px solid #000;">
                '.$fila["Claveregis"].'
            </td>
        </tr>
        <tr>
            <td style="background-color: #808080; color: #ffffff; text-align: center; padding: 3px; font-weight: bold; font-size: 7pt; border-bottom: 1px solid #000;">
                FECHA DE ACTUALIZACIÓN <br>
                <span style="font-size: 5pt; font-weight: normal;">(dd/mm/aaaa)</span>
            </td>
        </tr>
        <tr>
            <td style="background-color: #ffffff; color: #000000; text-align: center; padding: 4px; font-weight: bold; font-size: 8pt;">
                '.date("d/m/Y", strtotime($fila["FechaAct"])).' 
            </td>
        </tr>
    </table>
</td>
        </tr>
        
        
        <!-- PROCESO -->
        <tr style="border-bottom: none;">
            <td colspan="6" class="font-7" style="border-top: none; border-bottom: none;">
            <span class="text-bold">Proceso y/o Procedimiento: GESTIÓN DEL AMBIENTE DE TRABAJO Y DE LAS COMPETENCIAS DE PERSONAL (RI)</span>
            </td>
        </tr>
        
        <!-- FECHA Y PERIODO -->
        <tr style="border-bottom: none;">
            <td colspan="3" class="font-7" style="border-bottom: none; border-top: none; border-right: none;">
            <span class="text-bold">Fecha de Elaboración: '.date("d/m/Y", strtotime($fila["Mes"])).'</span>
            </td>
            <td colspan="3" class="font-7" style="border-bottom: none; border-left: none; border-top: none;">
            <span class="text-bold">Periodo: '.date("m/Y", strtotime($fila["Periodo"])).'</span>
            </td>
        </tr>
        
        <!-- FUENTE -->
        <tr>
            <td colspan="6" class="font-7">
                <span class="text-bold">Fuente de Información:</span> '.$fila["Fuente"].'
            </td>
        </tr>
        
        <!-- ENCABEZADOS DE TABLA -->
        <tr>
            <th rowspan="1" class="header-cell" style="width:2.5%;">No.</th>
            <th rowspan="1" class="header-cell" style="width:11%;">Nombre del<br>Indicador</th>
            <th colspan="1" class="header-cell" style="width:33%;">Construcción del Indicador (Indicar Unidades)</th>
            <th rowspan="1" class="header-cell" style="width:5%;">Meta</th>
            <th rowspan="1" class="header-cell" style="width:11%;">Rango de<br>Aceptación</th>
            <th rowspan="1" class="header-cell" style="width:17%;">Tendencia Deseada</th>
        </tr>
        
        <!-- FILA 1 -->
        <tr>
            <td class="text-center font-7">1</td>
            <td class="text-center font-6-5">Cumplimento de la capacitación</td>
            <td class="font-6">
                Cursos impartidos / cursos programados * 100<br><br>
                '.$fila["CapaImpar"].'<br>
                ─────  × 100 = <b>'.$fila["PorCumplimientoCAP"].'%</b><br>
                '.$fila["CapaProg"].'
            </td>
            <td class="text-center font-7">'.$fila["MetaEsperadaCC"].'%</td>
            <td class="text-center font-6-5">'.$fila["RangoAceptCC"].'</td>
            <td class="text-center font-6">'.$fila["TendenciaDeseadaCC"].'</td>
        </tr>
        
        <!-- FILA 2 -->
        <tr>
            <td class="text-center font-7">2</td>
            <td class="text-center font-6-5">Evaluación técnica</td>
            <td class="font-6">
                Nuevos ingresos al puesto /  número de evaluaciones * 100<br><br>
                '.$fila["NuevosIP"].'<br>
                ───────── × '.$fila["NumEvaluaciones"].'= <b>'.$fila["PorCumplimientoET"].'%</b><br>
                '.$fila["NumEvaluaciones"].'
                <br>
    
            </td>
            <td class="text-center font-7">'.$fila["MetaEsperadaET"].'%</td>
            <td class="text-center font-6-5">'.$fila["RangoAceptET"].'</td>
            <td class="text-center font-6">'.$fila["TendenciaDeseadaET"].'</td>
        </tr>
        
        
        <!-- FIRMA -->
        <tr class="no-border">
        </tr>
        <tr>
            <td colspan="3" class="no-border text-center font-8" style="padding-top:15px;">';
            // Mostrar firma si el usuario ha firmado
                     if ($mostrarFirma) {
                     $html .= '<img src="' . $rutaFirma . '" style="max-width: 150px; max-height: 80px; margin-bottom: 10px;"><br>_________________<br>';
                    } else {
                    $html .= '<br><br><br><br><br><br> _________________<br>';
                                            }                          
         $html.=' 
                 <span class="text-bold">Elaboró</span><br>
                <span class="text-bold">'.$fila["Responsable"].'</span>
            </td>
            <td colspan="2.5" class="no-border text-center font-8" style="padding-top:15px;">
               <br><br><br><br><br><br> _________________<br>
                <span class="text-bold">Revisó</span><br>
                <span class="text-bold">Antonio Rangel López</span>
            </td>
        </tr>
    </table>';
    
    // ====================================================
    // 4. GENERAR PDF
    // ====================================================
    cleanBuffers();
    
    // Escribir contenido
    $mpdf->WriteHTML($css . $html);
    
    // Salida directa
    $mpdf->Output('Indicadores_' . date('Y-m-d') . '.pdf', 'I');
    
    exit();
    
} catch (Exception $e) {
    cleanBuffers();
    header('Content-Type: text/html; charset=utf-8');
    echo '<h3>Error al generar PDF</h3>';
    echo '<p><strong>Error:</strong> ' . htmlspecialchars($e->getMessage()) . '</p>';
    echo '<p><strong>Archivo:</strong> ' . htmlspecialchars(__FILE__) . '</p>';
    echo '<p><strong>Línea:</strong> ' . $e->getLine() . '</p>';
    exit();
}
?>