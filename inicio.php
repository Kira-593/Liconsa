<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    
    <link rel="stylesheet" href="css/inicio.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
                    <input type="text" name="login" id="login" placeholder="Usuario">
                    <input type="password" name="password" id="password" placeholder="Contraseña" required>
                    <button>Entrar</button>
                </form>

                <form name="form" method="post" action="php/Guardar_login.php" class="formulario__register" required>
                    <h2>Regístrarse</h2>
                    <input type="text" name="nombrec" placeholder="Nombre completo" required>
                    <input type="text" name="user" placeholder="Usuario" required>
                    <input type="password" name="password" placeholder="Contraseña" required>
                    <button>Regístrarse</button>
                </form>
            </div>
        </div>
    </main>
    <script src="js/funcion.js"></script>
</body>
</html>