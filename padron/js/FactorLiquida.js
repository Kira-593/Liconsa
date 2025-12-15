document.addEventListener('DOMContentLoaded', function() {
    const LitrosVendidos = document.getElementById('LitrosVendidos');
    const NumBenefiActivos = document.getElementById('NumBenefiActivos');
    const DiasVenta = document.getElementById('DiasVenta');
    const FacRetLi = document.getElementById('FacRetLi');   


    function actualizarTotal() {
        const valorLit = parseFloat(LitrosVendidos.value) || 0;
        const valorBenefi = parseFloat(NumBenefiActivos.value) || 0;
        const valorDias = parseFloat(DiasVenta.value) || 0;
    
        FacRetLi.value = valorLit/valorBenefi/valorDias;
    }

    NumBenefiActivos.addEventListener('input', actualizarTotal);
    DiasVenta.addEventListener('input', actualizarTotal);       
});