document.addEventListener('DOMContentLoaded', function() {
    const NumBenefi = document.getElementById('NumBenefi');
    const MetaBeneficiarios = document.getElementById('MetaBeneficiarios');
    const MetaReal = document.getElementById('MetaReal');

    function actualizarTotal() {
        const valorBenef = parseFloat(NumBenefi.value) || 0;
        const valorMetabe = parseFloat(MetaBeneficiarios.value) || 0;
    
        MetaReal.value = valorBenef*100/ valorMetabe;
    }

    NumBenefi.addEventListener('input', actualizarTotal);
    MetaBeneficiarios.addEventListener('input', actualizarTotal);       
});