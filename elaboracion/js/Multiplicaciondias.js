document.addEventListener('DOMContentLoaded', function() {
    const dias = document.getElementById('DiasOTD');
    const capasidad = document.getElementById('CapacidadITC');
    const total = document.getElementById('TotalCapacidad');

    function actualizarTotal() {
        const valorDias = parseFloat(dias.value) || 0;
        const valorCapasidad = parseFloat(capasidad.value) || 0;
        total.value = valorDias * valorCapasidad;
    }

    dias.addEventListener('input', actualizarTotal);
    capasidad.addEventListener('input', actualizarTotal);
});