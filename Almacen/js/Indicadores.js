 document.addEventListener('DOMContentLoaded', function() {
    const sumen = document.getElementById('SumEn');
    const numencuestas = document.getElementById('NumEncuestas');
    const puntossatisfaccion = document.getElementById('PuntosSatisfaccion');

    function actualizarTotal() {
        const valorsumen = parseFloat(sumen.value) || 0;
        const valornumencuestas = parseFloat(numencuestas.value) || 0;
    
        puntossatisfaccion.value = (valorsumen/valornumencuestas).toFixed(2);
    }

    sumen.addEventListener('input', actualizarTotal);
    numencuestas.addEventListener('input', actualizarTotal);       
});