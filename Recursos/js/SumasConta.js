
//-----------------------------------------------------------------------------
//-------------------Servicios Personales-------------------------------
//----------------------------------------------------------------------

document.addEventListener('DOMContentLoaded', function() {
    const comprometidoEMCO = document.getElementById('ComprometidoEMCO');
    const comprometidoMAOB = document.getElementById('ComprometidoMAOB');
    const comprometidoEMEV = document.getElementById('ComprometidoEMEV');
    const tpcsepe = document.getElementById('TPCSEPE');

    function actualizarTotal() {
        const valorComprometidoEMCO = parseFloat(comprometidoEMCO.value) || 0;
        const valorComprometidoMAOB = parseFloat(comprometidoMAOB.value) || 0;
        const valorComprometidoEMEV = parseFloat(comprometidoEMEV.value) || 0;
        tpcsepe.value = valorComprometidoEMCO + valorComprometidoMAOB + valorComprometidoEMEV;
    }

    comprometidoEMCO.addEventListener('input', actualizarTotal);
    comprometidoMAOB.addEventListener('input', actualizarTotal);
    comprometidoEMEV.addEventListener('input', actualizarTotal);
});
//---------------------------

document.addEventListener('DOMContentLoaded', function() {
    const disponibleMAOB = document.getElementById('DisponibleMAOB');
    const disponibleEMCO = document.getElementById('DisponibleEMCO');
    const disponibleEMEV = document.getElementById('DisponibleEMEV');
    const tpdsepe = document.getElementById('TPDSEPE');

    function actualizarTotal() {
        const valorDisponibleEMCO = parseFloat(disponibleEMCO.value) || 0;
        const valorDisponibleMAOB = parseFloat(disponibleMAOB.value) || 0;
        const valorDisponibleEMEV = parseFloat(disponibleEMEV.value) || 0;
        tpdsepe.value = valorDisponibleEMCO + valorDisponibleMAOB + valorDisponibleEMEV;
    }

    disponibleEMCO.addEventListener('input', actualizarTotal);
    disponibleMAOB.addEventListener('input', actualizarTotal);
    disponibleEMEV.addEventListener('input', actualizarTotal);
});


//-----------------------------------------------------------------------------
//-------------------Materiales y Suministros-------------------------------
//----------------------------------------------------------------------

document.addEventListener('DOMContentLoaded', function() {
    const comprometidoPRES = document.getElementById('ComprometidoPRES');
    const comprometidoMAOP = document.getElementById('ComprometidoMAOP');
    const tpcmasu = document.getElementById('TPCMASU');

    function actualizarTotal() {
        const valorComprometidoPRES = parseFloat(comprometidoPRES.value) || 0;
        const valorComprometidoMAOP = parseFloat(comprometidoMAOP.value) || 0;
        tpcmasu.value = valorComprometidoPRES + valorComprometidoMAOP;
    }

    comprometidoPRES.addEventListener('input', actualizarTotal);
    comprometidoMAOP.addEventListener('input', actualizarTotal);
});
//---------------------------

document.addEventListener('DOMContentLoaded', function() {
    const disponiblePRES = document.getElementById('DisponiblePRES');
    const disponibleMAOP = document.getElementById('DisponibleMAOP');
    const tpdmasu = document.getElementById('TPDMASU');

    function actualizarTotal() {
        const valorDisponiblePRES = parseFloat(disponiblePRES.value) || 0;
        const valorDisponibleMAOP = parseFloat(disponibleMAOP.value) || 0;
        tpdmasu.value = valorDisponiblePRES + valorDisponibleMAOP;
    }

    disponiblePRES.addEventListener('input', actualizarTotal);
    disponibleMAOP.addEventListener('input', actualizarTotal);
});


//-----------------------------------------------------------------------------
//-------------------Servicios Generales-----------------------------------------------
//----------------------------------------------------------------------

document.addEventListener('DOMContentLoaded', function() {
    const comprometidoPRES = document.getElementById('ComprometidoPREM');
    const comprometidoMAOP = document.getElementById('ComprometidoMACO');
    const comprometidoIMDE = document.getElementById('ComprometidoIMDE');
    const comprometidoSEFI = document.getElementById('ComprometidoSEFI');
    const comprometidoSERBA = document.getElementById('ComprometidoSERBA');
    const comprometidoTRAN = document.getElementById('ComprometidoTRAN');
    const comprometidoGARE = document.getElementById('ComprometidoGARE');
    const tpcsege = document.getElementById('TPCSEGE');

    function actualizarTotal() {
        const valorComprometidoPRES = parseFloat(comprometidoPRES.value) || 0;
        const valorComprometidoMAOP = parseFloat(comprometidoMAOP.value) || 0;
        const valorComprometidoIMDE = parseFloat(comprometidoIMDE.value) || 0;
        const valorComprometidoSEFI = parseFloat(comprometidoSEFI.value) || 0;
        const valorComprometidoSERBA = parseFloat(comprometidoSERBA.value) || 0;
        const valorComprometidoTRAN = parseFloat(comprometidoTRAN.value) || 0;
        const valorComprometidoGARE = parseFloat(comprometidoGARE.value) || 0;
        tpcsege.value = valorComprometidoPRES + valorComprometidoMAOP + valorComprometidoIMDE + valorComprometidoSEFI + valorComprometidoSERBA + valorComprometidoTRAN + valorComprometidoGARE;
    }

    comprometidoPRES.addEventListener('input', actualizarTotal);
    comprometidoMAOP.addEventListener('input', actualizarTotal);
    comprometidoIMDE.addEventListener('input', actualizarTotal);
    comprometidoSEFI.addEventListener('input', actualizarTotal);
    comprometidoSERBA.addEventListener('input', actualizarTotal);
    comprometidoTRAN.addEventListener('input', actualizarTotal);
    comprometidoGARE.addEventListener('input', actualizarTotal);
});
//---------------------------

document.addEventListener('DOMContentLoaded', function() {
    const disponiblePREM = document.getElementById('DisponiblePREM');
    const disponibleMACO = document.getElementById('DisponibleMACO');
    const disponibleIMDE = document.getElementById('DisponibleIMDE');
    const disponibleSEFI = document.getElementById('DisponibleSEFI');
    const disponibleSERBA = document.getElementById('DisponibleSERBA');
    const disponibleTRAN = document.getElementById('DisponibleTRAN');
    const disponibleGARE = document.getElementById('DisponibleGARE');
    const tpdsege = document.getElementById('TPDSEGE');

    function actualizarTotal() {
        const valorDisponiblePRES = parseFloat(disponiblePREM.value) || 0;
        const valorDisponibleMAOP = parseFloat(disponibleMACO.value) || 0;
        const valorDisponibleIMDE = parseFloat(disponibleIMDE.value) || 0;
        const valorDisponibleSEFI = parseFloat(disponibleSEFI.value) || 0;
        const valorDisponibleSERBA = parseFloat(disponibleSERBA.value) || 0;
        const valorDisponibleTRAN = parseFloat(disponibleTRAN.value) || 0;
        const valorDisponibleGARE = parseFloat(disponibleGARE.value) || 0;
        tpdsege.value = valorDisponiblePRES + valorDisponibleMAOP + valorDisponibleIMDE + valorDisponibleSEFI + valorDisponibleSERBA + valorDisponibleTRAN + valorDisponibleGARE;
    }

    disponiblePREM.addEventListener('input', actualizarTotal);
    disponibleMACO.addEventListener('input', actualizarTotal);
    disponibleIMDE.addEventListener('input', actualizarTotal);
    disponibleSEFI.addEventListener('input', actualizarTotal);
    disponibleSERBA.addEventListener('input', actualizarTotal);
    disponibleTRAN.addEventListener('input', actualizarTotal);
    disponibleGARE.addEventListener('input', actualizarTotal);
});

