document.addEventListener('DOMContentLoaded', function() {
    const NumBenefi = document.getElementById('NumBenefi');
    const MetaBeneficiarios = document.getElementById('MetaBeneficiarios');
    const MetaReal = document.getElementById('MetaReal');

     const LitrosVendidos = document.getElementById('LitrosVendidos');
    const NumBenefiActivos = document.getElementById('NumBenefiActivos');
    const DiasVenta = document.getElementById('DiasVenta');
    const FacRetLi = document.getElementById('FacRetLi');   

 const LitrosVendidosP = document.getElementById('LitrosVendidosPol');
    const NumBenefiActivosP = document.getElementById('NumBenefiActivosPol');
    const DiasVentaP = document.getElementById('DiasVentaPol');
    const FacRetP = document.getElementById('FacRetPol'); 

    const tne = document.getElementById('TNE');
    const familiasInscritas = document.getElementById('FamiliasInscritas');
    const porcentajeTNE = document.getElementById('PorcentajeTNE');

    const quejasR = document.getElementById('QuejasRecibidas');
    const quejasAtendidas = document.getElementById('QuejasAtendidas');
    const PQNA = document.getElementById('PQNA');

    const totalEncues = document.getElementById('TotalEncues');
    const maxPuntos = document.getElementById('MaxPuntos');
    const TPTE = document.getElementById('TPTE');
    const PEncuestas = document.getElementById('PorcentajeEncuestas');


    function actualizarTotal() {
        const valorTNE = parseFloat(tne.value) || 0;
        const valorFamilias = parseFloat(familiasInscritas.value) || 0;
        const valorQuejasR = parseFloat(quejasR.value) || 0;

        const valorQuejasAtendidas = parseFloat(quejasAtendidas.value) || 0;
         const valorBenef = parseFloat(NumBenefi.value) || 0;
        const valorMetabe = parseFloat(MetaBeneficiarios.value) || 0;

         const valorLit = parseFloat(LitrosVendidos.value) || 0;
        const valorBenefi = parseFloat(NumBenefiActivos.value) || 0;
        const valorDias = parseFloat(DiasVenta.value) || 0;

         const valorLitp = parseFloat(LitrosVendidosP.value) || 0;
        const valorBenefip = parseFloat(NumBenefiActivosP.value) || 0;
        const valorDiasp = parseFloat(DiasVentaP.value) || 0;

        const valorTotalEncues = parseFloat(totalEncues.value) || 0;
        const valorMaxPuntos = parseFloat(maxPuntos.value) || 0;
        const valorTPTE = parseFloat(TPTE.value) || 0;


        PEncuestas.value =  valorTPTE / (valorTotalEncues * valorMaxPuntos);
    
        FacRetP.value = valorLitp/valorBenefip/valorDiasp;
    
        FacRetLi.value = valorLit/valorBenefi/valorDias;
    
        MetaReal.value = valorBenef*100/ valorMetabe;
    
        porcentajeTNE.value =(valorTNE * 100) / valorFamilias ;

        PQNA.value = (valorQuejasAtendidas / valorQuejasR) *100 ;
    }

    familiasInscritas.addEventListener('input', actualizarTotal);
    porcentajeTNE.addEventListener('input', actualizarTotal);  
    quejasR.addEventListener('input', actualizarTotal);
    quejasAtendidas.addEventListener('input', actualizarTotal); 
    NumBenefi.addEventListener('input', actualizarTotal);
    MetaBeneficiarios.addEventListener('input', actualizarTotal);
    NumBenefiActivos.addEventListener('input', actualizarTotal);
    DiasVenta.addEventListener('input', actualizarTotal);  
    NumBenefiActivosP.addEventListener('input', actualizarTotal);
    DiasVentaP.addEventListener('input', actualizarTotal);
    totalEncues.addEventListener('input', actualizarTotal);
    maxPuntos.addEventListener('input', actualizarTotal);
    TPTE.addEventListener('input', actualizarTotal);

});