document.addEventListener('DOMContentLoaded', function() {
    const aut = document.getElementById('ExpedinAut');
    const recibi = document.getElementById('ExpendiReci');
    const porcentaje = document.getElementById('PorcentajeExpAut');

    function actualizarTotal() {
        const valoraut = parseFloat(aut.value) || 0;
        const valorrecibi = parseFloat(recibi.value) || 0;

        porcentaje.value = ((valoraut*100) / valorrecibi).toFixed(2);
    }

    aut.addEventListener('input', actualizarTotal);
    recibi.addEventListener('input', actualizarTotal);       
});