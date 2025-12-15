 document.addEventListener('DOMContentLoaded', function() {
    const NumEquiposAtendidos = document.getElementById('NumEquiposAtendidos');
    const NumEquiposProgramados = document.getElementById('NumEquiposProgramados');
    const CalibracionEquipos = document.getElementById('CalibracionEquipos');

    const NumObservaciones = document.getElementById('NumObservaciones');
    const NumPuntosEvaluados = document.getElementById('NumPuntosEvaluados');
    const CumplimientoPuntosEvaluados = document.getElementById('CumplimientoPuntosEvaluados');

    function actualizarTotal() {
        const valorNumEquiposAtendidos = parseFloat(NumEquiposAtendidos.value) || 0;
        const valorNumEquiposProgramados = parseFloat(NumEquiposProgramados.value) || 0;

        const valorNumObservaciones = parseFloat(NumObservaciones.value) || 0;
        const valorNumPuntosEvaluados = parseFloat(NumPuntosEvaluados.value) || 0;

        CalibracionEquipos.value = (valorNumEquiposAtendidos / valorNumEquiposProgramados)*100;
        CumplimientoPuntosEvaluados.value = (valorNumObservaciones / valorNumPuntosEvaluados)*100;
    }

    NumEquiposAtendidos.addEventListener('input', actualizarTotal);
    NumEquiposProgramados.addEventListener('input', actualizarTotal);
    
    NumObservaciones.addEventListener('input', actualizarTotal);
    NumPuntosEvaluados.addEventListener('input', actualizarTotal);
});