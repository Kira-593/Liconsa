//Ejecutando funciones
document.getElementById("btn__iniciar-sesion").addEventListener("click", iniciarSesion);
document.getElementById("btn__registrarse").addEventListener("click", register);
window.addEventListener("resize", anchoPage);

// Inicializar validaciones cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', inicializarValidaciones);

//Declarando variables
var formulario_login = document.querySelector(".formulario__login");
var formulario_register = document.querySelector(".formulario__register");
var contenedor_login_register = document.querySelector(".contenedor__login-register");
var caja_trasera_login = document.querySelector(".caja__trasera-login");
var caja_trasera_register = document.querySelector(".caja__trasera-register");

    //FUNCIONES

function anchoPage(){

    if (window.innerWidth > 850){
        caja_trasera_register.style.display = "block";
        caja_trasera_login.style.display = "block";
    }else{
        caja_trasera_register.style.display = "block";
        caja_trasera_register.style.opacity = "1";
        caja_trasera_login.style.display = "none";
        formulario_login.style.display = "block";
        contenedor_login_register.style.left = "0px";
        formulario_register.style.display = "none";   
    }
}

anchoPage();


    function iniciarSesion(){
        if (window.innerWidth > 850){
            formulario_login.style.display = "block";
            contenedor_login_register.style.left = "10px";
            formulario_register.style.display = "none";
            caja_trasera_register.style.opacity = "1";
            caja_trasera_login.style.opacity = "0";
        }else{
            formulario_login.style.display = "block";
            contenedor_login_register.style.left = "0px";
            formulario_register.style.display = "none";
            caja_trasera_register.style.display = "block";
            caja_trasera_login.style.display = "none";
        }
    }

    function register(){
        if (window.innerWidth > 850){
            formulario_register.style.display = "block";
            contenedor_login_register.style.left = "410px";
            formulario_login.style.display = "none";
            caja_trasera_register.style.opacity = "0";
            caja_trasera_login.style.opacity = "1";
        }else{
            formulario_register.style.display = "block";
            contenedor_login_register.style.left = "0px";
            formulario_login.style.display = "none";
            caja_trasera_register.style.display = "none";
            caja_trasera_login.style.display = "block";
            caja_trasera_login.style.opacity = "1";
        }
}

// Función para validar nombres (solo letras, sin caracteres especiales)
function validarNombre(event) {
    let input = event.target;
    let valor = input.value;
    
    // Permitir solo letras (incluyendo acentos) y espacios (SIN guiones)
    let valorLimpio = valor.replace(/[^a-záéíóúñA-ZÁÉÍÓÚÑ\s]/g, '');
    
    // Si el valor cambió, actualizarlo
    if (valorLimpio !== valor) {
        input.value = valorLimpio;
    }
    
    // Capitalizar primera letra de cada palabra
    if (valorLimpio.length > 0) {
        let palabras = valorLimpio.split(/(\s+)/);
        let resultado = palabras.map(palabra => {
            if (palabra.match(/\s+/)) {
                return palabra;
            }
            return palabra.charAt(0).toUpperCase() + palabra.slice(1).toLowerCase();
        }).join('');
        input.value = resultado;
    }
}

// Función para inicializar las validaciones
function inicializarValidaciones() {
    let nombre = document.querySelector('input[name="nombre"]');
    let ap_P = document.querySelector('input[name="ap_P"]');
    let ap_M = document.querySelector('input[name="ap_M"]');
    
    if (nombre) nombre.addEventListener('input', validarNombre);
    if (ap_P) ap_P.addEventListener('input', validarNombre);
    if (ap_M) ap_M.addEventListener('input', validarNombre);

    // Validación de correo con dominio permitido (registro)
    try {
        var regForm = document.querySelector('.formulario__register');
        if (regForm) {
            var correoReg = regForm.querySelector('input[name="correo"]');
            var dominioPermitido = window.allowedDomain || '@lechebienestar.gob.mx';

            function validarCorreoInput() {
                if (!correoReg) return;
                var val = correoReg.value.trim();
                if (val === '') {
                    correoReg.setCustomValidity('');
                    return;
                }
                // comprobar que termina con el dominio (case-insensitive)
                var regex = new RegExp(dominioPermitido.replace(/[.*+?^${}()|[\]\\]/g, "\\$&") + "$", 'i');
                if (!regex.test(val)) {
                    correoReg.setCustomValidity('El correo debe pertenecer al dominio: ' + dominioPermitido);
                } else {
                    correoReg.setCustomValidity('');
                }
            }

            if (correoReg) {
                correoReg.addEventListener('input', validarCorreoInput);
                // validar al enviar
                regForm.addEventListener('submit', function(e){
                    validarCorreoInput();
                    if (!correoReg.checkValidity()) {
                        e.preventDefault();
                        correoReg.reportValidity();
                    }
                });
            }
        }
    } catch (err) {
        console.error('Error inicializando validación de correo:', err);
    }
}

function checkLoginStatusWithServer(correo) {
    const formData = new FormData();
    formData.append('correo', correo);
    formData.append('check_status', 'true');
    
    fetch('php/validar_login.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error en la respuesta del servidor');
        }
        return response.json();
    })
    .then(data => {
        if (data.locked) {
            const minutes = Math.ceil(data.remaining_time / 60);
            const seconds = data.remaining_time % 60;
            showLockoutMessage(minutes, seconds, 3);
            disableLoginButton();
            startCountdown(data.remaining_time * 1000, correo);
        } else if (data.attempts > 0) {
            showAttemptsWarning(data.remaining_attempts, data.attempts);
            enableLoginButton();
            
            // Registrar también localmente para consistencia
            const attemptKey = `login_attempts_${btoa(correo)}`;
            localStorage.setItem(attemptKey, JSON.stringify({
                attempts: data.attempts,
                lastAttempt: Date.now()
            }));
        } else {
            hideMessage();
            enableLoginButton();
            
            // Limpiar intentos locales si no hay en el servidor
            const attemptKey = `login_attempts_${btoa(correo)}`;
            localStorage.removeItem(attemptKey);
        }
    })
    .catch(error => {
        console.error('Error checking login status:', error);
        // Fallback al sistema local
        checkLocalAttempts(correo);
    });
}   

// Sistema de control de intentos de login
function initializeLoginAttemptsSystem() {
    const correoInput = document.getElementById('correo');
    const loginBtn = document.getElementById('login-btn') || document.querySelector('.formulario__login button');
    const loginForm = document.querySelector('.formulario__login');
    
    if (correoInput && loginBtn) {
        // Verificar estado cuando el usuario escribe el correo
        correoInput.addEventListener('input', function() {
            setTimeout(() => {
                checkLoginAttempts();
            }, 1000);
        });
        
        // Verificar cuando el campo pierde el foco
        correoInput.addEventListener('blur', checkLoginAttempts);
        
        // Prevenir envío del formulario si está bloqueado
        if (loginForm) {
            loginForm.addEventListener('submit', function(e) {
                const correo = correoInput.value.trim();
                if (isUserLocked(correo)) {
                    e.preventDefault();
                    showLockoutMessage(correo);
                }
            });
        }
    }
}

function checkLoginAttempts() {
    const correoInput = document.getElementById('correo');
    const loginBtn = document.getElementById('login-btn') || document.querySelector('.formulario__login button');
    
    if (!correoInput || !loginBtn) return;
    
    const correo = correoInput.value.trim();
    
    if (!correo) {
        hideAttemptsMessage();
        enableLoginButton();
        return;
    }
    
    // Verificar intentos locales
    checkLocalAttempts(correo);
}

function isUserLocked(correo) {
    const attemptKey = `login_attempts_${btoa(correo)}`;
    const attemptsData = localStorage.getItem(attemptKey);
    
    if (attemptsData) {
        const data = JSON.parse(attemptsData);
        const currentTime = Date.now();
        const lockoutTime = 5 * 60 * 1000; // 5 minutos
        
        return data.attempts >= 3 && (currentTime - data.lastAttempt) < lockoutTime;
    }
    return false;
}

function checkLocalAttempts(correo) {
    const attemptKey = `login_attempts_${btoa(correo)}`;
    const attemptsData = localStorage.getItem(attemptKey);
    const loginBtn = document.getElementById('login-btn') || document.querySelector('.formulario__login button');
    
    if (attemptsData) {
        const data = JSON.parse(attemptsData);
        const currentTime = Date.now();
        const lockoutTime = 5 * 60 * 1000; // 5 minutos
        
        // Verificar si está bloqueado
        if (data.attempts >= 3 && (currentTime - data.lastAttempt) < lockoutTime) {
            const remaining = lockoutTime - (currentTime - data.lastAttempt);
            const minutes = Math.floor(remaining / 60000);
            const seconds = Math.floor((remaining % 60000) / 1000);
            
            showLockoutMessageUI(minutes, seconds, data.attempts);
            disableLoginButton();
            startCountdown(remaining, correo);
            return;
        }
        
        // Mostrar advertencia de intentos
        if (data.attempts > 0 && data.attempts < 3) {
            const remainingAttempts = 3 - data.attempts;
            showAttemptsWarning(remainingAttempts, data.attempts);
            enableLoginButton();
        } else {
            hideAttemptsMessage();
            enableLoginButton();
        }
        
        // Limpiar datos expirados
        if ((currentTime - data.lastAttempt) >= lockoutTime) {
            localStorage.removeItem(attemptKey);
            hideAttemptsMessage();
            enableLoginButton();
        }
    } else {
        hideAttemptsMessage();
        enableLoginButton();
    }
}

function showLockoutMessageUI(minutes, seconds, attempts) {
    let messageDiv = document.getElementById('attempts-message');
    if (!messageDiv) {
        messageDiv = document.createElement('div');
        messageDiv.id = 'attempts-message';
        messageDiv.className = 'attempts-message';
        const loginForm = document.querySelector('.formulario__login');
        if (loginForm) {
            loginForm.appendChild(messageDiv);
        }
    }
    
    messageDiv.innerHTML = `
        <div class="attempts-locked">
            <strong>🔒 Cuenta Bloqueada</strong><br>
            Demasiados intentos fallidos.<br>
            Tiempo restante: <span class="countdown-timer">${minutes}:${seconds.toString().padStart(2, '0')}</span>
        </div>
    `;
    messageDiv.style.display = 'block';
}

function showAttemptsWarning(remainingAttempts, currentAttempts) {
    let messageDiv = document.getElementById('attempts-message');
    if (!messageDiv) {
        messageDiv = document.createElement('div');
        messageDiv.id = 'attempts-message';
        messageDiv.className = 'attempts-message';
        const loginForm = document.querySelector('.formulario__login');
        if (loginForm) {
            loginForm.appendChild(messageDiv);
        }
    }
    
    const percentage = (currentAttempts / 3) * 100;
    
    messageDiv.innerHTML = `
        <div class="attempts-warning">
            <strong>⚠ Advertencia</strong><br>
            Intentos fallidos: ${currentAttempts} de 3<br>
            Le quedan <strong>${remainingAttempts}</strong> intento(s)
            <div class="attempts-progress">
                <div class="attempts-progress-bar ${currentAttempts >= 2 ? 'danger' : 'warning'}" 
                     style="width: ${percentage}%"></div>
            </div>
        </div>
    `;
    messageDiv.style.display = 'block';
}

function hideAttemptsMessage() {
    const messageDiv = document.getElementById('attempts-message');
    if (messageDiv) {
        messageDiv.style.display = 'none';
    }
}

function disableLoginButton() {
    const loginBtn = document.getElementById('login-btn') || document.querySelector('.formulario__login button');
    if (loginBtn) {
        loginBtn.disabled = true;
        loginBtn.classList.add('btn-disabled');
    }
}

function enableLoginButton() {
    const loginBtn = document.getElementById('login-btn') || document.querySelector('.formulario__login button');
    if (loginBtn) {
        loginBtn.disabled = false;
        loginBtn.classList.remove('btn-disabled');
    }
}

function startCountdown(duration, correo) {
    const countdownElement = document.querySelector('.countdown-timer');
    if (!countdownElement) return;
    
    const countdownInterval = setInterval(() => {
        duration -= 1000;
        
        if (duration <= 0) {
            clearInterval(countdownInterval);
            localStorage.removeItem(`login_attempts_${btoa(correo)}`);
            hideAttemptsMessage();
            enableLoginButton();
            return;
        }
        
        const minutes = Math.floor(duration / 60000);
        const seconds = Math.floor((duration % 60000) / 1000);
        
        if (countdownElement) {
            countdownElement.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
        }
    }, 1000);
}

// Registrar intentos fallidos localmente (para sincronizar con el servidor)
function recordFailedAttempt(correo) {
    const attemptKey = `login_attempts_${btoa(correo)}`;
    const attemptsData = localStorage.getItem(attemptKey);
    
    if (attemptsData) {
        const data = JSON.parse(attemptsData);
        data.attempts++;
        data.lastAttempt = Date.now();
        localStorage.setItem(attemptKey, JSON.stringify(data));
    } else {
        localStorage.setItem(attemptKey, JSON.stringify({
            attempts: 1,
            lastAttempt: Date.now()
        }));
    }
}

// Inicializar el sistema cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    initializeLoginAttemptsSystem();
});