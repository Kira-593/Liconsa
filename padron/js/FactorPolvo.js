document.addEventListener('DOMContentLoaded', function() {
    const LitrosVendidosP = document.getElementById('LitrosVendidosPol');
    const NumBenefiActivosP = document.getElementById('NumBenefiActivosPol');
    const DiasVentaP = document.getElementById('DiasVentaPol');
    const FacRetP = document.getElementById('FacRetPol');   


    function actualizarTotal() {
        const valorLit = parseFloat(LitrosVendidosP.value) || 0;
        const valorBenefi = parseFloat(NumBenefiActivosP.value) || 0;
        const valorDias = parseFloat(DiasVentaP.value) || 0;
    
        FacRetP.value = valorLit/valorBenefi/valorDias;
    }

    NumBenefiActivosP.addEventListener('input', actualizarTotal);
    DiasVentaP.addEventListener('input', actualizarTotal);       
});