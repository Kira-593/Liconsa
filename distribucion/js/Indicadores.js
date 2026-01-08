document.addEventListener('DOMContentLoaded', function() {
    const cumplimiento=document.getElementById('CumplRealProgDia');
    const despacho=document.getElementById('ProgDiarioDespacho');
    const pcdp=document.getElementById('PCDP');

    const ventatot=document.getElementById('Ventatot');
    const dotacion=document.getElementById('DotEntre');
    const cumplimientoVentas=document.getElementById('CumplimientoVentas');

    const MermasEnva=document.getElementById('MermasEnva');
    const DotEnva=document.getElementById('DotEnva');
    const CantidadEnvRotos=document.getElementById('CantidadEnvRotos');

    const Devoluciones=document.getElementById('Devoluciones');
    const DotDev=document.getElementById('DotDev');
    const DevolucionesDPAS=document.getElementById('DevolucionesDPAS');

    const gastostd=document.getElementById('GastosTD');
    const litrosdistribucion=document.getElementById('LitrosDistribucion');
    const gastosdistribucion=document.getElementById('GastosDistribucion');
    

    function actualizarTotal() {
        const valorcumplimiento= parseFloat(cumplimiento.value) || 0;
        const valordespacho= parseFloat(despacho.value) || 0;

        const valorventatot= parseFloat(ventatot.value) || 0;
        const valordotacion= parseFloat(dotacion.value) || 0;

        const valormermas= parseFloat(MermasEnva.value) || 0;
        const valordotacionenva= parseFloat(DotEnva.value) || 0;

        const valordevoluciones= parseFloat(Devoluciones.value) || 0;
        const valordotaciondev= parseFloat(DotDev.value) || 0;

        const valorgastostd= parseFloat(gastostd.value) || 0;
        const valorlitrosdistribucion= parseFloat(litrosdistribucion.value) || 0;
    
        pcdp.value = ((valorcumplimiento / valordespacho)*100).toFixed(2);
        cumplimientoVentas.value = (valorventatot / valordotacion*100).toFixed(2);
        CantidadEnvRotos.value = (valormermas / valordotacionenva*100).toFixed(2);
        DevolucionesDPAS.value = (valordevoluciones / valordotaciondev*100).toFixed(2);
        gastosdistribucion.value = (valorgastostd / valorlitrosdistribucion).toFixed(2);
    }

    cumplimiento.addEventListener('input', actualizarTotal);
    despacho.addEventListener('input', actualizarTotal);  
    ventatot.addEventListener('input', actualizarTotal);
    dotacion.addEventListener('input', actualizarTotal);    
    MermasEnva.addEventListener('input', actualizarTotal);
    DotEnva.addEventListener('input', actualizarTotal);   
    Devoluciones.addEventListener('input', actualizarTotal);
    DotDev.addEventListener('input', actualizarTotal);
    gastostd.addEventListener('input', actualizarTotal);
    litrosdistribucion.addEventListener('input', actualizarTotal);  
});