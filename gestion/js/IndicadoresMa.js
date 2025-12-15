 document.addEventListener('DOMContentLoaded', function() {
    const capaImpar = document.getElementById('CapaImpar');
    const capaProg = document.getElementById('CapaProg');
    const porCumplimientoCAP = document.getElementById('PorCumplimientoCAP');
    const NuevosIP = document.getElementById('NuevosIP');
    const NumEvaluaciones = document.getElementById('NumEvaluaciones');
    const porCumplimientoET = document.getElementById('PorCumplimientoET');

    function actualizarTotal() {
        const valorcapampar = parseFloat(capaImpar.value) || 0;
        const valorcapaprog = parseFloat(capaProg.value) || 0;

        const valornuevosip = parseFloat(NuevosIP.value) || 0;
        const valornumevaluaciones = parseFloat(NumEvaluaciones.value) || 0;
    
        porCumplimientoCAP.value = (valorcapampar / valorcapaprog) *100;
        porCumplimientoET.value = (valornumevaluaciones/valornuevosip ) *100;
    }

    capaImpar.addEventListener('input', actualizarTotal);
    capaProg.addEventListener('input', actualizarTotal);       
    NuevosIP.addEventListener('input', actualizarTotal);
    NumEvaluaciones.addEventListener('input', actualizarTotal);
});