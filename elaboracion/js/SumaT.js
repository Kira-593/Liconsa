document.addEventListener('DOMContentLoaded', function() {
    const frisia = document.getElementById('Leche_Frisia');
    const abasto = document.getElementById('Leche_Abasto');
    const total = document.getElementById('Total');

    function actualizarTotal() {
        const valorFrisia = parseFloat(frisia.value) || 0;
        const valorAbasto = parseFloat(abasto.value) || 0;
        total.value = valorFrisia + valorAbasto;
    }

    frisia.addEventListener('input', actualizarTotal);
    abasto.addEventListener('input', actualizarTotal);
});