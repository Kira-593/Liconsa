<?php
include "Conexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $accion = isset($_POST['accion']) ? $_POST['accion'] : '';
    $tabla = isset($_POST['tabla']) ? $_POST['tabla'] : 'c_formulariofm';

    // Validar tabla permitida
    $tablas_permitidas = [
        'c_formulariofm',
        'c_captacionleche',
        'c_formulariogps',
        'c_evaluaciondesempeno',
        'c_contenidonetopesoenvase',
        'c_indicador'
    ];

    if (!in_array($tabla, $tablas_permitidas)) {
        echo "<script>alert('Tabla no permitida.'); window.history.back();</script>";
        include "Cerrar.php";
        exit;
    }

    if ($id <= 0 || !in_array($accion, ['modificar','firmar'])) {
        echo "<script>alert('Datos inválidos.'); window.history.back();</script>";
        include "Cerrar.php";
        exit;
    }

    // Usar los nombres de columna consistentes con el resto del proyecto
    $query_estado = "SELECT permitir_modificar, permitir_firmar FROM $tabla WHERE id = '$id' LIMIT 1";
    $res_estado = mysqli_query($link, $query_estado);

    if (!$res_estado) {
        echo "<script>alert('Error en la consulta: " . mysqli_real_escape_string($link, mysqli_error($link)) . "'); window.history.back();</script>";
        include "Cerrar.php";
        exit;
    }

    if (mysqli_num_rows($res_estado) === 0) {
        echo "<script>alert('Registro no encontrado.'); window.history.back();</script>";
        include "Cerrar.php";
        exit;
    }

    $estado_actual = mysqli_fetch_assoc($res_estado);

    // Determinar la página de retorno basada en la tabla
    $paginas_retorno = [
        'c_formulariofm' => 'verFM.php',
        'c_captacionleche' => 'verRCT.php',
        'c_formulariogps' => 'verGPS.php',
        'c_evaluaciondesempeno' => 'verEvaluacion.php',
        'c_contenidonetopesoenvase' => 'verContenidoNyP.php',
        'c_indicador' => 'verIndi.php'
    ];

    $pagina_retorno = isset($paginas_retorno[$tabla]) ? $paginas_retorno[$tabla] : 'MenuConsulta.php';

    if ($accion == 'modificar') {
        // CORRECCIÓN: usar la misma clave que devuelve la consulta ('permitir_modificar')
        $cur = isset($estado_actual['permitir_modificar']) ? intval($estado_actual['permitir_modificar']) : 0;
        $nuevo_estado = $cur ? 0 : 1;
        $query = "UPDATE $tabla 
                 SET permitir_modificar = $nuevo_estado 
                 WHERE id = '$id'";
        $mensaje = $nuevo_estado ? 'Modificación PERMITIDA para este formulario.' : 'Modificación BLOQUEADA para este formulario.';
    } elseif ($accion == 'firmar') {
        $cur = isset($estado_actual['permitir_firmar']) ? intval($estado_actual['permitir_firmar']) : 0;
        $nuevo_estado = $cur ? 0 : 1;
        $query = "UPDATE $tabla 
                 SET permitir_firmar = $nuevo_estado 
                 WHERE id = '$id'";
        $mensaje = $nuevo_estado ? 'Firma PERMITIDA para este formulario.' : 'Firma BLOQUEADA para este formulario.';
    }

    if (mysqli_query($link, $query)) {
        // usar json_encode para escapar correctamente el mensaje en JS
        $jsMsg = json_encode($mensaje);
        echo "<script>
            alert($jsMsg);
            window.location.href = '$pagina_retorno?sc={$id}';
        </script>";
    } else {
        $err = mysqli_real_escape_string($link, mysqli_error($link));
        echo "<script>
            alert('Error al actualizar el permiso: {$err}');
            window.history.back();
        </script>";
    }
}

include "Cerrar.php";
?>