// ValidacionFirma.js
function inicializarValidacionFirma() {
    const formulario = document.getElementById('formulario');
    const firmarCheckbox = document.getElementById('firmar_documento');
    const claveFirma = document.getElementById('clave_firma');
    const confirmarClave = document.getElementById('confirmar_clave');
    
    // Si no existe la sección de firma, salir
    if (!firmarCheckbox || !formulario) {
        console.log('Elementos de firma no encontrados');
        return;
    }
    
    console.log('Inicializando validación de firma...');
    
    // Habilitar/deshabilitar campos de firma según el checkbox
    firmarCheckbox.addEventListener('change', function() {
        const habilitado = this.checked;
        console.log('Checkbox cambiado:', habilitado);
        
        if (claveFirma) claveFirma.disabled = !habilitado;
        if (confirmarClave) confirmarClave.disabled = !habilitado;
        
        if (!habilitado) {
            if (claveFirma) claveFirma.value = '';
            if (confirmarClave) confirmarClave.value = '';
        }
    });
    
    // Validación al enviar el formulario
    formulario.addEventListener('submit', function(e) {
        console.log('Formulario enviándose...');
        
        if (firmarCheckbox && firmarCheckbox.checked) {
            console.log('Validando firma...');
            
            // Validar que las claves coincidan
            if (claveFirma.value !== confirmarClave.value) {
                e.preventDefault();
                alert('❌ Las claves de firma no coinciden. Por favor verifique.');
                claveFirma.focus();
                return;
            }
            
            // Validar que la clave no esté vacía
            if (claveFirma.value.trim() === '') {
                e.preventDefault();
                alert('❌ Debe ingresar su clave de firma.');
                claveFirma.focus();
                return;
            }
            
            // Validar longitud mínima de la clave
            if (claveFirma.value.length < 4) {
                e.preventDefault();
                alert('❌ La clave de firma debe tener al menos 4 caracteres.');
                claveFirma.focus();
                return;
            }
            
            if (!confirm('⚠️ ¿Está seguro de que desea firmar este documento?\n\nEsta acción no se puede deshacer y el documento quedará bloqueado para futuras modificaciones.')) {
                e.preventDefault();
                return;
            }
            
            console.log('Firma validada correctamente');
        }
    });
    
    // Inicializar campos como deshabilitados
    if (claveFirma) claveFirma.disabled = true;
    if (confirmarClave) confirmarClave.disabled = true;
    
    console.log('Validación de firma inicializada correctamente');
}

// Ejecutar cuando el DOM esté listo
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', inicializarValidacionFirma);
} else {
    inicializarValidacionFirma();
}