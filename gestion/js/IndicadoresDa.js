 document.addEventListener('DOMContentLoaded', function() {
    const NoSatis = document.getElementById('NoSatis');
    const NoPuntos = document.getElementById('NoPuntos');
    const DndSat = document.getElementById('DndSat');

    const NoSatisUnif = document.getElementById('NoSatisUnif');
    const NoPuntosUnif = document.getElementById('NoPuntosUnif');
    const DndSatUnif = document.getElementById('DndSatUnif');

    const CantAcci = document.getElementById('CantAcci');
    const DiasLaborados = document.getElementById('DiasLaborados');
    const Frecuencia = document.getElementById('Frecuencia');

    function actualizarTotal() {
        const valornosatis = parseFloat(NoSatis.value) || 0;
        const valornopuntos = parseFloat(NoPuntos.value) || 0;

        const valornosatisunif = parseFloat(NoSatisUnif.value) || 0;
        const valornopuntosunif = parseFloat(NoPuntosUnif.value) || 0;

        const valorcantacci = parseFloat(CantAcci.value) || 0;
        const valordiaslaborados = parseFloat(DiasLaborados.value) || 0;

        DndSat.value = (valornosatis / valornopuntos) *100;

        DndSatUnif.value = (valornosatisunif / valornopuntosunif) *100;

        Frecuencia.value = (valorcantacci / valordiaslaborados)*100;
        
    }

    NoSatis.addEventListener('input', actualizarTotal);
    NoPuntos.addEventListener('input', actualizarTotal);

    NoSatisUnif.addEventListener('input', actualizarTotal);
    NoPuntosUnif.addEventListener('input', actualizarTotal);

    CantAcci.addEventListener('input', actualizarTotal);
    DiasLaborados.addEventListener('input', actualizarTotal);
});