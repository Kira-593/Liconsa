document.addEventListener('DOMContentLoaded', function() {
    const real = document.getElementById('PDOACP');
    const planeado = document.getElementById('DBPAS');
    const ajuste = document.getElementById('LRAPMDOL');
    const porcentaje = document.getElementById('PC');
    const despaprog = document.getElementById('DespaProg');
    const despareal = document.getElementById('DespaReal');
    const lecheprograma = document.getElementById('LechePrograma');
    const porcentajeproduccion = document.getElementById('porcentajeProduccion');
    const ppl = document.getElementById('PPL');


    function actualizarTotal() {
        const valorreal = parseFloat(real.value) || 0;
        const valorplaneado = parseFloat(planeado.value) || 0;
        const valordespaprog = parseFloat(despaprog.value) || 0;
        const valordespareal = parseFloat(despareal.value) || 0;
        const valorlecheprograma = parseFloat(lecheprograma.value) || 0;

        
     
        
        
        

   
    
        ajuste.value = valorreal - valorplaneado;
        porcentaje.value = (valorreal / valorplaneado )*100;
         x =valordespareal;
        porcentajeproduccion.value = (valordespaprog / valordespareal)*100;
        ppl.value=((x)/valorlecheprograma)*100;
    }

    
    planeado.addEventListener('input', actualizarTotal);
    real.addEventListener('input', actualizarTotal);
    despaprog.addEventListener('input', actualizarTotal);
    despareal.addEventListener('input', actualizarTotal);
    lecheprograma.addEventListener('input', actualizarTotal);
    x.addEventListener('input', actualizarTotal);


});