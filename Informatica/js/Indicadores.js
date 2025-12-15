 document.addEventListener('DOMContentLoaded', function() {
    const SolicitudesAtendidas = document.getElementById('SolicitudesAtendidas');
    const NumSolicitudes = document.getElementById('NumSolicitudes');
    const PorSolicitudesAtendidas = document.getElementById('PorSolicitudesAtendidas');

    function actualizarTotal() {
        const valorSolicitudesAtendidas = parseFloat(SolicitudesAtendidas.value) || 0;
        const valorNumSolicitudes = parseFloat(NumSolicitudes.value) || 0;
    
        PorSolicitudesAtendidas.value = (valorSolicitudesAtendidas / valorNumSolicitudes)*100    ;
    }

    SolicitudesAtendidas.addEventListener('input', actualizarTotal);
    NumSolicitudes.addEventListener('input', actualizarTotal);       
});