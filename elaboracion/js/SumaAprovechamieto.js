document.addEventListener('DOMContentLoaded', function() {
    const FTP = document.getElementById('ProduccionFTP');
    const ATP = document.getElementById('ProduccionATP');
    const total = document.getElementById('TotalProduccion');

    function actualizarTotal() {
        const valorFTP = parseFloat(FTP.value) || 0;
        const valorATP = parseFloat(ATP.value) || 0;
        total.value = valorFTP + valorATP;
    }

    FTP.addEventListener('input', actualizarTotal);
    ATP.addEventListener('input', actualizarTotal);
});