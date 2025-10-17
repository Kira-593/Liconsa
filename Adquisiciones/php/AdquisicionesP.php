<?php

require_once '../../php/verificar_permisos.php';
$es_admin = ($_SESSION['departamento'] === 'ADMIN');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Padron</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/adquisicionesP.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="SGC-MLS logo">
</head>
<body>

    <header class="text-center my-4">
        <h1>¿QUÉ DESEAS HACER?</h1>
    </header>

    <main class="container">
        <section class="menu">
            <div class="menu-column">
                <!-- FORMULARIOS - Siempre habilitado para todos -->
                <a href="FormResumenA.php" class="opc habilitado">
                    <img src="../imagenes/registro.png" height="70" width="80" align="left" class="icono">
                    <span>FORMULARIOS</span>
                    <i class="fas fa-check icono-palomita"></i>
                </a>

                <!-- CONSULTA DE FORMULARIOS - Solo para ADMIN -->
                <?php if ($es_admin): ?>
                    <a href="ConResumenA.php" class="opc habilitado">
                        <img src="../imagenes/consulta.png" height="70" width="80" align="left" class="icono">
                        <span>CONSULTA DE FORMULARIOS</span>
                        <i class="fas fa-check icono-palomita"></i>
                    </a>
                <?php else: ?>
                    <div class="opc bloqueado">
                        <img src="../imagenes/consulta.png" height="70" width="80" align="left" class="icono">
                        <span>CONSULTA DE FORMULARIOS</span>
                        <i class="fas fa-lock icono-candado"></i>
                    </div>
                <?php endif; ?>
            </div>    

            <div class="menu-column">
                <!-- MODIFICACIÓN - Solo para ADMIN -->
                <?php if ($es_admin): ?>
                    <a href="Modificación.php" class="opc habilitado">
                        <img src="../imagenes/modificacion.png" height="70" width="80" align="left" class="icono">
                        <span>MODIFICACIÓN DE FORMULARIOS</span>
                        <i class="fas fa-check icono-palomita"></i>
                    </a>
                <?php else: ?>
                    <div class="opc bloqueado">
                        <img src="../imagenes/modificacion.png" height="70" width="80" align="left" class="icono">
                        <span>MODIFICACIÓN DE FORMULARIOS</span>
                        <i class="fas fa-lock icono-candado"></i>
                    </div>
                <?php endif; ?>
                
                <!-- ELIMINACIÓN - Solo para ADMIN -->
                <?php if ($es_admin): ?>
                    <a href="Bajas.php" class="opc habilitado">
                        <img src="../imagenes/eliminar.png" height="70" width="80" align="left" class="icono">
                        <span>ELIMINACIÓN DE FORMULARIOS</span>
                        <i class="fas fa-check icono-palomita"></i>
                    </a>
                <?php else: ?>
                    <div class="opc bloqueado">
                        <img src="../imagenes/eliminar.png" height="70" width="80" align="left" class="icono">
                        <span>ELIMINACIÓN DE FORMULARIOS</span>
                        <i class="fas fa-lock icono-candado"></i>
                    </div>
                <?php endif; ?>
            </div>
        </section>
        <br>
        <a href="../../menuphp/php/menuP.php" class="btn btn-danger">Menú principal</a>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <script>
        // Prevenir clic en opciones bloqueadas
        document.querySelectorAll('.opc.bloqueado').forEach(function(element) {
            element.addEventListener('click', function(e) {
                e.preventDefault();
                alert('No tienes permisos para acceder a esta función. Solo puedes usar FORMULARIOS.');
            });
        });
    </script>
</body>
</html>