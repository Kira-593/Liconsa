 document.addEventListener('DOMContentLoaded', function() {
    const ExpAtend = document.getElementById('ExpAtend');
    const ExpRecib = document.getElementById('ExpRecib');
    const Cumplimiento = document.getElementById('Cumplimiento');

    const EncuSatisfa = document.getElementById('EncuSatisfa');
    const EncEnvia = document.getElementById('EncEnvia');
    const Satisfaccion = document.getElementById('Satisfaccion');

    function actualizarTotal() {
        const valorExpAtend = parseFloat(ExpAtend.value) || 0;
        const valorExpRecib = parseFloat(ExpRecib.value) || 0;

        const valorEncuSatisfa = parseFloat(EncuSatisfa.value) || 0;
        const valorEncEnvia = parseFloat(EncEnvia.value) || 0;

        Satisfaccion.value = ((valorEncuSatisfa / valorEncEnvia)*100).toFixed(2);
        Cumplimiento.value = ((valorExpAtend / valorExpRecib)*100).toFixed(2);
    }

    ExpAtend.addEventListener('input', actualizarTotal);
    ExpRecib.addEventListener('input', actualizarTotal);   
    EncuSatisfa.addEventListener('input', actualizarTotal);
    EncEnvia.addEventListener('input', actualizarTotal);  
});