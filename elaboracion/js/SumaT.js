document.addEventListener('DOMContentLoaded', function() {
    const frisa = document.getElementById('Leche_Frisa');
    const abasto = document.getElementById('Leche_Abasto');
    const total = document.getElementById('Total');

    function actualizarTotal() {
        const valorFrisa = parseFloat(frisa.value) || 0;
        const valorAbasto = parseFloat(abasto.value) || 0;
        total.value = valorFrisa + valorAbasto;
    }

    frisa.addEventListener('input', actualizarTotal);
    abasto.addEventListener('input', actualizarTotal);
});