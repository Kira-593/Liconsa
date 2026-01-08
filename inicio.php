<?php
// Obtener dominio permitido desde la tabla usuarios.validacion_correo.tipoCorreo
$allowedDomain = '@lechebienestar.gob.mx';
$departamento_correos = [];

// Intentar conectar a la base de datos 'usuarios' para obtener el dominio y correos por departamento
try {
    $mysqli = new mysqli('localhost', 'root', '', 'usuario');
    if (!$mysqli->connect_error) {
        // Obtener dominio permitido
        $res = $mysqli->query("SELECT tipoCorreo FROM validacion_correo LIMIT 1");
        if ($res && $row = $res->fetch_assoc()) {
            if (!empty($row['tipoCorreo'])) $allowedDomain = $row['tipoCorreo'];
        }
        
        // Obtener un correo por cada departamento (el primero activo o registrado)
        $res_dept = $mysqli->query("SELECT DISTINCT departamento, correo FROM users WHERE activo = 1 ORDER BY departamento, id ASC");
        if ($res_dept) {
            while ($row = $res_dept->fetch_assoc()) {
                if (!isset($departamento_correos[$row['departamento']])) {
                    $departamento_correos[$row['departamento']] = $row['correo'];
                }
            }
        }
        
        $mysqli->close();
    }
} catch (Exception $e) {
    // usar valor por defecto si falla
}

// Normalizar para que comience con @
if (substr($allowedDomain, 0, 1) !== '@') {
    $allowedDomain = '@' . $allowedDomain;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    
    <link rel="stylesheet" href="css/inicio.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <img src="imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="imagenes/sgc.png" class="logo-sgc" alt="SGC-MLS logo">
    <script>
        // Dominio permitido disponible para JavaScript
        window.allowedDomain = '<?php echo addslashes($allowedDomain); ?>';
        
        // Mapa de departamento -> correo para autocompletación
        window.departamentoCorreos = <?php echo json_encode($departamento_correos, JSON_UNESCAPED_SLASHES); ?>;
    </script>
</head>
<body>
    <main>
        <div class="contenedor__todo">
            <div class="caja__trasera">
                <div class="caja__trasera-login">
                    <h3>¿Ya tienes una cuenta?</h3>
                    <p>Inicia sesión para entrar en la página</p>
                    <button id="btn__iniciar-sesion">Iniciar Sesión</button>
                </div>
                <div class="caja__trasera-register">
                    <h3>¿Aún no tienes una cuenta?</h3>
                    <p>Regístrate para que puedas iniciar sesión</p>
                    <button id="btn__registrarse">Regístrarse</button>
                </div>
            </div>

            <div class="contenedor__login-register">
                <form name="form" method="POST" action="php/validar_login.php" class="formulario__login" required>
                    <h2>Iniciar Sesión</h2>
                    <select name="departamento" id="departamento" class="form-select" required>
                        <option value="">Selecciona tu departamento</option>
                        <option value="ADMIN">Administración</option>
                        <option value="ENVASADO">Envasado</option>
                        <option value="CALIDAD">Control de Calidad</option>
                        <option value="PADRON">Padrón de Beneficiarios</option>
                        <option value="DISTRIBUCION">Distribución</option>
                        <option value="ADQUISICIONES">Adquisiciones</option>
                        <option value="ALMACEN">Almacén</option>
                        <option value="MANTENIMIENTO">Mantenimiento</option>
                        <option value="INFORMATICA">Informática</option>
                        <option value="ELABORACION">Elaboración</option>
                        <option value="GESTION TRABAJO">Gestión del Trabajo</option>
                        <option value="RECURSOS FINANCIEROS">Recursos Financieros</option>
                    </select> 
                    <input type="text" name="correo" id="correo" placeholder="Correo" required>
                    <input type="password" name="password" id="password" placeholder="Contraseña" required>
                    <button>Entrar</button>
                       <!-- Contenedor para mensajes de intentos -->
                    <div id="attempts-message" class="attempts-message" style="display: none;"></div>
                    
                    <script>
                        // Autocompletar correo según departamento seleccionado
                        document.getElementById('departamento').addEventListener('change', function() {
                            var dept = this.value;
                            var correoField = document.getElementById('correo');
                            if (dept && window.departamentoCorreos && window.departamentoCorreos[dept]) {
                                correoField.value = window.departamentoCorreos[dept];
                            } else {
                                correoField.value = '';
                            }
                        });
                    </script>
                </form>

                    <form name="form" method="post" action="php/Guardar_login.php" class="formulario__register" required>
                        <h2>Regístrarse</h2>
                        <input type="text" name="nombre" placeholder="Nombre" minlength="2" required>
                        <input type="text" name="ap_P" placeholder="Apellido Paterno" minlength="2" required>
                        <input type="text" name="ap_M" placeholder="Apellido Materno" minlength="2" required>
                        <input type="text" name="correo" placeholder="Correo" required>
                        <input type="password" name="password" placeholder="Contraseña" required>
                        <input type="password" name="confirm_password" placeholder="Confirmar Contraseña" required>
                        <select name="departamento" class="form-select" required>
                            <option value="">Selecciona tu departamento</option>
                            <option value="ENVASADO">Envasado</option>
                            <option value="CALIDAD">Control de Calidad</option>
                            <option value="PADRON">Padrón de Beneficiarios</option>
                            <option value="DISTRIBUCION">Distribución</option>
                            <option value="ADQUISICIONES">Adquisiciones</option>
                            <option value="ALMACEN">Almacén</option>
                            <option value="MANTENIMIENTO">Mantenimiento</option>
                            <option value="INFORMATICA">Informática</option>
                            <option value="ELABORACION">Elaboración</option>
                            <option value="GESTION TRABAJO">Gestión del Trabajo</option>
                            <option value="RECURSOS FINANCIEROS">Recursos Financieros</option>
                        </select>
                        <input type="text" name="claveF" placeholder="Clave de Firma" required>
                        <button>Regístrarse</button>
                </form>
            </div>
        </div>
    </main>
    <script src="js/funcion.js"></script>
</body>
</html>