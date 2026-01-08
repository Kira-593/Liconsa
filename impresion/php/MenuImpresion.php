<?php
require_once '../../php/configuracion.php';
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['correo'])) {
    header("Location: ../../inicio.php");
    exit();
}

registrarActividad("Accedió al menú de impresion", "Menú Impresión");
// DEPURACIÓN - Ver qué hay en la sesión
error_log("Departamento en sesión: " . ($_SESSION['departamento'] ?? 'NO HAY DEPARTAMENTO'));
error_log("Correo en sesión: " . ($_SESSION['correo'] ?? 'NO HAY CORREO'));

// Definir qué departamentos tienen acceso a qué áreas (USANDO LOS VALORES REALES DE LA BD)
$permisos_por_departamento = [
    'ADMIN' => [ 
        'ENVASADO', 
        'CONTROL DE CALIDAD',
        'PADRÓN DE BENEFICIARIOS',
        'DISTRIBUCIÓN',
        'ADQUISICIONES',
        'ALMACÉN',
        'MANTENIMIENTO',
        'INFORMÁTICA',
        'ELABORACIÓN',
        'GESTIÓN DEL TRABAJO',
        'RECURSOS FINANCIEROS'
    ],
    'ENVASADO' => ['ENVASADO'],
    'CONTROL DE CALIDAD' => ['CONTROL DE CALIDAD'],
    'PADRON' => ['PADRÓN DE BENEFICIARIOS'],
    'DISTRIBUCION' => ['DISTRIBUCIÓN'],
    'ADQUISICIONES' => ['ADQUISICIONES'],
    'ALMACEN' => ['ALMACÉN'],
    'MANTENIMIENTO' => ['MANTENIMIENTO'],
    'INFORMATICA' => ['INFORMÁTICA'],
    'ELABORACION' => ['ELABORACIÓN'],
    'GESTION DE TRABAJO' => ['GESTIÓN DEL TRABAJO'],
    'RECURSOS FINANCIEROS' => ['RECURSOS FINANCIEROS']
];

// Obtener departamento del usuario
$departamento_usuario = $_SESSION['departamento'] ?? '';

// DEPURACIÓN - Ver qué áreas deberían estar habilitadas
error_log("Departamento usuario: " . $departamento_usuario);

// Determinar qué áreas mostrar (CAMBIADO la comparación)
if ($departamento_usuario === 'ADMIN') { // CAMBIADO de 'ADMINISTRACION' a 'ADMIN'
    $areas_habilitadas = $permisos_por_departamento['ADMIN'];
} else {
    $areas_habilitadas = $permisos_por_departamento[$departamento_usuario] ?? [];
}

// DEPURACIÓN - Ver áreas habilitadas
error_log("Áreas habilitadas: " . implode(', ', $areas_habilitadas));

// Mapeo de departamentos a URLs
$urls_departamentos = [
    'ENVASADO' => '../../envasado/php/envasadoP.php',
    'CONTROL DE CALIDAD' => '../../Control de Calidad/php/ControlP.php',
    'PADRÓN DE BENEFICIARIOS' => 'ConPadron.php',
    'DISTRIBUCIÓN' => '../../distribucion/php/distribucionP.php',
    'ADQUISICIONES' => '../../Adquisiciones/php/AdquisicionesP.php',
    'ALMACÉN' => '../../Almacen/php/AlmacenP.php',
    'MANTENIMIENTO' => '../../mantenimiento/php/mantenimientoP.php',
    'INFORMÁTICA' => '../../Informatica/php/InformaticaP.php',
    'ELABORACIÓN' => '../../elaboracion/php/elaboracionP.php',
    'GESTIÓN DEL TRABAJO' => '../../gestion/php/gestionP.php',
    'RECURSOS FINANCIEROS' => '../../Recursos/php/RecursosP.php',
];

// Mapeo CORREGIDO de nombres de imágenes
$imagenes_departamentos = [
    'ENVASADO' => 'envasado',
    'CONTROL DE CALIDAD' => 'control de calidad',
    'PADRÓN DE BENEFICIARIOS' => 'padron de bene',
    'DISTRIBUCIÓN' => 'distribucion',
    'ADQUISICIONES' => 'adquisiciones',
    'ALMACÉN' => 'almacen',
    'MANTENIMIENTO' => 'mantenimiento',
    'INFORMÁTICA' => 'informatica',
    'ELABORACIÓN' => 'elaboracion',
    'GESTIÓN DEL TRABAJO' => 'gestion de trabajo',
    'RECURSOS FINANCIEROS' => 'recursos financieros'
];

// Verificar si es administrador
$es_admin = ($departamento_usuario === 'ADMIN');
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Menú</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/menu.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
	<img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
	<img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">
</head>
<body>



	<header class="text-center my-4 position-relative">
		<h1>IMPRESIÓN DE</h1>
		<div class="app-name">
			<span>INDICADORES</span>
		</div>

	</header>

	<main class="container">
		<section class="menu">
			<div class="menu-column">
				<?php
				$departamentos_columna1 = [
					'PADRÓN DE BENEFICIARIOS', 
					'ALMACÉN',
					'ELABORACIÓN',
					'ENVASADO'
				];
				
				foreach ($departamentos_columna1 as $depto): 
					$habilitado = in_array($depto, $areas_habilitadas);
					$url = $habilitado ? $urls_departamentos[$depto] : 'javascript:void(0);';
					$clase = $habilitado ? 'opc' : 'opc bloqueado';
					$imagen = $imagenes_departamentos[$depto];
				?>
					<a href="<?php echo $url; ?>" class="<?php echo $clase; ?>">
						<img src="../imagenes/<?php echo $imagen; ?>.png" height="70" width="80" align="left" class="icono" alt="<?php echo $depto; ?>">
						<span><?php echo $depto; ?></span>
						<?php if (!$habilitado): ?>
							<i class="fas fa-lock icono-candado"></i>
						<?php else: ?>
							<i class="fas fa-check icono-palomita"></i>
						<?php endif; ?>
					</a>
				<?php endforeach; ?>
			</div>
			
			<div class="menu-column">
				<?php
				$departamentos_columna2 = [
					'DISTRIBUCIÓN',
					'MANTENIMIENTO',
					'GESTIÓN DEL TRABAJO'
				];
				
				foreach ($departamentos_columna2 as $depto): 
					$habilitado = in_array($depto, $areas_habilitadas);
					$url = $habilitado ? $urls_departamentos[$depto] : 'javascript:void(0);';
					$clase = $habilitado ? 'opc' : 'opc bloqueado';
					$imagen = $imagenes_departamentos[$depto];
				?>
					<a href="<?php echo $url; ?>" class="<?php echo $clase; ?>">
						<img src="../imagenes/<?php echo $imagen; ?>.png" height="70" width="80" align="left" class="icono" alt="<?php echo $depto; ?>">
						<span><?php echo $depto; ?></span>
						<?php if (!$habilitado): ?>
							<i class="fas fa-lock icono-candado"></i>
						<?php else: ?>
							<i class="fas fa-check icono-palomita"></i>
						<?php endif; ?>
					</a>
				<?php endforeach; ?>
			</div>
			
			<div class="menu-column">
				<?php
				$departamentos_columna3 = [
					'CONTROL DE CALIDAD',
					'ADQUISICIONES',
					'INFORMÁTICA',
					'RECURSOS FINANCIEROS'
				];
				
				foreach ($departamentos_columna3 as $depto): 
					$habilitado = in_array($depto, $areas_habilitadas);
					$url = $habilitado ? $urls_departamentos[$depto] : 'javascript:void(0);';
					$clase = $habilitado ? 'opc' : 'opc bloqueado';
					$imagen = $imagenes_departamentos[$depto];
				?>
					<a href="<?php echo $url; ?>" class="<?php echo $clase; ?>">
						<img src="../imagenes/<?php echo $imagen; ?>.png" height="70" width="80" align="left" class="icono" alt="<?php echo $depto; ?>">
						<span><?php echo $depto; ?></span>
						<?php if (!$habilitado): ?>
							<i class="fas fa-lock icono-candado"></i>
						<?php else: ?>
							<i class="fas fa-check icono-palomita"></i>
						<?php endif; ?>
					</a>
				<?php endforeach; ?>
			</div>
		</section>

	 <a href="../../menuphp/php/menuP.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90">
    </a>

	</main>

	<!-- Bootstrap JS (necesario para dropdown) -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

	<script>
		// Prevenir clic en departamentos bloqueados
		document.querySelectorAll('.opc.bloqueado').forEach(function(element) {
			element.addEventListener('click', function(e) {
				e.preventDefault();
				alert('No tienes permisos para acceder a este departamento.');
			});
		});
	</script>
</body>
</html>