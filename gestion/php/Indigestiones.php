<?php

require_once '../../php/verificar_permisos.php';
$es_admin = ($_SESSION['departamento'] === 'ADMIN');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/Indigestiones.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="SGC-MLS logo">
</head>
<body>

    <header class="text-center my-4">
        <h1>SELECCIONA UN INDICADOR</h1>
    </header>

    <main class="container">
        <section class="menu">
            <div class="menu-column">
          <div class="menu-bottom">
            

            <a href="MenuIndiMa.php" class="opc">
            <img src="../imagenes/IndiMA.png" height="70" width="80" class="icono">
            <span>INDICADOR RELACIONES INDUSTRIALES</span>
            <i class="fas fa-check icono-palomita"></i>
            </a>
            
          </div>
          
        
        </section>
        <section class="menu">
            <div class="menu-column">
                  <div class="menu-bottom">
        <a href="MenuIndiDa.php" class="opc">
            <img src="../imagenes/IndiDA.png" height="70" width="80" class="icono">
            <span>INDICADOR SEGURIDAD E HIGIENE</span>
            <i class="fas fa-check icono-palomita"></i>
        </a>
            </div>
        </section>  
        
        <br>
        
        <a href="gestionP.php" class="btn btn-danger">Regresar</a>
        
        
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