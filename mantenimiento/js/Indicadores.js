document.addEventListener('DOMContentLoaded', function() {
    const PresEje= document.getElementById('PresEje');
    const GastoAutorizado = document.getElementById('GastoAutorizado');
    const Diferiencia = document.getElementById('Diferiencia');

    const HorasHombre = document.getElementById('HorasHombre');
    const HorasParo = document.getElementById('HorasParo');
    const HorasDisponibles = document.getElementById('HorasDisponibles');
    const prc = document.getElementById('prc');


    const TPE = document.getElementById('TPE');
    const TP = document.getElementById('TP');
    const PorcentTP = document.getElementById('PorcentTP');

    const TC = document.getElementById('TC');
    const PorcentTC = document.getElementById('PorcentTC');

    const ConsumoAgua = document.getElementById('ConsumoAgua');
    const LitrosLecheProducida = document.getElementById('LitrosLecheProducida');
    const ConsTA = document.getElementById('ConsTA');

    // NUEVOS CAMPOS → Consumo Térmico
    const ConsumoTermico = document.getElementById('ConsumoTermico');
    const LitrosLecheProducidatermica = document.getElementById('LitrosLecheProducidatermica');
    const ConsTT = document.getElementById('ConsTT');

    // NUEVOS CAMPOS → Consumo Eléctrico
    const ConsumoElectrico = document.getElementById('ConsumoElectrico');
    const LitrosLecheProducidaElectrico = document.getElementById('LitrosLecheProducidaElectrico');
    const ConsTE = document.getElementById('ConsTE');

    const HorasHombreEnv = document.getElementById('HorasHombreEnv');
    const HorasParoEnv = document.getElementById('HorasParoEnv');
    const HorasDisponiblesEnv = document.getElementById('HorasDisponiblesEnv');
    const prcEnv = document.getElementById('prcEnv');

    const HorasHombreReh = document.getElementById('HorasHombreReh');
    const HorasParoReh = document.getElementById('HorasParoReh');
    const HorasDisponiblesReh = document.getElementById('HorasDisponiblesReh');
    const prcReh = document.getElementById('prcReh');

    function actualizarTotal() {
        const valoreje = parseFloat(PresEje.value) || 0;
        const valorgasto = parseFloat(GastoAutorizado.value) || 0;

        const valorhorashombre = parseFloat(HorasHombre.value) || 0;
        const valorhorasparo = parseFloat(HorasParo.value) || 0;
        const valorhorasdisponibles = parseFloat(HorasDisponibles.value) || 0;

        const valortpe = parseFloat(TPE.value) || 0;
        const valortp = parseFloat(TP.value) || 0;

        const valortc = parseFloat(TC.value) || 0;

        const valorconsumoagua = parseFloat(ConsumoAgua.value) || 0;
        const valorlecheproducida = parseFloat(LitrosLecheProducida.value) || 0;

        // NUEVOS: valores para consumo térmico
        const valorconsumotermico = parseFloat(ConsumoTermico.value) || 0;
        const valorlechetermica = parseFloat(LitrosLecheProducidatermica.value) || 0;

        // NUEVOS: valores para consumo eléctrico
        const valorconsumoelectrico = parseFloat(ConsumoElectrico.value) || 0;
        const valorlecheelectrica = parseFloat(LitrosLecheProducidaElectrico.value) || 0;

        const valorhorashombreEnv = parseFloat(HorasHombreEnv.value) || 0;
        const valorhorasparoEnv = parseFloat(HorasParoEnv.value) || 0;
        const valorhorasdisponiblesEnv = parseFloat(HorasDisponiblesEnv.value) || 0;

        const valorhorashombreReh = parseFloat(HorasHombreReh.value) || 0;
        const valorhorasparoReh = parseFloat(HorasParoReh.value) || 0;
        const valorhorasdisponiblesReh = parseFloat(HorasDisponiblesReh.value) || 0;

        


        // CALCULOS
        Diferiencia.value = valorgasto - valoreje;

        prc.value = (valorhorasdisponibles ? ((valorhorashombre - valorhorasparo) / valorhorasdisponibles) * 100 : 0).toFixed(2);

        prcEnv.value = (valorhorasdisponiblesEnv ? ((valorhorashombreEnv - valorhorasparoEnv) / valorhorasdisponiblesEnv) * 100 : 0).toFixed(2);
        prcReh.value = (valorhorasdisponiblesReh ? ((valorhorashombreReh - valorhorasparoReh) / valorhorasdisponiblesReh) * 100 : 0).toFixed(2);

        PorcentTP.value = valortp ? (((valortpe / valortp) * 100)).toFixed(2) : 0;
        PorcentTC.value = valortp ? (((valortc / valortp) * 100)).toFixed(2) : 0;
        ConsTA.value = (valorlecheproducida ? (valorconsumoagua / valorlecheproducida) : 0).toFixed(2);

        // NUEVO → Cálculo Consumo TÉRMICO
        ConsTT.value = (valorlechetermica ? (valorconsumotermico / valorlechetermica) : 0).toFixed(2);

        // NUEVO → Cálculo Consumo ELÉCTRICO
        ConsTE.value = (valorlecheelectrica ? (valorconsumoelectrico / valorlecheelectrica) : 0).toFixed(2);
    }


    // EVENTOS (incluyen nuevos campos)
    PresEje.addEventListener('input', actualizarTotal);
    GastoAutorizado.addEventListener('input', actualizarTotal);
    HorasHombre.addEventListener('input', actualizarTotal);
    HorasParo.addEventListener('input', actualizarTotal);
    HorasDisponibles.addEventListener('input', actualizarTotal);
    TPE.addEventListener('input', actualizarTotal);
    TP.addEventListener('input', actualizarTotal);
    TC.addEventListener('input', actualizarTotal);
    ConsumoAgua.addEventListener('input', actualizarTotal);
    LitrosLecheProducida.addEventListener('input', actualizarTotal);

    // Nuevos eventos
    ConsumoTermico.addEventListener('input', actualizarTotal);
    LitrosLecheProducidatermica.addEventListener('input', actualizarTotal);
    ConsumoElectrico.addEventListener('input', actualizarTotal);
    LitrosLecheProducidaElectrico.addEventListener('input', actualizarTotal);

    HorasHombreEnv.addEventListener('input', actualizarTotal);
    HorasParoEnv.addEventListener('input', actualizarTotal);
    HorasDisponiblesEnv.addEventListener('input', actualizarTotal); 

    HorasHombreReh.addEventListener('input', actualizarTotal);
    HorasParoReh.addEventListener('input', actualizarTotal);
    HorasDisponiblesReh.addEventListener('input', actualizarTotal);      

});
