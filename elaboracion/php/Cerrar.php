<?php
// Cerrar.php (versión segura)
if (isset($link) && $link instanceof mysqli) {
    mysqli_close($link);
    // Opcional: desreferenciar la variable
    unset($link);
}
?>