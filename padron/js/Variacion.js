document.addEventListener('DOMContentLoaded', function() {
    const altas = document.getElementById('AltasTA');
    const bajas = document.getElementById('BajasTB');
    const total = document.getElementById('VariacionTV');

    function actualizarTotal() {
        const valorAltas = parseFloat(altas.value) || 0;
        const valorBajas = parseFloat(bajas.value) || 0;
        total.value = valorAltas - valorBajas;
    }

    altas.addEventListener('input', actualizarTotal);
    bajas.addEventListener('input', actualizarTotal);
});